<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Stok - 1/2 Kopi Tiam</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 12px; color: #333; padding: 20px; }
        .header { text-align: center; border-bottom: 3px double #333; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { font-size: 18px; margin-bottom: 4px; }
        .header p { font-size: 11px; color: #666; }
        .info { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px 10px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: 600; font-size: 11px; text-transform: uppercase; }
        td { font-size: 12px; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; display: flex; justify-content: space-between; }
        .signature { width: 200px; text-align: center; }
        .signature .line { border-top: 1px solid #333; margin-top: 60px; padding-top: 5px; }
        @media print {
            body { padding: 0; }
            @page { margin: 1.5cm; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN STOK GUDANG</h1>
        <p>1/2 Kopi Tiam - Sistem Stok Bahan Baku</p>
    </div>

    <div class="info">
        <span><strong>Periode:</strong> 
            @if($request->filter == 'semua' || !$request->filter)
                Semua Data
            @elseif($request->filter == 'hari_ini')
                Hari Ini ({{ date('d-m-Y') }})
            @elseif($request->filter == 'minggu')
                1 Minggu Terakhir
            @elseif($request->filter == 'bulan')
                1 Bulan Terakhir
            @elseif($request->filter == 'custom')
                {{ $request->tanggal_mulai }} s/d {{ $request->tanggal_sampai }}
            @endif
        </span>
        <span><strong>Dicetak:</strong> {{ date('d-m-Y H:i') }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:40px">No</th>
                <th>Nama Barang</th>
                <th class="text-right" style="width:100px">Sisa Stok</th>
                <th style="width:100px">Satuan</th>
                <th style="width:120px">Tgl Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data_laporan as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td class="text-right"><strong>{{ $item->jumlah }}</strong></td>
                <td>{{ $item->satuan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding:20px; color:#999;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <div class="line">Mengetahui</div>
        </div>
        <div class="signature">
            <div class="line">Dibuat Oleh</div>
        </div>
    </div>

</body>
</html>
