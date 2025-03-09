document.addEventListener('DOMContentLoaded', function() {
    // Profile image preview functionality
    const profileImageUpload = document.getElementById('profileImageUpload');
    const profileImagePreview = document.getElementById('profileImagePreview');

    if (profileImageUpload && profileImagePreview) {
        profileImageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Check file size (max 1MB)
                if (file.size > 1048576) {
                    alert("Image is too large! Please select an image less than 1MB.");
                    profileImageUpload.value = '';
                    return;
                }

                // Check file type
                if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                    alert("Please select a JPG or PNG image.");
                    profileImageUpload.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Form validation
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(event) {
            // Password validation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password && password !== confirmPassword) {
                event.preventDefault();
                alert("Passwords do not match!");
                return false;
            }
            
            // Form will be submitted
            return true;
        });
    }
    
    // Show success messages for 3 seconds then fade out
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(function() {
            alertSuccess.style.transition = 'opacity 1s';
            alertSuccess.style.opacity = '0';
            setTimeout(function() {
                alertSuccess.style.display = 'none';
            }, 1000);
        }, 3000);
    }
});
