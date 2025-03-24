<section class="container py-2">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Left side filter buttons -->
        <div class="d-flex gap-2">
            <!-- Sort dropdown button -->
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-1"></i> Sort by
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?sort=latest">Latest</a></li>
                    <!-- <li><a class="dropdown-item" href="?sort=popular">Most Popular</a></li> -->
                    <li><a class="dropdown-item" href="?sort=trending">Trending</a></li>
                </ul>
            </div>
            
            <!-- Category/filter dropdown button -->
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?category=tech">Technology</a></li>
                    <li><a class="dropdown-item" href="?category=ai">AI & Machine Learning</a></li>
                    <li><a class="dropdown-item" href="?category=web">Web Development</a></li>
                    <li><a class="dropdown-item" href="?category=data">Data Science</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="?category=all">All Categories</a></li>
                </ul>
            </div>
        </div>
        

        <div>
            <button class="btn btn-sm " type="button" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    
    <!-- Collapsible search form -->
    <div class="collapse mt-2" id="collapseSearch">
        <form action="search.php" method="GET">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search articles by auther or title..." name="q">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
    </div>
</section>