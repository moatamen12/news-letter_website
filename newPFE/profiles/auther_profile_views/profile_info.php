<!-- Profile Tab -->                     
<h1 class="mb-3">Profile</h1> 
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