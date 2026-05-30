/**
 * Sistem Stok Bahan Baku - 1/2 Kopi Tiam
 * Main JavaScript Entry Point
 */

// Import Alpine.js
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

/**
 * SweetAlert2 Helper Functions
 * SweetAlert2 is loaded via CDN in the layout
 */

// Confirm delete action
window.confirmDelete = function(message = 'Data yang dihapus tidak dapat dikembalikan!') {
    return Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    });
};

// Confirm dangerous action (bulk delete, etc)
window.confirmDanger = function(title, text) {
    return Swal.fire({
        title: title || 'Peringatan!',
        text: text || 'Aksi ini tidak dapat dibatalkan.',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Lanjutkan!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    });
};

// Show success message
window.showSuccess = function(message) {
    return Swal.fire({
        title: 'Berhasil!',
        text: message,
        icon: 'success',
        confirmButtonColor: '#0fa958',
        confirmButtonText: 'OK'
    });
};

// Show error message
window.showError = function(message) {
    return Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'OK'
    });
};

// Toast notification
window.toast = function(type, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
    
    Toast.fire({
        icon: type,
        title: message
    });
};

/**
 * Auto-show flash messages from session
 * Uses meta tags set in the layout
 */
document.addEventListener('DOMContentLoaded', function() {
    // Check for success flash message
    const flashSuccess = document.querySelector('meta[name="flash-success"]');
    if (flashSuccess && flashSuccess.content) {
        toast('success', flashSuccess.content);
    }
    
    // Check for error flash message
    const flashError = document.querySelector('meta[name="flash-error"]');
    if (flashError && flashError.content) {
        toast('error', flashError.content);
    }
    
    // Check for warning flash message
    const flashWarning = document.querySelector('meta[name="flash-warning"]');
    if (flashWarning && flashWarning.content) {
        toast('warning', flashWarning.content);
    }
});

/**
 * Form submission with SweetAlert2 confirmation
 * Usage: <form onsubmit="return confirmSubmit(event, 'Yakin?', 'Data akan dihapus')">
 */
window.confirmSubmit = function(event, title, text) {
    event.preventDefault();
    const form = event.target;
    
    Swal.fire({
        title: title || 'Konfirmasi',
        text: text || 'Apakah Anda yakin?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0fa958',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
};

/**
 * Delete confirmation with form submission
 * Usage: <form onsubmit="return confirmDeleteForm(event)">
 */
window.confirmDeleteForm = function(event, message) {
    event.preventDefault();
    const form = event.target;
    
    confirmDelete(message).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
};

/**
 * Bulk delete confirmation
 * Usage: <form onsubmit="return confirmBulkDelete(event)">
 */
window.confirmBulkDelete = function(event) {
    event.preventDefault();
    const form = event.target;
    
    confirmDanger(
        'PERINGATAN BAHAYA!',
        'Apakah Anda yakin ingin MENGHAPUS SELURUH DATA ini? Data yang dihapus tidak dapat dikembalikan lagi!'
    ).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
};

console.log('Sistem Stok Bahan Baku - JS Loaded');
