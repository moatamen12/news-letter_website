<?php 
    include  __DIR__ .'/../functions.php';
    require_once __DIR__ . '/../../config/config.php';
    require_once __DIR__ . '/../../Models/UserProfile.php';

    //startinf session if not started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // redirect to index if not logged in
    if (!is_logged_in()) {
        redirect(BASE_URL .  'index.php');
        exit;
    }
    $errors = [];
    $user_id = $_SESSION['user_id']; // get the user id
 

    $profile = new UserProfile($conn); // create a new object of the user profile

    $role = $profile -> getUserRole($user_id); // get the user role


    // 1 => reader
    // 2 => auther
    // 3 => admin

    if ($role['role_id'] == 1) {    // if role 1'reader' get the auther info
        $profile_info = $profile -> getReaderInfo($user_id); 
        $_SESSION['role'] = 'reader';
        $_SESSION['profile_info'] = $profile_info;

    } else if($role['role_id'] == 2) { // if role 2'auther' get the auther info
        $profile_info = $profile -> getAutherInfo($user_id);
        $_SESSION['role'] = 'author';
        $_SESSION['profile_info'] = $profile_info;

    } else{  // if not a reader or auther => admin redirect to admin dashboard
        $_SESSION['errors'] = ['You are not authorized to view this page'];
        redirect(BASE_URL . 'index.php'); // TODO change to admin dashboard and make it //
        exit;
    }   
?>