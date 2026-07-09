

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button',
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
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'type' => 'button',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$baseClasses = 'inline-flex items-center justify-center gap-2 font-medium rounded-lg transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/30 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50';

$variants = [
    'primary' => 'bg-brand-800 text-white hover:bg-brand-900 shadow-sm',
    'secondary' => 'bg-zinc-100 text-zinc-900 hover:bg-zinc-200',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 shadow-sm',
    'warning' => 'bg-amber-500 text-white hover:bg-amber-600 shadow-sm',
    'success' => 'bg-brand-600 text-white hover:bg-brand-700 shadow-sm',
    'info' => 'bg-blue-600 text-white hover:bg-blue-700 shadow-sm',
    'outline' => 'border border-zinc-200 bg-white shadow-sm hover:bg-zinc-50 text-zinc-900',
    'outline-primary' => 'border border-brand-700 bg-white shadow-sm hover:bg-brand-50 text-brand-800',
    'ghost' => 'hover:bg-zinc-100 hover:text-zinc-900',
];

$sizes = [
    'xs' => 'h-7 px-2 text-xs',
    'sm' => 'h-8 px-3 text-xs',
    'md' => 'h-9 px-4 text-sm',
    'lg' => 'h-10 px-6 text-sm',
];

$iconSizes = [
    'xs' => 'w-3.5 h-3.5',
    'sm' => 'w-3.5 h-3.5',
    'md' => 'w-4 h-4',
    'lg' => 'w-4 h-4',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
$iconClass = $iconSizes[$size] ?? $iconSizes['md'];
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php if($icon): ?><?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => $icon,'class' => $iconClass] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?><?php endif; ?>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php if($icon): ?><?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => $icon,'class' => $iconClass] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?><?php endif; ?>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/btn.blade.php ENDPATH**/ ?>