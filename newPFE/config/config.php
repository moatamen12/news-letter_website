<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $host = 'localhost';
    $dbname = 'newsletter_db';
    $username = 'root';
    $password = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";


    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $conn = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Database connection error: ' . $e->getMessage()
        ]);
        exit;
    }

    // Set timezone
    date_default_timezone_set('UTC');
    // Define constants
    define('BASE_URL', 'http://localhost/newsLetter/newPFE/');          //the base url of the project
    define('BASE_config', 'http://localhost/newsLetter/config');        //the base url of the config
    define('BASE_INC', BASE_URL .'includes');                           //the base url of the includes
    define('BASE_CONT', BASE_URL .'controllers');                       //the base url of the controllers
    define('BASE_UP', BASE_URL .'uploads/profiles');                    //the base url of the uploades
    define('LOGO_URL', BASE_URL .'assets/images/tech-expo-logo.png');   //logo url
    define('USER_IMG',BASE_URL .'assets/images/default_profile.webp');  //default user image



    // define('config_PATH', 'http://localhost/newsLetter/config/config.php');
?>
