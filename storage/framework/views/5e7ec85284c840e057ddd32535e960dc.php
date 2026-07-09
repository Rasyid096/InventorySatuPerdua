<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - 1/2 Kopi Tiam</title>

    <?php if(session('success')): ?>
        <meta name="flash-success" content="<?php echo e(session('success')); ?>">
    <?php endif; ?>
    <?php if(session('error')): ?>
        <meta name="flash-error" content="<?php echo e(session('error')); ?>">
    <?php endif; ?>
    <?php if(session('warning')): ?>
        <meta name="flash-warning" content="<?php echo e(session('warning')); ?>">
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="bg-zinc-50 min-h-screen text-sm" x-data="{ sidebarOpen: false, profileOpen: false }">

    <div x-show="sidebarOpen"
         x-transition:enter="ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/40 z-40 lg:hidden"
         x-cloak></div>

    <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="lg:ml-60 flex flex-col min-h-screen">
        <header class="bg-brand-800 text-white px-4 lg:px-6 py-3 flex items-center justify-between gap-3 shadow-sm sticky top-0 z-30 no-print">
            <div class="flex items-center gap-2 min-w-0">
                <button type="button" @click="sidebarOpen = true"
                        class="lg:hidden p-2 -ml-1 rounded-lg hover:bg-brand-700 transition-colors shrink-0">
                    <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'bars','class' => 'w-5 h-5'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                </button>
                <h1 class="text-sm sm:text-base font-semibold truncate">Sistem Stok Bahan Baku</h1>
            </div>

            <div class="relative shrink-0" @click.away="profileOpen = false">
                <button type="button" @click="profileOpen = !profileOpen"
                        class="flex items-center gap-2 hover:bg-brand-700 rounded-lg px-2 sm:px-3 py-1.5 transition-colors">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium leading-tight"><?php echo e(auth()->user()?->nama_user ?? 'Pengguna'); ?></p>
                        <p class="text-xs text-brand-200"><?php echo e(auth()->user()?->hak_akses ?? 'Tamu'); ?></p>
                    </div>
                    <div class="w-9 h-9 bg-brand-700 border border-brand-600 rounded-full flex items-center justify-center">
                        <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'user','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    <span class="hidden sm:block transition-transform duration-200" :class="profileOpen ? 'rotate-180' : ''">
                        <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'chevron-down','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                    </span>
                </button>

                <div x-show="profileOpen"
                     x-transition
                     class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-zinc-100 py-2 z-50"
                     x-cloak>
                    <div class="px-4 py-3 border-b border-zinc-100">
                        <p class="text-sm font-semibold text-zinc-900"><?php echo e(auth()->user()?->nama_user ?? 'Pengguna'); ?></p>
                        <p class="text-caption"><?php echo e(auth()->user()?->username ?? '-'); ?></p>
                        <span class="inline-block mt-1.5 px-2 py-0.5 bg-brand-100 text-brand-800 text-xs font-semibold rounded-full">
                            <?php echo e(auth()->user()?->hak_akses ?? 'Tamu'); ?>

                        </span>
                    </div>
                    <div class="py-1">
                        <a href="<?php echo e(url('/tentang')); ?>"
                           class="flex items-center gap-3 px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                            <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'info-circle','class' => 'w-4 h-4 text-zinc-400'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                            <span>Tentang Aplikasi</span>
                        </a>
                    </div>
                    <div class="border-t border-zinc-100 pt-1">
                        <a href="<?php echo e(url('/logout')); ?>"
                           class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <?php if (isset($component)) { $__componentOriginald88937ee957874c050ccbc67a5e19575 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald88937ee957874c050ccbc67a5e19575 = $attributes; } ?>
<?php $component = App\View\Components\Icon::resolve(['name' => 'sign-out-alt','class' => 'w-4 h-4'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                            <span class="font-medium">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 lg:p-6 page-content">
            <div class="max-w-7xl mx-auto w-full">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>

        <footer class="text-center text-caption py-4 border-t border-zinc-200 bg-white no-print">
            &copy; <?php echo e(date('Y')); ?> 1/2 Kopi Tiam — Sistem Stok Bahan Baku
        </footer>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\DevApps\xampp7\htdocs\stok_barang\resources\views/layouts/admin.blade.php ENDPATH**/ ?>