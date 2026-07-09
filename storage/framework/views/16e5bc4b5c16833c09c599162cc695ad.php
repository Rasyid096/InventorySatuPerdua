<?php $__env->startSection('title', $isGudangUtama ? 'Stok Gudang Keluar' : 'Barang Keluar'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => ''.e($isGudangUtama ? 'Data Stok Gudang Keluar' : 'Data Barang Keluar').'','breadcrumbs' => ['Dashboard', 'Transaksi', $isGudangUtama ? 'Stok Gudang Keluar' : 'Barang Keluar']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($isGudangUtama ? 'Data Stok Gudang Keluar' : 'Data Barang Keluar').'','breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Dashboard', 'Transaksi', $isGudangUtama ? 'Stok Gudang Keluar' : 'Barang Keluar'])]); ?>
    <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['icon' => 'plus','@click' => '$dispatch(\'open-modal\', \'entri-barang\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'plus','@click' => '$dispatch(\'open-modal\', \'entri-barang\')']); ?>Entri Data <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
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

<?php if(session('error')): ?>
    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'error','class' => 'mb-4','dismissible' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','class' => 'mb-4','dismissible' => true]); ?><?php echo e(session('error')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php endif; ?>
<?php if(session('success')): ?>
    <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.alert','data' => ['type' => 'success','class' => 'mb-4','dismissible' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','class' => 'mb-4','dismissible' => true]); ?><?php echo e(session('success')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
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
    <div x-data="{ tabAktif: '<?php echo e($filterKategori ?? 'Bar'); ?>' }">
        <form action="<?php echo e(url('/transaksi/barang-keluar')); ?>" method="GET" class="flex flex-col lg:flex-row lg:items-end gap-4 flex-wrap">
            <div class="min-w-[280px]">
                <label class="text-label block mb-2">Filter Kategori</label>
                <div class="flex flex-wrap gap-2">
                    <a href="<?php echo e(url('/transaksi/barang-keluar?kategori_lokasi=Bar' . ($isGudangUtama && filled($filterCabangTujuan) ? '&cabang_tujuan_id=' . $filterCabangTujuan : ''))); ?>"
                       :class="tabAktif === 'Bar' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
                       class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">Stok Bar</a>
                    <a href="<?php echo e(url('/transaksi/barang-keluar?kategori_lokasi=Dapur' . ($isGudangUtama && filled($filterCabangTujuan) ? '&cabang_tujuan_id=' . $filterCabangTujuan : ''))); ?>"
                       :class="tabAktif === 'Dapur' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
                       class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">Stok Dapur</a>
                    <a href="<?php echo e(url('/transaksi/barang-keluar?kategori_lokasi=Semua' . ($isGudangUtama && filled($filterCabangTujuan) ? '&cabang_tujuan_id=' . $filterCabangTujuan : ''))); ?>"
                       :class="tabAktif === 'Semua' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-zinc-600 border-zinc-200'"
                       class="px-4 py-2 rounded-lg border text-sm font-semibold transition-colors">Semua</a>
                </div>
            </div>

            <?php if($isGudangUtama): ?>
            <input type="hidden" name="kategori_lokasi" value="<?php echo e($filterKategori ?? 'Semua'); ?>">

            <div class="min-w-[220px]">
                <label class="text-label block mb-2">Filter Cabang Tujuan</label>
                <select name="cabang_tujuan_id" class="form-control">
                    <option value="">Semua Cabang</option>
                    <?php $__currentLoopData = $daftarCabangTujuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cabang->id); ?>" <?php echo e((string) ($filterCabangTujuan ?? '') === (string) $cabang->id ? 'selected' : ''); ?>><?php echo e($cabang->nama_cabang); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
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
                <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'secondary','href' => ''.e(url('/transaksi/barang-keluar?kategori_lokasi=' . ($filterKategori ?? 'Semua'))).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','href' => ''.e(url('/transaksi/barang-keluar?kategori_lokasi=' . ($filterKategori ?? 'Semua'))).'']); ?>Reset <?php echo $__env->renderComponent(); ?>
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
            <?php endif; ?>
        </form>
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
    <div class="p-6">
        <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
             <?php $__env->slot('header', null, []); ?> 
                <th class="px-3 py-2.5">No.</th>
                <th class="px-3 py-2.5">Tanggal</th>
                <th class="px-3 py-2.5">Barang</th>
                <th class="px-3 py-2.5">Kategori</th>
                <th class="px-3 py-2.5">Jumlah Keluar</th>
                <th class="px-3 py-2.5">Satuan</th>
                <?php if($isGudangUtama): ?>
                <th class="px-3 py-2.5">Pengambil</th>
                <th class="px-3 py-2.5">Cabang Tujuan</th>
                <?php endif; ?>
                <th class="px-3 py-2.5">Foto</th>
                <th class="px-3 py-2.5">Aksi</th>
             <?php $__env->endSlot(); ?>

            <?php $__empty_1 = true; $__currentLoopData = $barang_keluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                    <td class="px-3 py-2.5"><?php echo e($item->nama_pengambil_barang ?? '-'); ?></td>
                    <td class="px-3 py-2.5">
                        <?php if($item->cabang_tujuan_nama): ?>
                            <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'info']); ?><?php echo e($item->cabang_tujuan_nama); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td class="px-3 py-2.5">
                        <?php if($item->foto): ?>
                            <img src="<?php echo e(asset('uploads/' . $item->foto)); ?>" class="w-12 h-12 rounded-lg object-cover border border-zinc-200" alt="Foto">
                        <?php else: ?>
                            <span class="text-zinc-400 text-xs italic">Tidak ada foto</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-3 py-2.5">
                        <div class="flex items-center gap-2">
                            <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'warning','size' => 'sm','dataId' => ''.e($item->id).'','dataTanggal' => ''.e($item->tanggal).'','dataNama' => ''.e($item->nama_barang).'','dataJumlah' => ''.e($item->jumlah).'','dataKategori' => ''.e($item->kategori_lokasi).'','dataPengambil' => ''.e($item->nama_pengambil_barang ?? '').'','dataCabangtujuan' => ''.e($item->cabang_tujuan_id ?? '').'','onclick' => 'openEditModal(this)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'warning','size' => 'sm','data-id' => ''.e($item->id).'','data-tanggal' => ''.e($item->tanggal).'','data-nama' => ''.e($item->nama_barang).'','data-jumlah' => ''.e($item->jumlah).'','data-kategori' => ''.e($item->kategori_lokasi).'','data-pengambil' => ''.e($item->nama_pengambil_barang ?? '').'','data-cabangtujuan' => ''.e($item->cabang_tujuan_id ?? '').'','onclick' => 'openEditModal(this)']); ?>
                                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'edit','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
                            <?php if(auth()->user()->hak_akses != 'Karyawan'): ?>
                            <form action="<?php echo e(url('/transaksi/barang-keluar/' . $item->id)); ?>" method="POST"
                                  onsubmit="return confirmDeleteForm(event, 'Hapus riwayat ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'danger','size' => 'sm','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'danger','size' => 'sm','type' => 'submit']); ?>
                                    <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'trash','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="<?php echo e($isGudangUtama ? 10 : 8); ?>" class="px-4 py-8 text-center text-zinc-500">
                        <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'inbox','class' => 'w-10 h-10 text-zinc-300 mx-auto mb-2 block'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                        <p>Belum ada data barang keluar</p>
                    </td>
                </tr>
            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $attributes = $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $component = $__componentOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
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
<?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'entri-barang','title' => 'Input Barang Keluar','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'entri-barang','title' => 'Input Barang Keluar','maxWidth' => 'md']); ?>
    <form id="form-entri-keluar" action="<?php echo e(url('/transaksi/barang-keluar')); ?>" method="POST" enctype="multipart/form-data" x-data="{ kategoriLokasi: '<?php echo e(in_array($filterKategori ?? 'Bar', ['Bar', 'Dapur']) ? $filterKategori : 'Bar'); ?>' }">
        <?php echo csrf_field(); ?>
        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'tanggal','type' => 'date','label' => 'Tanggal Keluar','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tanggal','type' => 'date','label' => 'Tanggal Keluar','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'kategori_lokasi_filter','label' => 'Kategori Barang','xModel' => 'kategoriLokasi','@change' => '$refs.barangKeluar.value = \'\'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'kategori_lokasi_filter','label' => 'Kategori Barang','x-model' => 'kategoriLokasi','@change' => '$refs.barangKeluar.value = \'\'','required' => true]); ?>
            <option value="Bar">Barang Bar</option>
            <option value="Dapur">Barang Dapur</option>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'id_barang_master','label' => 'Pilih Data Barang (Dari Master Data)','xRef' => 'barangKeluar','xBind:key' => 'kategoriLokasi','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'id_barang_master','label' => 'Pilih Data Barang (Dari Master Data)','x-ref' => 'barangKeluar','x-bind:key' => 'kategoriLokasi','required' => true]); ?>
            <option value="">-- Pilih Barang dari Gudang --</option>
            <?php $__currentLoopData = $stok_tersedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option x-show="kategoriLokasi === '<?php echo e($stok->kategori_lokasi); ?>'" value="<?php echo e($stok->id); ?>"><?php echo e($stok->nama_barang); ?> (Sisa: <?php echo e($stok->jumlah); ?> <?php echo e($stok->satuan); ?>)</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>

        <?php if($isGudangUtama): ?>
            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'jumlah','type' => 'number','label' => 'Jumlah Keluar','min' => '1','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'jumlah','type' => 'number','label' => 'Jumlah Keluar','min' => '1','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>

            <div class="border-t border-zinc-200 pt-4 mt-4">
                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'nama_pengambil_barang','label' => 'Nama Pengambil Barang','placeholder' => 'Masukkan nama pengambil','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nama_pengambil_barang','label' => 'Nama Pengambil Barang','placeholder' => 'Masukkan nama pengambil','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'cabang_tujuan_id','label' => 'Cabang Tujuan','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'cabang_tujuan_id','label' => 'Cabang Tujuan','required' => true]); ?>
                    <option value="">-- Pilih Cabang Tujuan --</option>
                    <?php $__currentLoopData = $daftarCabangTujuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cabang->id); ?>"><?php echo e($cabang->nama_cabang); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>

                <div class="mb-4">
                    <label class="text-label block mb-2">Foto Bukti Keluar (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-zinc-200 rounded-lg p-2">
                </div>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'jumlah','type' => 'number','label' => 'Jumlah Keluar','min' => '1','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'jumlah','type' => 'number','label' => 'Jumlah Keluar','min' => '1','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                <div class="mb-4">
                    <label class="text-label block mb-2">Foto Bukti Keluar (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-zinc-200 rounded-lg p-2">
                </div>
            </div>
        <?php endif; ?>
    </form>

     <?php $__env->slot('footer', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'entri-barang\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'entri-barang\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['type' => 'submit','form' => 'form-entri-keluar','icon' => 'save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','form' => 'form-entri-keluar','icon' => 'save']); ?>Simpan Data <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'edit-barang','title' => 'Edit Barang Keluar','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'edit-barang','title' => 'Edit Barang Keluar','maxWidth' => 'md']); ?>
    <form id="form-edit-keluar" action="" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'tanggal','type' => 'date','label' => 'Tanggal Keluar','id' => 'edit_tanggal','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'tanggal','type' => 'date','label' => 'Tanggal Keluar','id' => 'edit_tanggal','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>

        <div class="mb-4">
            <label class="text-label block mb-2">Nama Barang (Tidak bisa diubah)</label>
            <input type="text" name="nama_barang" id="edit_nama" readonly
                   class="w-full px-3 py-2 border border-zinc-200 rounded-lg text-sm bg-zinc-100 cursor-not-allowed">
        </div>

        <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'kategori_lokasi','label' => 'Kategori Lokasi','id' => 'edit_kategori','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'kategori_lokasi','label' => 'Kategori Lokasi','id' => 'edit_kategori','required' => true]); ?>
            <option value="Bar">Bar</option>
            <option value="Dapur">Dapur</option>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'jumlah','type' => 'number','label' => 'Jumlah Keluar','id' => 'edit_jumlah','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'jumlah','type' => 'number','label' => 'Jumlah Keluar','id' => 'edit_jumlah','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
            <div class="mb-4">
                <label class="text-label block mb-2">Update Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm border border-zinc-200 rounded-lg p-2">
            </div>
        </div>

        <?php if($isGudangUtama): ?>
        <div class="border-t border-zinc-200 pt-4 mt-4">
            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'nama_pengambil_barang','label' => 'Nama Pengambil Barang','id' => 'edit_pengambil']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nama_pengambil_barang','label' => 'Nama Pengambil Barang','id' => 'edit_pengambil']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginaled2cde6083938c436304f332ba96bb7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled2cde6083938c436304f332ba96bb7c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'cabang_tujuan_id','label' => 'Cabang Tujuan','id' => 'edit_cabang_tujuan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'cabang_tujuan_id','label' => 'Cabang Tujuan','id' => 'edit_cabang_tujuan']); ?>
                <option value="">-- Pilih Cabang Tujuan --</option>
                <?php $__currentLoopData = $daftarCabangTujuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cabang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cabang->id); ?>"><?php echo e($cabang->nama_cabang); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $attributes = $__attributesOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__attributesOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled2cde6083938c436304f332ba96bb7c)): ?>
<?php $component = $__componentOriginaled2cde6083938c436304f332ba96bb7c; ?>
<?php unset($__componentOriginaled2cde6083938c436304f332ba96bb7c); ?>
<?php endif; ?>
        </div>
        <?php endif; ?>
    </form>

     <?php $__env->slot('footer', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'edit-barang\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'edit-barang\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['type' => 'submit','form' => 'form-edit-keluar','icon' => 'save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','form' => 'form-edit-keluar','icon' => 'save']); ?>Simpan Perubahan <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $attributes = $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19)): ?>
<?php $component = $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19; ?>
<?php unset($__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function openEditModal(btn) {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-barang' }));

        let id = btn.getAttribute('data-id');
        document.getElementById('edit_tanggal').value = btn.getAttribute('data-tanggal');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_jumlah').value = btn.getAttribute('data-jumlah');
        document.getElementById('edit_kategori').value = btn.getAttribute('data-kategori');

        var pengambilEl = document.getElementById('edit_pengambil');
        if (pengambilEl) {
            pengambilEl.value = btn.getAttribute('data-pengambil') || '';
        }
        var cabangEl = document.getElementById('edit_cabang_tujuan');
        if (cabangEl) {
            cabangEl.value = btn.getAttribute('data-cabangtujuan') || '';
        }

        document.getElementById('form-edit-keluar').action = "<?php echo e(url('/transaksi/barang-keluar')); ?>/" + id;
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/admin/barang_keluar.blade.php ENDPATH**/ ?>