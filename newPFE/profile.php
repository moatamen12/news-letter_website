<?php 
    $page_title = "Profile";
    require_once __DIR__ . '/controllers/profile_controllers/getProfile.php';

    //  Get any stored messages from session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // errors and success messages
    $errors = $_SESSION['errors'] ?? [];
    $success = $_SESSION['success'] ?? [];
    
    unset($_SESSION['errors']);
    unset($_SESSION['success']);
    
    $profile_info = $_SESSION['profile_info'] ?? [
        "name" => "User Name",
        "username" => "username",
        "email" => "No email provided",
        "profile_img" => BASE_URL . "assets/images/default-use.jpg",
        "bio" => "",
        "work" => ""
    ];

    $role = $_SESSION['role'] ?? 'User@role';
    // // Extract variables for easier access in the view
    // extract($profile_info);
    include __DIR__ . '/includes/header.php';

    // echo "Debug - Image path: " . $profile_info['profile_img'];
    // echo "<br>File exists: " . (file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $profile_info['profile_img']) ? 'Yes' : 'No');
?>



    <!--
        // 1 => reader
        // 2 => auther
        // 3 => admin 
    -->


<?php 

    $action = $_GET['action'] ?? '';
    
    if ($role === 'author') {
        if ($action === 'new_post') {
            // Show the new post form
            include __DIR__ . "/profiles/auther_profile_views/posts/new_post.php";
        } else {
            // Show the regular author profile
            include __DIR__ . "/profiles/auther_profile.php";
        }
    } else if($role === 'reader') {
        include __DIR__ . "/profiles/reader_profile.php"; // Reader PROFILE
    } else {
        redirect(BASE_URL . 'indx.php');
    }
?>









<?php include __DIR__ . '/includes/footer.php'; ?>