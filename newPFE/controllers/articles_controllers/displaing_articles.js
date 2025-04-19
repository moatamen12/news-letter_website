document.addEventListener('DOMContentLoaded',function(){
    //init the article system
    initArticleSystem();
});

function initArticleSystem(){
    const articlesContainer =document.getElementById('articles-container');

    if (!articlesContainer){
        console.error('Articles container not found!');
        return;
    }

    //Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 1;
    const category = urlParams.get('category') || '';
    const author = urlParams.get('author') || '';
    const searchTerm = urlParams.get('q')|| '';
    const limit = 10;
    
    loadArticles(page, limit, category, author, searchTerm);

    const paginationElement = document.querySelector('.pagination');
    if (paginationElement){
        setupPagination();
    }
}

/**
 * Load articles from API
 * @param {number} page - Current page number
 * @param {number} limit - Number of articles per page
 * @param {string} category - Category filter (optional)
 * @param {string} author - Author filter (optional)
 * @param {string} searchTerm - Search term (optional)
*/
function loadArticles(page,limit,category,author,searchTerm)
{
    //show the loadig spinner
    const articlesContainer = document.getElementById('articles-container');
    articlesContainer.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    //Build API URL based on filters
    let apiUrl = `APIS/articalls/list.php?page=${page}&limit=${limit}`

    if (category && category !== 'all') {
        apiUrl = `APIS/articalls/search.php?category=${category}&type=category`;
    } else if (author) {
        apiUrl = `APIS/articalls/search.php?author=${author}&type=author`;
    } else if (searchTerm) {
        apiUrl = `APIS/articalls/search.php?q=${searchTerm}`;
    }

    fetch(apiUrl)
        .then(response => {
            if (!response.ok){
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();

        })
        .then(data => {
            displayArticles(data);
            updatePagination(data.pagination || { page: page, limit: limit, total: data.data.length });
        })
        .catch(error => {
            console.error('Error fetching articles:', error);
            articlesContainer.innerHTML = 
                '<div class="alert alert-danger">Error loading articles. Please try again later.</div>';
        });
}


/**
 * Display articles in the container
 * @param {Object} data - API response data
*/  
function displayArticles(data) {
    const articlesContainer = document.getElementById('articles-container');
    
    if (!data.data || data.data.length === 0) {
        articlesContainer.innerHTML = '<div class="alert alert-info my-3">No articles found</div>';
        return;
    }
    
    // Display articles
    let articlesHtml = '';
    
    data.data.forEach(article => {
        // Calculate read time
        const wordCount = article.summary ? article.summary.split(' ').length : 0;
        const readMinutes = Math.max(1, Math.ceil(wordCount / 50)); // Rough estimate
        
        // Format date
        const date = new Date(article.created_at);
        const formattedDate = date.toLocaleDateString('en-US', { 
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
        
        articlesHtml += `
            <div class="rounded-0 border-0 border-bottom border-dark-subtle my-1">
                <div class="articall-card-hover">
                    <div class="card border-0 rounded-5 p-4 my-5">
                        <div class="row g-3">
                            <div class="col-lg-5">
                                <!-- Categories -->
                                <a href="?category=${encodeURIComponent(article.category)}" class="badge bg-danger mb-2">
                                    <i class="fas fa-circle me-2 small fw-bold"></i>${article.category}
                                </a>
                                
                                <!-- Title -->
                                <h2 class="card-title">
                                    <a href="article.php?id=${article.article_id}" class="btn-link text-reset stretched-link">
                                        ${article.title}
                                    </a>
                                </h2>
                                
                                <!-- Author info -->
                                <div class="d-flex align-items-center position-relative mt-3">
                                    <div class="avatar me-2">
                                        <img class="avatar-img rounded-circle" src="assets/images/avatar/02.jpg" alt="avatar">
                                    </div>
                                    <div>
                                        <h5 class="mb-0">
                                            <a href="?author=${encodeURIComponent(article.author)}" class="text-reset btn-link">
                                                ${article.author}
                                            </a>
                                        </h5>
                                        <ul class="nav align-items-center small text-decoration-none">
                                            <li class="nav-item me-3">${formattedDate}</li>
                                            <li class="nav-item"><i class="far fa-clock me-1"></i>${readMinutes} min read</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Detail -->
                            <div class="col-md-6 col-lg-4">
                                <p>${article.summary}</p>
                            </div>
                            
                            <!-- Image -->
                            <div class="col-md-6 col-lg-3">
                                <div style="height: 100%; min-height: 250px; min-width: 250px; overflow: hidden;">
                                    <img class="rounded-3 w-100 h-100 object-fit-cover" 
                                         src="${article.image}" 
                                         alt="${article.title}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    
    articlesContainer.innerHTML = articlesHtml;
}
    
/**
 * Update pagination based on API data
 * @param {Object} pagination - Pagination information from API
 */
function updatePagination(pagination) {
    const paginationContainer = document.querySelector('.pagination');
    if (!paginationContainer) return;
    
    const totalPages = Math.ceil(pagination.total / pagination.limit);
    const currentPage = parseInt(pagination.page);
    
    // Get current query parameters
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('page'); // Remove page so we can replace it
    const queryString = urlParams.toString() ? `${urlParams.toString()}&` : '';
    
    // Build pagination links
    let paginationHtml = '';
    
    // Previous button
    paginationHtml += `
        <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
            <a class="page-link" href="?${queryString}page=${currentPage - 1}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    `;
    
    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        paginationHtml += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="?${queryString}page=${i}">${i}</a>
            </li>
        `;
    }
    
    // Next button
    paginationHtml += `
        <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
            <a class="page-link" href="?${queryString}page=${currentPage + 1}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    `;
    
    paginationContainer.innerHTML = paginationHtml;
}

function setupPagination() {
    // This could be extended to handle pagination link clicks via JavaScript
    // for a smoother SPA-like experience without full page reloads
    console.log('Pagination setup complete');
}