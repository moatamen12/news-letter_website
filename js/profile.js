document.addEventListener('DOMContentLoaded', function() {

    const profileImageUpload = document.getElementById('profileImageUpload');
    const profileImagePreview = document.getElementById('profileImagePreview');

    profileImageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Check file size (max 1MB)
            if (file.size > 1048576) {
                alert("Image is too large! Please select an image less than 1MB.");
                return;
            }

            // Check file type
            if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                alert("Please select a JPG or PNG image.");
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                profileImagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Form submission
    const profileForm = document.getElementById('profileForm');
    profileForm.addEventListener('submit', function(event) {
        // Password validation
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (password && password !== confirmPassword) {
            event.preventDefault();
            alert("Passwords do not match!");
            return;
        }
        
        // Allow form submission to proceed if passwords match
        // The form will be submitted to the server
        console.log("Form submitted with the following data:");
        const formData = new FormData(profileForm);
        for (const [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
    });
});
