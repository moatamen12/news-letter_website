document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const usernameEmail = document.getElementById('logUsernameEmail').value.trim();
            const password = document.getElementById('logPassword').value.trim();
            
            // Form validation
            if (!usernameEmail || !password) {
                showError('Please enter both username/email and password.');
                return;
            }
            
            // Prepare data for API
            const loginData = {
                identifier: usernameEmail,
                password: password
            };
            
            // Show loading state
            const submitBtn = loginForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging in...';
            
            // Clear previous errors
            clearErrors();
            
            // Send login request to API
            fetch('/newsletter/newPFE/APIS/user_management/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(loginData),
                credentials: 'include' // Include cookies (for session)
            })
            .then(response => {
                // Store status for checking if it's a server error
                const status = response.status;
                return response.json().then(data => {
                    return { status, data };
                });
            })
            .then(({ status, data }) => {
                if (data.success) {
                    // Login successful
                    window.location.reload(); // Reload the page to update the UI
                } else {
                    // Different error handling based on status code
                    if (status === 500) {
                        console.error('Server error details:', data.debug);
                        showError('Server error occurred. Please try again later or contact support.');
                    } else {
                        showError(data.message || 'Failed to login. Please check your credentials.');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Network error. Please check your connection and try again.');
            })
            .finally(() => {
                // Restore button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
    
    function showError(message) {
        const errorContainer = document.getElementById('loginServerErrorContainer');
        const errorList = document.getElementById('loginErrorList');
        
        if (errorContainer && errorList) {
            errorContainer.classList.remove('d-none');
            errorList.innerHTML = `<li>${message}</li>`;
        } else {
            // Fallback if error containers aren't found
            alert(message);
        }
    }
    
    function clearErrors() {
        const errorContainer = document.getElementById('loginServerErrorContainer');
        const errorList = document.getElementById('loginErrorList');
        
        if (errorContainer && errorList) {
            errorContainer.classList.add('d-none');
            errorList.innerHTML = '';
        }
    }
});