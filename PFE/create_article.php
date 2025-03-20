<?php 
require_once __DIR__ . '\controllers\functions.php';
include 'includes/header.php';

    $pageTitle = "Edit Profile";
        
    // Get any stored messages from session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $user_id = $_SESSION['user_id'];
    




?>

<section class="container-fluid my-5">
    <div class="p-5 ">   
        <h1 class="fw-bold">My Account</h1>
        <footer class="text-body-secondary">Hi, <?php echo htmlspecialchars($name);?>you can create and edet Your articals</footer>
    </div>

</section>




<?php include 'includes/footer.php'; ?>