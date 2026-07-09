<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['variant' => 'default']));

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

foreach (array_filter((['variant' => 'default']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$variants = [
    'default' => 'bg-zinc-100 text-zinc-700',
    'admin' => 'bg-blue-600 text-white',
    'super-admin' => 'bg-red-600 text-white',
    'admin-gudang' => 'bg-purple-600 text-white',
    'karyawan' => 'bg-green-600 text-white',
    'success' => 'bg-green-100 text-green-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'danger' => 'bg-red-100 text-red-800',
    'info' => 'bg-blue-100 text-blue-800',
    'primary' => 'bg-brand-100 text-brand-800',
];
?>

<span <?php echo e($attributes->merge(['class' => 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold ' . ($variants[$variant] ?? $variants['default'])])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/badge.blade.php ENDPATH**/ ?>