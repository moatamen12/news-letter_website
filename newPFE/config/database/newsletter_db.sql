-- creating a table for roles
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default roles (reader, contributor, admin)
INSERT INTO roles (role_name) VALUES ('reader'), ('author'), ('admin');

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
    profile_photo VARCHAR(255) DEFAULT NULL,
    bio TEXT,
    work VARCHAR(100),
    website VARCHAR(255),
    facebook VARCHAR(255),
    twitter VARCHAR(255),
    instagram VARCHAR(255),
    linkedin VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE (user_id), --inforse one to one relationship (one user has one profile)
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
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
    statu ENUM('draft', 'published') NOT NULL DEFAULT 'draft',  
    featured_image VARCHAR(255) DEFAULT NULL, -- uploading an optionale image for the article
    explination_img VARCHAR(255) DEFAULT NULL, -- uploading an optionale image for the article explination
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE     
);
-- creating the comments table
CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- to track the articals that the user have saved 
CREATE TABLE user_saved_articles (
    user_id INT NOT NULL,
    article_id INT NOT NULL,
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, article_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE
);
