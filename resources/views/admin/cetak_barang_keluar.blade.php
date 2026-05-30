<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Barang Keluar - 1/2 Kopi Tiam</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; padding: 20px; }
        .kop-surat { text-align: center; border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 20px; }
        .kop-surat h1 { margin: 0; font-size: 24px; color: #0fa958; }
        .kop-surat p { margin: 5px 0 0; font-size: 14px; color: #555; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        
        .tanda-tangan { float: right; width: 250px; text-align: center; margin-top: 50px; }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>1/2 KOPI TIAM</h1>
        <p>Laporan Riwayat Transaksi Barang Keluar</p>
        <p style="font-size: 12px;">Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No.</th>
                <th>Tanggal Keluar</th>
                <th style="text-align: center;">Foto</th>
                <th>Nama Barang</th>
                <th style="text-align: center;">Jumlah Keluar</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_laporan as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td style="text-align: center;">
                    @if($item->foto)
                        <img src="{{ asset('uploads/' . $item->foto) }}" alt="Foto" style="width: 45px; height: 45px; object-fit: cover; border: 1px solid #ccc;">
                    @else
                        <span style="font-size: 11px; font-style: italic; color: #999;">Tidak ada foto</span>
                    @endif
                </td>
                <td>{{ $item->nama_barang }}</td>
                <td style="text-align: center; font-weight: bold;">{{ $item->jumlah }}</td>
                <td>{{ $item->satuan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="tanda-tangan">
        <p>Pontianak, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-bottom: 60px;">Mengetahui, Administrator</p>
        <p style="font-weight: bold;">( ......................................... )</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>