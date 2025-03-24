<?php
include_once __DIR__ . '/../../config/config.php';
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();
$home = BASE_URL."index.php";
// Redirect to home page (use relative path for safety)
header("Location: $home");
exit;
?>