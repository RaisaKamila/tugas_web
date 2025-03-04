<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel barang.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang'); // Membuat kolom id_barang dengan auto increment
            $table->string('nama_barang', 100); // Kolom nama_barang
            $table->text('deskripsi')->nullable(); // Kolom deskripsi (nullable)
            $table->integer('stok'); // Kolom stok
            $table->timestamps(0); // Untuk kolom created_at dan updated_at, menonaktifkan default timestamp

            // Menambahkan kolom dibuat_pada dan diperbarui_pada
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('diperbarui_pada')->useCurrent()->nullable()->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Membatalkan migration untuk menghapus tabel barang.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
