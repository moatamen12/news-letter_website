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
        <textarea name="bio" class="form-control" id="bio" placeholder="<?php echo htmlspecialchars($bio); ?>"></textarea>
    </div>

    <div class="col-md-6">
        <label for="FullName" class="form-label">Full Name </label>
        <input name="FullName" type="text" class="form-control" id="FullName" placeholder="<?php echo htmlspecialchars($name); ?>">
    </div>

    <div class="col-md-6">
        <label for="usernameInput" class="form-label">User Name </label>
        <input name="usernameInput" type="text" class="form-control" id="usernameInput" placeholder="<?php echo htmlspecialchars($username); ?>">
    </div>

    <div class="col-md-6">
        <label for="emaileInput" class="form-label">Email </label>
        <input name="emaileInput" type="text" class="form-control" id="emaileInput" placeholder="<?php echo htmlspecialchars($email); ?>">
    </div>

    <div class="col-md-6">
        <label for="WorkInput" class="form-label">Work </label>
        <input name="WorkInput" type="text" class="form-control" id="WorkInput" placeholder="<?php echo htmlspecialchars($work); ?>">
    </div>

    <!-- submit -->
    <div class="col-12 d-flex justify-content-end">
        <button type="submit" name="saveChanges" class="btn text-center btn-lg btn-primary border-primary">Save Change</button>
    </div>
</form>