<?php
    require_once '../config/config.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $Fname = trim($_POST['FullName'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confPassword = trim($_POST['confPassword'] ?? '');

        // Server-side validation
        $errors = [];
        
        // if (empty($Fname)) {
        //     $errors[] = "First name is required";
        // }
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }else{
            try{
                $stmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $count = $stmt->fetchColumn();
                if ($count > 0){
                    $errors[] = "user allready Exests";
                }
            }catch(PDOException $e){
                $errors[] = "Error checking email: " . $e->getMessage();
            }
        }            
        
        if (empty($username)) {
            $errors[] = "Username is required"; 
        } 
        // elseif (strlen($username) < 3) {
        //     $errors[] = "Username must be at least 3 characters"; 
        // }
        else{
            // Check if username already exists in database
            try {
                $stmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
                $stmt->execute(['username' => $username]);
                $count = $stmt->fetchColumn();
                
                if ($count > 0) {
                    $errors[] = "Username is already taken";
                }
            } catch (PDOException $e) {
                $errors[] = "Error checking username: " . $e->getMessage();
            }
        }
             
        // if (empty($password)) {
        //     $errors[] = "Password is required";
        // }
        
        // if ($password !== $confPassword) {
        //     $errors[] = "Passwords do not match";
        // }
        
        // If validation passes, insert into database
        if (empty($errors)) {
            try {
                // Hash the password 
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // Prepare statement
                $stmt = $connection->prepare("
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
                
                // Start session for messages
                session_start();
                $_SESSION['success_message'] = "Registration successful! You can now log in.";
                
                // Redirect to login
                header('Location: ../index.php');
                exit;
                
            } catch (PDOException $e) {
                // Check for duplicate email
                if ($e->getCode() == 23000) { // MySQL integrity constraint violation code
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
            
            header('Location: ../index.php');
            exit;
        }
    }

    // If not POST request, redirect to homepage
    header('Location: ../index.php');
    exit;
    session_regenerate_id(true);
?>