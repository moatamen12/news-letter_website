// Clear error messages
function clearError(Form) {
    Form.querySelectorAll('.error-message').forEach(msg => msg.remove());
}

// Display error message
function showError(error, element) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger';
    errorDiv.style.fontSize = '0.9em';
    errorDiv.textContent = error;
    element.parentElement.appendChild(errorDiv);
}

// Validate email format
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

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
                hasLoginError = true;
            } else if (!isValidEmail(email.value.trim())) {
                showError('Please enter a valid email address', email);
                hasLoginError = true;
            }

            if(!password.value.trim()){
                showError('password  is required', password);
                hasError = true;
            }else if (password.value.trim().length < 8) {
                showError('Password sholde have 8+ charecters', password);
                hasLoginError = true;
            }

            if(!confPassword.value.trim()){
                showError('Please confirm your password', confPassword);
                hasError = true;
            }

            if (confPassword.value.trim() !== password.value.trim()){
                showError('Passwords do not match', confPassword);
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

    // Display server-side errors
    function displayServerErrors() {
        // Check if window.serverData exists (will be set in footer.php)
        if (window.serverData && window.serverData.errors && window.serverData.errors.length > 0) {
            // Show the subscribe modal
            const subscribeModal = new bootstrap.Modal(document.getElementById('subscribeModal'));
            subscribeModal.show();
            
            // Display errors
            const errorContainer = document.getElementById('serverErrorContainer');
            const errorList = document.getElementById('errorList');
            
            errorList.innerHTML = ''; // Clear previous errors
            window.serverData.errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });
            
            errorContainer.classList.remove('d-none');
            
            // Fill form with previous data
            const formData = window.serverData.formData || {};
            
            if (formData['Full Name']) {
                document.getElementById('Fname').value = formData['Full Name'];
            }
            if (formData['username']) {
                document.getElementById('username').value = formData['username'];
            }
            if (formData['email']) {
                document.getElementById('modalInputEmail').value = formData['email'];
            }
        }
    }

    // Call the function to display errors
    displayServerErrors();
});