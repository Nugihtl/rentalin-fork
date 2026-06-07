<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Installment;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        // Verifikasi keaslian notifikasi dari Midtrans
        if ($hashed == $request->signature_key) {
            
            // Jika pembayaran berhasil (settlement/capture)
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {

                // Jika pembayaran berhasil (settlement/capture)
                
                // -----------------------------------------------------------
                // 1. LOGIKA UNTUK PEMBAYARAN PERPANJANGAN SEWA (TAMBAHKAN DI SINI)
                // -----------------------------------------------------------
                // --- LOGIKA UNTUK PEMBAYARAN PERPANJANGAN SEWA ---
                if (str_starts_with($request->order_id, 'EXT-')) {
                    $extension = \App\Models\RentalExtension::where('order_id', $request->order_id)->first();
                    
                    if ($extension && $extension->payment_status !== 'paid') {
                        $extension->update([
                            'payment_status' => $extension->payment_type === 'paylater' ? 'paylater_aktif' : 'paid'
                        ]);
                        
                        $rental = \App\Models\Rental::find($extension->rental_id);
                        if ($rental) {
                            // Perbarui tanggal akhir DAN tambahkan total harga
                            $rental->update([
                                'end_date' => $extension->new_end_date,
                                'total_price' => $rental->total_price + $extension->extension_price
                            ]);
                        }
                    }
                    return response()->json(['message' => 'Notifikasi perpanjangan berhasil diproses']);
                }
                // --- AKHIR LOGIKA PERPANJANGAN ---
                // -----------------------------------------------------------
                

                // 2. Ekstrak ID Rental dari order_id (Format: RENTAL-{id}-TERM-{term}-{time})
                preg_match('/RENTAL-(\d+)/', $request->order_id, $rentalMatches);
                if (!isset($rentalMatches[1])) {
                    return response()->json(['message' => 'Format order_id tidak dikenali']);
                }
                
                // 1. Ekstrak ID Rental dari order_id (Format: RENTAL-{id}-TERM-{term}-{time})
                preg_match('/RENTAL-(\d+)/', $request->order_id, $rentalMatches);
                if (!isset($rentalMatches[1])) {
                    return response()->json(['message' => 'Format order_id tidak dikenali']);
                }
                
                $rentalId = $rentalMatches[1];
                $payment = Payment::where('rental_id', $rentalId)->first();

                if (!$payment) {
                    return response()->json(['message' => 'Data payment tidak ditemukan']);
                }

                // 2. Jika transaksi ini adalah Cicilan (Paylater)
                if ($payment->payment_type == 'paylater') {
                    
                    // Ekstrak termin ke berapa yang sedang dibayar
                    preg_match('/-TERM-(\d+)-/', $request->order_id, $termMatches);
                    $termNumber = isset($termMatches[1]) ? (int) $termMatches[1] : 1;

                    // Cari baris cicilan yang sesuai
                    $installment = Installment::where('payment_id', $payment->id)
                        ->where('term_number', $termNumber)
                        ->first();

                    if ($installment && $installment->status !== 'paid') {
                        
                        // Tandai cicilan ini lunas
                        $installment->update([
                            'status' => 'paid',
                            'paid_at' => now()
                        ]);

                        // Tambahkan jumlah cicilan yang sudah dibayar pada tabel payment utama
                        $payment->increment('installment_paid');

                        // Jika ini pembayaran pertama (DP), ubah status rental menjadi diproses
                        if ($termNumber == 1) {
                            $payment->rental->update(['status' => 'diproses']);
                        }

                        // Cek apakah semua cicilan sudah lunas secara keseluruhan
                        if ($payment->installment_paid >= $payment->installment_plan) {
                            $payment->update([
                                'payment_status' => 'paid',
                                'status' => 'paid'
                            ]);
                        } else {
                            $payment->update([
                                'payment_status' => 'partially_paid',
                                'status' => 'pending' // Status transaksi utama masih berjalan
                            ]);
                        }
                    }

                } else {
                    // 3. Jika ini adalah transaksi Bayar Penuh (Full)
                    if ($payment->payment_status !== 'paid') {
                        $payment->update([
                            'payment_status' => 'paid',
                            'status' => 'paid'
                        ]);
                        $payment->rental->update(['status' => 'diproses']);
                    }
                }
            }
        }

        return response()->json(['message' => 'Callback berhasil diproses']);
    }

    public function demoSuccess(Rental $rental)
    {
        DB::transaction(function () use ($rental) {

            $payment = Payment::where(
                'rental_id',
                $rental->id
            )->firstOrFail();

            $payment->payment_status = 'paid';
            $payment->status = 'paid';

            $payment->save();

            $rental->status =
                'pesanan_masuk';

            $rental->save();
        });

        return redirect()
            ->route(
                'riwayat.transaksi.penyewa'
            )
            ->with(
                'success',
                'Pembayaran berhasil.'
            );
    }
}