<!-- footer-->
<footer class="bg-light bg-opacity-90  py-2 mt-auto mt-5 border">

        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p class="text-color">Your trusted source for the latest tech news, trends, and insights. Stay informed with our curated content.</p>
                    <div class="d-flex">
                        <ul class="list-unstyled"></ul>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-color text-decoration-none">Home</a></li>
                        <li><a href="articles.php" class="text-color text-decoration-none">Articles</a></li>
                        <li><a href="contact.php" class="text-color text-decoration-none">Contact</a></li>
                        <li><a href="about_us.php" class="text-color text-decoration-none">Subscribe</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-3">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled text-color">
                        <li><i class="fas fa-envelope me-2"></i> info@technewsletter.com</li>
                        <li><i class="fas fa-phone me-2"></i> +1 234 567 890</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> Tech Street, Digital City</li>
                    </ul>
                </div>

                <div class="col-mde-4 mb-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                        <a href="#" class="btn btn-subscribe btn-sm px-4 py-2 rounded-3" data-bs-toggle="modal" data-bs-target="#subscribeModal">
                            <i class="fas fa-envelope-open me-1"></i> Subscribe Now
                        </a>
                        <a href="articles.php" class="btn btn-subscribe-outline btn-sm rounded-3 px-4 py-2">
                            <i class="fas fa-pen me-1"></i> Start Writing
                        </a>
                    </div>
                </div>




            </div>
        </div>

        <div class="text-center mt-3 border-top border-secondary">
            <p class="text-color mb-0">&copy; 2025 Tech Newsletter. All rights reserved.</p>
        </div>
    </footer>






    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> for the tiny -->
    <!-- Debug info with error handling -->
    <script>
        console.log('PHP error data:', <?php echo isset($allErrors) ? json_encode($allErrors) : '{}' ?>);
        
        window.serverData = {
            errors: <?php echo isset($allErrors) ? json_encode($allErrors) : '{}' ?>,
            formData: <?php echo isset($registerData) ? json_encode($registerData) : (isset($loginData) ? json_encode($loginData) : '{}') ?>
        };
    </script>
    
    <!-- Script imports -->

    <script src="assets/js/forms handlers.js"               type="module"></script>
    <script src="assets/js/writer.js"></script>
    <!-- <script src="C:\xampp\htdocs\newsLetter\newPFE\tinymce\tinymce\tinymce.min.js" referrerpolicy="origin"></script> -->

    <!-- Custom JavaScript for Multi-Step Form & Social Links -->
    
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     // --- Multi-Step Form Logic ---
        //     const steps = document.querySelectorAll('#writerOnboardingForm .writer-step');
        //     const nextBtns = document.querySelectorAll('#writerOnboardingForm .writer-next-btn');
        //     const prevBtns = document.querySelectorAll('#writerOnboardingForm .writer-prev-btn');
        //     const form = document.getElementById('writerOnboardingForm');
        //     const modalTitle = document.getElementById('writerOnboardingModalLabel');
        //     const stepNumberSpan = document.getElementById('writerStepNumber');
        //     const progressBar = document.getElementById('writerProgressBar');
        //     let currentStep = 0;

        //     function showStep(stepIndex) {
        //         steps.forEach((step, index) => {
        //             step.classList.toggle('d-none', index !== stepIndex);
        //         });
        //         currentStep = stepIndex;
        //         stepNumberSpan.textContent = currentStep + 1;
        //         const progress = ((currentStep + 1) / steps.length) * 100;
        //         progressBar.style.width = progress + '%';
        //         progressBar.setAttribute('aria-valuenow', progress);
        //     }

        //     nextBtns.forEach(button => {
        //         button.addEventListener('click', () => {
        //             // --- Basic Validation ---
        //             let isValid = true;
        //             const currentStepInputs = steps[currentStep].querySelectorAll('input[required], textarea[required], select[required]');
        //             currentStepInputs.forEach(input => {
        //                 if (!input.checkValidity()) {
        //                     input.classList.add('is-invalid');
        //                     isValid = false;
        //                 } else {
        //                     input.classList.remove('is-invalid');
        //                 }
        //             });

        //             if (!isValid) return; // Stop if validation fails

        //             if (currentStep < steps.length - 1) {
        //                 showStep(currentStep + 1);
        //             }
        //         });
        //     });

        //     prevBtns.forEach(button => {
        //         button.addEventListener('click', () => {
        //             if (currentStep > 0) {
        //                 showStep(currentStep - 1);
        //             }
        //         });
        //     });

        //     // --- Reset on Modal Close ---
        //     const writerModal = document.getElementById('writerOnboardingModal');
        //     if (writerModal) {
        //         writerModal.addEventListener('hidden.bs.modal', function () {
        //             showStep(0);
        //             form.reset();
        //             form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        //             document.getElementById('writerServerErrorContainer').classList.add('d-none');
        //             document.getElementById('writerErrorList').innerHTML = '';
        //             // Reset photo preview
        //             document.getElementById('photoPreview').style.display = 'none';
        //             document.getElementById('photoPlaceholder').style.display = 'flex';
        //             // Remove extra social links
        //             const socialContainer = document.getElementById('socialLinksContainer');
        //             const extraLinks = socialContainer.querySelectorAll('.social-link-row:not(:first-child)');
        //             extraLinks.forEach(link => link.remove());
        //             // Ensure first remove button is hidden
        //             const firstRemoveBtn = socialContainer.querySelector('.remove-social-link-btn');
        //             if(firstRemoveBtn) firstRemoveBtn.style.display = 'none';
        //         });
        //     }

        //     // --- Profile Photo Preview ---
        //     const photoInput = document.getElementById('writerProfilePhoto');
        //     const photoPreview = document.getElementById('photoPreview');
        //     const photoPlaceholder = document.getElementById('photoPlaceholder');
        //     if (photoInput && photoPreview && photoPlaceholder) {
        //         photoInput.addEventListener('change', function(event) {
        //             const file = event.target.files[0];
        //             if (file && file.type.startsWith('image/')) {
        //                 const reader = new FileReader();
        //                 reader.onload = function(e) {
        //                     photoPreview.src = e.target.result;
        //                     photoPreview.style.display = 'block';
        //                     photoPlaceholder.style.display = 'none';
        //                 }
        //                 reader.readAsDataURL(file);
        //             } else {
        //                 // Reset if no file or not an image
        //                 photoPreview.src = '#';
        //                 photoPreview.style.display = 'none';
        //                 photoPlaceholder.style.display = 'flex';
        //             }
        //         });
        //     }

        //     // --- Add/Remove Social Links ---
        //     const socialContainer = document.getElementById('socialLinksContainer');
        //     const addSocialBtn = document.getElementById('addSocialLinkBtn');
        //     const firstSocialRow = socialContainer.querySelector('.social-link-row');

        //     function updateRemoveButtons() {
        //         const rows = socialContainer.querySelectorAll('.social-link-row');
        //         rows.forEach((row, index) => {
        //             const removeBtn = row.querySelector('.remove-social-link-btn');
        //             if (removeBtn) {
        //                 removeBtn.style.display = rows.length > 1 ? 'inline-block' : 'none'; // Show only if more than one row
        //             }
        //         });
        //     }

        //     addSocialBtn.addEventListener('click', function() {
        //         const newRow = firstSocialRow.cloneNode(true);
        //         newRow.querySelector('input[type="url"]').value = ''; // Clear input value
        //         newRow.querySelector('select').selectedIndex = 0; // Reset select
        //         const removeBtn = newRow.querySelector('.remove-social-link-btn');
        //         if(removeBtn) {
        //             removeBtn.style.display = 'inline-block'; // Ensure remove button is visible on new rows
        //             removeBtn.addEventListener('click', function() {
        //                 newRow.remove();
        //                 updateRemoveButtons(); // Update visibility after removing
        //             });
        //         }
        //         socialContainer.appendChild(newRow);
        //         updateRemoveButtons(); // Update visibility after adding
        //     });

        //     // Add event listener to the initial remove button (if it exists)
        //     const initialRemoveBtn = firstSocialRow.querySelector('.remove-social-link-btn');
        //         if(initialRemoveBtn) {
        //         initialRemoveBtn.addEventListener('click', function() {
        //             firstSocialRow.remove(); // This should ideally not happen if it's the only row, handled by updateRemoveButtons
        //             updateRemoveButtons();
        //         });
        //         }

        //     updateRemoveButtons(); // Initial check on page load

        //     // --- Server Error Display Logic ---
        //     const writerServerErrors = <?php echo json_encode($writerErrors ?? []); ?>;
        //     const writerErrorListElem = document.getElementById('writerErrorList');
        //     const writerErrorContainerElem = document.getElementById('writerServerErrorContainer');
        //     if (writerServerErrors && Object.keys(writerServerErrors).length > 0 && writerErrorListElem && writerErrorContainerElem) {
        //             writerErrorListElem.innerHTML = '';
        //             Object.values(writerServerErrors).forEach(error => {
        //                 const li = document.createElement('li');
        //                 li.textContent = error;
        //                 writerErrorListElem.appendChild(li);
        //             });
        //             writerErrorContainerElem.classList.remove('d-none');
        //             var writerModalInstance = new bootstrap.Modal(writerModal);
        //             writerModalInstance.show();
        //             // Consider adding logic here to show the specific step with the error
        //     }
        // });
    </script>

</html>