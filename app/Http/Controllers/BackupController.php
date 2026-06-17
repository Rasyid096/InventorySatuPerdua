<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    // Menampilkan halaman backup
    public function index()
    {
        // Tambahkan tanda ? sebelum ->hak_akses
        if (auth()->user()?->hak_akses == 'Karyawan') {
            return abort(403, 'Akses Ditolak! Halaman ini hanya untuk Administrator.');
        }

        // ... (kode lama biarkan di bawahnya)
        $nama_db = env('DB_DATABASE', 'users');
        $tables = DB::select('SHOW TABLES');
        $jumlah_tabel = count($tables);

        return view('admin.backup', [
            'nama_db' => $nama_db,
            'jumlah_tabel' => $jumlah_tabel
        ]);
    }

    // Fungsi inti untuk mengunduh database (.sql) secara otomatis
    public function download()
    {
        // Tambahkan tanda ? sebelum ->hak_akses
        if (auth()->user()?->hak_akses == 'Karyawan') {
            return abort(403, 'Anda tidak memiliki izin mengunduh database.');
        }
        $database_name = env('DB_DATABASE');
        $tables = DB::select('SHOW TABLES');
        $property = 'Tables_in_' . $database_name;

        // Header file SQL
        $sql_content = "-- --------------------------------------------------------\n";
        $sql_content .= "-- Backup Database Sistem Stok 1/2 Kopi Tiam\n";
        $sql_content .= "-- Tanggal Eksport: " . date('d-m-Y H:i:s') . "\n";
        $sql_content .= "-- --------------------------------------------------------\n\n";
        $sql_content .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $table_name = $table->$property;

            // 1. Ambil Struktur Create Table
            $create_table_query = DB::select("SHOW CREATE TABLE `$table_name`")[0];
            $sql_content .= "DROP TABLE IF EXISTS `$table_name`;\n";
            $sql_content .= $create_table_query->{'Create Table'} . ";\n\n";

            // 2. Ambil Seluruh Data di dalam Tabel
            $rows = DB::table($table_name)->get();
            foreach ($rows as $row) {
                $row_array = (array)$row;
                $columns = array_keys($row_array);
                
                // Rapikan nilai string agar aman saat di-insert kembali
                $values = array_map(function ($value) {
                    if (is_null($value)) {
                        return 'NULL';
                    }
                    return "'" . addslashes($value) . "'";
                }, array_values($row_array));

                $sql_content .= "INSERT INTO `$table_name` (`" . implode("`, `", $columns) . "`) VALUES (" . implode(", ", $values) . ");\n";
            }
            $sql_content .= "\n-- --------------------------------------------------------\n\n";
        }

        $sql_content .= "SET FOREIGN_KEY_CHECKS=1;\n";

        // Generate nama file unik berdasarkan waktu saat ini
        $file_name = 'Backup_Database_' . $database_name . '_' . date('Ymd_His') . '.sql';

        // Kembalikan sebagai response download file
        return response($sql_content)
            ->header('Content-Type', 'application/sql')
            ->header('Content-Disposition', "attachment; filename=\"$file_name\"");
    }
}