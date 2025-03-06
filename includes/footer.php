    <!-- Subscribe Modal  -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0  modal-bg">
                <h3 class="modal-title p-4" id="subscribeModalLabel">SUBSCRIBE</h3>
                <div class="modal-body">
                    <form class="row g-3">
                        <!-- name -->
                        <div class="col-md-6">
                            <label for="modalInputFname" class="form-label">First Name</label>
                            <input type="text" class="form-control " id="modalInputFname" placeholder="Your First Name" aria-required="true">
                        </div>

                        <!-- surnsme -->
                        <div class="col-md-6">
                            <label for="modalInputSname" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="modalInputSname" placeholder="Your Surname"  aria-required="true">
                        </div>

                        <!-- email -->
                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email" aria-required="true">
                        </div>

                        <!-- password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="modalInputPassword" placeholder="create a Password" aria-required="true">
                                <!-- visability togle -->
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- conferm password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label"> confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="modalInputPassword" placeholder="Confirm it  Password" aria-required="true">
                                <!-- visability togle -->
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                                
                        <div class="col-12 text-center d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                            <p class="text-body-secondary">Have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">Sign in</a></p>
                        </div>

                        <!-- Separator -->
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1"><hr class="m-0"></div>
                                <span class="px-2">OR</span>
                                <div class="flex-grow-1"><hr class="m-0"></div>
                            </div>
                        </div>

                        <!-- google subscribe -->
                        <div class="col-12 d-flex justify-content-between">
                            <button type="submit" class="btn text-center btn-primary border-primary "> 
                            <i class="fa-brands fa-google"></i> Subscribe with Google</button>
                            <p class="text-body-secondary"><small> Sign up with google for quick accesss </small></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- login Model -->
    <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="subscribeModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 modal-bg">
                <h3 class="modal-title p-4 " id="subscribeModalLabel">Log in to your account</h3>
                <div class="modal-body">
                    <form class="row g-3">
                        <!-- email -->
                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email" aria-required="true">
                        </div>


                        <!-- password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="modalInputPassword" placeholder="create a Password" aria-required="true">
                                <!-- visability togle -->
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>    
                        </div>
                                
                        <div class="col-12 text-center d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                            <p class="text-body-secondary">Don't have an account?<a href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal" data-bs-dismiss="modal">Sign up</a></p>

                        </div>

                        <!-- Separator -->
                        <div class="col-12">
                            <div class="d-flex align-items-center ">
                                <div class="flex-grow-1"><hr class="m-0"></div>
                                <span class="px-2">OR</span>
                                <div class="flex-grow-1"><hr class="m-0"></div>
                            </div>
                        </div>

                        <!-- google subscribe -->
                        <div class="col-12 d-flex justify-content-between">
                            <button type="submit" class="btn  text-center btn-primary border-primary"> 
                            <i class="fa-brands fa-google"></i> Subscribe with Google</button>
                            <p class="text-body-secondary text-center "> <small>Login with google for quick access</small></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
            <p class="text-color mb-0">&copy; 2024 Tech Newsletter. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>