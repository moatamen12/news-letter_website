<?php
    // Include headers
    require_once('../config/headers.php');
    
    // Only allow POST requests
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed'
        ]);
        exit;
    }

    // Include database and model
    require_once('../../config/config.php');
    require_once('../Models/Articals.php');



    // Get posted data
    $data = json_decode(file_get_contents("php://input"));

    // Check required fields
    if(!isset($data->title) || !isset($data->content) || !isset($data->author_id)) {
        http_response_code(400); // Bad Request
        echo json_encode([
            'success' => false,
            'message' => 'Missing required fields (title, content, author_id)'
        ]);
        exit;
    }

    // Instantiate article object
    $article = new Articals($db);

    // Set article properties
    $article->author_id = $data->author_id;
    $article->category_id = $data->category_id ?? 1; // Default category if not specified
    $article->title = $data->title;
    $article->content = $data->content;
    $article->summary = $data->summary ?? substr(strip_tags($data->content), 0, 200) . '...';
    $article->featured_image_url = $data->featured_image_url ?? null;
    $article->status = $data->status ?? 'draft';

    // Create article
    if($article->createArticle()) {
        // Set response code - 201 Created
        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Article created successfully',
            'id' => $article->id
        ]);
    } else {
        // Set response code - 500 Internal Server Error
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Could not create article'
        ]);
    }
?>