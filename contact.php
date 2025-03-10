<?php 
    $page_title = 'Contact US';
    require_once 'includes/header.php';
    
?>

<div class="container py-5 my-5">
    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="fw-bold mb-2">Contact Us</h1>
            <p class="text-muted">Have questions, comments or suggestions? We'd love to hear from you!</p>
        </div>
    </div>
    

    
    <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 border-start border-4 border-info ps-3">Send us a message</h3>
                    <form method="post" action="controllers/contact_msg.php">
                        <div class="row g-3">
                            <!-- name -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <!-- email -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <!-- supject/type-->
                            <div class="col-md-12">
                                <label for="subject" class="form-label">Subject</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                    <button class="btn btn-subscribe dropdown-toggle" 
                                            type="button" data-bs-toggle="dropdown">
                                    Category
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" >General</a></li>
                                        <li><a class="dropdown-item" >Complaint</a></li>
                                        <li><a class="dropdown-item" >Suggestion</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" name="message" style="height: 150px" placeholder="Your Message" required></textarea>
                                    <label for="message">Message <span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-subscribe">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                                <button type="reset" class="btn btn-outline">
                                    <i class="fas fa-redo me-2"></i>Reset
                                </button>
        `                   </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contact Information -->
        <div class="col-lg-5">
            <div class="card border-0 rounded-3 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-4 border-start border-4 border-info ps-3">Contact Information</h3>
                    <div class="mb-4 d-flex align-items-start contact-item">
                        <div class="contact-icon me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h5 class="fs-5 fw-bold">Email Us</h5>
                            <p class="mb-0"><a href="mailto:info@newsletter.com" class="text-decoration-none contact-link">info@newsletter.com</a></p>
                        </div>
                    </div>
                    <div class="mb-4 d-flex align-items-start contact-item">
                        <div class="contact-icon me-3">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h5 class="fs-5 fw-bold">Call Us</h5>
                            <p class="mb-0"><a href="tel:+1234567890" class="text-decoration-none contact-link">+1 (234) 567-890</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 rounded-3 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-4 border-start border-4 border-info ps-3">Connect With Us</h3>               
                    <div>
                        <h5 class="fs-5 fw-bold mb-3">Social Media</h5>
                        <ul class="list-unstyled mb-0 ms-3">
                            <li class= "md-2">
                                <i class="fab fa-facebook-f me-2 social-link"></i> 
                                <a href="#" class="social-link ms-1 text-decoration-none" title="Facebook">techexpo</a>
                            </li>

                            <li class="md-2">
                                <i class="fab fa-twitter me-2 social-link"></i> 
                                <a href="#" class="social-link ms-1 text-decoration-none" title="Twitter">techexpo</a>
                            </li>

                            <li class="md-2">
                                <i class="fab fa-instagram me-2"></i> 
                                <a href="#" class="social-link ms-1 text-decoration-none" title="Instagram">tech_expo</a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once 'includes/footer.php';
?>