<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tech News Letter</title>
    <script src="https://kit.fontawesome.com/fc7e8d802d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
</head>
  <body class="d-flex flex-column min-vh-100 "> <!--to take 100% of the view port-->
    <!-- the navegation bar -->
    <nav class="navbar navbar-custom sticky-top navbar-expand-lg bg-body-tertiary shadow-sm px-2">
        <div class="container-fluid">
            <a class="navbar-brand " href="index.php">Tech Expo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarNavDarkDropdown"> -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="articlesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Articles
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="articlesDropdown">
                            <li><a class="dropdown-item" href="article1.php">Followed</a></li>
                            <li><a class="dropdown-item" href="article2.php">All Articles</a></li>
                            <!-- Add more dropdown items as needed -->
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                </ul>
                <a class="btn btn-subscribe " href="#" data-bs-toggle="modal" data-bs-target="#subscribeModal"> Subscribe</a>
            </div>
        </div>
    </nav>

