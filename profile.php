<?php 
    require_once 'controllers/profile_logic.php';
    require_once 'includes/header.php';
?>


    <section class="container-fluid p-5">   
        <div class="p-5">
            <div class=" mb-5 ">
                <h1 class="fw-bold">My Account</h1>
                <footer class="text-body-secondary">Hi, <?php echo htmlspecialchars($name);?> feel free to edit your profile</footer>
            </div>
            <!-- profile -->
            <div class="card my-5 shadow-sm border-0">
                <div class="p-4 fw-bold ">
                    <h3 class="ps-3 border-start border-info  border-4">Profile</h3>
                    <div class=" my-3 border-bottom  border-secondary border-2 rounded"></div>
                </div>
                <div class="card-body p-4">
                    <form action="controllers/profile_logic.php" method="post" enctype="multipart/form-data" class="row g-3">
                        <!-- img -->
                        <div class="col-md-4">
                            <div class="d-flex align-items-start">
                                <div class="avatar-upload me-3">
                                    <div class="avatar-preview">
                                        <img id="profileImagePreview" src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Preview">
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" id="profileImageUpload" name="profileImage" accept=".png, .jpg, .jpeg">
                                        <label for="profileImageUpload"><i class="fas fa-pencil-alt"></i></label>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <button type="submit" name="deleteProfileImage" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt me-1"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- bio -->
                        <div class="col-md-8">
                            <label for="bio" class="form-label">Bio </label>
                            <textarea name="bio" type="text" class="form-control " id="bio" placeholder="<?php echo htmlspecialchars($bio);?>"  ></textarea>
                        </div>


                        <div class="col-md-6">
                            <label for="FullName" class="form-label">Full Name </label>
                            <input name="FullName" type="text" class="form-control " id="FullName" placeholder="<?php echo htmlspecialchars($name);?>"  >
                        </div>

                        <div class="col-md-6">
                            <label for="usernameInput" class="form-label">User Name </label>
                            <input name="usernameInput" type="text" class="form-control " id="usernameInput" placeholder="<?php echo htmlspecialchars($username);?>" >
                        </div>

                        <div class="col-md-6">
                            <label for="emaileInput" class="form-label">email </label>
                            <input name="emaileInput" type="text" class="form-control " id="emaileInput" placeholder="<?php echo htmlspecialchars($email);?>" >
                        </div>

                        <div class="col-md-6">
                            <label for="WorkInput" class="form-label">Work </label>
                            <input name="WorkInput" type="text" class="form-control " id="WorkInput" placeholder="<?php echo htmlspecialchars($work);?>" >
                        </div>

                        
                        <!-- submit -->
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" name="saveChanges" class="btn text-center btn-lg btn-primary border-primary ">Save Change</button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- social links -->
            <div class="card my-5 shadow-sm border-0">
                <div class="p-4 fw-bold ">
                    <h3 class="ps-3 border-start border-info  border-4">Profile</h3>
                    <div class=" my-3 border-bottom  border-secondary border-2 rounded"></div>
                </div>
                <div class="card-body p-4">
                <form action="controllers/profile_logic.php" method="post" class="row g-3">
                    <!-- Website URL -->
                    <div class="col-md-6">
                        <label for="website" class="form-label">Website</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            <input type="url" class="form-control" id="website" name="website" 
                                value="<?php echo isset($website) ? htmlspecialchars($website) : ''; ?>" 
                                placeholder="https://yourwebsite.com">
                        </div>
                    </div>

                    <!-- Facebook -->
                    <div class="col-md-6">
                        <label for="facebook" class="form-label">Facebook</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                            <input type="url" class="form-control" id="facebook" name="facebook" 
                                value="<?php echo isset($facebook) ? htmlspecialchars($facebook) : ''; ?>" 
                                placeholder="https://facebook.com/profile">
                        </div>
                    </div>

                    <!-- Twitter/X -->
                    <div class="col-md-6">
                        <label for="twitter" class="form-label">Twitter/X</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                            <input type="url" class="form-control" id="twitter" name="twitter" 
                                value="<?php echo isset($twitter) ? htmlspecialchars($twitter) : ''; ?>" 
                                placeholder="https://twitter.com/username">
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-6">
                        <label for="instagram" class="form-label">Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                            <input type="url" class="form-control" id="instagram" name="instagram" 
                                value="<?php echo isset($instagram) ? htmlspecialchars($instagram) : ''; ?>" 
                                placeholder="https://instagram.com/username">
                        </div>
                    </div>

                    <!-- LinkedIn -->
                    <div class="col-md-6">
                        <label for="linkedin" class="form-label">LinkedIn</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
                            <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                value="<?php echo isset($linkedin) ? htmlspecialchars($linkedin) : ''; ?>" 
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

            <!-- Change Password -->
            <div class="card my-5 shadow-sm border-0">
                <div class="p-4 fw-bold">
                    <h3 class="ps-3 border-start border-info border-4">Change Password</h3>
                    <div class="my-3 border-bottom border-secondary border-2 rounded"></div>
                </div>
                <div class="card-body p-4">
                    <form action="controllers/profile_logic.php" method="post" class="row g-3">
                        <!-- Current Password -->
                        <div class="col-md-6">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Empty for layout balance -->
                        </div>
                        
                        <!-- New Password -->
                        <div class="col-md-6">
                            <label for="newPassword" class="form-label">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                        </div>
                        
                        <!-- Confirm New Password -->
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
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

            <!-- Danger Zone -->
            <div class="card my-5 shadow-sm border-0">
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
    </section>






<?php 
    require_once 'includes/footer.php';
?>