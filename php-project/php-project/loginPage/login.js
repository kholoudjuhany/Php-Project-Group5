// adding regex later 

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const emailField = document.getElementById('loginEmail');
    const passwordField = document.getElementById('loginPassword');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const email = emailField.value.trim();
        const password = passwordField.value.trim();

        let hasError = false;

        emailField.style.border = '';
        passwordField.style.border = '';

        if (email === '') {
            emailField.style.border = '2px solid red';
            hasError = true;
        }

        if (password === '') {
            passwordField.style.border = '2px solid red';
            hasError = true;
        }

        if (hasError) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Input',
                text: 'Both email and password are required.',
            }).then(() => {
                emailField.value = '';
                passwordField.value = '';
            });
        } else {
            echo ("Wrong Email or Password");
        }
    });
});













