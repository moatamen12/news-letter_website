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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">    
        
        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="180x180"    href="<?= BASE_URL ?>assets/images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>assets/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>assets/images/favicon/favicon-16x16.png" >
        <link rel="manifest"                            href="<?= BASE_URL ?>site.webmanifest"> <!-- mainfest file including basec info about the site and icons -->
    
    </head>

    <body class="d-flex flex-column min-vh-100 "> <!--to take 100% of the view port-->
        <!-- the navegation bar -->
        <nav class="navbar navbar-custom sticky-top navbar-expand-lg border-bottom shadow-sm px-2">
            <div class="container-fluid">
                <a class="navbar-brand logo" href="index.php"><img src=<?= LOGO_URL ?> alt="Tech Expo"></a>
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
                                <!-- <a class="nav-link active" aria-current="page"  href="Articals.php">Followed</a>class="dropdown-item" -->
                        </li>
                        <li class="nav-item"><!--class="nav-item dropdown" -->
                                <a class="nav-link active" aria-current="page" href="<?= BASE_URL . 'articals.php'; ?>">Articles</a><!--class="dropdown-item" -->
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
                                    class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">                                   <!-- show the profile photo -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">   <!-- dropdown menu for more user options-->
                                <li><a class="dropdown-item" href="<?= BASE_URL . 'profile.php'; ?>"><i class="fas fa-user-edit me-2"></i>Edit Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= BASE_CONT . '/authintication_controllers/logout.php'?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?> <!-- if the user is not logged in show the subscribe btn-->
                        <a class="btn btn-subscribe rounded-3" href="#" data-bs-toggle="modal" data-bs-target="#SubscribeModal" >Subscribe</a>
                        <a class="btn btn-outline-secondary ms-2 rounded-3" href="#" data-bs-toggle="modal" data-bs-target="#LoginModal" >Sign In</a>
                    <?php endif; ?>
                    <button class="searchBtn btn ms-2" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </nav>

        

        <!-- Subscribe Model -->
        <div class="modal fade" id="SubscribeModal" tabindex="-1" aria-labelledby="SubscribeModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 modal-bg">
                    
                    <h3 class="modal-title p-4 " id="SubscribeModalLabel">Subscribe to Stay Updated</h3>
                    <div class="modal-body">

                        <!-- errors container -->
                        <div id="serverErrorContainer" class="alert alert-danger d-none mb-3">
                            <ul class="mb-0" id="errorList"></ul>
                        </div>

                        <form action="<?= BASE_CONT. "/authintication_controllers/Subscribe.php"?>" method="POST" class="row g-3" id = "SubscribeForm">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="Subname" class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="Subname" placeholder="Your Full name" aria-required="true" name="Subname">
                            </div>

                            <!-- userName -->
                            <div class="col-md-6">
                                <label for="SubUsername" class="form-label">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="SubUsername" placeholder="Your Username" aria-required="true" name="SubUsername">
                            </div>

                            <!-- email -->
                            <div class="col-md-12">
                                <label for="SubEmail" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="SubEmail" placeholder="Your Email" aria-required="true" name="SubEmail">
                            </div>


                            <!-- password -->
                            <div class="col-md-12">
                                <label for="SupPassword" class="form-label">Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="SupPassword" placeholder="create a Password" aria-required="true" name= "SupPassword">
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
                                <button type="submit" class="btn btn-primary btn-subscribe text-center">Subscribe </button>
                                <p class="text-body-secondary">Don't have an account?<a href="#" data-bs-toggle="modal" data-bs-target="#LoginModal" data-bs-dismiss="modal">Login</a></p>
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
                                <i class="fa-brands fa-google"></i> Subscribe with Google</button>
                                <p class="text-body-secondary text-center "> <small>Subscribe with google for quick access</small></p>
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
                    <h3 class="modal-title p-4 " id="SubscribeModalLabel">Login to Your Account</h3>
                    <div class="modal-body">

                        <!-- errors container
                        <div id="loginServerErrorContainer" class="alert alert-danger d-none mb-3">
                            <ul class="mb-0" id="loginErrorList"></ul>
                        </div> -->

                        <form action="<?= BASE_CONT. "/authintication_controllers/login.php"?>" method="POST" class="row g-3" id = "loginForm">
                            <!-- userName -->
                            <div class="col-md-12">
                                <label for="logUsernameEmail" class="form-label">Username or Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="logUsernameEmail" placeholder="Your Username/Email" aria-required="true" name="logUsernameEmail">
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
                                <p class="text-body-secondary">Don't have an account?<a href="#" data-bs-toggle="modal" data-bs-target="#SubscribeModal" data-bs-dismiss="modal">Sign up</a></p>
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
                                <i class="fa-brands fa-google"></i> Login with Google</button>
                                <p class="text-body-secondary text-center "> <small>Login with google for quick access</small></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- For Writers Modal -->
        <div class="modal fade" id="writerOnboardingModal" tabindex="-1" aria-labelledby="writerOnboardingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 modal-bg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="writerOnboardingModalLabel">Become a Writer - Step <span id="writerStepNumber">1</span> of 3</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-5">
                        <!-- Progress Bar -->
                        <div class="progress mb-4" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" id="writerProgressBar"></div>
                        </div>

                        <!-- Server Errors Container -->
                        <div id="writerServerErrorContainer" class="alert alert-danger d-none mb-3">
                            <ul class="mb-0" id="writerErrorList"></ul>
                        </div>

                        <form action="<?= BASE_CONT . "/writer_controllers/onboarding.php" ?>" method="POST" id="writerOnboardingForm" enctype="multipart/form-data"> <!-- Added enctype for file upload -->

                            <!-- Step 1: Email -->
                            <div class="writer-step" id="writerStep1">
                                <h6 class="mb-3 fw-bold">Enter Your Email</h6> <!-- Changed Title -->
                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-md-12 mb-3">
                                        <label for="writerEmail" class="form-label">Email Address<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="writerEmail" name="writerEmail" placeholder="you@example.com" required>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
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
                                            <input type="password" class="form-control" id="WconfPassword" placeholder="Confirm it  Password" aria-required="true" name="WconfPassword">
                                            <!-- visability togle -->
                                            <button class="btn btn-bg" type="button">
                                                <i class="fas fa-eye" id="eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary writer-next-btn">Next <i class="fas fa-arrow-right ms-1"></i></button>
                                </div>
                            </div>

                            <!-- Step 2: Profile Setup -->
                            <div class="writer-step d-none" id="writerStep2">
                                <h6 class="mb-3 fw-bold">Set up your profile</h6> <!-- Changed Title -->

                                <!-- Profile Photo Upload -->
                                <div class="mb-4 text-center">
                                    <label for="writerProfilePhoto" class="form-label">Profile Photo</label>
                                    <div class="mx-auto mb-2" style="width: 100px; height: 100px; border: 1px dashed #ccc; border-radius: 50%; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        <img id="photoPreview" src="#" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; display: none;" />
                                        <i id="photoPlaceholder" class="fas fa-user fa-2x text-muted"></i>
                                    </div>
                                    <input type="file" class="form-control form-control-sm w-auto mx-auto" id="writerProfilePhoto" name="writerProfilePhoto" accept="image/png, image/jpeg, image/gif">
                                    <div class="form-text">Optional. Max 2MB. JPG, PNG, GIF.</div>
                                </div>

                                <div class="row g-3">
                                    <!-- Full Name -->
                                    <div class="col-12">
                                        <label for="writerName" class="form-label">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="writerName" name="writerName" placeholder="Your Full Name" required>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>

                                    <!-- Username -->
                                    <div class="col-12">
                                         <label for="writerUsername" class="form-label">Username<span class="text-danger">*</span></label>
                                         <input type="text" class="form-control" id="writerUsername" name="writerUsername" placeholder="Choose a unique username" required>
                                         <div class="invalid-feedback">Please enter a username.</div>
                                    </div>

                                    <!-- Bio -->
                                    <div class="col-12">
                                        <label for="writerBio" class="form-label">Short Bio</label>
                                        <textarea class="form-control" id="writerBio" name="writerBio" rows="3" placeholder="A brief description about you and your writing interests..."></textarea>
                                    </div>

                                    <!-- Social Media Links -->
                                    <div class="col-12">
                                        <label class="form-label">Social Media Links</label>
                                        <div id="socialLinksContainer">
                                            <!-- Initial Social Link Row -->
                                            <div class="input-group mb-2 social-link-row">
                                                <select class="form-select flex-grow-0" style="width: auto;" name="socialPlatform[]">
                                                    <option value="twitter" selected>Twitter</option>
                                                    <option value="linkedin">LinkedIn</option>
                                                    <option value="github">GitHub</option>
                                                    <option value="website">Website</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <input type="url" class="form-control" name="socialUrl[]" placeholder="https://...">
                                                <button class="btn btn-outline-danger remove-social-link-btn" type="button" style="display: none;"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-secondary mt-1" id="addSocialLinkBtn"><i class="fas fa-plus me-1"></i> Add Social Link</button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary writer-prev-btn"><i class="fas fa-arrow-left me-1"></i> Previous</button>
                                    <button type="button" class="btn btn-primary writer-next-btn">Next <i class="fas fa-arrow-right ms-1"></i></button>
                                </div>
                            </div>

                            <!-- Step 3: URL -->
                            <div class="writer-step d-none" id="writerStep3">
                                <h6 class="mb-3 fw-bold">Add Your Website (Optional)</h6> <!-- Changed Title -->
                                <div class="mb-3">
                                    <label for="writerUrl" class="form-label">Personal Website/Portfolio URL</label>
                                    <input type="url" class="form-control" id="writerUrl" name="writerUrl" placeholder="https://yourwebsite.com">
                                    <div class="form-text">Link to your blog, portfolio, or personal site.</div>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary writer-prev-btn"><i class="fas fa-arrow-left me-1"></i> Previous</button>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i> Submit Application</button>
                                </div>
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