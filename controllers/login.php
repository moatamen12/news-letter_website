<?php
    require_once '../config/config.php';

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
                $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND username =:username");
                $stmt->execute(['email' => $email, 'username' => $username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$user) {
                    // User not found
                    $errors[] = "Invalid email or username ";
                } else {
                    // Verify password
                    if (password_verify($password, $user['password_hash'])) {
                        //udatig last login timesrstamp
                        $updateStmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :user_id");
                        $updateStmt->execute(['user_id' => $user['user_id']]);
                        
                        // Login successful
                        session_start();
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role_id'] = $user['role_id'];
                        $_SESSION['success_message'] = "Login successful. Welcome back!";
                        

                        header('Location: ../index.php');
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
            
            header('Location: ../index.php');
            exit;
        }
    }
    header('Location: ../index.php');
    exit;
session_regenerate_id(true);
?>