<!-- DANGER ZONE TAP CONTENT -->
<section>
    <h2 class="mb-3">Danger Zone</h2>
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
            <h3 class="ps-3 border-start border-danger border-4">Delet Account</h3>
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
</Section>