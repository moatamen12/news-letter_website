<?php 
    require_once('../config/headers.php');
    require_once('../../config/config.php');
    require_once('../Models/Articles.php');

    $article = new Articles($conn);

    // Get ID from URL
    $article->id = isset($_GET['id']) ? $_GET['id'] : die(json_encode([
        'success' => false,
        'message' => 'Missing article ID'
    ]));

    // Remove debug output that breaks the response

    if($article->getSingleArticle()){
        $article_arr = [
            'article_id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'summary' => $article->summary,
            'author_id' => $article->author_id,
            'category_id' => $article->category_id,
            'featured_image_url' => $article->featured_image_url,
            'like_count' => $article->like_count,
            'comment_count' => $article->comment_count,
            'view_count' => $article->view_count,
            'statu' => $article->status,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at
        ];

        // Set response code - 200 OK
        http_response_code(200);

        // Output
        echo json_encode($article_arr);
    }
    else{
        // No article found
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Article not found'
        ]);
    }
?>