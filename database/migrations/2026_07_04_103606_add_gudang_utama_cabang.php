<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $exists = DB::table('cabang')->where('id', 5)->exists();
        if (!$exists) {
            DB::table('cabang')->insert([
                'id' => 5,
                'nama_cabang' => 'Gudang Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('cabang')->where('id', 5)->where('nama_cabang', 'Gudang Utama')->delete();
    }
};