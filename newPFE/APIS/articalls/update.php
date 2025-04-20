<?php
    // Include headers
    require_once('../config/headers.php');
    
    // Only allow PUT requests
    if($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        http_response_code(405); // Method Not Allowed
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed'
        ]);
        exit;
    }

    // Include database and model
    require_once('../../config/config.php');
    require_once('../Models/Articles.php');



    // Get posted data
    $data = json_decode(file_get_contents("php://input"));

    // Check required fields
    if(!isset($data->id) || !isset($data->author_id)) {
        http_response_code(400); // Bad Request
        echo json_encode([
            'success' => false,
            'message' => 'Missing required fields (id, author_id)'
        ]);
        exit;
    }

    // Instantiate article object
    $article = new Articles($db);

    // Set ID 
    $article->id = $data->id;
    $article->author_id = $data->author_id;

    // Check if article exists and belongs to this author
    if(!$article->getSingleArticle()) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Article not found or you do not have permission to edit it'
        ]);
        exit;
    }

    // Update article properties (only the provided ones)
    if(isset($data->title)) $article->title = $data->title;
    if(isset($data->content)) $article->content = $data->content;
    if(isset($data->summary)) $article->summary = $data->summary;
    if(isset($data->category_id)) $article->category_id = $data->category_id;
    if(isset($data->featured_image_url)) $article->featured_image_url = $data->featured_image_url;
    if(isset($data->status)) $article->status = $data->status;

    // Update article
    if($article->updateArticle()) {
        // Set response code - 200 OK
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Article updated successfully'
        ]);
    } else {
        // Set response code - 500 Internal Server Error
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Could not update article'
        ]);
    }
?>