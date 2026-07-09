<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => null, 'padding' => true]));

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

foreach (array_filter((['title' => null, 'padding' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'rounded-xl border border-zinc-200 bg-white text-zinc-900 shadow-sm'])); ?>>
    <?php if($title): ?>
        <div class="px-5 py-4 border-b border-zinc-100">
            <h3 class="text-section-title"><?php echo e($title); ?></h3>
        </div>
    <?php endif; ?>

    <div class="<?php echo e($padding ? 'p-5' : ''); ?>">
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/card.blade.php ENDPATH**/ ?>