<?php 
    include  __DIR__ .'/../functions.php';
    $pageTitle = "Edit Profile";
    require_once __DIR__ . '/../../config/config.php';

    //startinf session if not started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // redirect to index if not logged in
    if (!is_logged_in()) {
        redirect(BASE_URL .  'index.php');
    }
    $userimg = 'assets/images/default-use.jpg';
    
    $user_id = $_SESSION['user_id'];
    $errors = [];

    try{
        $stmt = $conn->prepare('SELECT users.*, user_profiles.*, roles.role_name 
                                FROM users 
                                JOIN user_profiles ON users.user_id = user_profiles.user_id 
                                JOIN roles ON users.role_id = roles.role_id
                                WHERE users.user_id = :user_id');
        $stmt -> execute([$user_id]);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);

        $profile_photo = isset($profile['profile_photo']) && !empty($profile['profile_photo']) ? $profile['profile_photo'] : $userimg;
        // echo $profile_picture;
        $email = $profile['email'];
        $name = $profile['name'];
        $password_hash = $profile['password_hash'];
        $role= $profile['role_name'];
        $username = $profile['username'];
        $bio = isset($profile['bio']) && !empty($profile['bio']) ? $profile['bio'] : 'Make your bio';
        $work = isset($profile['work']) && !empty($profile['work']) ? $profile['work'] : 'Add your work';


        
    }catch(PDOException $e){
        $errors[] = "DATA ERROR PLEAS TRAY AGEN LATER: " . $e->getMessage();
        set_errors($errors,'errors','../profile.php');
    }
?>