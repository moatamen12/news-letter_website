<?php 
    $pageTitle = "Edit Profile";
    include 'functions.php';
    require_once __DIR__ . '/profile_functions.php';
    require_once __DIR__ . '/../config/config.php';
    
    $user_id = $_SESSION['user_id'];
    $errors = [];
    // auther profile
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['deleteProfileImage'])){
            delete_photo($conn, $user_id, $userimg);
        }else if(isset($_POST['saveChanges'])){
            try{
                if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0){
                    $allowed_types= ['image/jpeg','image/png'];
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
                        $upload_dir = __DIR__ . '/../uploads/profiles/';
                
                        // Create directory if it doesn't exist
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0755, true);
                        }

                        $file_extention = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
                        $filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extention;
                        $target_path = $upload_dir . $filename;
                    }
                    if(move_uploaded_file($file_tmp, $target_path)){
                        // Update database with new profile photo path
                        $profile_photo_path = 'uploads/profiles/' . $filename;
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
