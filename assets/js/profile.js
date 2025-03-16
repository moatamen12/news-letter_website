// Helper functions
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function clearError(Form) {
    Form.querySelectorAll('.error-message').forEach(msg => msg.remove());
}

function showError(error, element) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger';
    errorDiv.style.fontSize = '0.9em';
    errorDiv.textContent = error;
    element.parentElement.appendChild(errorDiv);
}

function displayServerErrors() {
    console.log('Server data:', window.serverData); // Debug output
    
    if (window.serverData && window.serverData.errors && window.serverData.errors.length > 0) {
        try {
            // if model not found(not loaded)
            const modal = document.getElementById('subscribeModal');
            if (!modal) {
                console.error('Modal element not found');
                return;
            }
            
            //Bootstrap is available
            if (typeof bootstrap === 'undefined') {
                console.error('Bootstrap not loaded');
                return;
            }
            
            const subscribeModal = new bootstrap.Modal(modal);
            subscribeModal.show();
            
            const errorContainer = document.getElementById('serverErrorContainer');
            const errorList = document.getElementById('errorList');
            
            if (!errorContainer || !errorList) {
                console.error('Error container or list not found');
                return;
            }
            
            errorList.innerHTML = '';
            window.serverData.errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });
            
            errorContainer.classList.remove('d-none');
            
            // Fill form data if available
            const formData = window.serverData.formData || {};
            if (formData['Full Name'] && document.getElementById('Fname')) {
                document.getElementById('Fname').value = formData['Full Name'];
            }
            if (formData['username'] && document.getElementById('username')) {
                document.getElementById('username').value = formData['username'];
            }
            if (formData['email'] && document.getElementById('modalInputEmail')) {
                document.getElementById('modalInputEmail').value = formData['email'];
            }
        } catch (err) {
            console.error('Error displaying server errors:', err);
        }
    }
}

// Validation functions
function validateUsername(username, minLength = 5) {
    if (!username.value.trim()) {
        showError('Username is required', username);
        return false;
    } else if (username.value.length < minLength) {
        showError(`Username must be at least ${minLength} characters`, username);
        return false;
    }
    return true;
}

function validateEmail(email) {
    if (!email.value.trim()) {
        showError('Email is required', email);
        return false;
    } else if (!isValidEmail(email.value.trim())) {
        showError('Please enter a valid email address', email);
        return false;
    }
    return true;
}

function validatePassword(password, minLength = 8) {
    if (!password.value.trim()) {
        showError('Password is required', password);
        return false;
    } else if (password.value.trim().length < minLength) {
        showError(`Password should have at least ${minLength} characters`, password);
        return false;
    }
    return true;
}

function validateMessage(message) {
    if (!message.value.trim()) {
        showError('Message is required', message);
        return false;
    }
    return true;
}
//Profile validation function
function validateProfile(form) {
    clearError(form);
    let hasError = false;
    
    // Get profile form elements
    const fullName = document.getElementById('profile_fullname');
    const bio = document.getElementById('profile_bio');
    const currentPassword = document.getElementById('current_password');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    const profileImage = document.getElementById('profile_image');
    
    // Validate full name
    if (fullName && !fullName.value.trim()) {
        showError('Full name is required', fullName);
        hasError = true;
    }
    
    // Validate bio (if required)
    if (bio && bio.value.trim().length > 500) {
        showError('Bio should not exceed 500 characters', bio);
        hasError = true;
    }
    
    // Password change validation (only if user is changing password)
    if (newPassword && newPassword.value.trim()) {
        // Current password is required when changing password
        if (!currentPassword.value.trim()) {
            showError('Current password is required to set a new password', currentPassword);
            hasError = true;
        }
        
        // Validate new password
        if (newPassword.value.trim().length < 8) {
            showError('New password must be at least 8 characters', newPassword);
            hasError = true;
        }
        
        // Confirm passwords match
        if (newPassword.value !== confirmPassword.value) {
            showError('Passwords do not match', confirmPassword);
            hasError = true;
        }
    }
    
    // Validate profile image (if user is uploading one)
    if (profileImage && profileImage.files.length > 0) {
        const file = profileImage.files[0];
        const fileSize = file.size / 1024 / 1024; // size in MB
        const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        
        if (!validTypes.includes(file.type)) {
            showError('Please upload a valid image file (JPG, PNG, or GIF)', profileImage);
            hasError = true;
        }
        
        if (fileSize > 2) {
            showError('Image size should not exceed 2MB', profileImage);
            hasError = true;
        }
    }
    
    return !hasError;
}

// Document ready handler
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

            // Full name validation
            if(!Fname.value.trim()) {
                showError('Full Name is required', Fname);
                hasError = true;
            } else if(Fname.value.length < 5) { 
                showError('Full Name must be at least 5 characters', Fname);
                hasError = true;
            }

            // Username validation
            if(!validateUsername(username)) {
                hasError = true;
            }

            // Email validation
            if(!validateEmail(email)) {
                hasError = true;
            }

            // Password validation
            if(!validatePassword(password)) {
                hasError = true;
            }

            // Confirm password validation
            if(confPassword && password.value !== confPassword.value) {
                showError('Passwords do not match', confPassword);
                hasError = true;
            }
            
            if (hasError) {
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
            if(!validateUsername(username)) {
                hasLoginError = true;
            }
            
            // Validate email
            if(!validateEmail(email)) {
                hasLoginError = true;
            }
            
            // Validate password
            if(!validatePassword(password)) {
                hasLoginError = true;
            }
            
            // Prevent form submission if there are errors
            if (hasLoginError) {
                event.preventDefault();
            }
        });
    }

    // Contact form validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {   
        contactForm.addEventListener('submit', function(event) {
            clearError(contactForm);
            
            const username = document.getElementById('contanct_username');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let hasError = false;
            
            // Validate username
            if(!validateUsername(username)) {
                hasError = true;
            }
            
            // Validate email
            if(!validateEmail(email)) {
                hasError = true;
            }
            
            // Validate message
            if(!validateMessage(message)) {
                hasError = true;
            }
            
            if (hasError) {
                event.preventDefault();
                // Scroll to the first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.focus();
                }
            } else {
                // Show a loading indicator
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
                submitBtn.disabled = true;
            }
        });
    }

    // NEW: Profile form validation
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(event) {
            const isValid = validateProfile(profileForm);
            
            if (!isValid) {
                event.preventDefault();
                // Scroll to the first error
                const firstError = document.querySelector('.error-message');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Show loading indicator
                const submitBtn = profileForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...';
                submitBtn.disabled = true;
            }
        });
    }
    
    // Call the function to display errors
    displayServerErrors();
});