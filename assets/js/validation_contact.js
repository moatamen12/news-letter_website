import { 
    isValidEmail, 
    clearError, 
    showError 
} from './helpers_fun.js';

document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('ContactForm'); 
    
    if (contactForm) {   
        contactForm.addEventListener('submit', function(event) {
            clearError(contactForm);
            
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let hasError = false;
            
            // Validate username
            if (!username.value.trim()) {
                showError('Username is required', username);
                hasError = true;
            }
            
            // Validate email
            if (!email.value.trim()) {
                showError('Email is required', email);
                hasError = true;
            } else if (!isValidEmail(email.value.trim())) {
                showError('Please enter a valid email address', email);
                hasError = true;
            }
            
            // Validate message
            if (!message.value.trim()) {
                showError('Message is required', message);
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
        
        // Handle category dropdown selection
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        const categoryInput = document.getElementById('category');
        const dropdownButton = document.querySelector('.dropdown-toggle');
        
        if (dropdownItems && categoryInput && dropdownButton) {
            dropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const category = this.textContent.trim().toLowerCase();
                    categoryInput.value = category;
                    dropdownButton.textContent = this.textContent;
                });
            });
        }
    }
});