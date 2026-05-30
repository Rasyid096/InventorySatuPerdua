<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_master', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->unsignedBigInteger('satuan_id');
            $table->integer('stok_saat_ini')->default(0);
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_master');
    }
};
