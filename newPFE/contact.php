<?php 
    $page_title = 'Contact Us';
    require_once 'includes/header.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Temporary debug (remove when done)
    // var_dump($_SESSION);


    // Get messages from session - consistent variable naming
    $errors = $_SESSION['errors'] ?? [];
    $success = $_SESSION['success'] ?? [];

    // Form data from session (if available)
    $formData = $_SESSION['form_data'] ?? [];

    // Clean up session after use
    unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['form_data']);


    $isLoggedIn = isset($_SESSION['user_id']);
?>

<div class="container py-5 my-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold mb-2">Contact Us</h1>
            <p class="text-muted">Have questions, comments or suggestions? We'd love to hear from you!</p>
        </div>
    </div>

    <!-- disply errors -->
    <div class="container mt-3">
        <?php 
            include 'includes/messages.php';
        ?>
    </div>


    <!-- Login required message for non-logged in users -->
    <?php if (!$isLoggedIn): ?>
    <div class="alert alert-info">
        <h5>Login Required</h5>
        <p>You need to be logged in to send us a message.</p>
        <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#LoginModal">Log In</a>
        <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#subscribeModal">Register</a>
    </div>
    
    <?php else: ?>
    <!-- Contact form - only shown for logged in users -->
    <div class="row g-4">
        <!-- Form Column -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-body ">
                    <h3 class="mb-4 border-start border-4 border-info ps-3">Send us a message</h3>
                    <form action="controllers/contatc_controllers/contact_msg.php" method="post" id="contactForm">
                        <input type="hidden" name="form_submitted" value="1" />
                        <div class="row mb-3 g-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="username" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="contanct_username" name="contanct_username" 
                                    value="<?= htmlspecialchars($formData['username'] ?? $_SESSION['username'] ?? '') ?>"/>
                                
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= htmlspecialchars($formData['email'] ?? $_SESSION['email'] ?? '') ?>"/>
                                
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    value="<?= htmlspecialchars($formData['subject'] ?? '') ?>"/>
                                
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="general" <?= ($formData['category'] ?? '') === 'general' ? 'selected' : '' ?>>General</option>
                                    <option value="Technical Support" <?= ($formData['category'] ?? '') === 'Technical Support' ? 'selected' : '' ?>>Technical Support</option>
                                    <option value="complaint" <?= ($formData['category'] ?? '') === 'complaint' ? 'selected' : '' ?>>Complaint</option>
                                    <option value="Suggestion" <?= ($formData['category'] ?? '') === 'Suggestion' ? 'selected' : '' ?>>Suggestion</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="should not pass 500 letter "><?= htmlspecialchars($formData['message'] ?? '') ?></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-2"></i>Send Message</button>
                            <button type="reset" class="btn btn-outline-info ms-2"><i class="fas fa-redo me-2"></i>Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contact Info Column -->
        <div class="col-lg-5">
            <!-- Contact Information Card -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Contact Information</h5>
                    <div class="mb-3 d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-envelope fa-lg text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Email Us</h6>
                            <a href="mailto:info@newsletter.com" class="text-decoration-none">info@newsletter.com</a>
                        </div>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-phone-alt fa-lg text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Call Us</h6>
                            <a href="tel:+1234567890" class="text-decoration-none">+1 (234) 567-890</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-map-marker-alt fa-lg text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Our Location</h6>
                            <p class="mb-0">123 Tech Street, Digital City, 45678</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Social Media Card -->
            <div class="card shadow-sm shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Connect With Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none d-flex align-items-center">
                                <i class="fab fa-facebook-f me-3 text-primary"></i>
                                <span>@facebook.com/newsletter</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none d-flex align-items-center">
                                <i class="fab fa-twitter me-3 text-info"></i>
                                <span>@newsletter</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none d-flex align-items-center">
                                <i class="fab fa-instagram me-3 text-danger"></i>
                                <span>@newsletter_official</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none d-flex align-items-center">
                                <i class="fab fa-linkedin me-3 text-primary"></i>
                                <span>@linkedin.com/company/newsletter</span>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none d-flex align-items-center">
                                <i class="fa-brands fa-discord me-3" style="color: #794f9c;"></i>
                                <span>@descord.com/newsletter</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>