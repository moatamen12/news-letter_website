<!-- the view of the view daily and subscripers -->
<h2 class="fw-bold">Home</h2>
<section class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">All subscribers</h5>
                <p class="card-text"> 1 </p> <!-- MAkE THE FUNCTIONALITY OF COUNTING THE SUBSCRIBERS -->
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title"> Likes and Comments </h5>
                <p class="card-text">                 <!-- MAkE THE FUNCTIONALITY OF COUNTING THE LIKWS and comments-->
                    1<i class="fa-solid fa-heart"></i>
                    2<i class="fa-solid fa-comment"></i>
                </p> 
            </div>
        </div>
    </div>  
</section>

<!-- stats            //MAKE THE STATES OF THES -->
<section class="my-5"> 
    <h4 class="mb-2">Latest Posts</h4>
    <?php include __DIR__ . '/latest_post.php' ?>
</section>

<!-- latest post section to desplay the post the user habe made from the last one to the first-->
<section class="my-5">
    <h4 class="mb-2">Latest Comments</h4>
    <?php include __DIR__ . '/latest_post.php' ?>
</section>

