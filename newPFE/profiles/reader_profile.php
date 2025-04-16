<!-- 
    Display the reader user type info 
-->
    
<div class="container my-4 p-4">
    <div class="card border-0 ">
        <div class="card-header bg-white">   
            <h3 class="fw-bold">Hi <?=$profile_info['name']?></h3>   
        </div>
        <div class="card-body">
            <form action="<?=BASE_URL?>controllers/profile_controllers/update_profile.php" method="post" id="readerForm">              
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?=$profile_info['name']?>">
                </div>

                <div class="mb-3">
                    <label for="profile_email" class="form-label">Email</label>
                    <input type="email" name="profile_email" id="profile_email" class="form-control" value="<?=$profile_info['email']?>">
                </div>

                <div class="mb-3">
                    <label for="profile_password" class="form-label">Old Password</label>
                    <input type="password" name="profile_password" id="profile_password" class="form-control" placeholder="Enter your Current Password">
                </div>

                <div class="mb-3">
                    <label for="profile_NewPassword" class="form-label">New Password</label>
                    <input type="password" name="profile_NewPassword" id="profile_NewPassword" class="form-control" placeholder="Leave empty to keep current password">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" name="updateReader" class="btn btn-subscribe fw-bold">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>