<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel
    protected $primaryKey = 'id_transaksi'; // Primary key
    public $timestamps = false;

    protected $fillable = [
        'siswa_nisn', // Pastikan ini ada
        'barang_id',
        'jumlah',
        'status',
        'tanggal_transaksi',
        'tanggal_kembali',
    ];
    // Mendefinisikan relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // Mendefinisikan relasi dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_NISN', 'NISN');
    }

}
