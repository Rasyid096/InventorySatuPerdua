<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'id' => null,
]));

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

foreach (array_filter(([
    'name',
    'label' => null,
    'error' => null,
    'required' => false,
    'id' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $selectId = $id ?? $name;
    $selectClass = 'flex h-9 w-full rounded-lg border bg-transparent px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/20 disabled:cursor-not-allowed disabled:opacity-50 '
        . ($error ? 'border-red-400 bg-red-50' : 'border-zinc-200');
?>

<div class="mb-4">
    <?php if($label): ?>
        <label for="<?php echo e($selectId); ?>" class="text-label block mb-2">
            <?php echo e($label); ?>

            <?php if($required): ?><span class="text-red-500">*</span><?php endif; ?>
        </label>
    <?php endif; ?>

    <select name="<?php echo e($name); ?>"
            id="<?php echo e($selectId); ?>"
            <?php echo e($attributes->merge(['class' => $selectClass])); ?>

            <?php if($required): ?> required <?php endif; ?>>
        <?php echo e($slot); ?>

    </select>

    <?php if($error): ?>
        <p class="mt-1 text-xs font-medium text-red-500"><?php echo e($error); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/select.blade.php ENDPATH**/ ?>