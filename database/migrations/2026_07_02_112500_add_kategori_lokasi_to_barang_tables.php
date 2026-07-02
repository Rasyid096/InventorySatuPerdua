<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_master', function (Blueprint $table) {
            $table->enum('kategori_lokasi', ['Bar', 'Dapur'])->default('Bar')->after('stok_saat_ini');
        });

        Schema::table('preset_barang', function (Blueprint $table) {
            $table->enum('kategori_lokasi', ['Bar', 'Dapur'])->default('Bar')->after('nama_barang');
        });
    }

    public function down(): void
    {
        Schema::table('preset_barang', function (Blueprint $table) {
            $table->dropColumn('kategori_lokasi');
        });

        Schema::table('barang_master', function (Blueprint $table) {
            $table->dropColumn('kategori_lokasi');
        });
    }
};
