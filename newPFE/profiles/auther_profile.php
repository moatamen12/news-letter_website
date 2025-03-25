<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-3 bg-primary bg-opacity-10 sidebar shadow-sm ">
                <h3 class="mb-4 ">HI! <?= htmlspecialchars($profile_info["username"])?></h3>
                <div class="profile-sidebar-user mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= htmlspecialchars($profile_info['profile_img']) ?>" alt="Profile" 
                            class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0"><?= htmlspecialchars(strtoupper($profile_info["role"])) ?></h6>
                            <small class="text-muted over_hid"><?= htmlspecialchars($profile_info["email"]) ?></small>
                        </div>
                    </div>
                    <hr>
                </div>
                
                <ul class="nav nav-pills flex-column" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active w-100 text-start" id="profile-tab" data-bs-toggle="pill" 
                                data-bs-target="#profile-content" type="button" role="tab">
                            <i class="fas fa-user me-2"></i> Profile
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link w-100 text-start" id="activity-tab" data-bs-toggle="pill" 
                                data-bs-target="#social-content" type="button" role="tab">
                            <i class="fa-solid fa-inbox me-2"></i> Activity
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link w-100 text-start" id="password-tab" data-bs-toggle="pill" 
                                data-bs-target="#password-content" type="button" role="tab">
                            <i class="fa-solid fa-table-columns me-2"></i> Dasheboard
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link w-100 text-start" id="danger-tab" data-bs-toggle="pill" 
                                data-bs-target="#danger-content" type="button" role="tab">
                            <i class="fas fa-exclamation-triangle me-2"></i> Danger Zone
                        </button>
                    </li>
                </ul>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-5">
                <div class="container mt-3">
                    <?php include 'includes/messages.php'; ?>
                </div>
                
                <!-- Tab Content -->
                <div class="tab-content" id="profileTabContent">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile-content" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Profile Info Card -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="p-4 fw-bold">
                                <h3 class="ps-3 border-start border-info border-4">Profile Info</h3>
                                <div class="my-3 border-bottom border-secondary border-2 rounded"></div>
                            </div>
                            <div class="card-body p-4">
                                <form action="controllers/profile_controllers/profile_update.php" method="post" enctype="multipart/form-data" class="row g-3" id="profileForm">
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar-upload me-3">
                                                <div class="avatar-preview">
                                                    <img id="profileImagePreview" src="<?= htmlspecialchars($profile_info['profile_img']) ?>" alt="Profile Photo">
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
                                    <div class="col-md-11">
                                        <label for="bio" class="form-label">Bio </label>
                                        <footer class="text-body-secondary">500 characters at max</footer>
                                        <textarea name="bio" class="form-control" id="bio" maxlength="500"><?= htmlspecialchars($profile_info['bio']) ?></textarea>
                                    </div>

                                    <!-- full name -->
                                    <div class="col-md-6">
                                        <label for="FullName" class="form-label">Full Name </label>
                                        <input name="FullName" type="text" class="form-control" id="FullName" value="<?= htmlspecialchars($profile_info['name']) ?>">
                                    </div>
                                    
                                    <!-- username -->
                                    <div class="col-md-6">
                                        <label for="usernameInput" class="form-label">User Name </label>
                                        <input name="usernameInput" type="text" class="form-control" id="usernameInput" value="<?= htmlspecialchars($profile_info['username']) ?>">
                                    </div>
                                    <!-- email -->
                                    <div class="col-md-6">
                                        <label for="emaileInput" class="form-label">Email </label>
                                        <input name="emaileInput" type="text" class="form-control" id="emaileInput" value="<?= htmlspecialchars($profile_info['email']) ?>">
                                    </div>
                                    <!-- work -->
                                    <div class="col-md-6">
                                        <label for="WorkInput" class="form-label">Work </label>
                                        <input name="WorkInput" type="text" class="form-control" id="WorkInput" value="<?= htmlspecialchars($profile_info['work']) ?>">
                                    </div>

                                    <!-- submit -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="saveChanges" class="btn text-center btn-lg btn-primary border-primary">Save Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Social Links Card -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="p-4 fw-bold">
                                <h3 class="ps-3 border-start border-info border-4">Social Links</h3>
                                <div class="my-3 border-bottom border-secondary border-2 rounded"></div>
                            </div>
                            <div class="card-body p-4">
                                <form action="controllers/profile_logic.php" method="post" class="row g-3">
                                    <!-- Website URL -->
                                    <div class="col-md-6">
                                        <label for="website" class="form-label">Website</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                            <input type="url" class="form-control" id="website" name="website" 
                                                value="<?= htmlspecialchars($profile_info['website']) ?>" 
                                                placeholder="https://yourwebsite.com">
                                        </div>
                                    </div>

                                    <!-- Facebook -->
                                    <div class="col-md-6">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                                            <input type="url" class="form-control" id="facebook" name="facebook" 
                                                value="<?= htmlspecialchars($profile_info['facebook']) ?>" 
                                                placeholder="https://facebook.com/profile">
                                        </div>
                                    </div>

                                    <!-- Twitter/X -->
                                    <div class="col-md-6">
                                        <label for="twitter" class="form-label">Twitter/X</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                            <input type="url" class="form-control" id="twitter" name="twitter" 
                                                value="<?= htmlspecialchars($profile_info['twitter']) ?>" 
                                                placeholder="https://twitter.com/username">
                                        </div>
                                    </div>

                                    <!-- Instagram -->
                                    <div class="col-md-6">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                            <input type="url" class="form-control" id="instagram" name="instagram" 
                                                value="<?= htmlspecialchars($profile_info['instagram']) ?>" 
                                                placeholder="https://instagram.com/username">
                                        </div>
                                    </div>

                                    <!-- LinkedIn -->
                                    <div class="col-md-6">
                                        <label for="linkedin" class="form-label">LinkedIn</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                                            <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                                value="<?= htmlspecialchars($profile_info['linkedin']) ?>" 
                                                placeholder="https://linkedin.com/in/username">
                                        </div>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="saveSocialLinks" class="btn text-center btn-lg btn-primary border-primary">
                                            Save Social Links
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>

                    <!-- ACTIVITY -->
                    <div class="tab-pane fade" id="social-content" role="tabpanel" aria-labelledby="activity-tab">
                        <?php include __DIR__ . "/activity.php"?>
                    </div>

                    <!-- DASHBOARD CONTENT -->
                    <div class="tab-pane fade" id="password-content" role="tabpanel" aria-labelledby="password-tab"></div>

                    <!-- DANGER ZONE TAP CONTENT -->
                    <div class="tab-pane fade" id="danger-content" role="tabpanel" aria-labelledby="danger-tab">
                        <!-- Change Password Card -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="p-4 fw-bold">
                                <h3 class="ps-3 border-start border-danger border-4">Change Password</h3>
                                <div class="my-3 border-bottom border-secondary border-2 rounded"></div>
                            </div>
                            <div class="card-body p-4">
                                <form action="controllers/profile_logic.php" method="post" class="row g-3">
                                    <!-- Current Password -->
                                    <div class="col-md-6">
                                        <label for="currentPassword" class="form-label">Current Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                            <!-- visibility toggle -->
                                            <button class="btn btn-bg" type="button">
                                                <i class="fas fa-eye" id="eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <!-- Empty for layout balance -->
                                    </div>
                                    
                                    <!-- New Password -->
                                    <div class="col-md-6">
                                        <label for="newPassword" class="form-label">New Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                            <!-- visibility toggle -->
                                            <button class="btn btn-bg" type="button">
                                                <i class="fas fa-eye" id="eye2"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Confirm New Password -->
                                    <div class="col-md-6">
                                        <label for="confirmPassword" class="form-label">Confirm New Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                            <!-- visibility toggle -->
                                            <button class="btn btn-bg" type="button">
                                                <i class="fas fa-eye" id="eye3"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Submit button -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="changePassword" class="btn text-center btn-lg btn-primary border-primary">
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Danger Zone Card -->
                        <div class="card shadow-sm border-0">
                            <div class="p-4 fw-bold">
                                <h3 class="ps-3 border-start border-danger border-4">Danger Zone</h3>
                                <div class="my-3 border-bottom border-secondary border-2 rounded"></div>
                            </div>
                            <div class="card-body p-4">
                                <div class="alert alert-danger">
                                    <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Delete Account</h5>
                                    <p>Warning: This action cannot be undone. Once you delete your account, all of your content and data will be permanently removed.</p>
                                    
                                    <hr>
                                    
                                    <form action="controllers/profile_logic.php" method="post" class="mt-3">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                                            <label class="form-check-label" for="confirmDelete">
                                                I understand that this action is irreversible and I want to permanently delete my account.
                                            </label>
                                        </div>
                                        
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" name="deleteAccount" class="btn btn-danger">
                                                <i class="fas fa-trash-alt me-2"></i>Delete My Account
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>