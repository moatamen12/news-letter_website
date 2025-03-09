<?php

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    // Prepareing variables for JavaScript
    $registerErrors = [];
    $registerData = [];

    if (isset($_SESSION['register_errors'])) {
    $registerErrors = $_SESSION['register_errors'];
    unset($_SESSION['register_errors']);
    }

    if (isset($_SESSION['register_data'])) {
    $registerData = $_SESSION['register_data'];
    unset($_SESSION['register_data']);
    }

    // Convert PHP arrays to JSON for JavaScript
    $registerErrorsJson = json_encode($registerErrors);
    $registerDataJson = json_encode($registerData);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($page_title)? $page_title . ' -Tech Expo': 'Tech Expo';?></title>
    <script src="https://kit.fontawesome.com/fc7e8d802d.js" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">     
</head>
<body class="d-flex flex-column min-vh-100 "> <!--to take 100% of the view port-->
    <!-- the navegation bar -->
    <nav class="navbar navbar-custom sticky-top navbar-expand-lg bg-body-tertiary shadow-sm px-2">
        <div class="container-fluid">
            <a class="navbar-brand " href="index.php">Tech Expo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarNavDarkDropdown"> -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item"><!--class="nav-item dropdown" -->
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="articlesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Articles
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="articlesDropdown"> -->
                            <a class="nav-link active" aria-current="page"  href="Articals.php">Followed</a><!--class="dropdown-item" -->
                    </li>
                    <li class="nav-item"><!--class="nav-item dropdown" -->
                            <a class="nav-link active" aria-current="page" href="Articals.php">All Articles</a><!--class="dropdown-item" -->
                        <!-- </ul> -->
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>

                <a class="btn btn-subscribe " href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal"> Subscribe</a>
                <button class="btn ms-2" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </nav>
    <!-- Subscribe Modal  -->
    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0  modal-bg">
                <h3 class="modal-title p-4" id="subscribeModalLabel">SUBSCRIBE</h3>
                <div class="modal-body">
                    <!-- errors container -->
                    <div id="serverErrorContainer" class="alert alert-danger d-none mb-3">
                        <ul class="mb-0" id="errorList"></ul>
                    </div>

                    <form action="controllers/Subscribe.php" method="POST" class="row g-3" id="subscribeForm">
                        <!--Full name -->
                        <div class="col-md-6">
                            <label for="modalInputFname" class="form-label">Full Name</label>
                            <input name="FullName" type="text" class="form-control " id="Fname" placeholder="Your Full Name" aria-required="true">
                        </div>

                        <!-- User anme -->
                        <div class="col-md-6">
                            <label for="modalInputSname" class="form-label">User Name</label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="Creat A Username"  aria-required="true">
                        </div>

                        <!-- email -->
                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email" aria-required="true" name="email">
                        </div>

                        <!-- password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="modalInputPassword" placeholder="create a Password" aria-required="true" name="password">
                                <!-- visability togle -->
                                <button class="btn btn-bg" type="button">
                                    <i class="fas fa-eye" id="eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- conferm password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label"> confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confPassword" placeholder="Confirm it  Password" aria-required="true" name="confPassword">
                                <!-- visability togle -->
                                <button class="btn btn-bg" type="button">
                                    <i class="fas fa-eye" id="eye"></i>
                                </button>
                            </div>
                        </div>
                                
                        <div class="col-12 text-center d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                            <p class="text-body-secondary">Have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">log in</a></p>
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

                    <!-- errors container -->
                    <div id="serverErrorContainer" class="alert alert-danger d-none mb-3">
                        <ul class="mb-0" id="errorList"></ul>
                    </div>

                    <form action="controllers/login.php" method="POST" class="row g-3" id = "loginForm">
                    <!-- userName -->
                    <div class="col-md-12">
                        <label for="modalInputEmail" class="form-label">Username</label>
                        <input type="text" class="form-control" id="logusername" placeholder="Your Username" aria-required="true" name="Logsername">
                    </div>
                        <!-- email -->
                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="logEmail" placeholder="Your Email" aria-required="true" name="LoginEmail">
                        </div>


                        <!-- password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="logPassword" placeholder="create a Password" aria-required="true" name= "LoginPassword">
                                <!-- visability togle -->
                                <button class="btn btn-bg" type="button">
                                    <i class="fas fa-eye" id="eye"></i>
                                </button>
                            </div>    
                        </div>
                                
                        <div class="col-12 text-center d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary btn-subscribe text-center">Login</button>
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



    <!-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="search.php" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Search for articles..." required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

