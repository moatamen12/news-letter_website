<?php 
    require_once('../config/headers.php'); 
    require_once('../../config/config.php');
    require_once('../models/Articals.php');

    $article = new Articals($conn);
    //get the pagination parameters
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ; //default to page 1
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; //default to 10 articles per page
    $offset = ($page - 1) * $limit; //calculate the offset

    $result = $article->getAllArticles($limit,$offset);
    $num = $result->rowCount(); //get the number of articles
    if($num > 0){
        //aricle array
        $articles_arr = [];
        $articles_arr['data'] = [];         //array to hold the articles
        $articles_arr['pagination'] = [
            'page' => $page,
            'limit' => $limit,
            'total' => $num, 
        ]; //total number of articles
        while($row = $result ->fetch(PDO::FETCH_ASSOC)){
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

            //push to 'data'
            array_push($articles_arr['data'], $article_item);   
        }
        // Set response code - 200 OK
        http_response_code(200);
        
        // Output
        echo json_encode($articles_arr);

    }else{
        echo json_encode([
            'success' => false,
            'message' => 'No articles found'
        ]);
    }
?>