<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['searchable' => true, 'perPage' => [10, 25, 50, 100]]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['searchable' => true, 'perPage' => [10, 25, 50, 100]]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="overflow-hidden">
    <?php if($searchable): ?>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4 text-caption">
        <div class="flex items-center gap-2">
            <span>Tampilkan</span>
            <select class="h-9 rounded-lg border border-zinc-200 bg-white px-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-600/20">
                <?php $__currentLoopData = $perPage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($num); ?>"><?php echo e($num); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span>data</span>
        </div>
        <div class="relative w-full sm:w-auto">
            <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'search','class' => 'w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400 pointer-events-none'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <input type="text"
                   placeholder="Cari..."
                   class="h-9 w-full sm:w-56 rounded-lg border border-zinc-200 bg-transparent pl-9 pr-3 text-sm placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-brand-600/20">
        </div>
    </div>
    <?php endif; ?>

    <div class="relative w-full overflow-x-auto -mx-1 px-1">
        <table class="w-full min-w-[640px] caption-bottom text-sm">
            <thead>
                <tr class="border-b border-zinc-200 text-left text-caption font-semibold uppercase tracking-wide [&>th]:px-3 [&>th]:py-2.5">
                    <?php echo e($header); ?>

                </tr>
            </thead>
            <tbody class="[&_tr]:border-b [&_tr:last-child]:border-0 [&>tr>td]:px-3 [&>tr>td]:py-2.5 text-sm">
                <?php echo e($slot); ?>

            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/data-table.blade.php ENDPATH**/ ?>