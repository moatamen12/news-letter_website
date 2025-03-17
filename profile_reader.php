<?php 
    require_once 'controllers/profile_controllers/getProfile.php';
    $pageTitle = "Edit Profile";
    
    // Get any stored messages from session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $errors = $_SESSION['errors'] ?? [];
    $success = $_SESSION['success'] ?? [];
    
    unset($_SESSION['errors']);
    unset($_SESSION['success']);
    
    require_once 'includes/header.php';
?>
    <!-- Profile Info Card -->
    <div class="card shadow-sm border-0 mb-4">
                        <div class="p-4 fw-bold">
                            <h3 class="ps-3 border-start border-info border-4">Profile Info</h3>
                            <div class="my-3 border-bottom border-secondary border-2 rounded"></div>
                        </div>
                        <div class="card-body p-4">
                            <form action="controllers/profile_controllers/profile_update.php" method="post" enctype="multipart/form-data" class="row g-3" id="profileForm">
                                <div class="col-md-4">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar-upload me-3">
                                            <div class="avatar-preview">
                                                <img id="profileImagePreview" src="<?php     
                                                        if (strpos($profile_photo, 'http') === 0) {
                                                            echo htmlspecialchars($profile_photo);
                                                        } else if (strpos($profile_photo, 'controllers/uploads/profiles/') === 0) {
                                                            echo htmlspecialchars(BASE_URL . $profile_photo);
                                                        } else {
                                                            echo htmlspecialchars(BASE_URL . $profile_photo);
                                                        } ?>" 
                                                    alt="Profile Photo">
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" id="profileImageUpload" name="profileImage" accept=".png, .jpeg">
                                                <label for="profileImageUpload"><i class="fas fa-pencil-alt"></i></label>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" id="deleteProfileImage" name="deleteProfileImage" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt me-1"></i>Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- bio -->
                                <div class="col-md-8">
                                    <label for="bio" class="form-label">Bio </label>
                                    <footer class="text-body-secondary">500 characters at max</footer>
                                    <textarea name="bio" class="form-control" id="bio" maxlength="500"><?php echo htmlspecialchars($bio ?? ''); ?></textarea>
                                </div>

                                <!-- full name -->
                                <div class="col-md-6">
                                    <label for="FullName" class="form-label">Full Name </label>
                                    <input name="FullName" type="text" class="form-control" id="FullName" value="<?php echo htmlspecialchars($name); ?>">
                                </div>
                                
                                <!-- username -->
                                <div class="col-md-6">
                                    <label for="usernameInput" class="form-label">User Name </label>
                                    <input name="usernameInput" type="text" class="form-control" id="usernameInput" value="<?php echo htmlspecialchars($username); ?>">
                                </div>
                                <!-- email -->
                                <div class="col-md-6">
                                    <label for="emaileInput" class="form-label">Email </label>
                                    <input name="emaileInput" type="text" class="form-control" id="emaileInput" value="<?php echo htmlspecialchars($email); ?>">
                                </div>
                                <!-- work -->
                                <div class="col-md-6">
                                    <label for="WorkInput" class="form-label">Work </label>
                                    <input name="WorkInput" type="text" class="form-control" id="WorkInput" value="<?php echo htmlspecialchars($work ?? ''); ?>">
                                </div>

                                <!-- submit -->
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="saveChanges" class="btn text-center btn-lg btn-primary border-primary">Save Change</button>
                                </div>
                            </form>
                        </div>
                    </div>

<?php     
    require_once 'includes/footer.php';
?>