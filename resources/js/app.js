/**
 * Sistem Stok Bahan Baku - 1/2 Kopi Tiam
 */

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const BRAND = {
    primary: '#065f46',
    danger: '#ef4444',
    muted: '#71717a',
    success: '#059669',
};

/** Page transition: loader + smooth leave on internal navigation */
// Disabled per user request - no loading animation on page navigation
/*
(function initPageTransitions() {
    const loader = document.createElement('div');
    loader.id = 'page-loader';
    loader.innerHTML = '<div class="loader-spinner" role="status" aria-label="Memuat"></div>';
    document.addEventListener('DOMContentLoaded', () => {
        document.body.appendChild(loader);
    });

    const showLoader = () => loader?.classList.add('is-active');
    const hideLoader = () => loader?.classList.remove('is-active');

    document.addEventListener('DOMContentLoaded', hideLoader);

    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href]');
        if (!link) return;
        if (link.target === '_blank' || link.hasAttribute('download')) return;
        if (link.dataset.noTransition !== undefined) return;

        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

        try {
            const url = new URL(link.href, window.location.origin);
            if (url.origin !== window.location.origin) return;
            if (url.pathname === window.location.pathname && url.search === window.location.search) return;
        } catch {
            return;
        }

        e.preventDefault();
        document.body.classList.add('is-leaving');
        showLoader();
        setTimeout(() => {
            window.location.href = link.href;
        }, 180);
    });
})();
*/

window.confirmDelete = function (message = 'Data yang dihapus tidak dapat dikembalikan!') {
    return Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: BRAND.danger,
        cancelButtonColor: BRAND.muted,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
    });
};

window.confirmDanger = function (title, text) {
    return Swal.fire({
        title: title || 'Peringatan!',
        text: text || 'Aksi ini tidak dapat dibatalkan.',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: BRAND.danger,
        cancelButtonColor: BRAND.muted,
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
    });
};

window.showSuccess = function (message) {
    return Swal.fire({
        title: 'Berhasil!',
        text: message,
        icon: 'success',
        confirmButtonColor: BRAND.success,
        confirmButtonText: 'OK',
    });
};

window.showError = function (message) {
    return Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonColor: BRAND.danger,
        confirmButtonText: 'OK',
    });
};

window.toast = function (type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        },
    });

    Toast.fire({ icon: type, title: message });
};

document.addEventListener('DOMContentLoaded', function () {
    const flashSuccess = document.querySelector('meta[name="flash-success"]');
    if (flashSuccess?.content) toast('success', flashSuccess.content);

    const flashError = document.querySelector('meta[name="flash-error"]');
    if (flashError?.content) toast('error', flashError.content);

    const flashWarning = document.querySelector('meta[name="flash-warning"]');
    if (flashWarning?.content) toast('warning', flashWarning.content);
});

window.confirmSubmit = function (event, title, text) {
    event.preventDefault();
    const form = event.target;

    Swal.fire({
        title: title || 'Konfirmasi',
        text: text || 'Apakah Anda yakin?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: BRAND.success,
        cancelButtonColor: BRAND.muted,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });

    return false;
};

window.confirmDeleteForm = function (event, message) {
    event.preventDefault();
    const form = event.target;

    confirmDelete(message).then((result) => {
        if (result.isConfirmed) form.submit();
    });

    return false;
};

window.confirmBulkDelete = function (event) {
    event.preventDefault();
    const form = event.target;

    confirmDanger(
        'PERINGATAN BAHAYA!',
        'Apakah Anda yakin ingin MENGHAPUS SELURUH DATA ini? Data yang dihapus tidak dapat dikembalikan lagi!'
    ).then((result) => {
        if (result.isConfirmed) form.submit();
    });

    return false;
};
