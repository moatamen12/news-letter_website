<?php 
    include __DIR__ . '/auther_profile_views/sub_header.php'; 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<div class="container-fluid">    
    <div class="p-4 pb-0">
        <!-- error message display -->
        <div class="container mb-0">
            <?php include __DIR__ .'/../includes/messages.php'; ?>
        </div>
        
        <!-- Tab Content -->
        <div class="tab-content p-4" id="profileTabContent">
            <!-- home tap -->
            <div class="tab-pane fade" id="profile-content" role="tabpanel" aria-labelledby="profile-tab">
                <?php include __DIR__ . "/auther_profile_views/home/home.php"; ?>
            </div> 

            <!-- Posts -->
            <div class="tab-pane fade show active" id="posts-content" role="tabpanel" aria-labelledby="posts-tab">
                <?php 

                    include __DIR__ . "/auther_profile_views/posts/posts.php";



                ?>
            </div>
                
            <!-- New Post Content -->
            <div class="tab-pane fade" id="newPost-content" role="tabpanel" aria-labelledby="newPost-tab">
                
            </div>


            <div class="tab-pane fade" id="newPost-content" role="tabpanel" aria-labelledby="newPost-tab">
                
            </div>

            <!-- DASHBOARD CONTENT -->
            <div class="tab-pane fade" id="password-content" role="tabpanel" aria-labelledby="password-tab">
                <h1 class="mb-3">Dashboard</h1>
            </div>

            <!-- DANGER ZONE TAP CONTENT -->
            <div class="tab-pane fade" id="danger-content" role="tabpanel" aria-labelledby="danger-tab">
                <?php include __DIR__ . "/auther_profile_views/DangerZone/danger_zone.php" ?>
            </div>

        </div>   
    </div>
</div>
