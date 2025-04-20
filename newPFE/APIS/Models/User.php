<?php
class User {
    // Database connection
    private $conn;
    private $table = 'users';
    
    // User properties
    public $user_id ;
    public $name;
    public $username;
    public $email;
    public $password_hash;
    public $role;           //admin, reader, writer 
    public $created_at;
    public $profile_photo;
    
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Create new user
    public function create() {
        // Sanitize inputs
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        
        // SQL query
        $query = "INSERT INTO " . $this->table . " 
                  (name, email, username, password_hash, role, created_at) 
                  VALUES (:name, :email, :username, :password_hash, :role, NOW())";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Execute with parameters
        $result = $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'password_hash' => $this->password_hash,
            'role' => $this->role ?? 'reader'
        ]);
        
        if($result) {
            $this->user_id  = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    // Read single user
    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id  = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id );
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->username = $row['username'];
            $this->role = $row['role'];
            $this->created_at = $row['created_at'];
            $this->profile_photo = $row['profile_photo'] ?? null;
            return true;
        }
        return false;
    }
    
    // Get all users
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    // Update user
    public function update() {
        $query = "UPDATE " . $this->table . "
                  SET name = :name, 
                      email = :email,
                      username = :username,
                      role = :role,
                      profile_photo = :profile_photo
                  WHERE user_id  = :id";
                  
        $stmt = $this->conn->prepare($query);
        
        // Sanitize inputs
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->user_id  = htmlspecialchars(strip_tags($this->user_id ));
        
        // Execute
        return $stmt->execute([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'role' => $this->role,
            'profile_photo' => $this->profile_photo,
            'id' => $this->user_id 
        ]);
    }
    
    // Delete user
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE user_id  = :id";
        $stmt = $this->conn->prepare($query);
        
        // Sanitize ID
        $this->user_id  = htmlspecialchars(strip_tags($this->user_id ));
        
        // Execute
        $stmt->bindParam(':id', $this->user_id );
        return $stmt->execute();
    }
    
    // Login/Authenticate via Email
    public function login() {
        try {
            // Make sure $this->conn is a valid PDO connection
            if (!$this->conn || !($this->conn instanceof PDO)) {
                throw new Exception("Database connection not available");
            }
            
            // Use named parameters instead of directly inserting values
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            
            // Execute query
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    
    // Check if email exists
    public function emailExists() {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $this->email]);
        return $stmt->fetchColumn() > 0;
    }
    
    // Check if username exists
    public function usernameExists() {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username' => $this->username]);
        return $stmt->fetchColumn() > 0;
    }


    // get the user role
    public function getUserRole($userId){
        $query = "SELECT role FROM users WHERE user_id = :user_id";
        $stmt = $this ->conn -> prepare($query);
        $stmt -> bindParam(':user_id', $userId);
        $stmt -> execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>