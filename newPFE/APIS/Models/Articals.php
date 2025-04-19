<?php
class Articals {
    private $conn; //the connection to the database
    private $table = 'articles'; //the tables in the database

    public $id;
    public $author_id;
    public $catiegory_id;

    public $title;
    public $content;
    public $summary;

    public $featured_image_url;
    public $explination_img; //will remove it later

    public $like_count;
    public $comment_count;
    public $view_count;

    public $status;  // draft, published, archived
    public $created_at;
    public $updated_at;

    public function __construct($db){
        $this->conn = $db;      
    }
    
    //get all the articles 'used in the articles page'
    public function getAllArticles($limit = 10,$offset = 0){
        //sql code to get the articles from the database
        $query = "SELECT 
                    a.article_id, u.username as author_name, c.name as category_name,
                    a.title, a.content, a.summary,
                    a.featured_image_url,
                    a.like_count, a.comment_count, a.view_count,
                    a.statu, a.created_at, a.updated_at
                  FROM " . $this->table . " a 
                  LEFT JOIN users u ON a.author_id = u.user_id 
                  LEFT JOIN categories c ON a.category_id = c.category_id
                  WHERE a.statu = 'published'
                  ORDER BY a.created_at DESC 
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':limit',$limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset',$offset, PDO::PARAM_INT);

        $stmt->execute();
        // $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stmt;
    }

    //get an article by id
    public function getArticleById($id){
        $query = "SELECT 
                    a.article_id, u.username as author_name, c.name as category_name,
                    a.title, a.content, a.summary,
                    a.featured_image_url,
                    a.like_count, a.comment_count, a.view_count,
                    a.statu, a.created_at, a.updated_at
                  FROM " . $this->table . " a 
                  LEFT JOIN users u ON a.author_id = u.user_id 
                  LEFT JOIN categories c ON a.category_id = c.category_id
                  WHERE a.article_id = :id AND a.statu = 'published'";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            // Populate properties
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
            $this->title = $row['title'];
            $this->content = $row['content'];
            $this->summary = $row['summary'];
            $this->featured_image_url = $row['featured_image_url'];
            $this->like_count = $row['like_count'];
            $this->comment_count = $row['comment_count'];
            $this->view_count = $row['view_count'];
            $this->status = $row['status'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            
            return true;
        }
        
        return false;
    }

    //search articles by title, content or summary
    public function searchArticlesString($searchTerm){
        $query = "SELECT 
                    a.article_id, u.username as author_name, c.name as category_name,
                    a.title, a.content, a.summary,
                    a.featured_image_url,
                    a.like_count, a.comment_count, a.view_count,
                    a.statu, a.created_at, a.updated_at
                  FROM " . $this->table . " a 
                  LEFT JOIN users u ON a.author_id = u.user_id 
                  LEFT JOIN categories c ON a.category_id = c.category_id
                  WHERE (a.title LIKE :search1 OR 
                        a.content LIKE :search2 OR 
                        a.summary LIKE :search3) 
                    AND a.statu = 'published'
                    ORDER BY a.created_at DESC";
    
        $stmt = $this->conn->prepare($query);
    
        // Add wildcards to search term
        $searchWithWildcards = '%' . $searchTerm . '%';
        
        // Bind the parameter with wildcards
        $stmt->bindParam(':search1', $searchWithWildcards, PDO::PARAM_STR);
        $stmt->bindParam(':search2', $searchWithWildcards, PDO::PARAM_STR);
        $stmt->bindParam(':search3', $searchWithWildcards, PDO::PARAM_STR);
        
        $stmt->execute();
        return $stmt;
    }

    //search articles by catagory 
    public function searchArticlesByCatagory($catiegory){
        $query = "SELECT 
                    a.article_id, u.username as author_name, c.name as category_name,
                    a.title, a.content, a.summary,
                    a.featured_image_url,
                    a.like_count, a.comment_count, a.view_count,
                    a.statu, a.created_at, a.updated_at
                  FROM " . $this->table . " a 
                  LEFT JOIN users u ON a.author_id = u.user_id 
                  LEFT JOIN categories c ON a.category_id = c.category_id
                  WHERE c.name = :catiegory AND a.statu = 'published'
                  ORDER BY a.created_at DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':catiegory', $catiegory, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;

    }

    //search articles by author
    public function searchArticlesByAuthor($author){
        $query = "SELECT 
                    a.article_id, u.username as author_name, c.name as category_name,
                    a.title, a.content, a.summary,
                    a.featured_image_url,
                    a.like_count, a.comment_count, a.view_count,
                    a.statu, a.created_at, a.updated_at
                  FROM " . $this->table . " a 
                  LEFT JOIN users u ON a.author_id = u.user_id 
                  LEFT JOIN categories c ON a.category_id = c.category_id
                  WHERE u.username LIKE :author AND a.statu = 'published'
                  ORDER BY a.created_at DESC";
    
        $stmt = $this->conn->prepare($query);
        
        // Add wildcards for partial matching
        $authorWithWildcards = '%' . $author . '%';
        
        $stmt->bindParam(':author', $authorWithWildcards, PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt;
    }

    //search articles by date
    public function searchArticlesByDate($date){
        $query = "SELECT 
                    a.article_id, u.username as author_name, c.name as category_name,
                    a.title, a.content, a.summary,
                    a.featured_image_url,
                    a.like_count, a.comment_count, a.view_count,
                    a.statu, a.created_at, a.updated_at
                  FROM " . $this->table . " a 
                  LEFT JOIN users u ON a.author_id = u.user_id 
                  LEFT JOIN categories c ON a.category_id = c.category_id
                  WHERE DATE(a.created_at) = :date AND a.statu = 'published'
                  ORDER BY a.created_at DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }   

    //geting the article counts (likes, comments, views) by article id or title
    public function ArticleCounts($term){
        $query = "  SELECT like_count, comment_count, view_count
                    FROM " . $this->table . " 
                    WHERE article_id = :term1 OR
                    title LIKE :term2 ";
        $stmt = $this->conn->prepare($query);
        $stmt ->bindparam(':term1', $term, PDO::PARAM_INT);
        $stmt -> bindparam(':term2', $term, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt;
    }   

    // Create a new article
    public function createArticle() {
        $query = "INSERT INTO " . $this->table . " 
                    (author_id, category_id, title, content, summary, 
                     featured_image_url, status, created_at) 
                  VALUES 
                    (:author_id, :category_id, :title, :content, :summary, 
                     :featured_image_url, :status, NOW())";

        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->summary = htmlspecialchars(strip_tags($this->summary));
        $this->featured_image_url = htmlspecialchars(strip_tags($this->featured_image_url));
        $this->status = htmlspecialchars(strip_tags($this->status));
        
        // Bind data
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':summary', $this->summary);
        $stmt->bindParam(':featured_image_url', $this->featured_image_url);
        $stmt->bindParam(':status', $this->status);
        
        // Execute query
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        
        return false;
    }

    // Update existing article
    public function updateArticle() {
        $query = "UPDATE " . $this->table . "
                  SET 
                    title = :title,
                    content = :content,
                    summary = :summary,
                    category_id = :category_id,
                    featured_image_url = :featured_image_url,
                    status = :status,
                    updated_at = NOW()
                  WHERE 
                    id = :id AND author_id = :author_id";
                    
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->summary = htmlspecialchars(strip_tags($this->summary));
        $this->featured_image_url = htmlspecialchars(strip_tags($this->featured_image_url));
        $this->status = htmlspecialchars(strip_tags($this->status));
        
        // Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':summary', $this->summary);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':featured_image_url', $this->featured_image_url);
        $stmt->bindParam(':status', $this->status);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    // Delete article
    public function deleteArticle() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id AND author_id = :author_id";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author_id', $this->author_id);
        
        // Execute query
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>