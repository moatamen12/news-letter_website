<?php 
   require_once '../config/config.php';
   
   if (session_status() === PHP_SESSION_NONE) {
      session_start();
   }

   // Server-side validation for login status
   if (!isset($_SESSION['user_id'])) {
      $_SESSION['contact_error'] = "You must be logged in to send a message.";
      header('Location: ../login.php');
      exit;
   }


   if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $username = trim($_POST['username'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $subject = trim($_POST['subject'] ?? '');
      $category = $_POST['category'] ?? 'general';  
      $message = $_POST['message'] ?? '';

      try{
         $stmt = $conn->prepare("
         INSERT INTO contact_messages (user_id, username, email, subject, catagory, message)
         VALUES (:user_id, :username, :email, :subject, :category, :message)
         ");

         $stmt->execute([
            'user_id' => $_SESSION['user_id'],
            'username' => $username,
            'email' => $email,
            'subject' => $subject,
            'message_category' => $category,
            'message' => $message
         ]);

         $_SESSION['contact_success'] = "Your message has been sent successfully.";
         header('Location: ../contact.php');
      }catch(PDOException $e){
         $_SESSION['contact_errors'] = ["Database error: " . $e->getMessage()];
         header('Location: ../contact.php');
      }
   }
   header('Location: ../contact.php');
   exit;
   session_regenerate_id(true);



?>