export function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

export function clearError(Form) {
    Form.querySelectorAll('.error-message').forEach(msg => msg.remove());
}

export function showError(error, element) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-danger';
    errorDiv.style.fontSize = '0.9em';
    errorDiv.textContent = error;
    element.parentElement.appendChild(errorDiv);
}




export function displayServerErrors() {
    console.log('Server data:', window.serverData); // Debug output
    
    if (window.serverData && window.serverData.errors && window.serverData.errors.length > 0) {
        try {
            // if model not found(not lodded)
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

