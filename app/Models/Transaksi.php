<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Nama tabel di database.
    protected $table = 'transaksis';

    // 
    // Primary key tabel.
    // Karena kita pakai id_transaksi, bukan id.
    //
    protected $primaryKey = 'id_transaksi';

    //
    // Kolom yang boleh diisi.
    // Ini diperlukan kalau nanti pakai Transaksi::create([...])
    //
    protected $fillable = [
        'kode_transaksi',
        'role',
        'nama_toko',
        'foto_toko',
        'nama_penyewa',
        'foto_penyewa',
        'nama_produk',
        'foto_produk',
        'varian',
        'jumlah',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'total_harga',
        'status',
    ];
}
