<?php 

// Display success messages
if (!empty($success)) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    
    // Handle both string and array types
    if (is_array($success)) {
        echo '<ul class="mb-0">';
        foreach ($success as $message) {
            echo '<li>' . htmlspecialchars($message) . '</li>';
        }
        echo '</ul>';
    } else {
        echo htmlspecialchars($success);
    }
    
     echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
     echo '</div>';
}

// Display errors messages
if (!empty($errors)) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    
    // Handle both string and array types
    if (is_array($errors)) {
        echo '<ul class="mb-0">';
        foreach ($errors as $message) {
            echo '<li>' . htmlspecialchars($message) . '</li>';
        }
        echo '</ul>';
    } else {
        echo htmlspecialchars($errors);
    }
    
     echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
     echo '</div>';
}

?>