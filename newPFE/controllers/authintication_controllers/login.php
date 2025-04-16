<?php
    require_once '../../config/config.php';
    require_once '../functions.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ini_set('display_errors', 1);
error_reporting(E_ALL);

    // Redirect if not a POST request
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        redirect(BASE_URL.'index.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $identifier = trim($_POST['logUsernameEmail'] ?? '');
        // $email = trim($_POST['logEmail'] ?? '');
        $password = $_POST['logPassword'] ?? '';

        $errors = [];
        $loginData = ['identifier' => $identifier];

        if (empty($identifier)) {
            $errors[] = "Username or Email is required";
        } 
        // elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     $errors[] = "Invalid email format";
        // }
        
        if (empty($password)) {
            $errors[] = "Password is required";
        }
          
        if (empty($errors)) {
            try {       
                // Check if user exists with this email
                // Determine if identifier is an email
                $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL) !== false;

                // Prepare the appropriate SQL query
                if ($isEmail) {
                    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :identifier");
                } else {
                    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :identifier");
                }

                $stmt->execute(['identifier' => $identifier]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
                if (!$user) {
                    // User not found
                    $errors[] = "Invalid username/email or password";
                } else {
                    // Verify password
                    if (password_verify($password, $user['password_hash'])) {
                        // Regenerate session ID for security
                        session_regenerate_id(true);

                        // Store user data in session
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role_id'] = $user['role_id'];
                        $_SESSION['email'] = $user['email']; // Store email as well
                        $_SESSION['success_message'] = "Login successful. Welcome back, " . htmlspecialchars($user['username']) . "!";

                        // Update last login timestamp (optional but good practice)
                        try {
                            $updateStmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE user_id = :user_id");
                            $updateStmt->execute(['user_id' => $user['user_id']]);
                        } catch (PDOException $e) {
                            // Log error, but don't prevent login
                            error_log("Failed to update last_login for user_id " . $user['user_id'] . ": " . $e->getMessage());
                        }

                        // Redirect to index page after successful login
                        redirect(BASE_URL.'index.php');
                        exit;

                    } else {
                        // Password does not match
                        $errors[] = "Invalid username/email or password"; // Keep error generic
                    }
                }
            } catch (PDOException $e) {
                $errors[] = "Database error. Please try again later."; // User-friendly error
                // Log the detailed error for developers
                error_log("Login attempt - POST data: " . print_r($_POST, true));
            }
        }


        if (!empty($errors)) {
            $_SESSION['login_errors'] = $errors;
            $_SESSION['login_data'] = $loginData;
            
            redirect(BASE_URL.'index.php');
            exit;
        }
    }
     redirect(BASE_URL.'index.php');
    exit;
?>