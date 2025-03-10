-- creating a table for roles
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default roles (reader, contributor, admin)
INSERT INTO roles (role_name) VALUES ('reader'), ('contributor'), ('admin');

-- creating a table for request statuses
CREATE TABLE request_statuses (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default statuses (pending, approved, rejected)
INSERT INTO request_statuses (status_name) VALUES ('pending'), ('approved'), ('rejected');

-- creating the users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,  
    username VARCHAR(50) UNIQUE,
    role_id INT NOT NULL DEFAULT 1,  -- defaults to 'reader'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- creating the user_profiles table
CREATE TABLE user_profiles (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    profile_photo VARCHAR(255) DEFAULT '../assets/images/userImage.jpg',
    bio TEXT,
    position VARCHAR(100),
    company VARCHAR(100),
    website VARCHAR(255),
    facebook VARCHAR(255),
    twitter VARCHAR(255),
    instagram VARCHAR(255),
    linkedin VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (user_id), --inforse one to one relationship (one user has one profile)
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- creating the role_requests table
CREATE TABLE role_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    requested_role_id INT NOT NULL,  -- references the role the user is requesting 
    request_reason TEXT,
    status_id INT NOT NULL DEFAULT 1,  -- defaults to 'pending'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (requested_role_id) REFERENCES roles(role_id),
    FOREIGN KEY (status_id) REFERENCES request_statuses(status_id)
);

-- following table
CREATE TABLE user_follows (
    follower_id INT NOT NULL, -- the user who follows.
    followed_id INT NOT NULL, -- user being followed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (follower_id, followed_id),
    FOREIGN KEY (follower_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (followed_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- creating the permetion table 
CREATE TABLE permissions (
    permission_id INT AUTO_INCREMENT PRIMARY KEY,
    permission_name VARCHAR(50) NOT NULL UNIQUE
);

-- creating a junction table to link roles and permissions
CREATE TABLE role_permissions (
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id)
);


-- user messages(contact)
CREATE TABLE contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  subject VARCHAR(255),
  message_category ENUM('general', 'complaint', 'Suggestion','Technical Support') NOT NULL DEFAULT 'general',
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- creating the articles table
CREATE TABLE articles ( 
    article_id INT AUTO_INCREMENT PRIMARY KEY, 
    user_id INT NOT NULL, 
    title VARCHAR(255) NOT NULL, 
    content TEXT NOT NULL, 
    summary TEXT NOT NULL, --for the article preview
    statu ENUM('draft', 'published') NOT NULL DEFAULT 'draft', --testing  
    featured_image VARCHAR(255) DEFAULT NULL, -- uploading an uptionale image for the article
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE     
);
-- creating the article_categories table
CREATE TABLE comments ( 
    comment_id INT AUTO_INCREMENT PRIMARY KEY, 
    article_id INT NOT NULL, 
    user_id INT NOT NULL,                   --the commint author
    parent_comment_id INT DEFAULT NULL,     --the comment that this comment is replying to
    comment_content TEXT NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE, 
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE, 
    FOREIGN KEY (parent_comment_id) REFERENCES comments(comment_id) ON DELETE CASCADE 
    
);

-- Categories table 
CREATE TABLE categories ( 
    category_id INT AUTO_INCREMENT PRIMARY KEY, 
    category_name VARCHAR(100) NOT NULL UNIQUE 
);

CREATE TABLE article_categories ( 
    article_id INT NOT NULL, 
    category_id INT NOT NULL, 
    PRIMARY KEY (article_id, category_id), 
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE, 
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE 
);