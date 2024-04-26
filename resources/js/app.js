import './bootstrap';
import 'flowbite';

document.querySelectorAll('.close-alert').forEach(function(closeButton) {
    closeButton.addEventListener('click', function() {
        this.parentElement.style.display = 'none';
    });
});
