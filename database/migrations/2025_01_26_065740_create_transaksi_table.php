<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel transaksi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi'); // Kolom id_transaksi dengan auto increment
            $table->string('siswa_NISN', 10); // Kolom siswa_NISN yang merujuk ke NISN di tabel siswa
            $table->foreign('siswa_NISN')->references('NISN')->on('siswa')->onDelete('cascade'); // Foreign key ke tabel siswa
            
            $table->unsignedBigInteger('barang_id'); // Kolom barang_id yang merujuk ke id di tabel barang
            $table->foreign('barang_id')->references('id_barang')->on('barang')->onDelete('cascade'); // Foreign key ke tabel barang
            
            $table->integer('jumlah'); // Kolom jumlah yang menyimpan banyaknya barang yang dipinjam
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam'); // Kolom status transaksi
            $table->timestamp('tanggal_transaksi')->useCurrent(); // Kolom tanggal_transaksi dengan default current timestamp
            $table->date('tanggal_kembali')->nullable();

            // Menambahkan indeks dan foreign keys
            $table->timestamps(0); // Kolom created_at dan updated_at jika diperlukan
        });
    }

    /**
     * Membatalkan migration untuk menghapus tabel transaksi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
