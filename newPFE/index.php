<?php 
    require_once 'includes/header.php';
?>
    <!-- Hero Section -->
    <section class="py-5 ">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center">
                    <!-- Improved Typography -->
                    <!-- <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2 rounded-pill">Newsletter Platform</span> -->
                    <h1 class="display-3 fw-bold mb-3">Tech. Product. Science, <br>All in Your Inbox! <i class="fas fa-paper-plane text-primary"></i></h1>
                    
                    <!-- Fixed grammar and capitalization -->
                    <p class="lead mb-4 px-md-5">Get to know the latest news through newsletters by passionate writers in what interests you.</p>
                    
                    <!-- Search bar above buttons
                    <div class="col-lg-8 mx-auto mb-4">
                        <form action="search.php" method="GET" class="d-flex">
                            <input type="text" class="form-control form-control-lg me-2" placeholder="Search topics..." name="q" aria-label="Search">
                            <button class="btn btn-subscribe" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div> -->
                    
                    <!-- Improved button layout -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                        <a href="#" class="btn btn-subscribe btn-lg px-4 py-2" data-bs-toggle="modal" data-bs-target="#subscribeModal">
                            <i class="fas fa-envelope-open me-1"></i> Subscribe Now
                        </a>
                        <a href="articals.php" class="btn btn-subscribe-outline btn-lg px-4 py-2">
                            <i class="fas fa-pen me-1"></i> Start Writing
                        </a>
                    </div>
                    
                    <!-- Stats counters -->
                    <div class="row justify-content-center mt-5 text-center">
                        <div class="col-md-4">
                            <h3 class="fw-bold">500+</h3>
                            <p class="text-muted">Articles</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="fw-bold">10k+</h3>
                            <p class="text-muted">Subscribers</p>
                        </div>
                        <div class="col-md-4">
                            <h3 class="fw-bold">50+</h3>
                            <p class="text-muted">Expert Writers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- devider -->
    <div class="section-divider">
        <hr class="border-0 border-3 border-bottom  border-dark-subtle rounded">
    </div>

    <!-- filepath: c:\xampp\htdocs\newsLetter\newPFE\index.php -->
    <section>
        <div class="px-4 my-5">
            <div class = "my-4">
                <h2 class=" fw-bold">Latest Articles</h2>
                <footer class="text-muted mb-4">Cutting-edge tech insights and innovations to keep you informed in our fast-footeraced digital world.</p>
            </div>
            
            <!-- Featured Article -->
            <div class="card mb-5 border-0 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="assets/images/01.jpg" class="img-fluid rounded-start h-100 object-fit-cover" alt="Featured Article">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <!-- <span class="badge bg-primary mb-2">Featured</span> -->
                            <h2 class="card-title fw-bold stretched-link">The Future of Artificial Intelligence in 2025</h2>
                            <p class="card-text mt-4 fs-5">An in-depth look at how AI is transforming industries and our daily lives. From healthcare to transportation, discover the cutting-edge developments shaping our future.</p>
                            
                            <div class="mt-5 d-flex align-items-center justify-content-between">
                                <span class="ms-3">by <a href="#" class=" text-reset btn-link">Samuel</a></span>
                                <p class="card-text"><small class="text-muted">Published on March 18, 2025</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- LEFT SIDE: Cards Grid -->
                <div class="col-md-9">   
                    <div class="mb-3">
                        <?php include __DIR__ . '\includes\sub_header.php'?>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="card h-100 border-0 ">
                                <img src="assets\images\01.jpg" class="card-img-top rounded " alt="artical/jpg">
                                <div class="card-body">
                                    <h5 class="card-title stretched-link">Card title</h5>
                                    <p class="card-text mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="ms-3">by <a href="#" class=" text-reset btn-link">Samuel</a></span>
                                    <p class="text-muted">Jan 22, 2021</p>
                                </div>
                            </div>  
                        </div>
                        
                        
                        <div class="col">
                            <div class="card h-100">
                                <img src="assets\images\01.jpg" class="card-img-top" alt="artical/jpg">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col">
                            <div class="card h-100">
                                <img src="assets\images\01.jpg" class="card-img-top" alt="artical/jpg">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card h-100">
                                <img src="assets\images\01.jpg" class="card-img-top" alt="artical/jpg">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>


                        <div class="col">
                            <div class="card h-100">
                                <img src="assets\images\01.jpg" class="card-img-top" alt="artical/jpg">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>



                        <div class="col">
                            <div class="card h-100">
                                <img src="assets\images\01.jpg" class="card-img-top" alt="artical/jpg">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- RIGHT SIDE: Recommended List -->
                <div class="col-md-3 ">
                    <div class="card ">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-4">Recommended Articles</h4>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-primary rounded-pill me-2">1</span>
                                <a href="#" class="text-decoration-none text-dark">Why AI is the Future of Content Creation</a>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-primary rounded-pill me-2">2</span>
                                <a href="#" class="text-decoration-none text-dark">Top 10 Programming Languages to Learn in 2025</a>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-primary rounded-pill me-2">3</span>
                                <a href="#" class="text-decoration-none text-dark">The Rise of Remote Work Technologies</a>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-primary rounded-pill me-2">4</span>
                                <a href="#" class="text-decoration-none text-dark">How Blockchain is Changing Financial Services</a>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-primary rounded-pill me-2">5</span>
                                <a href="#" class="text-decoration-none text-dark">The Future of Cloud Computing: What to Expect</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php include __DIR__.'/includes/see_more.php'?>
        </div>
    </section>

   
<?php 
    require_once __DIR__ . '/includes/footer.php';
?>



