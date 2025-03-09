<?php
    require_once 'config/config.php';
    
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error_message'] = "You must be logged in to access this page";
        header("Location: index.php");
        exit;
    }
    
    $user_id = $_SESSION['user_id'];
    $error_message = $_SESSION['error_message'] ?? '';
    $success_message = $_SESSION['success_message'] ?? '';
    
    // Clear session messages
    unset($_SESSION['error_message']);
    unset($_SESSION['success_message']);
    
    try {
        // Get user data
        $stmt = $conn->prepare("SELECT u.*, r.role_name 
                                     FROM users u 
                                     JOIN roles r ON u.role_id = r.role_id 
                                     WHERE u.user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            $_SESSION['error_message'] = "User not found";
            header("Location: index.php");
            exit;
        }
        
        
        // Get user profile data
        $stmt = $conn->prepare("SELECT * FROM user_profiles WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Set default values
        $firstName = $user['name'] ?? '';
        $username = $user['username'] ?? '';
        $lastName = ''; // You may need to adjust if you store full name differently
        $profile_picture = $profile['profile_picture'] ?? 'assets/images/default-avatar.png';
        
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        header("Location: index.php");
        exit;
    }
    
    require_once 'includes/header.php';   
?>

<!-- Main content -->
<div class="container-fluid py-4"> <!-- FIXED: Removed nested container issue -->
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

    <!-- Two column layout -->
    <div class="row">
        <!-- Left column - Main profile information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Profile Picture</h5>
                </div>
                <div class="card-body">
                    <form action="update_profile_picture.php" method="post" enctype="multipart/form-data">
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
                                <h5><?php echo htmlspecialchars($firstName) ?></h5>
                                <p class="text-muted mb-2"><?php echo htmlspecialchars($user['email']); ?></p>
                                <p class="text-muted mb-2">JPG or PNG format. Max size 1MB.</p>
                                <button type="submit" class="btn btn-sm btn-primary">Upload Photo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <form id="profileForm" action="update_profile.php" method="post">
                <!-- Personal Information -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">user Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($username); ?>">
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
                            <input type="text" class="form-control" id="location" name="location" value="<?php echo isset($profile['location']) ? htmlspecialchars($profile['location']) : ''; ?>">
                        </div>
                    </div>
                </div>

                <!-- Remaining cards omitted for brevity... -->
                
                <div class="d-flex justify-content-end mb-5">
                    <a href="dashboard.php" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        
        <!-- Right column - Profile Management -->
        <div class="col-lg-4">
            <!-- Profile Management Card -->
            <div class="card mb-4" style="top: 20px; z-index: 10;">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Profile Management</h5>
                </div>
                <div class="card-body">
                    <!-- Profile Type Change -->
                    <div class="mb-4">
                        <h6>Profile Type</h6>
                        <p class="text-muted mb-3">Current type: <span class="badge bg-primary"><?php echo htmlspecialchars(isset($user['role_name']) ? $user['role_name'] : 'Reader'); ?></span></p>
                        
                        <?php if ($user['role_id'] == 1): // If user is a reader ?>
                        <form action="profile_upgrade.php" method="post" class="d-inline">
                            <input type="hidden" name="request_type" value="contributor">
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">Request Contributor Access</button>
                        </form>
                        <?php endif; ?>
                        
                        <?php if ($user['role_id'] == 1 || $user['role_id'] == 2): // If user is reader or contributor ?>
                        <button type="button" class="btn btn-outline-secondary btn-sm mt-2 w-100" data-bs-toggle="modal" data-bs-target="#roleInfoModal">
                            <i class="fas fa-info-circle"></i> Role Information
                        </button>
                        <?php endif; ?>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Delete Account Section -->
                    <div>
                        <h6 class="text-danger">Danger Zone</h6>
                        <p class="text-muted mb-3">Once you delete your account, there is no going back. Please be certain.</p>
                        
                        <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                            <i class="fas fa-trash-alt me-2"></i>Delete My Account
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Account Status Card -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Account Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                        <span>Your account is active</span>
                    </div>
                    <p class="text-muted small">Member since: <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                    <p class="text-muted small">Last login: <?php echo $user['last_login'] ? date('F j, Y', strtotime($user['last_login'])) : 'Never'; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals and scripts remain unchanged -->

<?php require_once 'includes/footer.php'; ?>

<script>
    // Image preview functionality
    document.getElementById('profileImageUpload').onchange = function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImagePreview').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    };

    // Enable delete button only when user types DELETE correctly
    document.getElementById('deleteConfirmation').addEventListener('input', function() {
        document.getElementById('confirmDeleteBtn').disabled = this.value !== 'DELETE';
    });
</script>