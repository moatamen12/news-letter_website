-- Create a table for roles
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default roles (reader, contributor, admin)
INSERT INTO roles (role_name) VALUES ('reader'), ('contributor'), ('admin');

-- Create a table for request statuses
CREATE TABLE request_statuses (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default statuses (pending, approved, rejected)
INSERT INTO request_statuses (status_name) VALUES ('pending'), ('approved'), ('rejected');

-- Create the users table
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

-- Create the user_profiles table
CREATE TABLE user_profiles (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    profile_picture VARCHAR(255),
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

-- Create the role_requests table
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

-- create the permetion table 
CREATE TABLE permissions (
    permission_id INT AUTO_INCREMENT PRIMARY KEY,
    permission_name VARCHAR(50) NOT NULL UNIQUE
);

-- Create a junction table to link roles and permissions
CREATE TABLE role_permissions (
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id)
);


-- user messages(contact)
CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  subject VARCHAR(255),
  message_category ENUM('general', 'complaint', 'Suggestion') NOT NULL DEFAULT 'general',
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);