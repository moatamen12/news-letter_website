<!-- footer-->
<footer class="bg-dark bg-opacity-90 text-light py-2 mt-auto mt-5 border">

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
            </div>
        </div>

        <div class="text-center mt-3 border-top border-secondary">
            <p class="text-color mb-0">&copy; 2025 Tech Newsletter. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Debug info with error handling -->
    <script>
        console.log('PHP error data:', <?php echo isset($allErrors) ? json_encode($allErrors) : '{}' ?>);
        
        window.serverData = {
            errors: <?php echo isset($allErrors) ? json_encode($allErrors) : '{}' ?>,
            formData: <?php echo isset($registerData) ? json_encode($registerData) : (isset($loginData) ? json_encode($loginData) : '{}') ?>
        };
    </script>
    
    <!-- Script imports -->
    <script src="assets/js/search_container.js"></script>
    <script src="assets/js/helpers_fun.js"        type="module"></script>
    <script src="assets/js/validation_forms.js"   type="module"></script>
    <script src="assets/js/validation_contact.js" type="module" ></script>
    </body>    
</html>