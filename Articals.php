<?php 
    $page_title = 'All Articles';
    require_once 'includes/header.php';
?>   

<div class="container my-5">
    <section class="position-relative mb-5">
        <div class="container p-0 ">
            <div class="row align-items-center justify-content-center min-vh-75 text-center">
                <!-- introduction text section  -->
                <div class="mb-4">
                    <h1 class="fw-bold">Today's top highlights</h1>
                    <footer class="text-body-secondary">Latest breaking news, in tech, sciences and gaming</footer>
                </div>        
            </div>
        </div>
    </section>


    <div class="row g-4">
        <!-- main card LARGE -->
        <div class="col-md-9 order-md-1 order-1">
            <div class="card bg-transparent mb-4 border-0">
                <div class="row g-3">
                    <div class="col-md-12">
                        <img class="rounded-3 img-fluid article-card-img" src="assets/images/01.jpg" alt="">
                    </div>
                    <div class="col-md-10">
                        <a href="#" class="badge bg-info mb-2"><i class="fas fa-circle me-2 small fw-bold"></i>Sports</a>
                        <h3><a href="#" class="stretched-link btn-link text-dark fw-bold">12 worst types of business accounts you follow on Twitter</a></h3>
                        <p>Given and shown creating curiously to more in are man were smaller by we instead the these sighed Avoid in the sufficient me real man longer of his how...</p>
                        <!-- Card info -->
                        <ul class="nav align-items-center">
                            <li class="nav-item">
                                <div class="nav-link">
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="avatar avatar-xs">
                                            <img class="avatar-img rounded-circle" src="assets/images/avatar/01.jpg" alt="avatar">
                                        </div>
                                        <span class="ms-3">by <a href="#" class="text-reset btn-link">Dennis</a></span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">Mar 07, 2021</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- side bare TODO:make it beter -->
        <!-- side bare TODO:make it better -->
        <div>
            
        </div>
        <div class="col-md-3 order-md-2 order-3">
            <div class="card-title">
                <h4 class="fw-bold">Trending topics</h4>
            </div>
            <div class="card border mb-4 border-0">
                <ul class="list-group list-group-flush text-center  border-0 shadow-sm">
                    <li class="list-group-item my-2">
                        <a class="btn btn-primary w-100 border-0">Technology</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">Gaming</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">Featured</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">Popular</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">AR/VR</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">AI/LLM</a>
                    </li>
                </ul>
            </div>
            <div class="card border mb-4 shadow-sm border-0">
                <h5 class="card-header">More Topics</h5>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">AI Ethics</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">Web3</a>
                    </li>
                    <li class="list-group-item my-2">
                        <a class="btn btn-outline-primary w-100">Quantum Computing</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main content area - Article cards -->
        <div class="col-md-12  order-2">
            <!-- First article card -->
            <div class="card bg-transparent mb-4 border-0">
                <div class="row g-3">
                    <?php include 'includes/list_cards.php'?>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination  -->
    <section class = "container d-flex justify-content-center align-items-center" style="margin-top: 2rem">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
</div>

<?php 
    require_once 'includes/footer.php';
?>