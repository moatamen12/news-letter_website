<?php 
//deleteing the profile image
function delete_photo($conn, $user_id,$userimg){
    try {
        //get the current profile photo
        $stmt = $conn->prepare("SELECT profile_photo FROM user_profiles WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentPhoto = $result['profile_photo'];
        
        // Check if the user have a photo and if the photo is not the default photo
        if ($currentPhoto && $currentPhoto !== $userimg && strpos($currentPhoto, 'uploads/profiles/') !== false) {
            // Construct the file path
            $filePath = __DIR__ . '/../' . $currentPhoto;
            
            // Debug info 
            error_log("Attempting to delete file: " . $filePath);
            
            // Delete the file if it exists
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    error_log("File successfully deleted");
                } else {
                    error_log("Failed to delete file - permission issue");
                }
            } else {
                error_log("File does not exist at path: " . $filePath);
            }
        }
        
        //update with the new image
        $stmt = $conn->prepare("UPDATE user_profiles SET profile_photo = :profile_photo WHERE user_id = :user_id");
        $stmt->execute([
            'user_id' => $user_id,
            'profile_photo' => $userimg
        ]);
        
        $_SESSION['Profile_success'] = "Profile image deleted successfully";
        // Redirect back to profile page
        redirect('../profile.php');
    } catch(PDOException $e) {
        $errors[] = "DATA ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage();
        $_SESSION['errors'] = $errors;
        redirect('../profile.php');
    }
}

//udating the profile
function update_profile($conn, $user_id){
    
}

?>