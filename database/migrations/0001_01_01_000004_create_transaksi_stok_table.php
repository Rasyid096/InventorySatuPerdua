<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang_master')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('jenis', ['Masuk', 'Keluar']);
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->bigInteger('harga_total')->default(0);
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_stok');
    }
};
