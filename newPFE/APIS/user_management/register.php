<?php
    // Include required files
    require_once '../../config/config.php';
    require_once '../config/headers.php';
    require_once '../Models/User.php';

    // Initialize response array
    $response = [
        'success' => false,
        'message' => '',
        'data' => null,
        'errors' => []
    ];

    // Process only POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $response['message'] = 'Only POST requests are allowed';
        http_response_code(405); // Method Not Allowed
        echo json_encode($response);
        exit;
    }

    try {
        // Get posted data
        $data = json_decode(file_get_contents("php://input"));
        
        // Validate required fields
        $required_fields = ['name', 'email', 'username', 'password', 'confirm_password'];
        $errors = [];
        
        foreach ($required_fields as $field) {
            if (!isset($data->$field) || empty(trim($data->$field))) {
                $errors[] = ucfirst($field) . " is required";
            }
        }
        
        // Validate email format
        if (isset($data->email) && !filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        // Validate username length
        if (isset($data->username) && strlen($data->username) < 5) {
            $errors[] = "Username must be at least 5 characters";
        }
        
        // Check if passwords match
        if (isset($data->password, $data->confirm_password) && $data->password !== $data->confirm_password) {
            $errors[] = "Passwords do not match";
        }
        
        // If there are validation errors, return them
        if (!empty($errors)) {
            $response['errors'] = $errors;
            http_response_code(422); // Unprocessable Entity
            echo json_encode($response);
            exit;
        }
        
        // Create user object
        $user = new User($conn);
        
        // Check if email already exists
        $user->email = $data->email;
        if ($user->emailExists()) {
            $response['errors'][] = "Email already exists";
            http_response_code(409); // Conflict
            echo json_encode($response);
            exit;
        }
        
        // Check if username already exists
        $user->username = $data->username;
        if ($user->usernameExists()) {
            $response['errors'][] = "Username already exists";
            http_response_code(409); // Conflict
            echo json_encode($response);
            exit;
        }
        
        // Set user properties
        $user->name = $data->name;
        $user->password_hash = password_hash($data->password, PASSWORD_DEFAULT);
        $user->role = $data->role ?? 'reader';
        
        // Create the user
        if ($user->create()) {
            $response['success'] = true;
            $response['message'] = "User registered successfully";
            $response['data'] = [
                'id' => $user->user_id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role
            ];
            http_response_code(201); // Created
        } else {
            $response['message'] = "Unable to register user";
            http_response_code(500); // Internal Server Error
        }

    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
        http_response_code(500); // Internal Server Error
    }

    // Return response
    echo json_encode($response);
?>