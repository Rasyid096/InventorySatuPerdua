<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BackupController extends Controller
{
    public function index()
    {
        if (auth()->user()?->hak_akses == 'Karyawan') {
            return abort(403, 'Akses Ditolak! Halaman ini hanya untuk Administrator.');
        }

        $nama_db = env('DB_DATABASE', 'users');
        $tables = DB::select('SHOW TABLES');
        $jumlah_tabel = count($tables);

        return view('admin.backup', [
            'nama_db' => $nama_db,
            'jumlah_tabel' => $jumlah_tabel,
        ]);
    }

    public function download()
    {
        if (auth()->user()?->hak_akses == 'Karyawan') {
            return abort(403, 'Anda tidak memiliki izin mengunduh database.');
        }

        $database_name = env('DB_DATABASE');
        $tables = DB::select('SHOW TABLES');
        $property = 'Tables_in_'.$database_name;
        $cabangAktif = session('cabang_aktif', auth()->user()?->cabang_id ?? 1);

        $sql_content = "-- --------------------------------------------------------\n";
        $sql_content .= "-- Backup Database Sistem Stok 1/2 Kopi Tiam\n";
        $sql_content .= "-- Tanggal Eksport: ".date('d-m-Y H:i:s')."\n";
        $sql_content .= "-- Cabang Aktif: ".(session('cabang_aktif_nama') ?? 'Cabang')."\n";
        $sql_content .= "-- --------------------------------------------------------\n\n";
        $sql_content .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $table_name = $table->$property;
            $create_table_query = DB::select("SHOW CREATE TABLE `$table_name`")[0];
            $sql_content .= "DROP TABLE IF EXISTS `$table_name`;\n";
            $sql_content .= $create_table_query->{'Create Table'}.";\n\n";

            $rowsQuery = DB::table($table_name);
            if (Schema::hasColumn($table_name, 'cabang_id')) {
                $rowsQuery->where('cabang_id', $cabangAktif);
            }
            $rows = $rowsQuery->get();

            foreach ($rows as $row) {
                $row_array = (array) $row;
                $columns = array_keys($row_array);
                $values = array_map(function ($value) {
                    if (is_null($value)) {
                        return 'NULL';
                    }
                    return "'".addslashes($value)."'";
                }, array_values($row_array));

                $sql_content .= "INSERT INTO `$table_name` (`".implode('`, `', $columns)."`) VALUES (".implode(', ', $values).");\n";
            }
            $sql_content .= "\n-- --------------------------------------------------------\n\n";
        }

        $sql_content .= "SET FOREIGN_KEY_CHECKS=1;\n";

        $file_name = 'Backup_Database_'.$database_name.'_Cabang_'.$cabangAktif.'_'.date('Ymd_His').'.sql';

        return response($sql_content)
            ->header('Content-Type', 'application/sql')
            ->header('Content-Disposition', "attachment; filename=\"$file_name\"");
    }
}
