<?php
    // Include headers
    require_once('../config/headers.php');
    
    // Only allow DELETE requests
    if($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
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

    // Set ID and author
    $article->id = $data->id;
    $article->author_id = $data->author_id;

    // Delete article
    if($article->deleteArticle()) {
        // Set response code - 200 OK
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Article deleted successfully'
        ]);
    } else {
        // Set response code - 404 Not found or 403 Forbidden
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Article not found or you do not have permission to delete it'
        ]);
    }
?>