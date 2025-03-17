<?php
    require_once __DIR__ . '/../config/config.php';
/**
 * Common functions for the newsletter application
 */

/**
 *
 * 
 * @param string $data The input data
 * @return string The cleaned data
 */
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * 
 * 
 * @return boolean True if logged in, false otherwise
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * 
 * @param PDO $conn Database connection
 * @return boolean:string True if logged in, false otherwise
 */
function get_role($conn){
    if (is_logged_in()){
        $stmt = $conn->prepare("SELECT r.role_name FROM roles r 
                                LEFT JOIN users u on u.role_id = r.role_id
                                WHERE u.user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        return $role['role_name'] ?? false;
    }
    else return false;     
}

/**
 * 
 * 
 * @param string $location The URL to redirect to
 * @return void
 */
function redirect($location) {
    header("Location: $location");
    exit();
}

// /**
//  * 
//  * 
//  * @param int $role_id The role ID to check
//  * @return boolean True if user has the role, false otherwise
//  */
// function has_role($role_id) {
//     if (!is_logged_in()) {
//         return false;
//     }
//     return $_SESSION['role_id'] == $role_id;
// }

/**
 * Check if user is admin
 * 
 * @return boolean True if user is admin, false otherwise
 */
function is_admin() {
    return get_role(3); // Role ID 3 is admin
}

/**
 * Format a date string
 * 
 * @param string $date The date string
 * @param string $format The format to use
 * @return string The formatted date
 */
function format_date($date, $format = 'F j, Y') {
    $timestamp = strtotime($date);
    return date($format, $timestamp);
}

/**
 * Get user name by ID
 *
 * @param PDO $conn Database connection
 * @param int $user_id User ID
 * @return string User's name or 'Unknown' if not found
 */
function get_user_name($conn, $user_id) {
    try {
        $stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $result = $stmt->fetch();
        
        if ($result) {
            return $result['name'];
        }
    } catch (Exception $e) {
        // Log error
    }
    
    return 'Unknown';
}



/**
 * Set error messages in session and redirect
 * 
 * @param mixed $errors String or array of error messages
 * @param string $type Error type
 * @param string $redirect_to URL to redirect to
 */
function set_errors($errors, $type = 'errors', $redirect_to = null) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Convert single string error to array
    if (!is_array($errors)) {
        $errors = [$errors];
    }
    
    // Set errors in session
    $_SESSION[$type] = $errors;
    
    // Redirect if specified
    if ($redirect_to) {
        redirect($redirect_to);
    }
    exit();
}

/**
 * Set success message in session and redirect
 * 
 * @param mixed $message Success message
 * @param string $type Success message type
 * @param string $redirect_to URL to redirect to
 */
function set_success($message, $type = 'success', $redirect_to = null) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION[$type] = $message;
    
    // Redirect if specified
    if ($redirect_to) {
        redirect($redirect_to);
    }
    exit();
}
?>
