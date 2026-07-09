<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Masuk'); ?> - 1/2 Kopi Tiam</title>

    <?php if(session('success')): ?>
        <meta name="flash-success" content="<?php echo e(session('success')); ?>">
    <?php endif; ?>
    <?php if(session('error')): ?>
        <meta name="flash-error" content="<?php echo e(session('error')); ?>">
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="min-h-screen flex flex-col bg-zinc-50 text-sm" x-data="{ menuOpen: false }">

    <header class="sticky top-0 z-50 bg-brand-800 text-white shadow-sm no-print">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
            <a href="<?php echo e(route('login')); ?>" class="text-sm sm:text-base font-semibold truncate">
                1/2 Kopi Tiam
            </a>

            <button type="button" @click="menuOpen = !menuOpen"
                    class="sm:hidden p-2 rounded-lg hover:bg-brand-700 transition-colors"
                    aria-label="Menu">
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'bars','class' => 'w-5 h-5'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => '!menuOpen']); ?>
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
                <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'times','class' => 'w-5 h-5'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Icon::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => 'menuOpen','x-cloak' => true]); ?>
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
            </button>

            <nav class="hidden sm:flex items-center gap-1">
                <a href="<?php echo e(route('login')); ?>"
                   class="px-3 py-2 text-sm font-medium rounded-lg hover:bg-brand-700 transition-colors <?php echo e(request()->routeIs('login') ? 'bg-brand-700' : ''); ?>">
                    Masuk
                </a>
            </nav>
        </div>

        <div x-show="menuOpen"
             x-transition
             x-cloak
             class="sm:hidden border-t border-brand-700 px-4 py-2">
            <a href="<?php echo e(route('login')); ?>"
               class="block px-3 py-2.5 text-sm font-medium rounded-lg hover:bg-brand-700">
                Masuk
            </a>
        </div>
    </header>

    <main class="flex-1 page-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-zinc-900 text-zinc-300 text-center py-4 text-caption no-print">
        <p>&copy; <?php echo e(date('Y')); ?> 1/2 Kopi Tiam — Sistem Stok Bahan Baku</p>
    </footer>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/main.blade.php ENDPATH**/ ?>