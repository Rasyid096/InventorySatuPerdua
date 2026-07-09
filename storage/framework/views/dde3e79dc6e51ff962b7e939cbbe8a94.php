<?php $__env->startSection('title', $isGudangUtama ? 'Laporan Stok Masuk' : 'Laporan Barang Masuk'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => ''.e($isGudangUtama ? 'Laporan Stok Masuk' : 'Laporan Riwayat Barang Masuk').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($isGudangUtama ? 'Laporan Stok Masuk' : 'Laporan Riwayat Barang Masuk').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['class' => 'mb-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-6']); ?>
    <form action="<?php echo e(url('/laporan/barang-masuk')); ?>" method="GET" class="flex flex-col lg:flex-row lg:items-end gap-4 flex-wrap" x-data="{ showCustom: '<?php echo e($request->filter); ?>' === 'custom' }">
        <div class="flex-1 min-w-[200px]">
            <label class="text-label block mb-2">Periode Masuk *</label>
            <select name="filter" @change="showCustom = $event.target.value === 'custom'" class="form-control">
                <option value="semua" <?php echo e($request->filter == 'semua' ? 'selected' : ''); ?>>Semua Data</option>
                <option value="hari_ini" <?php echo e($request->filter == 'hari_ini' ? 'selected' : ''); ?>>Hari Ini</option>
                <option value="minggu" <?php echo e($request->filter == 'minggu' ? 'selected' : ''); ?>>1 Minggu Terakhir</option>
                <option value="bulan" <?php echo e($request->filter == 'bulan' ? 'selected' : ''); ?>>1 Bulan Terakhir</option>
                <option value="custom" <?php echo e($request->filter == 'custom' ? 'selected' : ''); ?>>Pilih Tanggal Custom</option>
            </select>
        </div>

        <div class="min-w-[180px]">
            <label class="text-label block mb-2">Filter Kategori</label>
            <select name="kategori_lokasi" class="form-control">
                <option value="">Semua</option>
                <option value="Bar" <?php echo e($request->kategori_lokasi == 'Bar' ? 'selected' : ''); ?>>Bar</option>
                <option value="Dapur" <?php echo e($request->kategori_lokasi == 'Dapur' ? 'selected' : ''); ?>>Dapur</option>
            </select>
        </div>

        <div x-show="showCustom" x-transition class="flex flex-col sm:flex-row gap-4">
            <div>
                <label class="text-label block mb-2">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" value="<?php echo e($request->tanggal_mulai); ?>" class="form-control">
            </div>
            <div>
                <label class="text-label block mb-2">Sampai Tanggal</label>
                <input type="date" name="tanggal_sampai" value="<?php echo e($request->tanggal_sampai); ?>" class="form-control">
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['type' => 'submit','icon' => 'search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','icon' => 'search']); ?>Tampilkan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
            <?php
                $params = $filter_aktif ? '?filter=' . ($request->filter ?? 'semua') . '&tanggal_mulai=' . ($request->tanggal_mulai ?? '') . '&tanggal_sampai=' . ($request->tanggal_sampai ?? '') . '&kategori_lokasi=' . ($request->kategori_lokasi ?? '') : '';
            ?>
            <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'warning','icon' => 'print','href' => ''.e(url('/laporan/barang-masuk/cetak' . $params)).'','target' => '_blank']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'warning','icon' => 'print','href' => ''.e(url('/laporan/barang-masuk/cetak' . $params)).'','target' => '_blank']); ?>Cetak PDF <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'success','icon' => 'file-excel','href' => ''.e(url('/laporan/barang-masuk/export' . $params)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'success','icon' => 'file-excel','href' => ''.e(url('/laporan/barang-masuk/export' . $params)).'']); ?>Export Excel <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['padding' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['padding' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
    <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
        <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'arrow-down','class' => 'w-5 h-5 text-green-600'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
        <h3 class="text-section-title">Detail Transaksi Barang Masuk</h3>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm min-w-[780px]">
                <thead>
                    <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                        <th class="px-3 py-2.5">No.</th>
                        <th class="px-3 py-2.5">Tanggal Masuk</th>
                        <th class="px-3 py-2.5">Nama Barang</th>
                        <th class="px-3 py-2.5">Kategori</th>
                        <th class="px-3 py-2.5">Jumlah Masuk</th>
                        <th class="px-3 py-2.5">Satuan</th>
                        <?php if($isGudangUtama): ?>
                        <th class="px-3 py-2.5">Harga</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $data_laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-zinc-50 transition-colors">
                            <td class="px-3 py-2.5"><?php echo e($index + 1); ?></td>
                            <td class="px-3 py-2.5"><?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')); ?></td>
                            <td class="px-3 py-2.5 font-bold text-zinc-900"><?php echo e($item->nama_barang); ?></td>
                            <td class="px-3 py-2.5">
                                <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => ''.e($item->kategori_lokasi == 'Bar' ? 'success' : 'warning').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => ''.e($item->kategori_lokasi == 'Bar' ? 'success' : 'warning').'']); ?><?php echo e($item->kategori_lokasi); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                            </td>
                            <td class="px-3 py-2.5"><?php echo e($item->jumlah); ?></td>
                            <td class="px-3 py-2.5"><?php echo e($item->satuan); ?></td>
                            <?php if($isGudangUtama): ?>
                            <td class="px-3 py-2.5">Rp <?php echo e(number_format($item->harga_total, 0, ',', '.')); ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e($isGudangUtama ? 7 : 6); ?>" class="px-4 py-8 text-center text-red-500">
                                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'exclamation-circle','class' => 'w-8 h-8 mx-auto mb-2 text-zinc-400 block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $attributes = $__attributesOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__attributesOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald88937ee957874c050ccbc67a5e19575)): ?>
<?php $component = $__componentOriginald88937ee957874c050ccbc67a5e19575; ?>
<?php unset($__componentOriginald88937ee957874c050ccbc67a5e19575); ?>
<?php endif; ?>
                                <p>Tidak ada transaksi barang masuk pada periode ini.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <?php if($isGudangUtama && $data_laporan->count() > 0): ?>
                <tfoot>
                    <tr class="bg-zinc-100 font-bold">
                        <td colspan="6" class="px-3 py-2.5 text-right">Total Harga:</td>
                        <td class="px-3 py-2.5">Rp <?php echo e(number_format($totalHarga, 0, ',', '.')); ?></td>
                    </tr>
                </tfoot>
                <?php endif; ?>
            </table>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/admin/laporan_barang_masuk.blade.php ENDPATH**/ ?>