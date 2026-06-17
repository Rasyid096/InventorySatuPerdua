<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update semua user dengan role "Kepala Cabang" menjadi "Admin"
        DB::table('users')
            ->where('hak_akses', 'Kepala Cabang')
            ->update(['hak_akses' => 'Admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak dapat di-reverse karena kita tidak tahu user mana yang sebelumnya "Kepala Cabang"
        // Data sudah digabung ke role "Admin"
    }
};
