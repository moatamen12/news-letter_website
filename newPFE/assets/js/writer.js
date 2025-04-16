document.addEventListener('DOMContentLoaded', function() {
    // --- Multi-Step Form Logic ---
    const steps = document.querySelectorAll('#writerOnboardingForm .writer-step');
    const nextBtns = document.querySelectorAll('.writer-next-btn');
    const prevBtns = document.querySelectorAll('.writer-prev-btn');
    const form = document.getElementById('writerOnboardingForm');
    const stepNumberSpan = document.getElementById('writerStepNumber');
    const progressBar = document.getElementById('writerProgressBar');
    const step1Indicator = document.getElementById('step1Indicator');
    const step2Indicator = document.getElementById('step2Indicator');
    const step3Indicator = document.getElementById('step3Indicator');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('d-none', index !== stepIndex);
        });
        currentStep = stepIndex;
        
        // Update progress bar
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = progress + '%';
        progressBar.setAttribute('aria-valuenow', progress);
        
        // Update step indicators
        updateStepIndicators(currentStep);
    }
    
    function updateStepIndicators(currentStep) {
        // Reset all indicators
        step1Indicator.className = 'rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center';
        step2Indicator.className = 'rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center';
        step3Indicator.className = 'rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center';
        
        // Mark active and complete steps
        if (currentStep >= 0) {
            step1Indicator.className = currentStep > 0 ? 
                'rounded-circle step-complete text-white d-flex align-items-center justify-content-center' : 
                'rounded-circle step-active text-white d-flex align-items-center justify-content-center';
            
            if (currentStep > 0) {
                step1Indicator.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                step1Indicator.innerHTML = '<i class="fas fa-envelope"></i>';
            }
        }
        
        if (currentStep >= 1) {
            step2Indicator.className = currentStep > 1 ? 
                'rounded-circle step-complete text-white d-flex align-items-center justify-content-center' : 
                'rounded-circle step-active text-white d-flex align-items-center justify-content-center';
            
            if (currentStep > 1) {
                step2Indicator.innerHTML = '<i class="fas fa-check"></i>';
            } else {
                step2Indicator.innerHTML = '<i class="fas fa-user"></i>';
            }
        }
        
        if (currentStep >= 2) {
            step3Indicator.className = 'rounded-circle step-active text-white d-flex align-items-center justify-content-center';
        }
    }

    // Handle next button clicks with validation
    nextBtns.forEach(button => {
        button.addEventListener('click', () => {
            // --- Basic Validation ---
            let isValid = true;
            const currentStepInputs = steps[currentStep].querySelectorAll('input[required], textarea[required], select[required]');
            
            currentStepInputs.forEach(input => {
                if (input.type === 'password' && input.id === 'WconfPassword') {
                    // Special validation for password confirmation
                    const password = document.getElementById('WPassword').value;
                    if (input.value !== password) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                } else if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) return; // Stop if validation fails

            if (currentStep < steps.length - 1) {
                showStep(currentStep + 1);
            }
        });
    });

    // Handle previous button clicks
    prevBtns.forEach(button => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                showStep(currentStep - 1);
            }
        });
    });

    // --- Reset on Modal Close ---
    const writerModal = document.getElementById('writerOnboardingModal');
    if (writerModal) {
        writerModal.addEventListener('hidden.bs.modal', function () {
            showStep(0);
            form.reset();
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.getElementById('writerServerErrorContainer').classList.add('d-none');
            document.getElementById('writerErrorList').innerHTML = '';
            
            // Reset photo preview
            document.getElementById('photoPreview').style.display = 'none';
            document.getElementById('photoPlaceholder').style.display = 'flex';
            document.getElementById('removePhotoBtn').classList.add('d-none');
            
            // Remove extra social links
            const socialContainer = document.getElementById('socialLinksContainer');
            const extraLinks = socialContainer.querySelectorAll('.social-link-row:not(:first-child)');
            extraLinks.forEach(link => link.remove());
            
            // Ensure first remove button is hidden
            const firstRemoveBtn = socialContainer.querySelector('.remove-social-link-btn');
            if(firstRemoveBtn) firstRemoveBtn.style.display = 'none';
            
            // Reset step indicators
            updateStepIndicators(0);
        });
        
        // Focus trap in modal for keyboard navigation
        writerModal.addEventListener('shown.bs.modal', function() {
            // Set focus on first input
            const firstInput = writerModal.querySelector('input:not([type="hidden"])');
            if (firstInput) firstInput.focus();
        });
    }

    // --- Profile Photo Preview ---
    const photoInput = document.getElementById('writerProfilePhoto');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const removePhotoBtn = document.getElementById('removePhotoBtn');
    
    if (photoInput && photoPreview && photoPlaceholder) {
        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                    photoPlaceholder.style.display = 'none';
                    if (removePhotoBtn) removePhotoBtn.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Remove photo functionality
        if (removePhotoBtn) {
            removePhotoBtn.addEventListener('click', function() {
                photoInput.value = '';
                photoPreview.src = '#';
                photoPreview.style.display = 'none';
                photoPlaceholder.style.display = 'flex';
                removePhotoBtn.classList.add('d-none');
            });
        }
    }

    // --- Password Strength Meter ---
    const passwordInput = document.getElementById('WPassword');
    const strengthBar = document.getElementById('passwordStrength');
    
    if (passwordInput && strengthBar) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Calculate password strength
            if (password.length >= 8) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^A-Za-z0-9]/)) strength += 1;
            
            // Update strength bar
            switch(strength) {
                case 0:
                    strengthBar.style.width = '0%';
                    strengthBar.className = 'progress-bar';
                    break;
                case 1:
                    strengthBar.style.width = '25%';
                    strengthBar.className = 'progress-bar strength-weak';
                    break;
                case 2:
                    strengthBar.style.width = '50%';
                    strengthBar.className = 'progress-bar strength-medium';
                    break;
                case 3:
                    strengthBar.style.width = '75%';
                    strengthBar.className = 'progress-bar strength-medium';
                    break;
                case 4:
                    strengthBar.style.width = '100%';
                    strengthBar.className = 'progress-bar strength-strong';
                    break;
            }
        });
    }

    // --- Bio character counter ---
    const bioTextarea = document.getElementById('writerBio');
    const bioCharCount = document.getElementById('bioCharCount');
    
    if (bioTextarea && bioCharCount) {
        bioTextarea.addEventListener('input', function() {
            const length = this.value.length;
            bioCharCount.textContent = length;
            
            if (length > 160) {
                bioCharCount.classList.add('text-danger');
            } else {
                bioCharCount.classList.remove('text-danger');
            }
        });
    }

    // --- Add/Remove Social Links ---
    const socialContainer = document.getElementById('socialLinksContainer');
    const addSocialBtn = document.getElementById('addSocialLinkBtn');
    
    if (socialContainer && addSocialBtn) {
        const firstSocialRow = socialContainer.querySelector('.social-link-row');
        
        function updateRemoveButtons() {
            const rows = socialContainer.querySelectorAll('.social-link-row');
            rows.forEach((row) => {
                const removeBtn = row.querySelector('.remove-social-link-btn');
                if (removeBtn) {
                    removeBtn.style.display = rows.length > 1 ? 'inline-block' : 'none';
                }
            });
        }
        
        addSocialBtn.addEventListener('click', function() {
            const newRow = firstSocialRow.cloneNode(true);
            newRow.querySelector('input').value = '';
            newRow.querySelector('select').selectedIndex = 0;
            
            const removeBtn = newRow.querySelector('.remove-social-link-btn');
            if (removeBtn) {
                removeBtn.style.display = 'inline-block';
                removeBtn.addEventListener('click', function() {
                    newRow.remove();
                    updateRemoveButtons();
                });
            }
            
            socialContainer.appendChild(newRow);
            updateRemoveButtons();
        });
        
        // Add event listener to initial remove button
        const initialRemoveBtn = firstSocialRow.querySelector('.remove-social-link-btn');
        if (initialRemoveBtn) {
            initialRemoveBtn.addEventListener('click', function() {
                if (socialContainer.querySelectorAll('.social-link-row').length > 1) {
                    firstSocialRow.remove();
                    updateRemoveButtons();
                }
            });
        }
        
        updateRemoveButtons();
    }

    // Initialize the form
    showStep(0);
    
    // Handle form submission
    form.addEventListener('submit', function(event) {
        // Final validation check before submission
        const allRequiredInputs = form.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;
        
        allRequiredInputs.forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                isValid = false;
            }
        });
        
        if (!isValid) {
            event.preventDefault();
            // Show the step with errors
            const invalidInput = form.querySelector('.is-invalid');
            if (invalidInput) {
                const stepWithError = invalidInput.closest('.writer-step');
                const stepIndex = Array.from(steps).indexOf(stepWithError);
                if (stepIndex !== -1) {
                    showStep(stepIndex);
                }
                invalidInput.focus();
            }
        }
    });



    // Handle next button clicks with validation
nextBtns.forEach(button => {
    button.addEventListener('click', () => {
        // --- Basic Validation ---
        let isValid = true;
        const currentStepInputs = steps[currentStep].querySelectorAll('input[required], textarea[required], select[required]');
        
        // If we're on step 1, add special password validation
        if (currentStep === 0) {
            const password = document.getElementById('WPassword');
            const confirmPassword = document.getElementById('WconfPassword');
            
            // Validate password is entered
            if (!password.value.trim()) {
                password.classList.add('is-invalid');
                const feedback = password.nextElementSibling?.nextElementSibling || document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = 'Please enter a password';
                if (!password.nextElementSibling?.nextElementSibling) {
                    password.parentNode.appendChild(feedback);
                }
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
            }
            
            // Validate confirmation password
            if (!confirmPassword.value.trim()) {
                confirmPassword.classList.add('is-invalid');
                confirmPassword.nextElementSibling.textContent = 'Please confirm your password';
                isValid = false;
            } else if (password.value !== confirmPassword.value) {
                confirmPassword.classList.add('is-invalid');
                confirmPassword.nextElementSibling.textContent = 'Passwords do not match';
                isValid = false;
            } else {
                confirmPassword.classList.remove('is-invalid');
            }
            
            // If passwords don't match or are empty, don't continue with other validations
            if (!isValid) {
                return;
            }
        }
        
        // Standard validation for all required fields
        currentStepInputs.forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                isValid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (!isValid) return; // Stop if validation fails

        if (currentStep < steps.length - 1) {
            showStep(currentStep + 1);
        }
    });
});

// Add this code after the password strength meter code section

// --- Password match checking ---
const confirmPasswordInput = document.getElementById('WconfPassword');
if (passwordInput && confirmPasswordInput) {
    // Create indicator element if it doesn't exist
    let matchIndicator = document.querySelector('.password-match-indicator');
    if (!matchIndicator) {
        matchIndicator = document.createElement('div');
        matchIndicator.className = 'password-match-indicator';
        confirmPasswordInput.parentNode.insertAdjacentElement('afterend', matchIndicator);
    }
    
    // Function to check password match
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (!confirmPassword) {
            matchIndicator.className = 'password-match-indicator';
            matchIndicator.innerHTML = '';
            return;
        }
        
        if (password === confirmPassword) {
            matchIndicator.className = 'password-match-indicator match';
            matchIndicator.innerHTML = '<i class="fas fa-check-circle"></i> Passwords match';
            confirmPasswordInput.classList.remove('is-invalid');
        } else {
            matchIndicator.className = 'password-match-indicator mismatch';
            matchIndicator.innerHTML = '<i class="fas fa-times-circle"></i> Passwords do not match';
            if (confirmPasswordInput.value) {
                confirmPasswordInput.classList.add('is-invalid');
            }
        }
    }
    
    // Add event listeners for both password fields
    passwordInput.addEventListener('input', checkPasswordMatch);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
}
});