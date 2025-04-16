<h2 class="fw-bold">Posts</h2>
<!-- search and filtering  -->
<section class="mb-2">    
    <nav class="navbar navbar-expand-lg w-100 ">
        <div class="d-flex flex-column p-2 rounded w-100 ">
            <!-- Top row with buttons and actions -->
            <div class="d-flex justify-content-between align-items-center w-100 mb-2">
                <!-- Filter buttons container (left side) -->
                <div class="d-flex border border-1 rounded-2 p-2">
                    <div class="nav nav-tabs" id="statusTabs" role="tablist">
                        <button class="btn btn-sm btn-outline-secondary me-2 active" type="button" data-status="published">Published</button>
                        <button class="btn btn-sm btn-outline-secondary me-2" type="button" data-status="drafts">Drafts</button>
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-status="scheduled">Scheduled</button>              
                    </div>
                </div>
                
                <!-- New Post button (right side) -->
                <a href="/newsLetter/newPFE/profile.php?action=new_post" class="btn btn-subscribe">
                    <i class="fas fa-plus me-1"></i> New Post
                </a>
            </div>
            
            <!-- Bottom row with search and filters -->
            <div class="d-flex gap-2 align-items-center w-100">
                <!-- Search form (full width) -->
                <form class="d-flex flex-grow-1" role="search">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="search" class="form-control border-start-0 ps-0" 
                            id="searchInput" name="search"
                            placeholder="Search posts..."
                            aria-label="Search posts">
                    </div>
                </form>
                
                <!-- Advanced Filters Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-arrow-down-short-wide"></i> Filters
                    </button>
                    <div class="dropdown-menu p-3" style="width: 280px;" aria-labelledby="filterDropdown">
                        <h6 class="fw-bold">Filter by Date</h6>
                        <div class="mb-3">
                            <label for="dateFrom" class="form-label small">From</label>
                            <input type="date" class="form-control form-control-sm" id="dateFrom">
                        </div>
                        <div class="mb-3">
                            <label for="dateTo" class="form-label small">To</label>
                            <input type="date" class="form-control form-control-sm" id="dateTo">
                        </div>
                        
                        <h6 class="fw-bold mt-3">Post Type</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="article" id="typeArticle" checked>
                            <label class="form-check-label" for="typeArticle">Articles</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="news" id="typeNews" checked>
                            <label class="form-check-label" for="typeNews">News</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="tutorial" id="typeTutorial" checked>
                            <label class="form-check-label" for="typeTutorial">Tutorials</label>
                        </div>
                        
                        <div class="d-flex justify-content-between border-top pt-2">
                            <button class="btn btn-sm btn-outline-secondary" id="clearFilters">Clear</button>
                            <button class="btn btn-sm btn-primary" id="applyFilters">Apply Filters</button>
                        </div>
                    </div>
                </div>
                
                <!-- Sort Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort
                    </button>
                    <div class="dropdown-menu" aria-labelledby="sortDropdown">
                        <button class="dropdown-item active" type="button" data-sort="newest">
                            Newest First
                        </button>
                        <button class="dropdown-item" type="button" data-sort="oldest">
                            Oldest First
                        </button>
                        <button class="dropdown-item" type="button" data-sort="popular">
                            Most Popular
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</section>

<section>  

    <!-- Change Password Card -->
    <div class="card shadow-sm border-0 mb-4">

        <div class="p-4 fw-bold">
            <h3 class="ps-3 border-start border-info border-4">Display The month</h3>
            <div class="my-3 border-bottom border-secondary border-1 rounded"></div>
        </div>

        <div class="card-body p-4">
            <?php include __DIR__ . '/../posts_card_view.php'; ?>
        </div>

    </div>

</section>

