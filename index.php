<?php 
    require_once 'utility/header.php';
?>
   
    <!--introduction section   -->
    <section class="intro-bg position-relative m-5 ">
        <div class="row align-items-center justify-content-center text-center min-vh-75">
            <!-- introduction text section  -->
            <div class="col-md-6 position-relative">
                <h1 class="display-4">Stay updated whenever you want!📫</h1>
                <p class="lead my-3">
                    Welcome to our vibrant newsletter where tech meets creativity!<br>
                    Discover inspiring stories, fresh ideas, rising startups, cutting-edge tech<br>
                    and more
                </p>

                <form class="row g-3 justify-content-center my-3">
                    <div class="col-md-6">
                        <label for="inputEmail" class="visually-hidden">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Your Email!">
                    </div>
                    
                    <div class="col-auto">
                        <a class="btn btn-primary mb-3 btn-subscribe "  href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
 


    <!-- prev artical -->
    <section class="container mrgn">
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h2 class="display-4"> See for yourself </h2>
                <p class="lead my-3"> the word is changing and evry change have a story behind them. We'll connect the dots and make it make sense and ceap you updated</p>  
            </div>
        </div>


        <!-- Latest News -->
        <h2 class="my-5 text-start">Today's top highlights</h2>
        <div class="row gy-2">
            <div class="col-md-6 ">
                <div class="card main-card ">
                    <img src="assets\images\background.webp" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small>Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card secondary-card mb-5">
                    <img src="assets/images/BACKGROUND.jpeg" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">First Secondary Card Title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small>Last updated 3 mins ago</small></p>
                    </div>
                </div>


                <div class="card secondary-card">
                    <img src="assets/images/BACKGROUND.jpeg" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">Second Secondary Card Title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small>Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>




<!-- Comments Section -->
    <section class="container mrgn" >
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <h2 class="display-4"> The people who know US </h2>
                <p class="lead my-3 "> the word is changing and evry change have a story behind them. We'll connect the dots and make it make sense and ceap you updated</p>  
            </div>
        </div>
        <div class="row justify-content-around my-3">
            <div class="card text-center mb-4 bg-transparent border-0" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">Yours is one of the few newsletters I’m excited to open! So many interesting tools to explore that I would never hear of otherwise</p>
                    <h5 class="card-title">jou hatabe</h5>
                </div>
            </div>



            <div class="card text-center mb-4 bg-transparent border-0" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">The best newsletter of all, mandatory daily reading, great job!.</p>
                    <h5 class="card-title">mr beast</h5>
                </div>
            </div>

            <div class="card text-center mb-4 bg-transparent border-0" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text">For me it is a great source of inspiration. I get ideas and feel very creative after browsing PH and also the newsletter is just fantastic. Great gift of the internet</p>
                    <h5 class="card-title">maotamen naief</h5>
                </div>
            </div>

        </div>
    </section>
  
    


<!-- 
    Contact Section
    <section class="container my-5 mb-5 ">
        <div class="row justify-content-center shadow-lg">
            <div class="col-md-8 text-center">
                <h2 class="display-4">Get in Touch</h2>
                <p class="lead mb-5">Have questions? We'd love to hear from you.</p>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="your@email.com">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-subscribe w-100">Send Message</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </section> -->


    <!-- Subscribe Modal -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title " id="subscribeModalLabel">SUBSCRIBE</h5>
                    <!-- <button type="button" class="btn-close position-absolute " data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>

                <div class="modal-body">
                    <!-- Place your subscription form here -->
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label for="modalInputFname" class="form-label">First Name</label>
                            <input type="password" class="form-control" id="modalInputFname" placeholder="Your First Name">
                        </div>

                        <div class="col-md-6">
                            <label for="modalInputSname" class="form-label">Surname</label>
                            <input type="password" class="form-control" id="modalInputSname" placeholder="Your SoreName">
                        </div>

                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email">
                        </div>

                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="modalInputPassword" placeholder="creat a Password">
                        </div>
                                
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                        </div>

                        <!-- SEperatore -->
                        <div class="col-12">
                        <div class="d-flex align-items-center my-3">
                            <div class="flex-grow-1"><hr class="m-0"></div>
                            <span class="px-2">OR</span>
                            <div class="flex-grow-1"><hr class="m-0"></div>
                        </div>
                        </div>

                        <!-- google subscribe -->
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-google w-100  text-center border-secondary"> 
                                <i class="fa-brands fa-google"></i> Subscribe with Google</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>









<?php 
    require_once 'utility/footer.php';
?>

