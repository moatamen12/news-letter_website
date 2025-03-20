<?php 
    // $page_title = 'Home';
    require_once 'includes/header.php';
?> 
    
    <!-- hero sec -->
    <section class="position-relative  py-2 bg-light rounded-bottom" style="background: url('assets/images/hero_bg.jpg') center/cover no-repeat; min-height: 400px;">
        <div class="container p-0 ">
            <div class="row align-items-center justify-content-start text-white">
                <div class="col-md-5 position-relative text-center text-md-start blur rounded ">
                    <h1 class="display-4 fw-bold">Tech. Product. Science, All in <br>Your Inbox! <i class="fas fa-paper-plane text-primary"></i></h1>
                    <p class="lead my-3">The latest technology news and daily updates</p>
                    <div class=" my-5">
                        <a href="#" class="btn btn-subscribe btn-lg me-2" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe Now</a>
                        <a href="articals.php" class="btn btn-subscribe-outline text-white btn-lg">Browse Articles</a>
                    </div>
                </div>
                <!-- <div class="col-md-6 d-none d-md-block">
                    <img src="assets/images/hero_bg.jpg" alt="Newsletter illustration" class="img-fluid rounded">
                </div> -->
            </div>
        </div>
    </section>



    <!-- our news letter -->
    <section class="container p-4">
        <div class="my-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold">Our Newsletter</h1>
                    <footer class="text-body-secondary">Latest breaking news, in tech, sciences and gaming all in your inbox</footer>
                </div>
                <?php include 'includes/see_more.php'?>
            </div>

        </div>
        <div class="row g-4">
            <!-- Newsletter Card 1 -->
            <div class="col-md-4">
                <div class="card text-white border-0 overflow-hidden h-100">
                    <img src="assets/images/background.webp" class="card-img" alt="Tech News" style="height: 200px; object-fit: cover; filter: brightness(0.7);">
                    <div class="card-img-overlay d-flex flex-column p-3">
                        <h4 class="fw-bold">Tech Updates</h4>
                        <p class="small">Weekly insights on emerging technologies and digital trends</p>
                        <div class="mt-auto">
                            <a href="#" class="btn btn-sm btn-subscribe" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter Card 2 -->
            <div class="col-md-4">
                <div class="card text-white border-0 overflow-hidden h-100">
                    <img src="assets/images/01.jpg" class="card-img" alt="Science News" style="height: 200px; object-fit: cover; filter: brightness(0.7);">
                    <div class="card-img-overlay d-flex flex-column p-3">
                        <h4 class="fw-bold">Science Digest</h4>
                        <p class="small">Breakthroughs and discoveries from the scientific community</p>
                        <div class="mt-auto">
                            <a href="#" class="btn btn-sm btn-subscribe" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Newsletter Card 3 -->
            <div class="col-md-4">
                <div class="card text-white border-0 overflow-hidden h-100">
                    <img src="assets/images/BACKGROUND.jpeg" class="card-img" alt="Gaming News" style="height: 200px; object-fit: cover; filter: brightness(0.7);">
                    <div class="card-img-overlay d-flex flex-column p-3">
                        <h4 class="fw-bold">Gaming Pulse</h4>
                        <p class="small">Latest releases, reviews and esports coverage</p>
                        <div class="mt-auto">
                            <a href="#" class="btn btn-sm btn-subscribe" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Today's top highlights   -->
    <section class="container my-5 ">
        <div class="container p-4">
            <div class="my-5 d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold">Trending</h1>
                    <footer class="text-body-secondary">Latest breaking news, breaking thow in Tech</footer>
                </div>
                <?php include 'includes/see_more.php' ?>
            </div>     
        <?php for($x=1; $x<=10; $x++){?>
            <?php include 'includes/list_cards.php'?>
        <?php }?>

        </div>

    </section>

    <!-- Ai topics-->
    <section class="container my-5 ">
        <div class="my-3 d-flex justify-content-between align-items-center">
            <div class="my-5 d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold">Ai</h1>
                    <footer class="text-body-secondary">Biggest breaking news in AI/LLM</footer>
                </div>
            </div>
            <?php include 'includes/see_more.php' ?>
        </div>


        <div class="row g-5">
            <div class="col-md-6">
                <div class="card border-0 bg-transparent">
                    <!-- Card img -->
                    <div class="position-relative">
                        <img class="card-img" src="assets/images/01.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                            <!-- Card overlay Top -->
                            <div class="w-100 mb-auto d-flex justify-content-end">
                                <div class="text-end ms-auto">
                                    <!-- Card format icon -->
                                    
                                </div>
                            </div>
                            <!-- Card overlay bottom -->
                            <div class="w-100 mt-auto">
                                <!-- Card category -->
                                <a href="#" class="badge bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Technology</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-3">
                        <h4 class="card-title"><a href="#" class="btn-link text-reset fw-bold">12 worst types of business accounts you follow on Twitter</a></h4>
                        <p class="card-text">He moonlights difficult engrossed it, sportsmen. Interested has all Devonshire difficulty gay assistance joy. Unaffected at ye of compliment alteration to</p>
                        <!-- Card info -->
                        <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                            <li class="nav-item">
                                <div class="nav-link">
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="avatar avatar-xs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="avatar">
                                        </div>
                                        <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Samuel</a></span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">Jan 22, 2021</li>
                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> 5</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 bg-transparent">
                    <!-- Card img -->
                    <div class="position-relative">
                        <img class="card-img" src="assets/images/about_us_bg.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                            <!-- Card overlay Top -->
                            <div class="w-100 mb-auto d-flex justify-content-end">
                                <div class="text-end ms-auto">
                                    <!-- Card format icon -->
                                    
                                </div>
                            </div>
                            <!-- Card overlay bottom -->
                            <div class="w-100 mt-auto">
                                <!-- Card category -->
                                <a href="#" class="badge bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Technology</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body - px-2 pt-3">
                        <h4 class="card-title"><a href="#" class="btn-link text-reset fw-bold">12 worst types of business accounts you follow on Twitter</a></h4>
                        <p class="card-text">He moonlights difficult engrossed it, sportsmen. Interested has all Devonshire difficulty gay assistance joy. Unaffected at ye of compliment alteration to</p>
                        <!-- Card info -->
                        <ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
                            <li class="nav-item">
                                <div class="nav-link">
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="avatar avatar-xs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="avatar">
                                        </div>
                                        <span class="ms-3">by <a href="#" class="stretched-link text-reset btn-link">Samuel</a></span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">Jan 22, 2021</li>
                            <li class="nav-item"><a href="#" class="btn-link"><i class="far fa-comment-alt me-1"></i> 5</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>


    

<?php 
    require_once 'includes/footer.php';
?>