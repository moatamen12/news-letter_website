<?php 
   require_once '../config/config.php';
   
   // Start session if not already started
   if (session_status() === PHP_SESSION_NONE) {
      session_start();
   }

   // Check if user is logged in
   if (!isset($_SESSION['user_id'])) {
      $_SESSION['contact_error'] = "You must be logged in to send a message.";
      header('Location: ../contact.php');
      exit;
   }

   if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $username = trim($_POST['username'] ?? '');
      $email = trim($_POST['email'] ?? '');
      $subject = trim($_POST['subject'] ?? '');
      $category = $_POST['category'] ?? 'general';  
      $message = trim($_POST['message'] ?? '');
      
      // Validate inputs
      $errors = [];
      if (empty($username)) {
         $errors[] = "Username is required";
      }
      
      if (empty($email)) {
         $errors[] = "Email is required";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors[] = "Invalid email format";
      }
      
      if (empty($message)) {
         $errors[] = "Message is required";
      }
      
      // If there are errors, redirect back with errors
      if (!empty($errors)) {
         $_SESSION['contact_errors'] = $errors;
         $_SESSION['form_data'] = [
            'username' => $username,
            'email' => $email,
            'subject' => $subject,
            'category' => $category,
            'message' => $message
         ];
         header('Location: ../contact.php');
         exit;
      }

      // Try to insert the message into database
      try {
         $stmt = $conn->prepare("
            INSERT INTO contact_messages (user_id, username, email, subject, message_category, message)
            VALUES (:user_id, :username, :email, :subject, :category, :message)
         ");
         
         $success = $stmt->execute([
            'user_id' => $_SESSION['user_id'],
            'username' => $username,
            'email' => $email,
            'subject' => $subject,
            'category' => $category,
            'message' => $message
         ]);
         
         if ($success) {
            $_SESSION['contact_success'] = "Your message has been sent successfully!";
         } else {
            $_SESSION['contact_errors'] = ["Failed to send your message. Please try again."];
         }
         
         header('Location: ../contact.php');
         exit;
      } catch (PDOException $e) {
         $_SESSION['contact_errors'] = ["Database error: " . $e->getMessage()];
         header('Location: ../contact.php');
         exit;
      }
   } else {
      // If not a POST request, redirect back to contact page
      header('Location: ../contact.php');
      exit;
   }
?>