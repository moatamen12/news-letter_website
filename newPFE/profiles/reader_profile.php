
<div class="container my-4 p-4">
    <div class="card">
        <div class="card-header">   
            <h3 class="fw-bold">Hi <?=$profile_info['name']?></h3>   
        </div>
        <div class="card-body">
            <form action="" method="post" id="readerForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?=$profile_info['name']?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?=$profile_info['username']?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?=$profile_info['email']?>">
                </div>
                <div class="mb-3">
                    <label for="work" class="form-label">password</label>
                    <input type="password" name="work" id="work" class="form-control" value="<?=$profile_info['password']?> ">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="updateReader">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>