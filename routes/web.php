<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatTransaksiController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk halaman login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Halaman Dashboard setelah login
Route::get('/dashboard', function () {
    return view('dashboard'); // Atau buat dashboard rentalin Anda nanti
})->middleware(['auth', 'verified'])->name('dashboard');

// Profil pengguna 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk halaman riwayat transaksi.
Route::get('/riwayatTransaksiPenyewa', [RiwayatTransaksiController::class, 'penyewa'])
    ->name('riwayat.transaksi.penyewa');

Route::get('/riwayatTransaksiPemilik', [RiwayatTransaksiController::class, 'pemilik'])
    ->name('riwayat.transaksi.pemilik');

// Detail Transaksi
Route::get('/transaksi/{id}/detailTransaksi', [RiwayatTransaksiController::class, 'detail'])
    ->name('transaksi.detail');

// Penyewa - Konfirmasi Penerimaan
Route::get('/transaksi/{id}/konfirmasiPenerimaan', [RiwayatTransaksiController::class, 'formKonfirmasiPenerimaan'])
    ->name('transaksi.formKonfirmasiPenerimaan');

Route::put('/transaksi/{id}/konfirmasiPenerimaan', [RiwayatTransaksiController::class, 'simpanKonfirmasiPenerimaan'])
    ->name('transaksi.simpanKonfirmasiPenerimaan');

// Penyewa - Perpanjangan Sewa
Route::get('/transaksi/{id}/perpanjanganSewa', [RiwayatTransaksiController::class, 'formPerpanjanganSewa'])
    ->name('transaksi.formPerpanjanganSewa');

Route::put('/transaksi/{id}/perpanjanganSewa', [RiwayatTransaksiController::class, 'simpanPerpanjanganSewa'])
    ->name('transaksi.simpanPerpanjanganSewa');

// Penyewa - Pesanan Dikembalikan
Route::get('/transaksi/{id}/pesananDikembalikan', [RiwayatTransaksiController::class, 'formPesananDikembalikan'])
    ->name('transaksi.formPesananDikembalikan');

Route::put('/transaksi/{id}/pesananDikembalikan', [RiwayatTransaksiController::class, 'simpanPesananDikembalikan'])
    ->name('transaksi.simpanPesananDikembalikan');

// Pemilik - Konfirmasi Pengiriman
Route::get('/transaksi/{id}/konfirmasiPengiriman', [RiwayatTransaksiController::class, 'formKonfirmasiPengiriman'])
    ->name('transaksi.formKonfirmasiPengiriman');

Route::put('/transaksi/{id}/konfirmasiPengiriman', [RiwayatTransaksiController::class, 'simpanKonfirmasiPengiriman'])
    ->name('transaksi.simpanKonfirmasiPengiriman');

// Pemilik - Konfirmasi Penyerahan COD
Route::get('/transaksi/{id}/konfirmasiPenyerahan', [RiwayatTransaksiController::class, 'formKonfirmasiPenyerahan'])
    ->name('transaksi.formKonfirmasiPenyerahan');

Route::put('/transaksi/{id}/konfirmasiPenyerahan', [RiwayatTransaksiController::class, 'simpanKonfirmasiPenyerahan'])
    ->name('transaksi.simpanKonfirmasiPenyerahan');

// Pemilik - Konfirmasi Pengembalian
Route::get('/transaksi/{id}/konfirmasiPengembalian', [RiwayatTransaksiController::class, 'formKonfirmasiPengembalian'])
    ->name('transaksi.formKonfirmasiPengembalian');

Route::put('/transaksi/{id}/konfirmasiPengembalian', [RiwayatTransaksiController::class, 'simpanKonfirmasiPengembalian'])
    ->name('transaksi.simpanKonfirmasiPengembalian');

// Pemilik - Pengajuan Kerusakan
Route::get('/transaksi/{id}/pengajuanKerusakan', [RiwayatTransaksiController::class, 'formPengajuanKerusakan'])
    ->name('transaksi.formPengajuanKerusakan');

Route::put('/transaksi/{id}/pengajuanKerusakan', [RiwayatTransaksiController::class, 'simpanPengajuanKerusakan'])
    ->name('transaksi.simpanPengajuanKerusakan');

// Klaim Kerusakan
Route::get('/transaksi/{id}/klaimKerusakan', [RiwayatTransaksiController::class, 'lihatKlaim'])
    ->name('transaksi.lihatKlaim');

// Impor autentikasi Laravel bawaan
require __DIR__.'/auth.php';