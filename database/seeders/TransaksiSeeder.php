<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Data Riwayat Transaksi Penyewa
        Transaksi::create([
            'kode_transaksi' => 'TRX-20260901-0042',
            'role' => 'penyewa',
            'nama_toko' => 'Vynelle Market',
            'foto_toko' => 'store-vynelle.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Tank M103 Counter Soviet Tahun 1960 Sekali Tembak Rata',
            'foto_produk' => 'tank.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-09-05',
            'tanggal_selesai' => '2026-09-08',
            'durasi' => 3,
            'total_harga' => 5000000,
            'status' => 'menunggu_penerimaan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260828-0187',
            'role' => 'penyewa',
            'nama_toko' => 'Vynelle Market',
            'foto_toko' => 'store-vynelle.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Iphone 17 Pro Max',
            'foto_produk' => 'iphone.png',
            'varian' => '100 TB',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-08-28',
            'tanggal_selesai' => '2026-08-30',
            'durasi' => 2,
            'total_harga' => 400000,
            'status' => 'selesai',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260508-0001',
            'role' => 'penyewa',
            'nama_toko' => 'Vynelle Market',
            'foto_toko' => 'store-vynelle.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Kompor Listrik Portable',
            'foto_produk' => 'kompor-listrik.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-08',
            'tanggal_selesai' => '2026-05-12',
            'durasi' => 4,
            'total_harga' => 65000,
            'status' => 'disewa',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260510-0002',
            'role' => 'penyewa',
            'nama_toko' => 'Seliora Store',
            'foto_toko' => 'store-seliora.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Macbook Pro',
            'foto_produk' => 'macbook.png',
            'varian' => 'M4',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-10',
            'tanggal_selesai' => '2026-05-13',
            'durasi' => 3,
            'total_harga' => 500000,
            'status' => 'pengembalian',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260508-0003',
            'role' => 'penyewa',
            'nama_toko' => 'Vynelle Market',
            'foto_toko' => 'store-vynelle.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Kebaya One Set',
            'foto_produk' => 'kebaya.png',
            'varian' => 'Navy',
            'jumlah' => '4 Buah',
            'tanggal_mulai' => '2026-05-08',
            'tanggal_selesai' => '2026-05-10',
            'durasi' => 2,
            'total_harga' => 400000,
            'status' => 'dibatalkan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260507-0004',
            'role' => 'penyewa',
            'nama_toko' => 'Zenvy Market',
            'foto_toko' => 'store-zenvy.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Drum',
            'foto_produk' => 'drum.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-07',
            'tanggal_selesai' => '2026-05-10',
            'durasi' => 3,
            'total_harga' => 150000,
            'status' => 'belum_dikembalikan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260508-0005',
            'role' => 'penyewa',
            'nama_toko' => 'IBOX',
            'foto_toko' => 'store-ibox.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'I Watch',
            'foto_produk' => 'iwatch.png',
            'varian' => 'Gen 4',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-08',
            'tanggal_selesai' => '2026-05-12',
            'durasi' => 4,
            'total_harga' => 200000,
            'status' => 'kerusakan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260511-0006',
            'role' => 'penyewa',
            'nama_toko' => 'Velisse Shop',
            'foto_toko' => 'store-velisse.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Sony Alpha A6400',
            'foto_produk' => 'sony-a6400.png',
            'varian' => 'Black',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-11',
            'tanggal_selesai' => '2026-05-14',
            'durasi' => 3,
            'total_harga' => 300000,
            'status' => 'menunggu_pembayaran',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260512-0007',
            'role' => 'penyewa',
            'nama_toko' => 'Lunara Store',
            'foto_toko' => 'store-lunara.png',
            'nama_penyewa' => null,
            'foto_penyewa' => null,
            'nama_produk' => 'Kompor Listrik Portable',
            'foto_produk' => 'kompor-listrik.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-12',
            'tanggal_selesai' => '2026-05-15',
            'durasi' => 3,
            'total_harga' => 195000,
            'status' => 'pembayaran_berhasil',
        ]);
        
        // DATA RIWAYAT TRANSAKSI PEMILIK

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260828-0201',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Ayu Ratna',
            'foto_penyewa' => 'ayu.png',
            'nama_produk' => 'Iphone 17 Pro Max',
            'foto_produk' => 'iphone.png',
            'varian' => '100 TB',
            'jumlah' => '2 Buah',
            'tanggal_mulai' => '2026-08-28',
            'tanggal_selesai' => '2026-08-30',
            'durasi' => 2,
            'total_harga' => 200000,
            'status' => 'selesai',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260828-0202',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Tariq Hallilintar',
            'foto_penyewa' => 'tariq.png',
            'nama_produk' => 'Sepeda Gunung',
            'foto_produk' => 'sepeda.png',
            'varian' => 'Lipat',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-08-28',
            'tanggal_selesai' => '2026-08-30',
            'durasi' => 2,
            'total_harga' => 70000,
            'status' => 'pesanan_masuk',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260828-0203',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Nugra Hasahattan',
            'foto_penyewa' => 'nugra.png',
            'nama_produk' => 'Panci Listrik',
            'foto_produk' => 'panci.png',
            'varian' => null,
            'jumlah' => '2 Buah',
            'tanggal_mulai' => '2026-08-28',
            'tanggal_selesai' => '2026-08-30',
            'durasi' => 2,
            'total_harga' => 60000,
            'status' => 'disewa',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260509-0204',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Nugra Hasahattan',
            'foto_penyewa' => 'nugra.png',
            'nama_produk' => 'Coffee Maker',
            'foto_produk' => 'coffee-maker.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-09',
            'tanggal_selesai' => '2026-05-13',
            'durasi' => 4,
            'total_harga' => 100000,
            'status' => 'pengembalian',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260509-0205',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Nugra Hasahattan',
            'foto_penyewa' => 'nugra.png',
            'nama_produk' => 'Kamera Instax',
            'foto_produk' => 'kamera-instax.png',
            'varian' => 'Hitam',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-09',
            'tanggal_selesai' => '2026-05-13',
            'durasi' => 4,
            'total_harga' => 100000,
            'status' => 'dibatalkan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260507-0206',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Nugra Hasahattan',
            'foto_penyewa' => 'nugra.png',
            'nama_produk' => 'Raket Tenis',
            'foto_produk' => 'raket.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-07',
            'tanggal_selesai' => '2026-05-10',
            'durasi' => 3,
            'total_harga' => 75000,
            'status' => 'belum_dikembalikan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260508-0207',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Nugra Hasahattan',
            'foto_penyewa' => 'nugra.png',
            'nama_produk' => 'Iphone 16 Pro Max',
            'foto_produk' => 'iphone16.png',
            'varian' => 'Gen 4',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-08',
            'tanggal_selesai' => '2026-05-12',
            'durasi' => 4,
            'total_harga' => 200000,
            'status' => 'kerusakan',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260514-0208',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Ayu Ratna',
            'foto_penyewa' => 'ayu.png',
            'nama_produk' => 'Sony Alpha A6400',
            'foto_produk' => 'sony-a6400.png',
            'varian' => 'Black',
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-14',
            'tanggal_selesai' => '2026-05-16',
            'durasi' => 2,
            'total_harga' => 250000,
            'status' => 'pembayaran_berhasil',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-20260515-0209',
            'role' => 'pemilik',
            'nama_toko' => null,
            'foto_toko' => null,
            'nama_penyewa' => 'Tariq Hallilintar',
            'foto_penyewa' => 'tariq.png',
            'nama_produk' => 'Kompor Listrik Portable',
            'foto_produk' => 'kompor-listrik.png',
            'varian' => null,
            'jumlah' => '1 Buah',
            'tanggal_mulai' => '2026-05-15',
            'tanggal_selesai' => '2026-05-18',
            'durasi' => 3,
            'total_harga' => 195000,
            'status' => 'menunggu_penerimaan',
        ]);

    }
}
