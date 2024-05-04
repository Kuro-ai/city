import './bootstrap';
import 'flowbite';
import 'alpinejs';

document.querySelectorAll('.close-alert').forEach(function(closeButton) {
    closeButton.addEventListener('click', function() {
        this.parentElement.style.display = 'none';
    });
});
