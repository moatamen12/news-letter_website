import { 
    isValidEmail, 
    clearError, 
    showError, 
    displayServerErrors 
} from './helpers_fun.js';

document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const eyeIcons = document.querySelectorAll('.fa-eye, .fa-eye-slash');
    eyeIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const inputField = this.closest('.input-group').querySelector('input');
            if (inputField.type === 'password') {
                inputField.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                inputField.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });

    // Subscribe form validation
    const subscribeForm = document.getElementById('subscribeForm');
    if (subscribeForm) {
        subscribeForm.addEventListener('submit', function(event) {
            clearError(subscribeForm);

            const Fname = document.getElementById('Fname');
            const username = document.getElementById('username');
            const email = document.getElementById('modalInputEmail');
            const password = document.getElementById('modalInputPassword');
            const confPassword = document.getElementById('confPassword');
            
            let hasError = false;
            if(!Fname.value.trim() ){
                showError('Full Name is required' ,Fname);
                hasError = true;
            }else if(Fname.value.length <5) { 
                showError('FullName must be at least 5 characters', Fname);
                hasError = true;
            }

            if(!username.value.trim()){
                showError('username is required', username);
                hasError = true;
            }else if(username.value.length <5) { 
                showError('Username must be at least 5 characters', username);
                hasError = true;
            }

            if (!email.value.trim()) {
                showError('Email is required', email);
                hasError = true;  
            } else if (!isValidEmail(email.value.trim())) {
                showError('Please enter a valid email address', email);
                hasError = true;  
            }

            if(!password.value.trim()){
                showError('password  is required', password);
                hasError = true;
            }else if (password.value.trim().length < 8) {
                showError('Password sholde have 8+ charecters', password);
                hasError = true;  
            }
            if (hasError){
                event.preventDefault();
            }
        });
    }
    // Login form validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {

                    clearError(loginForm);
                    

                    const username = document.getElementById('logusername');
                    const email = document.getElementById('logEmail');
                    const password = document.getElementById('logPassword');
                    
                    let hasLoginError = false;
                    
                    // Validate username
                    if (!username.value.trim()) {
                        showError('Username is required, should be>5', username);
                        hasLoginError = true;
                    }
                    
                    // Validate email
                    if (!email.value.trim()) {
                        showError('Email is required', email);
                        hasLoginError = true;
                    } else if (!isValidEmail(email.value.trim())) {
                        showError('Please enter a valid email address', email);
                        hasLoginError = true;
                    }
                    
                    // Validate password
                    if (!password.value.trim()) {
                        showError('Password is required', password);
                        hasLoginError = true;
                    }else if (password.value.trim().length < 8) {
                        showError('Password sholde have 8+ charecters', password);
                        hasLoginError = true;
                    }
                    
                    // Prevent form submission if there are errors
                    if (hasLoginError) {
                        event.preventDefault();
                    }
                });
    }

    
    // Call the function to display errors
    displayServerErrors();
});