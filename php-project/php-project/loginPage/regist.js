document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('regist');

    form.addEventListener('submit', function(event) {
        const firstNameField = document.getElementById('signupFirstName');
        const lastNameField = document.getElementById('signupLastName');
        const emailField = document.getElementById('signupEmail');
        const passwordField = document.getElementById('signupPassword');
        const mobileField = document.getElementById('signupMobile');
        const cityField = document.getElementById('signupCity');
        const streetField = document.getElementById('signupStreet');
        const buildingNumberField = document.getElementById('signupAddress');

        const firstName = firstNameField.value.trim();
        const lastName = lastNameField.value.trim();
        const email = emailField.value.trim();
        const password = passwordField.value.trim();
        const mobile = mobileField.value.trim();
        const city = cityField.value.trim();
        const street = streetField.value.trim();
        const buildingNumber = buildingNumberField.value.trim();

        let hasError = false;

        firstNameField.style.border = '';
        lastNameField.style.border = '';
        emailField.style.border = '';
        passwordField.style.border = '';
        mobileField.style.border = '';
        cityField.style.border = '';
        streetField.style.border = '';
        buildingNumberField.style.border = '';

       
        if (firstName === '') {
            firstNameField.style.border = '2px solid red';
            hasError = true;
        }
        if (lastName === '') {
            lastNameField.style.border = '2px solid red';
            hasError = true;
        }
        if (email === '') {
            emailField.style.border = '2px solid red';
            hasError = true;
        }
        if (password === '') {
            passwordField.style.border = '2px solid red';
            hasError = true;
        }
        if (mobile === '') {
            mobileField.style.border = '2px solid red';
            hasError = true;
        }
        if (city === '') {
            cityField.style.border = '2px solid red';
            hasError = true;
        }
        if (street === '') {
            streetField.style.border = '2px solid red';
            hasError = true;
        }
        if (buildingNumber === '') {
            buildingNumberField.style.border = '2px solid red';
            hasError = true;
        }

        
        if (hasError) {
            event.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Invalid Input',
                text: 'Please fill in all required fields.',
            })
            return;
        }

        
        event.preventDefault(); 

        fetch(`check_email.php?email=${encodeURIComponent(email)}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Already Exists',
                        text: 'The email you entered is already in use. Please use a different email.',
                    }).then(() => {
                        emailField.value = ''; 
                    });
                } else {
                    form.submit(); 
                }
            })
            .catch(error => console.error('Error checking email:', error));
    });
});










