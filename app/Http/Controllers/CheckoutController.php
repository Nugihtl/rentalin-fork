<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

public function index(Rental $rental)
{
    // Hanya owner atau tenant yang boleh membuka checkout
    if (
        $rental->tenant_id !== Auth::id() &&
        $rental->owner_id !== Auth::id()
    ) {
        abort(403, 'Akses ditolak.');
    }

    // Load relasi item
    $rental->load('item');

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.serverKey');
    Config::$isProduction = config('midtrans.isProduction');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Generate Order ID
    $orderId = "RENTAL-" . $rental->id . "-" . time();

    // Simpan payment jika belum ada
    $payment = Payment::firstOrCreate(
        [
            'rental_id' => $rental->id,
        ],
        [
            'order_id' => $orderId,
            'payment_method' => 'midtrans',
            'amount' => $rental->total_price,
            'status' => 'pending',
        ]
    );

    // Jika payment sudah ada tetapi belum punya order_id
    if (!$payment->order_id) {

        $payment->order_id = $orderId;
        $payment->save();
    }

    $params = [

        'transaction_details' => [

            'order_id' => $payment->order_id,

            'gross_amount' => (int) $payment->amount,

        ],

        'customer_details' => [

            'first_name' => Auth::user()->name,

            'email' => Auth::user()->email,

        ],

    ];

    $snapToken = Snap::getSnapToken($params);

    return view(
        'pages.checkout.checkout',
        compact(
            'rental',
            'payment',
            'snapToken'
        )
    );
}

}