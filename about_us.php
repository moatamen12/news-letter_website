<?php 
    $page_title = 'About Us';
    include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="mx-5 py-5 text-center rounded text-white d-flex align-items-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('assets/images/about_us_bg.jpg') center/cover no-repeat; min-height: 400px; ">
    <div class="container-fluid">
        <h1 class="display-4 ">All About Our Newsletter</h1>
        <p class="lead ">Discover who we are and what we do</p>
    </div>
</section>

<main class="container-fluid py-4">
    <!-- About / Mission Section -->
    <section class="my-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="mb-3">Our Mission</h2>
                <div class="card border-0 mb-4">
                    <div class="card-body">
                        <p>We are dedicated to providing high-quality, timely information to our subscribers. Our mission is to keep you informed about the latest trends, news, and updates in our industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="my-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="mb-3">Our Team</h2>
                <div class="card border-0 mb-4">
                    <div class="card-body">
                        <p>Our team consists of experienced professionals who are passionate about delivering valuable content. We work tirelessly to research, verify, and present information that matters to you.</p>
                        
                        <div class="row mt-4">
                            <div class="col-md-4 text-center mb-3">
                                <div class="rounded-circle bg-light mx-auto mb-2" style="width: 120px; height: 120px; line-height: 120px;">Team Member</div>
                                <h5>John Doe</h5>
                                <p class="text-muted">Editor-in-Chief</p>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <div class="rounded-circle bg-light mx-auto mb-2" style="width: 120px; height: 120px; line-height: 120px;">Team Member</div>
                                <h5>Jane Smith</h5>
                                <p class="text-muted">Content Manager</p>
                            </div>
                            <div class="col-md-4 text-center mb-3">
                                <div class="rounded-circle bg-light mx-auto mb-2" style="width: 120px; height: 120px; line-height: 120px;">Team Member</div>
                                <h5>Mike Johnson</h5>
                                <p class="text-muted">Senior Writer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- History / Additional Info -->
    <section class="my-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="mb-3">Our History</h2>
                <div class="card border-0">
                    <div class="card-body">
                        <p>Founded in 2020, our newsletter has grown from a small project to a trusted source of information for thousands of subscribers. We've consistently improved our content and delivery methods to better serve our audience.</p>
                        <p>We believe in building lasting relationships with our readers through honesty, reliability, and valuable insights.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php 
    include 'includes/footer.php';
?>