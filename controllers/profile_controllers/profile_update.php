<?php 
    $pageTitle = "Edit Profile";
    include 'functions.php';
    include __DIR__ . '/profile_functions.php';
    include __DIR__ . '/delet_profile.php';
    require_once __DIR__ . '/../config/config.php';
    
    $user_id = $_SESSION['user_id'];
    $errors = [];
    $success = [];
    $userimg = 'assets\images\default-use.jpg';//default user image
    // echo $userimg;
    // auther profile
if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['deleteProfileImage'])){
            $result = delete_photo($conn, $user_id, $userimg);
            $errors = $result['errors'];
            $success = $result['success'];

        }else if(isset($_POST['saveChanges'])){
            $result = update_profile($conn, $user_id);
            $errors = $result['errors'];
            $success = $result['success'];
        }


        
        // If there are errors, store them in session and redirect back
        if (!empty($errors)) {
            set_errors($errors,'errors','../profile.php');
            exit;
        }
        if (!empty($success)) {
            set_success($success,'success','../profile.php');
            exit;
        }
        header("Location: " . BASE_URL . "profile.php");
        exit;
    }
?>
