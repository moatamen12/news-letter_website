<?php 
    include 'functions.php';
    $pageTitle = "Edit Profile";
    require_once __DIR__ . '/../config/config.php';

    $userimg = BASE_URL . USER_IMG;
    
    $user_id = $_SESSION['user_id'];
    $errors = [];
    // auther profile
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
                $errors[] = "DATA ERROR PLEAS TRAY AGEN LATER'could not delet photo': " . $e->getMessage();
            }
        }else if(isset($_POST['saveChanges'])){
            try{
                if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0){
                    $allowed_types= ['jmage/jpeg','image/png'];
                    $max_size = 1024 * 1024 ;//1MB

                    $file_info = $_FILES['profileImage'];
                    $file_type= $file_info['type'];
                    $file_size = $file_info['size'];
                    $file_tmp = $file_info['tmp_name'];
                    $file_error = $file_info['error'];

                    if(!in_array($file_type, $allowed_types)){
                        $errors[] = "File type not allowed('jpeg or png only')";
                    }else if($file_size > $max_size){
                        $errors[] = "File size exceeds maximum allowed size('1MB')";
                    }else{
                        $upload_dir = __DIR__ . '/../profiles/profiles/';
                        $file_extention = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
                        $filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extention;
                        $target_path = $upload_dir . $filename;
                    }
                    if(move_uploaded_file($file_tmp, $target_path)){
                        // Update database with new profile photo path
                        $profile_photo_path = 'profiles/profiles/' . $filename;
                        $stmt = $conn->prepare("UPDATE user_profiles SET profile_photo = :profile_photo WHERE user_id = :user_id");
                        $stmt->execute([
                            'user_id' => $user_id,
                            'profile_photo' => $profile_photo_path
                        ]);
                        $errors[] = "Profile photo updated successfully";
                        redirect('../profile.php');
                    }else {
                        $error_message = "Error uploading file. Please try again.";
                    }
                }else {
                    $error_message = "Please select an image to upload.";
                }
            } catch(PDOException $e){
                $error_message = "DATABASE ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage();
            } catch(Exception $e){
                $error_message = "ERROR: " . $e->getMessage();
            }
        }
        // If there are errors, store them in session and redirect back
        if (!empty($errors)) {
            session_start();
            $_SESSION['Profile_errors'] = $errors;
            
            header('Location: ../profile.php');
            exit;
        }
    }
?>
