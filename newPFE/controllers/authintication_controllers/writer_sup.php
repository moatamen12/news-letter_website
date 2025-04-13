<?php
    include '../../config/config.php';
    require_once '../functions.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Only process POST requests
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Collect form data
        $writerEmail = trim($_POST['writerEmail'] ?? '');
        $password = $_POST['WPassword'] ?? '';
        $confPassword = $_POST['WconfPassword'] ?? '';
        $writerName = trim($_POST['writerName'] ?? '');
        $writerUsername = trim($_POST['writerUsername'] ?? '');
        $writerBio = trim($_POST['writerBio'] ?? '');
        $writerUrl = trim($_POST['writerUrl'] ?? '');
        
        // Get social media links (may be multiple)
        $socialPlatforms = $_POST['socialPlatform'] ?? [];
        $socialUrls = $_POST['socialUrl'] ?? [];
        
        // Get writing interests (if present)
        $writerInterests = isset($_POST['writerInterests']) ? $_POST['writerInterests'] : [];
        
        // Terms agreement check
        $termsAgreed = isset($_POST['writerTerms']);
        
        // Server-side validation
        $errors = [];
        
        // Required fields validation
        if (empty($writerEmail)) {
            $errors['email'] = "Email is required";
        } elseif (!filter_var($writerEmail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        } else {
            // Check if email already exists
            try {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
                $stmt->execute(['email' => $writerEmail]);
                $count = $stmt->fetchColumn();
                if ($count > 0) {
                    $errors['email'] = "Email address is already registered";
                }
            } catch (PDOException $e) {
                $errors['database'] = "Error checking email: " . $e->getMessage();
            }
        }
        
        // Validate name
        if (empty($writerName)) {
            $errors['name'] = "Name is required";
        }
        
        // Validate username
        if (empty($writerUsername)) {
            $errors['username'] = "Username is required"; 
        } elseif (strlen($writerUsername) < 5) {
            $errors['username'] = "Username must be at least 5 characters"; 
        } else {
            // Check if username already exists
            try {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
                $stmt->execute(['username' => $writerUsername]);
                $count = $stmt->fetchColumn();
                
                if ($count > 0) {
                    $errors['username'] = "Username is already taken";
                }
            } catch (PDOException $e) {
                $errors['database'] = "Error checking username: " . $e->getMessage();
            }
        }
        
        // Password validation
        if (empty($password)) {
            $errors['password'] = "Password is required";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters";
        }
        
        // Confirm password match
        if ($password !== $confPassword) {
            $errors['confPassword'] = "Passwords do not match";
        }
        
        // Terms agreement validation
        if (!$termsAgreed) {
            $errors['terms'] = "You must agree to the Terms of Service";
        }
        
        // If validation passes, insert into database
        if (empty($errors)) {
            try {
                // Start a transaction
                $conn->beginTransaction();
                
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert into users table - set role to writer (2)
                $stmt = $conn->prepare("
                    INSERT INTO users (name, email, username, password_hash, role_id, created_at)
                    VALUES (:name, :email, :username, :password_hash, 2, NOW())
                ");

                $stmt->execute([
                    'name' => $writerName,
                    'email' => $writerEmail,
                    'username' => $writerUsername,
                    'password_hash' => $hashedPassword
                ]);
                
                // Get the new user ID
                $userId = $conn->lastInsertId();
                
                // Handle profile photo upload
                $profilePhotoPath = null;
                if (isset($_FILES['writerProfilePhoto']) && $_FILES['writerProfilePhoto']['error'] == 0) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $maxSize = 2 * 1024 * 1024; // 2MB
                    
                    if (in_array($_FILES['writerProfilePhoto']['type'], $allowedTypes) && 
                        $_FILES['writerProfilePhoto']['size'] <= $maxSize) {
                        
                        $uploadDir = '../../uploads/profiles/';
                        if (!file_exists($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }
                        
                        $fileExtension = pathinfo($_FILES['writerProfilePhoto']['name'], PATHINFO_EXTENSION);
                        $newFileName = 'writer_' . $userId . '_' . time() . '.' . $fileExtension;
                        $targetFilePath = $uploadDir . $newFileName;
                        
                        if (move_uploaded_file($_FILES['writerProfilePhoto']['tmp_name'], $targetFilePath)) {
                            $profilePhotoPath = 'uploads/profiles/' . $newFileName;
                        }
                    }
                }
                
                // Process social media links
                $facebook = $twitter = $instagram = $linkedin = $website = null;
                
                if (!empty($socialPlatforms) && !empty($socialUrls)) {
                    foreach ($socialPlatforms as $key => $platform) {
                        if (isset($socialUrls[$key]) && !empty($platform) && !empty($socialUrls[$key])) {
                            $url = $socialUrls[$key];
                            
                            switch ($platform) {
                                case 'twitter':
                                    $twitter = $url;
                                    break;
                                case 'linkedin':
                                    $linkedin = $url;
                                    break;
                                case 'facebook':
                                    $facebook = $url;
                                    break;
                                case 'instagram':
                                    $instagram = $url;
                                    break;
                                case 'website':
                                    $website = $url;
                                    break;
                            }
                        }
                    }
                }
                
                // If personal website was provided separately, use it
                if (empty($website) && !empty($writerUrl)) {
                    $website = $writerUrl;
                }
                
                // Insert into user_profiles table
                $stmt = $conn->prepare("
                    INSERT INTO user_profiles (user_id, profile_photo, bio, website, facebook, twitter, instagram, linkedin)
                    VALUES (:user_id, :profile_photo, :bio, :website, :facebook, :twitter, :instagram, :linkedin)
                ");
                
                $stmt->execute([
                    'user_id' => $userId,
                    'profile_photo' => $profilePhotoPath,
                    'bio' => $writerBio,
                    'website' => $website,
                    'facebook' => $facebook,
                    'twitter' => $twitter,
                    'instagram' => $instagram,
                    'linkedin' => $linkedin
                ]);
                
                // Store interests if applicable (optional)
                if (!empty($writerInterests)) {
                    // Assuming you have a user_interests table
                    foreach ($writerInterests as $interest) {
                        $stmt = $conn->prepare("
                            INSERT INTO user_interests (user_id, interest_name) 
                            VALUES (:user_id, :interest)
                        ");
                        $stmt->execute([
                            'user_id' => $userId,
                            'interest' => $interest
                        ]);
                    }
                }
                
                // Commit all database changes
                $conn->commit();
                
                // Set up session (auto-login)
                $_SESSION['user_id'] = $userId;
                $_SESSION['username'] = $writerUsername;
                $_SESSION['name'] = $writerName;
                $_SESSION['role_id'] = 2; // Writer role
                $_SESSION['success_message'] = "Welcome to Tech Newsletter! Your writer account has been created successfully.";
                
                // Redirect to dashboard or writer profile
                redirect(BASE_URL . 'profile.php');
                exit;
                
            } catch (PDOException $e) {
                // Rollback transaction if any error occurs
                $conn->rollBack();
                $errors['database'] = "Database error: " . $e->getMessage();
            }
        }
        
        // If there are errors, store them in session and redirect back
        if (!empty($errors)) {
            $_SESSION['writer_errors'] = $errors;
            $_SESSION['writer_data'] = [
                'email' => $writerEmail,
                'name' => $writerName,
                'username' => $writerUsername,
                'bio' => $writerBio,
                'url' => $writerUrl
            ];
            
            redirect(BASE_URL . 'index.php');
            exit;
        }
    } else {
        // Not a POST request
        redirect(BASE_URL . 'index.php');
        exit;
    }
?>