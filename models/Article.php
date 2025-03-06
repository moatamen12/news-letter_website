<?php
class Article {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * Get all published articles with optional pagination
     * 
     * @param int $limit Number of articles to return
     * @param int $offset Offset for pagination
     * @param int|null $category_id Filter by category ID (optional)
     * @return array Array of article data
     */
    public function getPublishedArticles($limit = 10, $offset = 0, $category_id = null) {
        $sql = "SELECT a.*, c.name AS category_name, c.color AS category_color, 
                       c.slug AS category_slug, u.username, u.first_name, u.last_name, u.profile_image
                FROM articles a
                LEFT JOIN categories c ON a.category_id = c.category_id
                LEFT JOIN users u ON a.user_id = u.user_id
                WHERE a.status = 'published'";
                
        if ($category_id !== null) {
            $sql .= " AND a.category_id = :category_id";
        }
        
        $sql .= " ORDER BY a.published_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        if ($category_id !== null) {
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Get a single article by its slug
     * 
     * @param string $slug Article slug
     * @return array|false Article data or false if not found
     */
    public function getArticleBySlug($slug) {
        $sql = "SELECT a.*, c.name AS category_name, c.color AS category_color, 
                       c.slug AS category_slug, u.username, u.first_name, u.last_name, u.profile_image
                FROM articles a
                LEFT JOIN categories c ON a.category_id = c.category_id
                LEFT JOIN users u ON a.user_id = u.user_id
                WHERE a.slug = :slug AND a.status = 'published'";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    /**
     * Get featured articles
     * 
     * @param int $limit Number of featured articles to return
     * @return array Array of featured article data
     */
    public function getFeaturedArticles($limit = 3) {
        $sql = "SELECT a.*, c.name AS category_name, c.color AS category_color, 
                       c.slug AS category_slug, u.username, u.first_name, u.last_name, u.profile_image
                FROM articles a
                LEFT JOIN categories c ON a.category_id = c.category_id
                LEFT JOIN users u ON a.user_id = u.user_id
                WHERE a.status = 'published' AND a.is_featured = 1
                ORDER BY a.published_at DESC LIMIT :limit";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    /**
     * Count total number of published articles
     * 
     * @param int|null $category_id Filter by category ID (optional)
     * @return int Total number of articles
     */
    public function countPublishedArticles($category_id = null) {
        $sql = "SELECT COUNT(*) FROM articles WHERE status = 'published'";
        
        if ($category_id !== null) {
            $sql .= " AND category_id = :category_id";
        }
        
        $stmt = $this->pdo->prepare($sql);
        
        if ($category_id !== null) {
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    /**
     * Increment view count for an article
     * 
     * @param int $article_id Article ID
     * @return bool Success or failure
     */
    public function incrementViewCount($article_id) {
        $sql = "UPDATE articles SET views = views + 1 WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
