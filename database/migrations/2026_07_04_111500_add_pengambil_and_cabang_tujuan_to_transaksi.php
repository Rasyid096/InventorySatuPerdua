<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi_stok', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksi_stok', 'nama_pengambil_barang')) {
                $table->string('nama_pengambil_barang')->nullable()->after('foto');
            }
            if (!Schema::hasColumn('transaksi_stok', 'cabang_tujuan_id')) {
                $table->foreignId('cabang_tujuan_id')->nullable()->after('nama_pengambil_barang')->constrained('cabang')->cascadeOnUpdate()->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_stok', function (Blueprint $table) {
            if (Schema::hasColumn('transaksi_stok', 'cabang_tujuan_id')) {
                $table->dropConstrainedForeignId('cabang_tujuan_id');
            }
            if (Schema::hasColumn('transaksi_stok', 'nama_pengambil_barang')) {
                $table->dropColumn('nama_pengambil_barang');
            }
        });
    }
};