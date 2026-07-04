<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $cabangs = [
            ['id' => 3, 'nama_cabang' => 'Stand Event'],
            ['id' => 4, 'nama_cabang' => 'Galeri'],
            ['id' => 6, 'nama_cabang' => 'Petani'],
        ];

        foreach ($cabangs as $cabang) {
            $exists = DB::table('cabang')->where('id', $cabang['id'])->exists();
            if (!$exists) {
                DB::table('cabang')->insert([
                    'id' => $cabang['id'],
                    'nama_cabang' => $cabang['nama_cabang'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('cabang')->whereIn('id', [3, 4, 6])->delete();
    }
};