<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('hak_akses', 'Owner')->update(['hak_akses' => 'Super Admin']);
    }

    public function down(): void
    {
        DB::table('users')->where('hak_akses', 'Super Admin')->update(['hak_akses' => 'Owner']);
    }
};
