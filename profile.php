<?php

    session_start();
    require_once 'config/config.php';
    require_once 'includes/functions.php';


    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }


    $user_id = $_SESSION['user_id'];

    // Initialize variables for form handling
    $success_message = '';
    $error_message = '';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['update_profile'])) {

            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $email = trim($_POST['email']);
            $bio = trim($_POST['bio']);
            $location = trim($_POST['location']);
            $username = trim($_POST['username']);
            $website = trim($_POST['website']);
            
            // Social profiles
            $facebook = trim($_POST['facebook']);
            $twitter = trim($_POST['twitter']);
            $instagram = trim($_POST['instagram']);
            $linkedin = trim($_POST['linkedin']);
            
            try {
                // Begin transaction
                $conn->beginTransaction();
                
                // Update users table
                $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, username = ? WHERE user_id = ?");
                $name = $firstName . ' ' . $lastName;
                $stmt->execute([$name, $email, $username, $user_id]);
                
                // Check if profile exists
                $stmt = $conn->prepare("SELECT COUNT(*) FROM user_profiles WHERE user_id = ?");
                $stmt->execute([$user_id]);
                $profileExists = $stmt->fetchColumn();
                
                if ($profileExists) {
                    // Update existing profile
                    $stmt = $conn->prepare("UPDATE user_profiles SET bio = ?, position = ?, website = ?, 
                                        facebook = ?, twitter = ?, instagram = ?, linkedin = ? 
                                        WHERE user_id = ?");
                    $stmt->execute([$bio, $location, $website, $facebook, $twitter, $instagram, $linkedin, $user_id]);
                } else {
                    // Create new profile
                    $stmt = $conn->prepare("INSERT INTO user_profiles 
                                        (user_id, bio, position, website, facebook, twitter, instagram, linkedin) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$user_id, $bio, $location, $website, $facebook, $twitter, $instagram, $linkedin]);
                }
                
                // Handle password change if provided
                if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
                    if ($_POST['password'] === $_POST['confirmPassword']) {
                        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
                        $stmt->execute([$password_hash, $user_id]);
                    } else {
                        throw new Exception("Passwords do not match!");
                    }
                }
                
                // Commit the transaction
                $conn->commit();
                $success_message = "Profile updated successfully!";
            } catch (Exception $e) {
                // Rollback on error
                $conn->rollBack();
                $error_message = "Error: " . $e->getMessage();
            }
        }
        
        if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/png'];
            $max_size = 1048576; // 1MB
            
            $file = $_FILES['profileImage'];
            
            if (!in_array($file['type'], $allowed_types)) {
                $error_message = "Only JPG and PNG images are allowed!";
            } elseif ($file['size'] > $max_size) {
                $error_message = "File is too large! Maximum size is 1MB.";
            } else {

                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = 'profile_' . $user_id . '_' . time() . '.' . $file_extension;
                $upload_dir = 'uploads/profiles/';
                
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $target_file = $upload_dir . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    try {
                        $stmt = $conn->prepare("UPDATE user_profiles SET profile_picture = ? WHERE user_id = ?");
                        $stmt->execute([$target_file, $user_id]);
                        $success_message = "Profile picture updated successfully!";
                    } catch (Exception $e) {
                        $error_message = "Error updating profile picture: " . $e->getMessage();
                    }
                } else {
                    $error_message = "Error uploading file. Please try again.";
                }
            }
        }
    }

    try {
        // Get user information
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Split name into first and last name
        $name_parts = explode(' ', $user['name'], 2);
        $firstName = $name_parts[0];
        $lastName = isset($name_parts[1]) ? $name_parts[1] : '';
        
        $stmt = $conn->prepare("SELECT * FROM user_profiles WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $profile_picture = isset($profile['profile_picture']) && !empty($profile['profile_picture']) 
                        ? $profile['profile_picture'] : 'assets/images/avatar.jpg';
    } catch (Exception $e) {
        $error_message = "Error fetching user data: " . $e->getMessage();
    }

    // Include header
    $pageTitle = "Edit Profile";
    include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Newsletter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar navigation -->
            <div class="col-lg-3 col-md-4 sidebar">
                <div class="d-flex flex-column align-items-center text-center pt-5 pb-4">
                    <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="User Avatar" class="rounded-circle sidebar-avatar mb-3">
                    <h5 class="fw-bold"><?php echo htmlspecialchars($user['name']); ?></h5>
                    <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                    <li class="nav-item"><a href="profile.php" class="nav-link active"><i class="fas fa-user me-2"></i> My Profile</a></li>
                    <li class="nav-item"><a href="posts.php" class="nav-link"><i class="fas fa-file-alt me-2"></i> Posts</a></li>
                    <li class="nav-item"><a href="notifications.php" class="nav-link"><i class="fas fa-bell me-2"></i> Notifications</a></li>
                    <li class="nav-item"><a href="bookmarks.php" class="nav-link"><i class="fas fa-bookmark me-2"></i> Bookmarks</a></li>
                    <li class="nav-item"><a href="settings.php" class="nav-link"><i class="fas fa-cog me-2"></i> Settings</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Sign Out</a></li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-lg-9 col-md-8 main-content">
                <div class="container py-4">
                    <h1 class="mb-4">Edit Profile</h1>
                    
                    <?php if(!empty($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">Profile Picture</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="profileImagePreview" src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Preview">
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" id="profileImageUpload" name="profileImage" accept=".png, .jpg, .jpeg">
                                            <label for="profileImageUpload"><i class="fas fa-pencil-alt"></i></label>
                                        </div>
                                    </div>
                                    <div class="ms-4">
                                        <h5>Profile Photo</h5>
                                        <p class="text-muted mb-2">JPG or PNG format. Max size 1MB.</p>
                                        <button type="submit" class="btn btn-sm btn-primary">Upload Photo</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form id="profileForm" action="" method="post">
                        <!-- Personal Information -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Personal Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($profile['phone']) ? htmlspecialchars($profile['phone']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="4"><?php echo isset($profile['bio']) ? htmlspecialchars($profile['bio']) : ''; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="<?php echo isset($profile['position']) ? htmlspecialchars($profile['position']) : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Account Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control" id="website" name="website" value="<?php echo isset($profile['website']) ? htmlspecialchars($profile['website']) : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="text-muted">Leave blank to keep current password</small>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                </div>
                            </div>
                        </div>

                        <!-- Social Profiles -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Social Profiles</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label"><i class="fab fa-facebook text-primary me-2"></i> Facebook</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook" value="<?php echo isset($profile['facebook']) ? htmlspecialchars($profile['facebook']) : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="twitter" class="form-label"><i class="fab fa-twitter text-info me-2"></i> Twitter</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter" value="<?php echo isset($profile['twitter']) ? htmlspecialchars($profile['twitter']) : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="instagram" class="form-label"><i class="fab fa-instagram text-danger me-2"></i> Instagram</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram" value="<?php echo isset($profile['instagram']) ? htmlspecialchars($profile['instagram']) : ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="linkedin" class="form-label"><i class="fab fa-linkedin text-primary me-2"></i> LinkedIn</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo isset($profile['linkedin']) ? htmlspecialchars($profile['linkedin']) : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-5">
                            <a href="dashboard.php" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/profile.js"></script>
</body>
</html>

<?php
// Include footer
include 'includes/footer.php';
?>