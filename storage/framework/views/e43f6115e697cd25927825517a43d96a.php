<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label' => null,
    'type' => 'text',
    'error' => null,
    'required' => false,
    'value' => null,
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
    'type' => 'text',
    'error' => null,
    'required' => false,
    'value' => null,
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
    $inputId = $id ?? $name;
    $inputClass = 'flex h-9 w-full rounded-lg border bg-transparent px-3 py-1 text-sm shadow-sm transition-colors placeholder:text-zinc-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-600/20 disabled:cursor-not-allowed disabled:opacity-50 '
        . ($error ? 'border-red-400 bg-red-50 focus-visible:ring-red-500/20' : 'border-zinc-200');
?>

<div class="mb-4">
    <?php if($label): ?>
        <label for="<?php echo e($inputId); ?>" class="text-label block mb-2">
            <?php echo e($label); ?>

            <?php if($required): ?><span class="text-red-500">*</span><?php endif; ?>
        </label>
    <?php endif; ?>

    <?php if($type === 'password'): ?>
        <div class="relative" x-data="{ show: false }">
            <input :type="show ? 'text' : 'password'"
                   name="<?php echo e($name); ?>"
                   id="<?php echo e($inputId); ?>"
                   value="<?php echo e(old($name, $value)); ?>"
                   <?php echo e($attributes->merge(['class' => $inputClass . ' pr-10'])); ?>

                   <?php if($required): ?> required <?php endif; ?>>
            <button type="button"
                    @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-zinc-700">
                <span x-show="!show"><?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'eye','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?></span>
                <span x-show="show" x-cloak><?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'eye-slash','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?></span>
            </button>
        </div>
    <?php else: ?>
        <input type="<?php echo e($type); ?>"
               name="<?php echo e($name); ?>"
               id="<?php echo e($inputId); ?>"
               value="<?php echo e(old($name, $value)); ?>"
               <?php echo e($attributes->merge(['class' => $inputClass])); ?>

               <?php if($required): ?> required <?php endif; ?>>
    <?php endif; ?>

    <?php if($error): ?>
        <p class="mt-1 text-xs font-medium text-red-500"><?php echo e($error); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/components/input.blade.php ENDPATH**/ ?>