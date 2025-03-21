<?php
    require_once '../../config/config.php';
    require_once '../functions.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = trim($_POST['logusername'] ?? '');
        $email = trim($_POST['logEmail'] ?? '');
        $password = $_POST['logPassword'] ?? '';

        $errors = [];

        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        if (empty($password)) {
            $errors[] = "Password is required";
        }
        
        if (empty($errors)) {
            try {
                // Check if user exists with this email
                $stmt = $conn->prepare("
                        SELECT u.*, up.profile_photo 
                        FROM users u 
                        LEFT JOIN user_profiles up ON u.user_id = up.user_id 
                        WHERE u.email = :email AND u.username = :username
                    ");
                $stmt->execute(['email' => $email, 'username' => $username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
                if (!$user) {
                    // User not found
                    $errors[] = "Invalid email or username";
                } else {
                    // Verify password
                    if (password_verify($password, $user['password_hash'])) {
                        // update last login timestamp
                        $updateStmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :user_id");
                        $updateStmt->execute(['user_id' => $user['user_id']]);
                        
                        // Login successful
                        session_start();
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role_id'] = $user['role_id'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['success_message'] = "Login successful. Welcome back!";
                        // Set profile photo; fallback to default
                        $_SESSION['profile_photo'] = $user['profile_photo'] ?? 'assets/images/userImage.jpg';
        
                         redirect(BASE_URL.'index.php');
                        exit;
                    } else {

                        $errors[] = "Invalid  password";
                    }
                }
            } catch (PDOException $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
        if (!empty($errors)) {
            session_start();
            $_SESSION['login_errors'] = $errors;
            $_SESSION['login_data'] = [
                'username' => $username,
                'email' => $email
            ];
            
             redirect(BASE_URL.'index.php');
            exit;
        }
    }
     redirect(BASE_URL.'index.php');
    exit;
session_regenerate_id(true);
?>