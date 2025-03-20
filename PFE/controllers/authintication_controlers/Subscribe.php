<?php
    include '../../config/config.php';
    require_once '../functions.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $Fname = trim($_POST['FullName'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confPassword = $_POST['confPassword'] ?? '';

        // Server-side validation
        $errors = [];
        
        if (empty($Fname)) {
            $errors[] = "First name is required";
        }
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }else{
            try{
                $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $count = $stmt->fetchColumn();
                if ($count > 0 ){
                    $errors[] = "user allready Exests";
                }
            }catch(PDOException $e){
                $errors[] = "Error checking email: " . $e->getMessage();
            }
        }            
        
        if (empty($username)) {
            $errors[] = "Username is required"; 
        } 
        elseif (strlen($username) < 5) {
            $errors[] = "Username must be at least 5 characters"; 
        }
        else{
            // Check if username already exists in database
            try {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
                $stmt->execute(['username' => $username]);
                $count = $stmt->fetchColumn();
                
                if ($count > 0) {
                    $errors[] = "Username is already taken";
                }
            } catch (PDOException $e) {
                $errors[] = "Error checking username: " . $e->getMessage();
            }
        }
             
        if (empty($password)) {
            $errors[] = "Password is required";
        }
        
        if ($password !== $confPassword) {
            $errors[] = "Passwords do not match";
        }
        
        // If validation passes, insert into database
        if (empty($errors)) {
            try {
                // Start a transaction to ensure both user and profile are created
                $conn->beginTransaction();
                
                // Hash the password 
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Prepare statement for user insertion
                $stmt = $conn->prepare("
                    INSERT INTO users (name, email, username, password_hash, role_id, created_at)
                    VALUES (:name, :email, :username, :password_hash, 1, NOW())
                ");


                // Execute with parameters
                $stmt->execute([
                    'name' => $Fname,
                    'email' => $email,
                    'username' => $username,
                    'password_hash' => $hashedPassword
                ]);
                
                // Get the newly created user ID
                $user_id = $conn->lastInsertId();
                
                // Create default profile for the new user
                $stmt = $conn->prepare("
                    INSERT INTO user_profiles (user_id)
                    VALUES (:user_id)
                ");
                $stmt->execute(['user_id' => $user_id]);
                
                // Commit the transaction
                $conn->commit();
                
                // Set up session (automatic login)
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $Fname;
                $_SESSION['role_id'] = 1; // Default role is reader (1)
                $_SESSION['success_message'] = "Registration successful! Your profile has been created.";
                // Set the default profile photo explicitly
                $_SESSION['profile_photo'] = 'assets/images/userImage.jpg';
                $_SESSION['success_message'] = "Registration successful! Your profile has been created.";

                // Redirect to profile page
                redirect(BASE_URL.'index.php');
                exit;
                
            } catch (PDOException $e) {
                // Rollback transaction in case of error
                $conn->rollBack();
                
                // Check for duplicate email
                if ($e->getCode() == 23000) { 
                    $errors[] = "Email is already registered";
                } else {
                    $errors[] = "Database error: " . $e->getMessage();
                }
            }
        }
        
        // If there are errors, store them in session and redirect back
        if (!empty($errors)) {
            session_start();
            $_SESSION['register_errors'] = $errors;
            $_SESSION['register_data'] = [
                'Full Name' => $Fname,
                'username' => $username,
                'email' => $email
            ];
            
            redirect(BASE_URL.'index.php');
            exit;
        }
    }

    // If not POST request, redirect to homepage
    redirect(BASE_URL.'index.php');
    exit;

?>