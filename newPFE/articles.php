<?php
    $page_title = 'Articles';
    require_once __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb Navigation > -->

<div class=" container">
    <section class="my-2 p-3">
        <div class="my-3"> <?php include_once __DIR__ . '/includes/sub_header.php'?> </div>
        
        <div class="row">
            <div class="col-md-12 px-4" id="articles-container">
                <!-- articles will be loaded here -->
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </section>

    <section >
        <div class="d-flex justify-content-center align-item-center my-3">
            <div class="text-body-secondary">
                <?php include __DIR__.'/includes/pagination.php'?>
            </div>
        </div>
    </section>
</div>

<!-- Include the article display controller -->
<script src="controllers/articles_controllers/displaing_articles.js"></script>

<?php require_once __DIR__ . '/includes/footer.php'?>