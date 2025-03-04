<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'id_barang'; // Menentukan primary key
    public $timestamps = false; // Disable timestamps jika kamu tidak ingin menggunakan created_at dan updated_at otomatis

    protected $fillable = [
        'nama_barang', 'deskripsi', 'stok'
    ];
}
