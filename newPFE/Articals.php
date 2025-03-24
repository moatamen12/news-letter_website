<?php
    $page_title = 'Articals';
    require_once __DIR__ . '/includes/header.php';
?>


<!-- Breadcrumb Navigation > -->

<div class=" container">


    <section class="my-2 p-3">
        <div class="my-3"> <?php include_once __DIR__ . '/includes/sub_header.php'?> </div>
        
        <div class="row">
            <div class="col-md-12 px-4">
            <?php 
                for ($i=0; $i < 10; $i++) { 
                    include __DIR__.'/includes/articals_card.php';
                }
            ?>
                <!-- include __DIR__.'/includes/articals_card.php'?> -->
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

<?php require_once __DIR__ . '/includes/footer.php'?>