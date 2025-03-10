<?php 
    $page_title = 'Contact Us';
    require_once 'includes/header.php';
    
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Get messages from session
    $contactErrors = $_SESSION['contact_errors'] ?? [];
    $contactError = $_SESSION['contact_error'] ?? '';
    $contactSuccess = $_SESSION['contact_success'] ?? '';
    
    // Get form data if available (for refilling the form after validation error)
    $formData = $_SESSION['form_data'] ?? [];
    
    // Clear session variables
    unset($_SESSION['contact_errors'], $_SESSION['contact_error'], $_SESSION['contact_success'], $_SESSION['form_data']);
    
    // Check if user is logged in
    $isLoggedIn = isset($_SESSION['user_id']);
?>

<div class="container py-5 my-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold mb-2">Contact Us</h1>
            <p class="text-muted">Have questions, comments or suggestions? We'd love to hear from you!</p>
        </div>
    </div>

    <!-- Success message -->
    <?php if (!empty($contactSuccess)): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($contactSuccess) ?>
    </div>
    <?php endif; ?>
    
    <!-- Login error message -->
    <?php if (!empty($contactError)): ?>
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i><?= htmlspecialchars($contactError) ?>
        <div class="mt-3">
            <a href="login.php" class="btn btn-primary me-2">Log In</a>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Validation errors -->
    <?php if (!empty($contactErrors)): ?>
    <div class="alert alert-danger">
        <h5>Please fix the following errors:</h5>
        <ul>
            <?php foreach($contactErrors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- Login required message for non-logged in users -->
    <?php if (!$isLoggedIn): ?>
    <div class="alert alert-info">
        <h5>Login Required</h5>
        <p>You need to be logged in to send us a message.</p>
        <a href="login.php" class="btn btn-primary me-2">Log In</a>
        <a href="register.php" class="btn btn-outline-primary">Register</a>
    </div>
    
    <?php else: ?>
    <!-- Contact form - only shown for logged in users -->
    <div class="card">
        <div class="card-body">
            <form action="controllers/contact_msg.php" method="post">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="username" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="username" name="username" 
                            value="<?= htmlspecialchars($formData['username'] ?? $_SESSION['username'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= htmlspecialchars($formData['email'] ?? $_SESSION['email'] ?? '') ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject"
                            value="<?= htmlspecialchars($formData['subject'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="general" <?= ($formData['category'] ?? '') === 'general' ? 'selected' : '' ?>>General</option>
                            <option value="technical" <?= ($formData['category'] ?? '') === 'technical' ? 'selected' : '' ?>>Technical Support</option>
                            <option value="billing" <?= ($formData['category'] ?? '') === 'billing' ? 'selected' : '' ?>>Billing</option>
                            <option value="feature" <?= ($formData['category'] ?? '') === 'feature' ? 'selected' : '' ?>>Feature Request</option>
                            <option value="feedback" <?= ($formData['category'] ?? '') === 'feedback' ? 'selected' : '' ?>>Feedback</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5"><?= htmlspecialchars($formData['message'] ?? '') ?></textarea>
                </div>
                
                <div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                    <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>