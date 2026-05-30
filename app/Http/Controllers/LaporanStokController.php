<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanStokController extends Controller
{
    // Fungsi inti untuk mengambil data berdasarkan filter
    private function getDataByFilter(Request $request)
    {
        $query = DB::table('barang_master as bm')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('bm.id', 'bm.nama_barang', 'bm.stok_saat_ini as jumlah', 'sb.nama_satuan as satuan', 'bm.foto', 'bm.updated_at as tanggal');

        if ($request->has('filter')) {
            $filter = $request->filter;

            if ($filter == 'hari_ini') {
                $query->whereDate('bm.updated_at', Carbon::today());
            } elseif ($filter == 'minggu') {
                $query->whereDate('bm.updated_at', '>=', Carbon::now()->subDays(7));
            } elseif ($filter == 'bulan') {
                $query->whereDate('bm.updated_at', '>=', Carbon::now()->subDays(30));
            } elseif ($filter == 'custom') {
                $mulai = $request->tanggal_mulai;
                $sampai = $request->tanggal_sampai;
                if($mulai && $sampai) {
                    $query->whereBetween('bm.updated_at', [$mulai, $sampai]);
                }
            }
        }

        return $query->orderBy('bm.nama_barang', 'asc')->get();
    }

    // 1. Menampilkan Halaman Laporan Stok
    public function index(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $filter_aktif = $request->has('filter');
        
        return view('admin.laporan_stok', [
            'data_laporan' => $data_laporan,
            'filter_aktif' => $filter_aktif,
            'request' => $request 
        ]);
    }

    // 2. Fungsi Cetak (PDF / Print Browser)
    public function cetak(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        return view('admin.cetak_stok', ['data_laporan' => $data_laporan, 'request' => $request]);
    }

    // 3. Fungsi Export ke Excel (Format CSV)
    public function export(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $fileName = 'Laporan_Stok_1_2_KopiTiam_' . date('Ymd_His') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No', 'Nama Barang', 'Sisa Stok', 'Satuan', 'Tanggal');

        $callback = function() use($data_laporan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data_laporan as $index => $item) {
                $row['No']      = $index + 1;
                $row['Nama']    = $item->nama_barang;
                $row['Stok']    = $item->jumlah;
                $row['Satuan']  = $item->satuan;
                $row['Tanggal'] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');

                fputcsv($file, array($row['No'], $row['Nama'], $row['Stok'], $row['Satuan'], $row['Tanggal']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}