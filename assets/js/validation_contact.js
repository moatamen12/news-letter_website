import { 
    isValidEmail, 
    clearError, 
    showError 
} from './helpers_fun.js';

document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('ContactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            //verefying if useer is loged in
            if (!userLoggedIn) {
                event.preventDefault();
                
                // Create login modal or message
                const formContainer = contactForm.closest('.card-body');
                
                // Clear the form
                formContainer.innerHTML = `
                    <div class="alert alert-warning">
                        <h4><i class="fas fa-exclamation-triangle me-2"></i>Login Required</h4>
                        <p>You must be logged in to send a message.</p>
                        <a href="login.php" class="btn btn-subscribe mt-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Log In
                        </a>
                        <a href="index.php" class="btn btn-outline-secondary mt-3 ms-2">
                            <i class="fas fa-home me-2"></i>Back to Home
                        </a>
                    </div>
                `;
                return;
            }
            
            // If logged in, continue with form validation
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
            }
        });
    }
});