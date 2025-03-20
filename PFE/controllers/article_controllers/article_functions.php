<?php
require_once __DIR__ . '../../config/config.php';
require_once __DIR__ . '../functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!is_logged_in() || !get_role($conn)) {
    redirect(BASE_URL .  'index.php');
}else{ $_SESSION['user_id'] = get_role($conn);}
$errors=[];
$articles = [];
$statu = ['draft','published'];
function get_artical($status,$conn){
    try{
        $stmt = $conn->prepare('SELECT u.*, a.* FROM articles a
                                JOIN users u ON a.user_id = u.user_id
                                WHERE a.user_id = :user_id AND a.statu = :status');
        $stmt->execute(['user_id' => $_SESSION['user_id']
                        ,'status' => $status]);
        $articles = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $articles['name'];
        $title = $articles['title'];
        $statu = $articles['statu'];
        $content = $articles['content'];
        $summary = $articles['summary'];
    
    
    }catch(PDOException $e){
        $errors[] = "DATA ERROR PLEASE TRY AGAIN LATER: " . $e->getMessage();
        set_errors($errors,'errors','../profile.php');
    }
}
?>