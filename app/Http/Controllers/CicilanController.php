<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Installment;
use Carbon\Carbon;

class CicilanController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'belum_lunas');
        $user = Auth::user();

        // 1. Query Pembayaran Paylater milik User
        $query = Payment::where('payment_type', 'paylater')
            ->whereHas('rental', function($q) use ($user) {
                $q->where('tenant_id', $user->id);
            })
            ->with(['rental.item', 'rental.owner', 'installments']);

        // 2. Filter Tab
        if ($tab === 'selesai') {
            $payments = $query->where('payment_status', 'paid')->get();
        } else {
            $payments = $query->whereIn('payment_status', ['pending', 'partially_paid', 'overdue'])->get();
        }

        // 3. Hitung Ringkasan (Total tagihan yang belum lunas)
        $totalTagihan = Installment::whereIn('status', ['pending', 'overdue'])
            ->whereHas('payment.rental', function($q) use ($user) {
                $q->where('tenant_id', $user->id);
            })
            ->sum('amount');

        $jatuhTempoTerdekat = Installment::whereIn('status', ['pending', 'overdue'])
            ->whereHas('payment.rental', function($q) use ($user) {
                $q->where('tenant_id', $user->id);
            })
            ->orderBy('due_date', 'asc')
            ->value('due_date');

        $summary = [
            'total_tagihan' => $totalTagihan,
            'jatuh_tempo_terdekat' => $jatuhTempoTerdekat ? Carbon::parse($jatuhTempoTerdekat)->format('d M Y') : '-',
        ];

        return view('pages.profile.cicilan.index', compact('user', 'tab', 'payments', 'summary'));
    }
}