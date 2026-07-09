<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['icon', 'label', 'value', 'color' => 'blue']));

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

foreach (array_filter((['icon', 'label', 'value', 'color' => 'blue']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$colors = [
    'blue' => ['border' => 'border-l-blue-600', 'bg' => 'bg-blue-600'],
    'green' => ['border' => 'border-l-green-600', 'bg' => 'bg-green-600'],
    'orange' => ['border' => 'border-l-orange-500', 'bg' => 'bg-orange-500'],
    'red' => ['border' => 'border-l-red-600', 'bg' => 'bg-red-600'],
    'emerald' => ['border' => 'border-l-brand-600', 'bg' => 'bg-brand-600'],
    'amber' => ['border' => 'border-l-amber-500', 'bg' => 'bg-amber-500'],
    'purple' => ['border' => 'border-l-purple-600', 'bg' => 'bg-purple-600'],
];
$c = $colors[$color] ?? $colors['blue'];
?>

<div <?php echo e($attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-zinc-100 border-l-4 ' . $c['border'] . ' p-4 lg:p-5 flex items-center gap-4 hover:-translate-y-0.5 transition-transform duration-200'])); ?>>
    <div class="w-10 h-10 <?php echo e($c['bg']); ?> rounded-xl flex items-center justify-center text-white shrink-0">
        <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => $icon,'class' => 'w-5 h-5'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    <div class="min-w-0">
        <p class="text-caption font-medium truncate"><?php echo e($label); ?></p>
        <p class="text-xl font-bold text-zinc-900 tabular-nums"><?php echo e($value); ?></p>
    </div>
</div>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/stat-card.blade.php ENDPATH**/ ?>