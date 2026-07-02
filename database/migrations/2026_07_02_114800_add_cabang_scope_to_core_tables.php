<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_cabang');
            $table->timestamps();
        });

        DB::table('cabang')->insert([
            ['id' => 1, 'nama_cabang' => 'Sepakat 2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_cabang' => 'Reformasi', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->after('hak_akses')->constrained('cabang')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('barang_master', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->after('kategori_lokasi')->constrained('cabang')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('transaksi_stok', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->after('barang_id')->constrained('cabang')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->after('user_id')->constrained('cabang')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('preset_barang', function (Blueprint $table) {
            $table->foreignId('cabang_id')->nullable()->after('kategori_lokasi')->constrained('cabang')->cascadeOnUpdate()->restrictOnDelete();
        });

        DB::table('users')->update(['cabang_id' => 1]);
        DB::table('barang_master')->update(['cabang_id' => 1]);
        DB::table('transaksi_stok')->update(['cabang_id' => 1]);
        DB::table('activity_logs')->update(['cabang_id' => 1]);
        DB::table('preset_barang')->update(['cabang_id' => 1]);

        DB::statement('ALTER TABLE users MODIFY cabang_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE barang_master MODIFY cabang_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE transaksi_stok MODIFY cabang_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE activity_logs MODIFY cabang_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE preset_barang MODIFY cabang_id BIGINT UNSIGNED NOT NULL');
    }

    public function down(): void
    {
        Schema::table('preset_barang', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cabang_id');
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cabang_id');
        });

        Schema::table('transaksi_stok', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cabang_id');
        });

        Schema::table('barang_master', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cabang_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cabang_id');
        });

        Schema::dropIfExists('cabang');
    }
};
