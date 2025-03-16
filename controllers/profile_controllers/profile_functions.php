<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function delete_photo($conn, $user_id,$userimg){
    $errors = [];
    $success = [];
    try {
        //get the current profile photo
        $stmt = $conn->prepare("SELECT profile_photo FROM user_profiles WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentPhoto = $result['profile_photo'];
        
        // Check if the user have a photo and if the photo is not the default photo
        if ($currentPhoto && strpos($currentPhoto, 'uploads/profiles/') !== false) {
            // Construct the file path and proceed with deletion
            $filePath = __DIR__ . '/../' . $currentPhoto;
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    $success[] = "File successfully deleted";
                } else {
                    $errors[] = "Failed to delete file - permission issue";
                }
            } else {
                $errors[] = "Image file does not exist on server";
            }
        } else {
            // No custom profile photo to delete
            $success[] = "Default profile photo restored";
        }
        
        //update with the new image
        $stmt = $conn->prepare("UPDATE user_profiles SET profile_photo = :profile_photo WHERE user_id = :user_id");
        $stmt->execute([
            'user_id' => $user_id,
            'profile_photo' => $userimg
        ]);
        $success[] = "Profile image deleted successfully"; 
        // set_success("Profile image deleted successfully",'success','../profile.php');
        

    } catch(PDOException $e) {
        $errors[] = "DATA ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage();
        // set_errors("DATA ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage(),'errors','../profile.php');
    }
    return ['errors' => $errors, 'success' => $success];

}

//udating the profile
function update_profile($conn, $user_id){
    $errors = [];
    $success = [];
    // update profile pictore
    try{
        if(isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0){
            $allowed_types= ['image/jpeg','image/png'];
            $max_size = 1024 * 1024 ;//1MB

            $file_info = $_FILES['profileImage'];
            $file_type= $file_info['type'];
            $file_size = $file_info['size'];
            $file_tmp = $file_info['tmp_name'];
            // $file_error = $file_info['error'];

            if(!in_array($file_type, $allowed_types)){
                $errors[] = "File type not allowed('jpeg or png only')";
                // set_errors("File type not allowed('jpeg or png only')",'errors','../profile.php');
            }else if($file_size > $max_size){
                $errors[] = "File size exceeds maximum allowed size('1MB')";
                // set_errors("File size exceeds maximum allowed size('1MB')",'errors','../profile.php');
            }else{
                $upload_dir = __DIR__ . '/../uploads/profiles/';
        
                // Create directory if it doesn't exist
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                $file_extention = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
                var_dump($file_extention);
                $filename = 'profile_' . $user_id . '_' . time() .$_FILES['profileImage']['name']. '.' . $file_extention;
                $target_path = $upload_dir . $filename;

                // Only attempt to move the file if path is defined and validation passed
                if(move_uploaded_file($file_tmp, $target_path)){
                    // Update database with new profile photo path
                    $profile_photo_path = 'uploads/profiles/' . $filename;
                    $stmt = $conn->prepare("UPDATE user_profiles SET profile_photo = :profile_photo WHERE user_id = :user_id");
                    $stmt->execute([
                        'user_id' => $user_id,
                        'profile_photo' => $profile_photo_path
                    ]);
                    $success[] = "Profile photo updated successfully";
                    // set_success("Profile photo updated successfully",'success','../profile.php');
                }else {
                    $errors[] = "Error uploading file. Please try again.";
                    // set_errors("Error uploading file. Please try again.",'errors','../profile.php');
                }
            }
        }else {
            $errors[] = "Please select an image to upload.";
            // set_errors("Please select an image to upload.",'errors','../profile.php');
        }
    } catch(PDOException $e){
        $errors[] = "DATABASE ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage();
        // set_errors("DATABASE ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage(),'errors','../profile.php');
    } catch(Exception $e){
        $errors[] = "ERROR: " . $e->getMessage();
        // set_errors("ERROR: " . $e->getMessage(),'errors','../profile.php');
    }

    // try{
    //     $stmt = "SELECT * FROM users WHERE user_id = :user_id";
    // }catch{
    //     $errors[] = "ERROR: " . $e->getMessage();
    // }
    return ['errors' => $errors, 'success' => $success];
}

?>