<?php 
    require_once('../config/headers.php');
    require_once('../../config/config.php');
    require_once('../Models/Articles.php'); // Fix typo: Moddels → Models


    $article = new Articles($conn);

    // Get search parameters
    $searchTerm = isset($_GET['q']) ? $_GET['q'] : '';  // General search term
    $category = isset($_GET['category']) ? $_GET['category'] : ''; // Category name
    $author = isset($_GET['author']) ? $_GET['author'] : ''; // Author name
    $date = isset($_GET['date']) ? $_GET['date'] : ''; // Publication date (YYYY-MM-DD)
    $type = isset($_GET['type']) ? $_GET['type'] : 'general'; // Search type (general, category, author, date)
    
    // Check if we have at least one search parameter
    if(empty($searchTerm) && empty($category) && empty($author) && empty($date)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'At least one search parameter is required'
        ]);
        exit;
    }

    // Determine which search to perform
    $result = null;
    $searchDescription = '';
    
    if(!empty($category) || $type === 'category') {
        // Search by category
        if(empty($category) && !empty($searchTerm)) {
            $category = $searchTerm; // Use general search term if category not specified
        }
        $result = $article->searchArticlesByCatagory($category);
        $searchDescription = "Category: $category";
    } 
    else if(!empty($author) || $type === 'author') {
        // Search by author
        if(empty($author) && !empty($searchTerm)) {
            $author = $searchTerm; // Use general search term if author not specified
        }
        $result = $article->searchArticlesByAuthor($author);
        $searchDescription = "Author: $author";
    }
    else if(!empty($date) || $type === 'date') {
        // Search by date
        if(empty($date) && !empty($searchTerm)) {
            $date = $searchTerm; // Use general search term if date not specified
        }
        
        // Validate date format (YYYY-MM-DD)
        if(preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            $result = $article->searchArticlesByDate($date);
            $searchDescription = "Date: $date";
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Invalid date format. Please use YYYY-MM-DD'
            ]);
            exit;
        }
    }
    else {
        // General search (by title or content)
        $result = $article->searchArticlesString($searchTerm); 
        $searchDescription = "Term: $searchTerm";
    }

    // Get row count
    $num = $result->rowCount();

    // Check if any articles found
    if($num > 0) {
        // Articles array
        $articles_arr = [];
        $articles_arr['data'] = [];
        $articles_arr['search'] = [
            'type' => $type,
            'description' => $searchDescription,
            'total_results' => $num
        ];

        // Fetch articles
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            
            $article_item = [
                'article_id' => $article_id,
                'title' => $title,
                'summary' => $summary,
                'author' => $author_name,
                'category' => $category_name,
                'image' => $featured_image_url,
                'likes' => $like_count,
                'comments' => $comment_count,
                'views' => $view_count,
                'created_at' => $created_at
            ];
            
            // Push to "data" array
            array_push($articles_arr['data'], $article_item);
        }
        
        // Set response code - 200 OK
        http_response_code(200);
        
        // Output as JSON
        echo json_encode($articles_arr);
    } else {
        // No articles found
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'No articles found matching your search',
            'search' => [
                'type' => $type,
                'description' => $searchDescription
            ]
        ]);
    }
?>