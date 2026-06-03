<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Membuat tabel transaksi
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');

             // Kode transaksi, contoh: TRX-20260901-0042
            $table->string('kode_transaksi')->unique();

            // Role digunakan untuk membedakan tampilan penyewa dan pemilik
            $table->enum('role', ['penyewa', 'pemilik']);

            // Data toko, dipakai jika role penyewa
            $table->string('nama_toko')->nullable();
            $table->string('foto_toko')->nullable();

            // Data penyewa, dipakai jika role pemilik
            $table->string('nama_penyewa')->nullable();
            $table->string('foto_penyewa')->nullable();

            // Data produk
            $table->string('nama_produk');
            $table->string('foto_produk')->nullable();
            $table->string('varian')->nullable();
            $table->string('jumlah')->default('1 Buah');

            // Data tanggal sewa
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('durasi')->nullable();

            // Total harga transaksi
            $table->integer('total_harga')->default(0);

            /*
            Status disesuaikan dengan alur sistem:
            - Pemesanan & pembayaran
            - Serah terima / pengiriman
            - Disewa
            - Pengembalian
            - Bermasalah
            - Selesai
            */
            $table->enum('status', [
                'pesanan_masuk',
                'menunggu_pembayaran',
                'pembayaran_berhasil',
                'diproses',
                'dikirim',
                'menunggu_penerimaan',
                'disewa',
                'pengembalian',
                'belum_dikembalikan',
                'kerusakan',
                'dibatalkan',
                'selesai'
            ])->default('pesanan_masuk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // menghapus table jika rollback
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
