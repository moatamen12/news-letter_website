<?php 
    include 'functions.php';
    $pageTitle = "Edit Profile";
    require_once __DIR__ . '/../config/config.php';

    //startinf session if not started
    if(!isset($_SESSION)) { session_start(); }
    // redirect to index if not logged in
    if (!is_logged_in()) {
        redirect(BASE_URL .  'index.php');
    }
    $userimg = BASE_URL . USER_IMG;
    
    $user_id = $_SESSION['user_id'];

    try{
        $stmt = $conn->prepare('SELECT users.*, user_profiles.*, roles.role_name 
                                FROM users 
                                JOIN user_profiles ON users.user_id = user_profiles.user_id 
                                JOIN roles ON users.role_id = roles.role_id
                                WHERE users.user_id = :user_id');
        $stmt -> execute([$user_id]);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);

        $profile_picture = isset($profile['profile_photo']) && !empty($profile['profile_photo']) ? $profile['profile_photo'] : $userimg;
        $email = $profile['email'];
        $name = $profile['name'];
        $password_hash = $profile['password_hash'];
        $role= $profile['role_name'];
        $username = $profile['username'];
        $bio = isset($profile['bio']) && !empty($profile['bio']) ? $profile['bio'] : 'Make your bio';
        $work = isset($profile['work']) && !empty($profile['work']) ? $profile['work'] : 'Add your work';


        
    }catch(PDOException $e){
        $error_message = "DATA ERROR PLEAS TRAY AGEN LATER: " . $e->getMessage();
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['deleteProfileImage'])){
            try{           
                // Delete the profile image 
                $stmt = $conn->prepare("UPDATE user_profiles SET profile_photo = :profile_photo WHERE user_id = :user_id");
                $stmt->execute(['user_id'  =>  $user_id,
                            'profile_photo' =>  $userimg]);
                // Redirect back to profile page
                redirect('../profile.php');               
            }catch(PDOException $e){
                $error_message = "DATA ERROR PLEAS TRAY AGEN LATER'could not delet photo': " . $e->getMessage();
            }
        }
        else if(isset($_POST['saveChanges'])){
            try{
                $newEmail = isset($_POST['emailInput']) ? trim($_POST['emailInput']) : '';
                $newName = isset($_POST['FullName']) ? trim($_POST['FullName']) : '';
                $newUsername = isset($_POST['usernameInput']) ? trim($_POST['usernameInput']) : '';
                $newBio = isset($_POST['bio']) ? trim($_POST['bio']) : '';
                $newJop = isset($_POST['work']) ? trim($_POST['work']) : '';
        
            }catch(PDOException $e){
                $error_message = "DATA ERROR PLEAS TRAY AGEN LATER'could not delet photo': " . $e->getMessage();
            }
        }
    }





?>
