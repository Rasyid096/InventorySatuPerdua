<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($isGudangUtama ? 'Cetak Laporan Stok Gudang' : 'Cetak Laporan Stok'); ?> - 1/2 Kopi Tiam</title>
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
        <h1><?php echo e($isGudangUtama ? 'LAPORAN STOK GUDANG' : 'LAPORAN STOK'); ?></h1>
        <p>1/2 Kopi Tiam - Sistem Stok Bahan Baku</p>
    </div>

    <div class="info">
        <span><strong>Periode:</strong>
            <?php if($request->filter == 'semua' || !$request->filter): ?>
                Semua Data
            <?php elseif($request->filter == 'hari_ini'): ?>
                Hari Ini (<?php echo e(date('d-m-Y')); ?>)
            <?php elseif($request->filter == 'minggu'): ?>
                1 Minggu Terakhir
            <?php elseif($request->filter == 'bulan'): ?>
                1 Bulan Terakhir
            <?php elseif($request->filter == 'custom'): ?>
                <?php echo e($request->tanggal_mulai); ?> s/d <?php echo e($request->tanggal_sampai); ?>

            <?php endif; ?>
            | <strong>Kategori:</strong> <?php echo e($request->kategori_lokasi ?: 'Semua'); ?>

        </span>
        <span><strong>Dicetak:</strong> <?php echo e(date('d-m-Y H:i')); ?></span>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width:40px">No</th>
                <th>Nama Barang</th>
                <th style="width:90px">Kategori</th>
                <th class="text-right" style="width:100px">Sisa Stok</th>
                <th style="width:100px">Satuan</th>
                <th style="width:120px">Tgl Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $data_laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="text-center"><?php echo e($index + 1); ?></td>
                <td><?php echo e($item->nama_barang); ?></td>
                <td><?php echo e($item->kategori_lokasi); ?></td>
                <td class="text-right"><strong><?php echo e($item->jumlah); ?></strong></td>
                <td><?php echo e($item->satuan); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center" style="padding:20px; color:#999;">Tidak ada data</td>
            </tr>
            <?php endif; ?>
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
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/admin/cetak_stok.blade.php ENDPATH**/ ?>