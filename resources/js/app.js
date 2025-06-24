import './bootstrap';
import 'bootstrap';
import { showAlert } from './helpers';

document.addEventListener('DOMContentLoaded', function() {
    // get the notifications if there are any
    if (window.sessionMessage) {
        showAlert(window.sessionMessage.type, window.sessionMessage.title, window.sessionMessage.fields);
    }
    
    // Click event to toggle password visibility and icon
    document.querySelectorAll('.icon_show_password').forEach(icon => {
        icon.addEventListener('click', function () {
            let input = this.previousElementSibling;
    
            if (input && input.type === 'password') {
                input.type = 'text';
                this.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });

    // forces all included fields to have the first letter capitalized
    document.addEventListener('input', function(e) {
        const fields = ['name', 'last_name'];

        if(fields.includes(e.target.name)) {
            e.target.value = e.target.value.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
        }
    });
})