<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_updated_at_to_siswa_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedAtToSiswaTable extends Migration
{
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable(); // Menambahkan kolom updated_at
        });
    }

    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('updated_at'); // Menghapus kolom updated_at jika rollback
        });
    }
}
