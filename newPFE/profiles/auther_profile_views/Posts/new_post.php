<?php 
    $page_tatile= "New Post";
    include_once  'C:\xampp\htdocs\newsletter\newPFE\includes\header.php'; // Include the headers for CORS and JSON response
?>


<script src="/newsLetter/newPFE/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>  <!-- tinymce include script -->

    <div class="container p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="/newsLetter/newPFE/profile.php" class="btn secondary-btns mb-3">
                <i class="fas fa-arrow-left me-1"></i> 
            </a>

            <h1 class="">New Post</h1>
        </div>


        <form id="articleForm" method="post" action="save_article.php">
            <!-- Title editor -->
            <div class="mb-4">
                <label for="article_title" class="form-label fw-bold">Article Title</label>
                <textarea id="title_editor" name="article_title" placeholder="Enter Your Title Here"></textarea>
            </div>
            
            <!-- Main content editor -->
            <div class="mb-3">
                <label for="article_content" class="form-label fw-bold">Article Content</label>
                <textarea id="content_editor" name="article_content" placeholder = "Enter Your Content Here"></textarea>
            </div>
            
            <!-- submission buttons -->
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-subscribe me-2" name="action" value="publish">Publish</button>
                <button type="submit" class="btn btn-secondary" name="action" value="draft">Save as Draft</button>
            </div>
        </form>

    </div>
<script src="/newsLetter/newPFE/assets/js/tinyMCE_config.js"></script> <!-- tinymce config script -->