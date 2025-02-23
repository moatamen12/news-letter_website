<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Newsletter</title>
  <!-- Bootstrap 5 CSS (CDN) -->
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >

  <!-- Optional: Your own custom CSS -->
  <link rel="stylesheet" href="css/custom.css">
</head>
<body>

  <div class="container my-5">
    <div class="row">
      <!-- Left column (main article) -->
      <div class="col-md-8">
        <div class="card mb-4">
          <!-- Replace the image src with your own -->
          <img src="img/main-article.jpg" class="card-img-top" alt="Main article image">

          <div class="card-body">
            <span class="badge bg-secondary mb-2">Technology</span>
            <h2 class="card-title">
              12 worst types of business accounts you follow on Twitter
            </h2>
            <p class="card-text">
              He moorights difficulty engrossed it, sportsmen. Interested has all 
              Devonshire difficulty gay assistance joy.
            </p>
          </div>
        </div>
      </div>

      <!-- Right column (list of smaller articles) -->
      <div class="col-md-4">
        <!-- One approach is to use a "list group" or just plain cards. Here is a simple list group approach. -->
        <div class="list-group">

          <!-- Article item 1 -->
          <a href="#" class="list-group-item list-group-item-action d-flex gap-3">
            <img 
              src="img/smaller-article-1.jpg" 
              alt="Article thumbnail" 
              class="rounded" 
              style="width: 80px; height: auto;"
            >
            <div class="d-flex flex-column">
              <h5 class="mb-1">
                Ten tell-tale signs you need to get a new startup
              </h5>
              <small class="text-muted">by Samuel - Jan 12, 2022</small>
            </div>
          </a>

          <!-- Article item 2 -->
          <a href="#" class="list-group-item list-group-item-action d-flex gap-3">
            <img 
              src="img/smaller-article-2.jpg" 
              alt="Article thumbnail" 
              class="rounded" 
              style="width: 80px; height: auto;"
            >
            <div class="d-flex flex-column">
              <h5 class="mb-1">
                Best Pinterest boards for learning about business
              </h5>
              <small class="text-muted">by Dennis - Feb 14, 2022</small>
            </div>
          </a>

          <!-- Repeat for more articles -->
          <!-- ... -->

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (CDN) -->
  <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js">
  </script>
</body>
</html>
