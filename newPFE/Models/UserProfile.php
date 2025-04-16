<?php 
    class UserProfile{
        private $db;
        private $id;

        public function __construct($database){
            $this->db = $database;
        }

        // get the user role
        public function getUserRole($userId){
            $query = "SELECT role_id FROM users WHERE user_id = :user_id";
            $stmt = $this -> db -> prepare($query);
            $stmt -> bindParam(':user_id', $userId);
            $stmt -> execute();
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);
            return $result;
        }


        // gitting the information of the user if the user is a reader
        public function getReaderInfo($userId){
            try{
                $query ="SELECT roles.role_name ,users.* FROM users 
                JOIN roles ON users.role_id = roles.role_id 
                WHERE users.user_id = :user_id";
                $stmt = $this -> db -> prepare($query);
                $stmt -> bindParam(':user_id', $userId);
                $stmt -> execute();
                $result = $stmt -> fetch(PDO::FETCH_ASSOC);
                return $result = [
                    "name" => (isset($result['name']) && !empty($result['name'])) ? $result['name'] : 'User@name',
                    "username" => (isset($result['username']) && !empty($result['username'])) ? $result['username'] : 'User@username',
                    "email" => (isset($result['email']) && !empty($result['email'])) ? $result['email'] : 'User@email',
                    "profile_img" => (isset($result['profile_photo']) && !empty($result['profile_photo'])) ? $result['profile_photo'] : BASE_URL . "assets/images/default-use.jpg",
                    "role" => (isset($result['role_name']) && !empty($result['role_name'])) ? $result['role_name'] : 'User@role',
                ];

            }catch(PDOException $e){
                error_log('Role fetch error: ' . $e->getMessage());
            }
        }


        // geting the information of the user if the user is an auther
        public function getAutherInfo($userId){
            $userimg = BASE_URL . "assets/images/default-use.jpg"; //default user image
            try{
                // get the user profile info
                $stmt = $this -> db -> prepare('SELECT users.*, user_profiles.*, roles.role_name 
                                                FROM users 
                                                JOIN user_profiles ON users.user_id = user_profiles.user_id 
                                                JOIN roles ON users.role_id = roles.role_id
                                                WHERE users.user_id = :user_id');
                $stmt -> bindParam(':user_id', $userId);
                $stmt -> execute();
                $profile = $stmt->fetch(PDO::FETCH_ASSOC);
                // return $role = $profile['role_name'];
        
                
                if ($profile) {
                    // set them in a opject
                    return  $profile = [
                            "profile_img" => (isset($profile['profile_photo']) && !empty($profile['profile_photo'])) ? $profile['profile_photo'] : $userimg,
                            "email" => (isset($profile['email']) && !empty($profile['email'])) ? $profile['email'] : 'User@email',
                            "name" => (isset($profile['name']) && !empty($profile['name'])) ? $profile['name'] : 'User@name',
                            "username" => (isset($profile['username']) && !empty($profile['username'])) ? $profile['username'] : 'User@username',
                            "bio" => (isset($profile['bio']) && !empty($profile['bio'])) ? $profile['bio'] : 'Make your bio',
                            "work" => (isset($profile['work']) && !empty($profile['work'])) ? $profile['work'] : 'Add your work',
                            "role" =>(isset($profile['role_name']) && !empty($profile['role_name'])) ? $profile['role_name'] : 'User@role', 
                            "website" => (isset($profile['website']) && !empty($profile['website'])) ? $profile['website'] : 'https://yourwebsite.com',
                            "facebook" => (isset($profile['facebook']) && !empty($profile['facebook'])) ? $profile['facebook'] : 'https://facebook.com/profile',
                            "twitter" => (isset($profile['twitter']) && !empty($profile['twitter'])) ? $profile['twitter'] : 'https://twitter.com/profile',
                            "instagram" => (isset($profile['instagram']) && !empty($profile['instagram'])) ? $profile['instagram'] : 'https://instagram.com/profile',
                            "linkedin" => (isset($profile['linkedin']) && !empty($profile['linkedin'])) ? $profile['linkedin'] : 'https://linkedin.com/profile',
                    ];
        
                } else {
                    // If no profile found, set defaults
                    $_SESSION['errors'] = ["User profile not found"];
                    return $profile_info = [
                        "name" => "User Name",
                        "username" => "username",
                        "email" => "No email provided",
                        "profile_img" => $userimg,
                        "bio" => "",
                        "work" => "",
                        "website" => 'https://yourwebsite.com',
                        "facebook" => 'https://facebook.com/profile',
                        "twitter" => 'https://twitter.com/profile',
                        "instagram" => 'https://instagram.com/profile',
                    ];
                    
                }  
            }catch(PDOException $e){
                error_log('Profile fetch error: ' . $e->getMessage());
            }
        }

        public function getActivity($userId){
            
        }
    }
?>