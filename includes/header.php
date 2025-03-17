<?php
// include_once __DIR__ .'/../controllers/getProfile.php';
    require_once 'C:\xampp\htdocs\newsLetter\config\config.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
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
            <a class="navbar-brand logo" href="index.php"><img src=<?= LOGO_URL ?> alt="Tech Expo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarNavDarkDropdown"> -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-1 mb-lg-0">
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
        
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= htmlspecialchars($_SESSION['profile_photo'] ?? 'assets/images/default-use.jpg') ?>" alt="Profile" 
                                class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="/newsLetter/profile.php"><i class="fas fa-user-edit me-2"></i>Edit Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/newsLetter/controllers/authintication_controlers/logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a class="btn btn-subscribe" href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal">Subscribe</a>
                <?php endif; ?>
                <button class="border-start border-2 btn ms-2" type="button" id="searchToggleBtn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div id="topSearchBar" class="top-search-container">
        <div class="container py-2">
            <form action="search.php" method="GET" class="d-flex">
                <input type="text" name="q" class="form-control form-control-lg flex-grow-1" placeholder="Search articles, topics, authors...">
                <button type="submit" class="btn btn-subscribe ms-2">
                    <i class="fas fa-search"></i>
                </button>
                <button type="button" id="closeSearchBar" class="btn btn-light ms-2">
                    <i class="fas fa-times"></i>
                </button>
            </form>
        </div>
    </div>



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

                    <form action=<?= BASE_CONT. "/authintication_controlers/Subscribe.php"?> method="POST" class="row g-3" id="subscribeForm">
                        <!--Full name -->
                        <div class="col-md-6">
                            <label for="Fname" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input name="FullName" type="text" class="form-control " id="Fname" placeholder="Your Full Name" aria-required="true" required>
                        </div>

                        <!-- User anme -->
                        <div class="col-md-6">
                            <label for="username" class="form-label">User Name <span class="text-danger">*</span></label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="Creat A Username" aria-required="true">
                        </div>

                        <!-- email -->
                        <div class="col-md-12">
                            <label for="modalInputEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="modalInputEmail" placeholder="Your Email" aria-required="true" name="email">
                        </div>

                        <!-- password -->
                        <div class="col-md-12">
                            <label for="modalInputPassword" class="form-label">Password <span class="text-danger">*</span></label>
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
                            <label for="confPassword" class="form-label"> confirm Password <span class="text-danger">*</span> </label>
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

                    <form action="<?= BASE_CONT. "/authintication_controlers/login.php"?>" method="POST" class="row g-3" id = "loginForm">
                    <!-- userName -->
                    <div class="col-md-12">
                        <label for="logusername" class="form-label">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="logusername" placeholder="Your Username" aria-required="true" name="logusername">
                    </div>
                        <!-- email -->
                        <div class="col-md-12">
                            <label for="logEmail" class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="logEmail" placeholder="Your Email" aria-required="true" name="logEmail">
                        </div>


                        <!-- password -->
                        <div class="col-md-12">
                            <label for="logPassword" class="form-label">Password<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="logPassword" placeholder="create a Password" aria-required="true" name= "logPassword">
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