<?php
class Category {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * Get all categories
     * 
     * @return array Array of category data
     */
    public function getAllCategories() {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Get category by ID
     * 
     * @param int $id Category ID
     * @return array|false Category data or false if not found
     */
    public function getCategoryById($id) {
        $sql = "SELECT * FROM categories WHERE category_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Get category by slug
     * 
     * @param string $slug Category slug
     * @return array|false Category data or false if not found
     */
    public function getCategoryBySlug($slug) {
        $sql = "SELECT * FROM categories WHERE slug = :slug";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    /**
     * Get article count per category
     * 
     * @return array Array with category data and article count
     */
    public function getCategoriesWithCount() {
        $sql = "SELECT c.*, COUNT(a.article_id) as article_count 
                FROM categories c
                LEFT JOIN articles a ON c.category_id = a.category_id AND a.status = 'published'
                GROUP BY c.category_id
                ORDER BY c.name ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
