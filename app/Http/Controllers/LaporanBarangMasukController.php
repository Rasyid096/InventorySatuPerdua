<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanBarangMasukController extends Controller
{
    private function getDataByFilter(Request $request)
    {
        $query = DB::table('transaksi_stok as ts')
            ->join('barang_master as bm', 'bm.id', '=', 'ts.barang_id')
            ->join('satuan_barang as sb', 'sb.id', '=', 'bm.satuan_id')
            ->select('ts.id', 'ts.tanggal', 'bm.nama_barang', 'ts.jumlah', 'sb.nama_satuan as satuan', 'ts.harga_total as harga', 'ts.foto')
            ->where('ts.jenis', 'Masuk');

        if ($request->has('filter')) {
            $filter = $request->filter;

            if ($filter == 'hari_ini') {
                $query->whereDate('ts.tanggal', Carbon::today());
            } elseif ($filter == 'minggu') {
                $query->whereDate('ts.tanggal', '>=', Carbon::now()->subDays(7));
            } elseif ($filter == 'bulan') {
                $query->whereDate('ts.tanggal', '>=', Carbon::now()->subDays(30));
            } elseif ($filter == 'custom') {
                $mulai = $request->tanggal_mulai;
                $sampai = $request->tanggal_sampai;
                if($mulai && $sampai) {
                    $query->whereBetween('ts.tanggal', [$mulai, $sampai]);
                }
            }
        }

        return $query->orderBy('ts.tanggal', 'desc')->orderBy('ts.id', 'desc')->get();
    }

    public function index(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $filter_aktif = $request->has('filter');
        
        return view('admin.laporan_barang_masuk', [
            'data_laporan' => $data_laporan,
            'filter_aktif' => $filter_aktif,
            'request' => $request 
        ]);
    }

    public function cetak(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        return view('admin.cetak_barang_masuk', ['data_laporan' => $data_laporan, 'request' => $request]);
    }

    public function export(Request $request)
    {
        $data_laporan = $this->getDataByFilter($request);
        $fileName = 'Laporan_Barang_Masuk_1_2_KopiTiam_' . date('Ymd_His') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No', 'Tanggal Masuk', 'Nama Barang', 'Jumlah', 'Satuan', 'Total Harga');

        $callback = function() use($data_laporan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data_laporan as $index => $item) {
                $row['No']      = $index + 1;
                $row['Tanggal'] = \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y');
                $row['Nama']    = $item->nama_barang;
                $row['Jumlah']  = $item->jumlah;
                $row['Satuan']  = $item->satuan;
                $row['Harga']   = 'Rp ' . number_format($item->harga, 0, ',', '.'); // Format Rupiah di Excel

                fputcsv($file, array($row['No'], $row['Tanggal'], $row['Nama'], $row['Jumlah'], $row['Satuan'], $row['Harga']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}