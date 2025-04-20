<?php
    require_once __DIR__ . '\..\config\config.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $photoPath = USER_IMG;

    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
        include_once __DIR__ .'\..\controllers/profile_controllers/getProfile.php';
        
    }

    // Preparing variables for JavaScript
    $registerErrors = [];
    $registerData = [];
    $loginErrors = [];
    $loginData = [];

    if (isset($_SESSION['register_errors'])) {
        $registerErrors = $_SESSION['register_errors'];
        unset($_SESSION['register_errors']);
    }

    if (isset($_SESSION['register_data'])) {
        $registerData = $_SESSION['register_data'];
        unset($_SESSION['register_data']);
    }

    if (isset($_SESSION['login_errors'])) {
        $loginErrors = $_SESSION['login_errors'];
        unset($_SESSION['login_errors']);
    }

    if (isset($_SESSION['login_data'])) {
        $loginData = $_SESSION['login_data'];
        unset($_SESSION['login_data']);
    }

    // Combine all errors for JavaScript
    $allErrors = array_merge($registerErrors, $loginErrors);

?>

<!Doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo isset($page_title)? $page_title . ' -Tech Expo': 'Tech Expo';?></title> 

        <script src="https://kit.fontawesome.com/fc7e8d802d.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">    
        
        <!-- favicon -->
        <link rel="apple-touch-icon"          sizes="180x180" href="<?= BASE_URL ?>assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png"     sizes="96x96"   href="<?= BASE_URL ?>assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png"     sizes="any"     href="<?= BASE_URL ?>assets/favicon/favicon.ico">
        <link rel="icon" type="image/svg+xml"                 href="<?= BASE_URL ?>assets/favicon/favicon.svg">
        <link rel="manifest"                                  href="<?= BASE_URL ?>assets/favicon/site.webmanifest">       
    </head>

    <body class="d-flex flex-column min-vh-100 "> <!--to take 100% of the view port-->
        <!-- the navegation bar -->
        <nav class="navbar navbar-custom sticky-top navbar-expand-lg border-bottom shadow-sm px-2">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="navbar-brand logo" href="index.php">
                    <img src="<?= BASE_URL ?>assets/favicon/favicon.svg" alt="Tech Expo" width="40" height="40" class="d-inline-block align-top">
                    <!-- <span>Tech Expo</span> -->
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- <div class="collapse navbar-collapse" id="navbarNavDarkDropdown"> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-1 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASE_URL . 'index.php'; ?>">Home</a>
                        </li>

                        <li class="nav-item"><!--class="nav-item dropdown" -->
                            <!-- <a class="nav-link dropdown-toggle" href="#" id="articlesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Articles
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="articlesDropdown"> -->
                                <!-- <a class="nav-link active" aria-current="page"  href="Articles.php">Followed</a>class="dropdown-item" -->
                        </li>
                        <li class="nav-item"><!--class="nav-item dropdown" -->
                                <a class="nav-link active" aria-current="page" href="<?= BASE_URL . 'articles.php'; ?>">Articles</a><!--class="dropdown-item" -->
                            <!-- </ul> -->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL . 'about_us.php'; ?>">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL . 'contact.php'; ?>">Contact</a>
                        </li>
                    </ul>
            
                    <?php if(isset($_SESSION['user_id'])): ?> <!-- if the user is logged in -->
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= htmlspecialchars($photoPath); ?>" alt="Profile"  
                                    class="rounded-circle" style="width:40px; height:40px; object-fit:cover;"> <!-- show the profile photo -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">   <!-- dropdown menu for more user options-->
                                <li><a class="dropdown-item" href="<?= BASE_URL . 'profile.php'; ?>"><i class="fas fa-user-edit me-2"></i>Edit Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= BASE_CONT . '/authintication_controllers/logout.php'?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?> <!-- if the user is not logged in show the subscribe btn-->
                        <a class="btn btn-subscribe rounded-3" href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal" >Subscribe</a>
                        <a class="btn btn-outline-secondary ms-2 rounded-3" href="#" data-bs-toggle="modal" data-bs-target="#LoginModal" >LogIn</a>
                    <?php endif; ?>
                    <button class="searchBtn btn ms-2" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </nav>

        
        <!-- subscribe model -->
        <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 modal-bg">          
                    <h3 class="modal-title p-4 " id="SubscribeModalLabel">Subscribe and Join Our Community</h3>
                    <div class="modal-body">

                        <!-- errors container -->
                        <div id="loginServerErrorContainer" class="alert alert-danger d-none mb-3">
                            <ul class="mb-0" id="loginErrorList"></ul>
                        </div>

                        <form action="<?= BASE_CONT. "/authintication_controllers/Subscribe.php"?>" method="POST" class="row g-3" id = "SubForm">
                            
                            <!-- username -->
                            <div class="col-md-12">
                                <label for="SubUsername" class="form-label">User name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubUsername" placeholder="Enter Your UserName" aria-required="true" name="SubUsername">
                            </div>

                            <!-- Email -->
                            <div class="col-md-12">
                                <label for="SubEmail" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubEmail" placeholder="Enter Your Email" aria-required="true" name="SubEmail">
                            </div>

                            <!-- password -->
                            <div class="col-md-12">
                                <label for="SupPassword" class="form-label">Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="SupPassword" placeholder="Enter Your Password" aria-required="true" name="SupPassword">
                                    <!-- visibility toggle -->
                                    <button class="btn btn-bg" type="button">
                                        <i class="fas fa-eye" id="eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- confirm password -->
                            <div class="col-md-12">
                                <label for="SubConfPassword" class="form-label">confirm Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="SubConfPassword" placeholder="Confirm Your Password" aria-required="true" name="SubConfPassword">
                                    <!-- visibility toggle -->
                                    <button class="btn btn-bg" type="button">
                                        <i class="fas fa-eye" id="eye"></i>
                                    </button>
                                </div>
                            </div>
                                                            
                            <div class="col-12 text-center d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe</button>
                                <p class="text-body-secondary">have an account?<a href="#" data-bs-toggle="modal" data-bs-target="#SubscribeModal" data-bs-dismiss="modal">Sign up</a></p>
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
                                <button type="submit" class="btn  text-center text-white btn-primary border-primary"> 
                                <i class="fa-brands fa-google"></i> Continue with Google </button>
                                <p class="text-body-secondary text-center "> <small>Continue with google for quick access</small></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- login model -->
        <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 modal-bg">          
                    <h3 class="modal-title p-4 " id="LoginModalLabel">Login to Your Account</h3>
                    <div class="modal-body">

                        <!-- errors container -->
                        <div id="loginServerErrorContainer" class="alert alert-danger d-none mb-3">
                            <ul class="mb-0" id="loginErrorList"></ul>
                        </div>

                        <form class="row g-3" id = "loginForm">
                            <!-- userName -->
                            <div class="col-md-12">
                                <label for="logEmail" class="form-label">Email address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="logEmail" placeholder="Your Username/Email" aria-required="true" name="logEmail">
                            </div>

                            <!-- password -->
                            <div class="col-md-12">
                                <label for="logPassword" class="form-label">Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="logPassword" placeholder="Enter Your Password" aria-required="true" name="logPassword">
                                    <!-- visibility toggle -->
                                    <button class="btn btn-bg" type="button">
                                        <i class="fas fa-eye" id="eye"></i>
                                    </button>
                                </div>
                            </div>
                                                            
                            <div class="col-12 text-center d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary btn-subscribe text-center">Login</button>
                                <p class="text-body-secondary">Don't have an account?<a href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal" data-bs-dismiss="modal"> Subscribe</a></p>
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
                                <button type="submit" class="btn  text-center text-white btn-primary border-primary"> 
                                <i class="fa-brands fa-google"></i> Continue with Google</button>
                                <p class="text-body-secondary text-center "> <small>Continue with google for quick access</small></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- For Writers Modal -->
        <div class="modal fade writer-modal" id="writerOnboardingModal" tabindex="-1" aria-labelledby="writerOnboardingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-md-down">
                <div class="modal-content border-0 shadow-lg">
                    <!-- Modal Header with Gradient -->
                    <div class="modal-header bg-gradient-primary text-white border-0 p-4">
                        <div class="modal-title-container">
                            <h5 class="modal-title fs-4 fw-bold" id="writerOnboardingModalLabel">
                                <i class="fas fa-pen-fancy me-2"></i>Become a Writer
                            </h5>
                            <p class="mb-0 text-white-50">Join our community of tech enthusiasts and share your knowledge</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- errors container -->
                    <div id="serverErrorContainer" class="alert alert-danger d-none mb-3">
                        <ul class="mb-0" id="errorList"></ul>
                    </div>

                    <div class="modal-body">
                        <form action="<?= BASE_CONT. "/authintication_controllers/writer.php"?>" method="POST" class="row g-3" id = "SubscribeForm">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="Wname" class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="Wname" placeholder="Enter Your Full name" aria-required="true" name="Wname">
                            </div>

                            <!-- userName -->
                            <div class="col-md-6">
                                <label for="WUsername" class="form-label">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="WUsername" placeholder="EnterYour Username" aria-required="true" name="WUsername">
                            </div>

                            <!-- email -->
                            <div class="col-md-12">
                                <label for="WEmail" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="WEmail" placeholder="Enter Your Email" aria-required="true" name="WEmail">
                            </div>


                            <!-- password -->
                            <div class="col-md-12">
                                <label for="WPassword" class="form-label">Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="WPassword" placeholder="create a Password" aria-required="true" name= "WPassword">
                                    <!-- visability togle -->
                                    <button class="btn btn-bg" type="button">
                                        <i class="fas fa-eye" id="eye"></i>
                                    </button>
                                </div>    
                            </div>

                            <!-- conferm password -->
                            <div class="col-md-12">
                                <label for="WconfPassword" class="form-label"> confirm Password <span class="text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="WconfPassword" placeholder="Confirm your Password" aria-required="true" name="WconfPassword">
                                    <!-- visability togle -->   
                                    <button class="btn btn-bg" type="button">
                                        <i class="fas fa-eye" id="eye"></i>
                                    </button>
                                </div>
                            </div>
                                    
                            <div class="col-12 text-center d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary btn-subscribe text-center">Start Writer</button>
                                <p class="text-body-secondary">have an account?<a href="#" data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">Login</a></p>
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
                                <button type="submit" class="btn  text-center text-white btn-primary border-primary"> 
                                <i class="fa-brands fa-google"></i> Continue with Google</button>
                                <p class="text-body-secondary text-center "> <small>Continue with google for quick access</small></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        


        <!-- search section  -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content border-0 modal-bg">
                    <div class="modal-body">
                        
                        <!-- errors container -->
                        <div id="serverErrorContainer" class="alert alert-danger d-none mb-3">
                            <ul class="mb-0" id="errorList"></ul>
                        </div>

                        <form action="<?php __DIR__ . '/controllers/search_controllers/search_controlle.php'; ?>" method="GET" class="w-100" id = "searchForm">
                            <!-- search input -->
                            <div class="input-group ">
                                <input type="text" class="form-control form-control-lg" placeholder="Search articles by auther or title..." name="q">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>