import './bootstrap';

// Auto-hide alerts after 4 seconds
window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 4000);
    });
});
