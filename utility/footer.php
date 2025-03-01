    <!-- Subscribe Modal  -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0  modal-bg">
                <h3 class="modal-title p-4" id="subscribeModalLabel">SUBSCRIBE</h3>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="modalInputFname" class="form-label">First Name</label>
                            <input type="password" class="form-control" id="modalInputFname" placeholder="Your First Name">
                        </div>

                        <div class="col-md-6">
                            <label for="modalInputSname" class="form-label">Surname</label>
                            <input type="password" class="form-control" id="modalInputSname" placeholder="Your Surname">
                        </div>

                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email">
                        </div>

                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="modalInputPassword" placeholder="create a Password">
                        </div>

                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label"> confirm Password</label>
                            <input type="password" class="form-control" id="modalInputPassword" placeholder="Confirm it  Password">
                        </div>
                                
                        <div class="col-6 text-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                        </div>

                        <div class="col-6 text-center">
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
                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email">
                        </div>

                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="modalInputPassword" placeholder="create a Password">
                        </div>
                                
                        <div class="col-6 text-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                        </div>

                        <div class="col-6 text-center">
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
    <footer class="bg-dark text-light py-4 mt-auto mt-5">
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
                        <li>📧 info@technewsletter.com</li>
                        <li>📱 +1 234 567 890</li>
                        <li>📍 Tech Street, Digital City</li>
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