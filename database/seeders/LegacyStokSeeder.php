<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LegacyStokSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('satuan_barang') || !Schema::hasTable('barang_master') || !Schema::hasTable('transaksi_stok')) {
            return;
        }

        if (DB::table('satuan_barang')->count() === 0) {
            DB::table('satuan_barang')->insert([
                ['nama_satuan' => 'Kilogram'],
                ['nama_satuan' => 'Liter'],
                ['nama_satuan' => 'Pcs'],
                ['nama_satuan' => 'Pack'],
            ]);
        }

        if (DB::table('barang_master')->count() === 0) {
            $satuanByName = DB::table('satuan_barang')->pluck('id', 'nama_satuan');

            DB::table('barang_master')->insert([
                [
                    'nama_barang' => 'Susu Evaporasi',
                    'satuan_id' => $satuanByName['Pack'] ?? 1,
                    'stok_saat_ini' => 12,
                    'foto' => null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],
                [
                    'nama_barang' => 'Biji Kopi Arabika',
                    'satuan_id' => $satuanByName['Kilogram'] ?? 1,
                    'stok_saat_ini' => 8,
                    'foto' => null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ],
            ]);
        }

        if (DB::table('transaksi_stok')->count() === 0) {
            $barangSusu = DB::table('barang_master')->where('nama_barang', 'Susu Evaporasi')->value('id');
            if ($barangSusu) {
                DB::table('transaksi_stok')->insert([
                    'barang_id' => $barangSusu,
                    'jenis' => 'Masuk',
                    'tanggal' => now()->toDateString(),
                    'jumlah' => 12,
                    'harga_total' => 0,
                    'foto' => null,
                    'catatan' => 'Data awal sistem',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
