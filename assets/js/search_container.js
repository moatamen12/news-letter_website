document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchToggleBtn = document.getElementById('searchToggleBtn');
    const searchBar = document.getElementById('topSearchBar');
    const closeSearchBtn = document.getElementById('closeSearchBar');
    let searchOverlay = document.createElement('div');
    searchOverlay.className = 'search-overlay';
    document.body.appendChild(searchOverlay);

    // Toggle search bar
    searchToggleBtn.addEventListener('click', function() {
        searchBar.classList.add('show');
        searchOverlay.classList.add('show');
        searchBar.querySelector('input').focus();
    });

    // Close search bar with close button
    closeSearchBtn.addEventListener('click', function() {
        searchBar.classList.remove('show');
        searchOverlay.classList.remove('show');
    });

    // Close search bar when clicking overlay
    searchOverlay.addEventListener('click', function() {
        searchBar.classList.remove('show');
        searchOverlay.classList.remove('show');
    });

    // Close search bar with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && searchBar.classList.contains('show')) {
            searchBar.classList.remove('show');
            searchOverlay.classList.remove('show');
        }
    });
});