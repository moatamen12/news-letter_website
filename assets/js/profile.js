// Error handling utilities
function showError(message, element) {
    // Remove any existing error messages
    clearError(element);
    
    // Create error message container
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger mt-1 small';
    errorDiv.textContent = message;
    
    // Insert after the element
    element.parentNode.insertBefore(errorDiv, element.nextSibling);
    
    // Add error class to the input
    element.classList.add('is-invalid');
}

function clearError(element) {
    // Clear all errors if form element is passed
    if (element.tagName === 'FORM') {
        const errorMessages = element.querySelectorAll('.error-message');
        errorMessages.forEach(msg => msg.remove());
        
        const invalidInputs = element.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => input.classList.remove('is-invalid'));
        return;
    }
    
    // Clear specific error for an input element
    const errorElement = element.parentNode.querySelector('.error-message');
    if (errorElement) {
        errorElement.remove();
    }
    element.classList.remove('is-invalid');
}

// Validation functions
function validateUsername(username, minLength = 5) {
    if (!username) return true; // Skip if element doesn't exist
    
    if (!username.value.trim()) {
        showError('Username is required', username);
        return false;
    } 
    
    if (username.value.length < minLength) {
        showError(`Username must be at least ${minLength} characters`, username);
        return false;
    }
    
    // Username format validation (letters, numbers, underscores)
    const usernameRegex = /^[a-zA-Z0-9_]+$/;
    if (!usernameRegex.test(username.value)) {
        showError('Username can only contain letters, numbers, and underscores', username);
        return false;
    }
    
    return true;
}

function validateEmail(email) {
    if (!email) return true; // Skip if element doesn't exist
    
    if (!email.value.trim()) {
        showError('Email is required', email);
        return false;
    }
    
    // Email format validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        showError('Please enter a valid email address', email);
        return false;
    }
    
    return true;
}

function validatePassword(password, minLength = 8) {
    if (!password) return true; // Skip if element doesn't exist
    
    if (!password.value.trim()) {
        showError('Password is required', password);
        return false;
    }
    
    if (password.value.length < minLength) {
        showError(`Password must be at least ${minLength} characters`, password);
        return false;
    }
    
    return true;
}

function validateMessage(message) {
    if (!message) return true; // Skip if element doesn't exist
    
    if (!message.value.trim()) {
        showError('Message is required', message);
        return false;
    }
    
    return true;
}

function displayServerErrors() {
    console.log('Server data:', window.serverData); // Debug output
    
    if (window.serverData && window.serverData.errors && window.serverData.errors.length > 0) {
        try {
            // If modal not found (not loaded)
            const modal = document.getElementById('subscribeModal');
            if (!modal) {
                console.error('Modal element not found');
                return;
            }
            
            // Ensure Bootstrap is loaded
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
            });  // <-- Fixed missing closing parenthesis
            
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

// Document ready handler
document.addEventListener('DOMContentLoaded', function() {

    displayServerErrors();
    
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
            if (Fname && !Fname.value.trim()) {
                showError('Full Name is required', Fname);
                hasError = true;
            } else if (Fname && Fname.value.length < 5) { 
                showError('Full Name must be at least 5 characters', Fname);
                hasError = true;
            }

            // Username validation
            if (username && !validateUsername(username)) {
                hasError = true;
            }

            // Email validation
            if (email && !validateEmail(email)) {
                hasError = true;
            }

            // Password validation
            if (password && !validatePassword(password)) {
                hasError = true;
            }

            // Confirm password validation
            if (confPassword && password && password.value !== confPassword.value) {
                showError('Passwords do not match', confPassword);
                hasError = true;
            }
            
            if (hasError) {
                event.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.error-message');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
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
            if (username && !validateUsername(username)) {
                hasLoginError = true;
            }
            
            // Validate email
            if (email && !validateEmail(email)) {
                hasLoginError = true;
            }
            
            // Validate password
            if (password && !validatePassword(password)) {
                hasLoginError = true;
            }
            
            // Prevent form submission if there are errors
            if (hasLoginError) {
                event.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.error-message');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }

    // Contact form validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {   
        contactForm.addEventListener('submit', function(event) {
            clearError(contactForm);
            
            // Fixed potential typo: using "contact_username" instead of "contanct_username"
            const username = document.getElementById('contact_username');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let hasError = false;
            
            // Validate username
            if (username && !validateUsername(username)) {
                hasError = true;
            }
            
            // Validate email
            if (email && !validateEmail(email)) {
                hasError = true;
            }
            
            // Validate message
            if (message && !validateMessage(message)) {
                hasError = true;
            }
            
            // Prevent form submission if there are errors
            if (hasError) {
                event.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.error-message');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Show loading indicator
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
                    submitBtn.disabled = true;
                    
                    // Re-enable after timeout (fallback in case form submission is delayed)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 5000);
                }
            }
        });
    }
    
    // Profile form validation
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(event) {
            clearError(profileForm);
            let hasError = false;
            
            // Validate file type on submit
            const imgUpload = document.getElementById('profileImageUpload');
            if (imgUpload && imgUpload.files.length > 0) {
                const file = imgUpload.files[0];
                if (!(file.type === 'image/jpeg' || file.type === 'image/png')) {
                    showError('Invalid file type. Only JPEG or PNG files are allowed', imgUpload);
                    hasError = true;
                }
                
                // Check file size (max 1MB)
                const maxSize = 1 * 1024 * 1024; // 1MB
                if (file.size > maxSize) {
                    showError('File size exceeds 1MB limit', imgUpload);
                    hasError = true;
                }
            }
            // validation bio
            const bio = document.getElementById('bio');
            if (bio && bio.value.length > 500) {
                showError('Bio cannot exceed 500 characters', bio);
                hasError = true;
            }

            // validation of the fuul name
            const FullName = document.getElementById('FullName');
            if(FullName && !validateUsername(FullName)){
                hasError = true;
            }

            const usernameInput = document.getElementById('usernameInput');
            if(usernameInput && !validateUsername(usernameInput)){
                hasError = true;
            }
            // validation of the email
            const emaileInput = document.getElementById('emaileInput');
            if (emaileInput && !validateEmail(emaileInput)) {
                hasError = true;
            }

            
            if (hasError) {
                event.preventDefault();
                // Scroll to the first error
                const firstError = document.querySelector('.error-message');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Show a loading indicator
                const submitBtn = profileForm.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
                    submitBtn.disabled = true;
                }
            }
        });

        // Image preview functionality
        const imgUpload = document.getElementById('profileImageUpload');
        const imgPreview = document.getElementById('profileImagePreview');
        
        if (imgUpload && imgPreview) {
            imgUpload.addEventListener('change', function() {
                // Clear previous errors
                clearError(imgUpload);
                
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    
                    // Validate file type
                    if (!(file.type === 'image/jpeg' || file.type === 'image/png')) {
                        showError('Invalid file type. Only JPEG or PNG files are allowed', imgUpload);
                        return;
                    }
                    
                    // Validate file size
                    const maxSize = 1 * 1024 * 1024; // 1MB
                    if (file.size > maxSize) {
                        showError('File size exceeds 1MB limit', imgUpload);
                        return;
                    }
                    
                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                        imgPreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    }
});
