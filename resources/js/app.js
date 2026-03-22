import './bootstrap';

// confoirm modal script
window.openModal = function(actionUrl, name) {
    document.getElementById('confirm-modal-form').action = actionUrl;
    document.getElementById('confirm-modal-name').textContent = name;
    document.getElementById('confirm-modal').style.display = 'flex';
}

window.closeModal = function() {
    document.getElementById('confirm-modal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('confirm-modal');

    if (modal) {
        // Close if backdrop is clicked
        modal.addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    }
});
