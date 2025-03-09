
    <!--  footer-->
    <footer class="bg-dark bg-opacity-90 text-light py-2 mt-auto mt-5 border">
        <!-- subscrip -->
        <section class="container p-3 mb-3 border-bottom border-secondary">
            <div class="card text-bg-dark">
                <img src="assets\images\subscipe_bg.jpg" class="card-img" alt="..." style="height: 350px;">
                <div class="card-img-overlay d-flex flex-column justify-content-center text-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7));">
                    <h2 class="display-2 card-title fw-bold ">Never miss a story!</h2>
                    <p class="card-text">Get the freshest headlines and updates sent uninterrupted to your inbox.</p>

                    <form class="row g-3 justify-content-center my-3">
                        <div class="col-md-6">
                            <label for="inputEmail" class="visually-hidden">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Your Email!">
                        </div>
                        
                        <div class="col-auto">
                            <a class="btn btn-primary mb-3 btn-subscribe "  href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                        </div>
                    </form>

                    <p class="card-text"><small>By subscribing you agree to our <a href="" style="text-decoration: none;">Privacy Policy</a></small></p>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p class="text-color">Your trusted source for the latest tech news, trends, and insights. Stay informed with our curated content.</p>
                </div>
                

                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-color text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-color text-decoration-none">Articles</a></li>
                        <li><a href="#" class="text-color text-decoration-none">Contact</a></li>
                        <li><a href="#" class="text-color text-decoration-none">Subscribe</a></li>
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
        

        <div class="text-center  mt-3 border-top border-secondary">
            <p class="text-color mb-0">&copy; 2025 Tech Newsletter. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Password visibility toggle and validation  -->
    <script>
        //global object to store server-side data
        window.serverData = {
            errors: <?= json_encode($registerErrors) ?>,
            formData: <?= json_encode($registerData) ?>
        };
    </script>
    <!-- Password visibility toggle and validation  -->
    <script src="assets/js/validation_forms.js"></script>
    </body>    
</html>
