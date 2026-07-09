<?php $__env->startSection('title', 'Preset Barang'); ?>

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['title' => 'Preset Nama Barang','breadcrumbs' => ['Pengaturan', 'Preset Barang']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Preset Nama Barang','breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Pengaturan', 'Preset Barang'])]); ?>
    <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['icon' => 'plus','@click' => '$dispatch(\'open-modal\', \'entri-preset\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'plus','@click' => '$dispatch(\'open-modal\', \'entri-preset\')']); ?>
        Tambah Preset
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
<?php $component->withAttributes(['type' => 'success','class' => 'mb-4','dismissible' => true]); ?>
        <?php echo e(session('success')); ?>

     <?php echo $__env->renderComponent(); ?>
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
    <form method="GET" class="flex flex-col sm:flex-row gap-4 sm:items-end">
        <div class="w-full sm:max-w-xs">
            <label class="text-label block mb-2">Filter Lokasi</label>
            <select name="kategori_lokasi" class="form-control">
                <option value="Semua" <?php echo e(($filterKategori ?? 'Semua') == 'Semua' ? 'selected' : ''); ?>>Tampilkan Semua</option>
                <option value="Bar" <?php echo e(($filterKategori ?? 'Semua') == 'Bar' ? 'selected' : ''); ?>>Khusus Bar</option>
                <option value="Dapur" <?php echo e(($filterKategori ?? 'Semua') == 'Dapur' ? 'selected' : ''); ?>>Khusus Dapur</option>
            </select>
        </div>
        <div class="flex gap-2">
            <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['type' => 'submit','icon' => 'filter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','icon' => 'filter']); ?>Terapkan <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'secondary','href' => ''.e(url('/pengaturan/preset-barang')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','href' => ''.e(url('/pengaturan/preset-barang')).'']); ?>Reset <?php echo $__env->renderComponent(); ?>
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

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
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
<?php $component = App\View\Components\Icon::resolve(['name' => 'tags','class' => 'w-5 h-5 text-brand-600'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                <h4 class="font-bold text-zinc-700">Daftar Preset Barang</h4>
                <span class="ml-auto bg-brand-100 text-brand-700 px-2.5 py-0.5 rounded-full text-xs font-bold">
                    <?php echo e(count($preset)); ?> Item
                </span>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-zinc-50 text-left text-zinc-600 font-semibold">
                                <th class="px-3 py-2.5 w-20">No.</th>
                                <th class="px-3 py-2.5">Nama Barang</th>
                                <th class="px-3 py-2.5">Kategori</th>
                                <th class="px-3 py-2.5 w-40 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $preset; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-zinc-50 transition-colors">
                                    <td class="px-4 py-4 text-zinc-500"><?php echo e($index + 1); ?></td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-brand-100 rounded-lg flex items-center justify-center">
                                                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'box','class' => 'w-5 h-5 text-brand-600'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                                            </div>
                                            <span class="font-bold text-zinc-900"><?php echo e($item->nama_barang); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
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
                                    <td class="px-4 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'warning','size' => 'sm','dataId' => ''.e($item->id).'','dataNama' => ''.e($item->nama_barang).'','dataKategori' => ''.e($item->kategori_lokasi).'','onclick' => 'openEditModal(this)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'warning','size' => 'sm','data-id' => ''.e($item->id).'','data-nama' => ''.e($item->nama_barang).'','data-kategori' => ''.e($item->kategori_lokasi).'','onclick' => 'openEditModal(this)']); ?>
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
<?php endif; ?> Edit
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
                                            <form action="<?php echo e(url('/pengaturan/preset-barang/' . $item->id)); ?>" method="POST"
                                                  onsubmit="return confirmDeleteForm(event, 'Preset barang ini akan dihapus!')">
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
                                    <td colspan="4" class="px-4 py-12 text-center text-zinc-500">
                                        <div class="flex flex-col items-center">
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
                                            <p>Belum ada preset barang</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
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
    </div>

    <div class="lg:col-span-1">
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <div class="text-center mb-4">
                <div class="w-12 h-12 bg-brand-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'info-circle','class' => 'w-6 h-6 text-brand-600'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </div>
                <h4 class="font-bold text-zinc-900">Tentang Preset Barang</h4>
            </div>
            <p class="text-sm text-zinc-600 leading-relaxed mb-4">
                Preset barang dipakai untuk menentukan nama barang sekaligus kategori lokasi otomatis saat input transaksi.
            </p>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-sm text-blue-800">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'lightbulb','class' => 'w-4 h-4 inline'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                <strong>Tips:</strong> Pastikan setiap preset sudah ditandai sebagai Bar atau Dapur.
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
    </div>
</div>

<?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'entri-preset','title' => 'Input Preset Barang','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'entri-preset','title' => 'Input Preset Barang','maxWidth' => 'sm']); ?>
    <form id="form-entri-preset" action="<?php echo e(url('/pengaturan/preset-barang')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'nama_barang','label' => 'Nama Barang','placeholder' => 'Contoh: Gula Pasir, Tepung Terigu...','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nama_barang','label' => 'Nama Barang','placeholder' => 'Contoh: Gula Pasir, Tepung Terigu...','required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select','data' => ['name' => 'kategori_lokasi','label' => 'Kategori Lokasi','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'kategori_lokasi','label' => 'Kategori Lokasi','required' => true]); ?>
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
    </form>

     <?php $__env->slot('footer', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'entri-preset\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'entri-preset\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['type' => 'submit','form' => 'form-entri-preset','icon' => 'save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','form' => 'form-entri-preset','icon' => 'save']); ?>Simpan Data <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'edit-preset','title' => 'Edit Preset Barang','maxWidth' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'edit-preset','title' => 'Edit Preset Barang','maxWidth' => 'sm']); ?>
    <form id="form-edit-preset" action="" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['name' => 'nama_barang','label' => 'Nama Barang','id' => 'edit_nama','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'nama_barang','label' => 'Nama Barang','id' => 'edit_nama','required' => true]); ?>
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
    </form>

     <?php $__env->slot('footer', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ae21645af14cbe6f605c53b2fc7ff19 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'edit-preset\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','@click' => '$dispatch(\'close-modal\', \'edit-preset\')']); ?>Batal <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn','data' => ['type' => 'submit','form' => 'form-edit-preset','icon' => 'save']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','form' => 'form-edit-preset','icon' => 'save']); ?>Simpan Perubahan <?php echo $__env->renderComponent(); ?>
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
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'edit-preset' }));

        let id = btn.getAttribute('data-id');
        document.getElementById('edit_nama').value = btn.getAttribute('data-nama');
        document.getElementById('edit_kategori').value = btn.getAttribute('data-kategori');
        document.getElementById('form-edit-preset').action = "<?php echo e(url('/pengaturan/preset-barang')); ?>/" + id;
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/admin/preset_barang.blade.php ENDPATH**/ ?>