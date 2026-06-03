<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class RiwayatTransaksiController extends Controller
{
    
    // Riwayat Transaksi Penyewa
    public function penyewa(Request $request)
    {
        $statusAktif = $request->query('status', 'semua');

        $filters = [
            'semua' => 'Semua',
            'diproses' => 'Diproses',
            'disewa' => 'Disewa',
            'pengembalian' => 'Pengembalian',
            'selesai' => 'Selesai',
            'bermasalah' => 'Bermasalah',
        ];

        $query = Transaksi::where('role', 'penyewa');

        if ($statusAktif !== 'semua') {
            if ($statusAktif === 'diproses') {
                $query->whereIn('status', [
                    'menunggu_pembayaran',
                    'pembayaran_berhasil',
                    'diproses',
                    'dikirim',
                    'menunggu_penerimaan',
                ]);
            } elseif ($statusAktif === 'bermasalah') {
                $query->whereIn('status', [
                    'dibatalkan',
                    'belum_dikembalikan',
                    'kerusakan',
                ]);
            } else {
                $query->where('status', $statusAktif);
            }
        }

        $transaksis = $query->latest()->paginate(5)->withQueryString();

        return view('pages.transactions.transactions history.riwayatTransaksiPenyewa', compact(
            'transaksis',
            'filters',
            'statusAktif'
        ));
    }

    // Riwayat Transaksi Pemilik
    public function pemilik(Request $request)
    {
        $statusAktif = $request->query('status', 'semua');

        $filters = [
            'semua' => 'Semua',
            'pesanan_masuk' => 'Pesanan Masuk',
            'disewa' => 'Disewa',
            'pengembalian' => 'Pengembalian',
            'selesai' => 'Selesai',
            'bermasalah' => 'Bermasalah',
        ];

        $query = Transaksi::where('role', 'pemilik');

        if ($statusAktif !== 'semua') {
            if ($statusAktif === 'pesanan_masuk') {
                $query->whereIn('status', [
                    'pesanan_masuk',
                    'pembayaran_berhasil',
                    'diproses',
                ]);
            } elseif ($statusAktif === 'disewa') {
                $query->whereIn('status', [
                    'dikirim',
                    'menunggu_penerimaan',
                    'disewa',
                ]);
            } elseif ($statusAktif === 'bermasalah') {
                $query->whereIn('status', [
                    'dibatalkan',
                    'belum_dikembalikan',
                    'kerusakan',
                ]);
            } else {
                $query->where('status', $statusAktif);
            }
        }

        $transaksis = $query->latest()->paginate(5)->withQueryString();

        return view('pages.transactions.transactions history.riwayatTransaksiPemilik', compact(
            'transaksis',
            'filters',
            'statusAktif'
        ));
    }

    // Detail Transaksi
    public function detail($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.transactions.transactions detail.detailTransaksi', compact('transaksi'));    }

    // Penyewa - konfirmasi Penerimaan
    public function formKonfirmasiPenerimaan($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.confirmation.konfirmasiPenerimaan', compact('transaksi'));    }

    public function simpanKonfirmasiPenerimaan(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'disewa',
        ]);

        return redirect()
            ->route('riwayat.transaksi.penyewa')
            ->with('success', 'Penerimaan berhasil dikonfirmasi. Status transaksi berubah menjadi Disewa.');
    }

    //  Penyewa - Perpanjangan Sewa
    public function formPerpanjanganSewa($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.perpanjanganSewa.perpanjanganSewa', compact('transaksi'));    }

    public function simpanPerpanjanganSewa(Request $request, $id)
    {
        $request->validate([
            'tanggal_selesai' => 'required|date',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'disewa',
        ]);

        return redirect()
            ->route('transaksi.detail', $transaksi->id_transaksi)
            ->with('success', 'Perpanjangan sewa berhasil. Tanggal pengembalian terbaru telah diperbarui.');
    }

    // Penyewa - Pesanan Dikembalikan
    public function formPesananDikembalikan($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.confirmation.pesananDikembalikan', compact('transaksi'));    }

    public function simpanPesananDikembalikan(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'pengembalian',
        ]);

        return redirect()
            ->route('riwayat.transaksi.penyewa')
            ->with('success', 'Pesanan berhasil ditandai dikembalikan. Status berubah menjadi Pengembalian.');
    }

    // Pemilik - Konfirmasi Pengiriman
    public function formKonfirmasiPengiriman($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.confirmation.konfirmasiPengriman', compact('transaksi'));    }

    public function simpanKonfirmasiPengiriman(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'menunggu_penerimaan',
        ]);

        return redirect()
            ->route('riwayat.transaksi.pemilik')
            ->with('success', 'Pengiriman berhasil dikonfirmasi. Status transaksi menunggu penerimaan penyewa.');
    }

    // Pemilik - Konfirmasi Penyerahan COD
    public function formKonfirmasiPenyerahan($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.confirmation.konfirmasiPenyerahan', compact('transaksi'));    }

    public function simpanKonfirmasiPenyerahan(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'menunggu_penerimaan',
        ]);

        return redirect()
            ->route('riwayat.transaksi.pemilik')
            ->with('success', 'Penyerahan berhasil dikonfirmasi. Status transaksi menunggu penerimaan penyewa.');
    }

    // Pemilik - Konfirmasi Pengembalian
    public function formKonfirmasiPengembalian($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.confirmation.konfirmasiPengembalian', compact('transaksi'));    }

    public function simpanKonfirmasiPengembalian(Request $request, $id)
    {
        $request->validate([
            'kondisi_barang' => 'required|in:aman,rusak',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if ($request->kondisi_barang === 'aman') {
            $transaksi->update([
                'status' => 'selesai',
            ]);

            return redirect()
                ->route('riwayat.transaksi.pemilik')
                ->with('success', 'Pengembalian berhasil dikonfirmasi. Status transaksi berubah menjadi Selesai.');
        }

        $transaksi->update([
            'status' => 'kerusakan',
        ]);

        return redirect()
            ->route('transaksi.formPengajuanKerusakan', $transaksi->id_transaksi)
            ->with('success', 'Barang ditandai mengalami kerusakan. Silakan ajukan klaim kerusakan.');
    }

    // Pemilik - Pengajuan Kerusakan
    public function formPengajuanKerusakan($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.damage submission.pengajuanKerusakan', compact('transaksi'));    }

    public function simpanPengajuanKerusakan(Request $request, $id)
    {
        $request->validate([
            'jenis_kerusakan' => 'required|string|max:100',
            'bagian_rusak' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'biaya_perbaikan' => 'required|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'kerusakan',
        ]);

        return redirect()
            ->route('riwayat.transaksi.pemilik')
            ->with('success', 'Klaim kerusakan berhasil diajukan dan menunggu tanggapan penyewa.');
    }

    // Klaim Kerusakan
    public function lihatKlaim($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        return view('pages.damage submission.klaimKerusakan', compact('transaksi'));    }
}