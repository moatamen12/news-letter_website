-- -- creating a table for roles
-- CREATE TABLE roles (
--     role_id INT AUTO_INCREMENT PRIMARY KEY,
--     role_name VARCHAR(50) NOT NULL UNIQUE
-- );

-- -- Insert default roles (reader, contributor, admin)
-- INSERT INTO roles (role_name) VALUES ('reader'), ('author'), ('admin');

-- creating a table for request statuses     
CREATE TABLE request_statuses (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE
);

-- Insert default statuses (pending, approved, rejected)
INSERT INTO request_statuses (status_name) VALUES ('pending'), ('approved'), ('rejected');


CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    username VARCHAR(50) UNIQUE,
    role ENUM('reader', 'author', 'admin') NOT NULL DEFAULT 'reader',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
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
    UNIQUE (user_id), 
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
    author_id INT NOT NULL,     -- the author of the article
    category_id INT NOT NULL, -- FK to categories table
    title VARCHAR(255) NOT NULL,
    -- The content field stores the main body of the article.
    -- To include images "as the user put them", the application should:
    -- 1. Allow users to upload images (e.g., via a rich text editor).
    -- 2. Store these uploaded images on the server or a cloud storage service.
    -- 3. Insert HTML <img> tags into the 'content' field, pointing to the stored image URLs.
    -- Example within content: "<p>Some text...</p><img src='/uploads/images/article1_image1.jpg' alt='Description'><p>More text...</p>"
    content LONGTEXT NOT NULL, -- Max size: 4,294,967,295 characters. Can store HTML including <img> tags.
    summary TEXT NOT NULL,     -- Max size: 65,535 characters
    featured_image_url VARCHAR(255) DEFAULT NULL, -- Path/URL to the main representative image for the article.
    like_count INT DEFAULT 0,   -- to count the number of likes for the article
    comment_count INT DEFAULT 0, -- to count the number of comments for the article
    view_count INT DEFAULT 0,   -- to count the number of views for the article
    statu ENUM('draft', 'published','archived') NOT NULL DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) -- Add if you create a categories table
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


-- creating the categories table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT, -- Optional: A brief description of the category
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);







--------------- DOMY DATA -----------------
-- Insert test users
-- Note: Replace 'hashed_password_X' with actual securely hashed passwords in a real application.
INSERT INTO users (name, email, password_hash, username, role) VALUES
('Alice Reader', 'alice@example.com', 'hashed_password_1', 'alicer', 'reader'),
('Bob Author', 'bob@example.com', 'hashed_password_2', 'boba', 'author'),
('Charlie Admin', 'charlie@example.com', 'hashed_password_3', 'charliea', 'admin');


-- Insert sample articles (assuming user_id 1 and 2 exist and have 'author' role, and category_ids 1, 4, 5 exist)
INSERT INTO articles (author_id, category_id, title, content, summary, featured_image_url, statu, view_count, like_count) VALUES
(1, 1, 'The Future of AI in Software Development', '<p>Artificial intelligence is rapidly changing the landscape of software development.</p><p>From automated testing to code generation, AI tools are becoming indispensable.</p><img src="/images/ai_dev.jpg" alt="AI in Development"><p>This article explores the latest trends and future possibilities.</p>', 'A look into how AI is revolutionizing software development practices and what to expect in the coming years.', '/images/featured_ai_dev.jpg', 'published', 150, 25),
(2, 4, 'Understanding Blockchain Technology Beyond Cryptocurrency', '<p>Blockchain technology is often associated with Bitcoin, but its applications are far broader.</p><p>This article delves into the core concepts of blockchain and explores its potential in various industries like supply chain management, voting systems, and digital identity verification.</p>', 'An explanation of blockchain fundamentals and its diverse applications beyond the world of cryptocurrencies.', '/images/featured_blockchain.jpg', 'published', 210, 35),
(1, 5, 'Top 10 Travel Destinations for Adventure Seekers', '<p>Looking for your next thrill?</p><p>From hiking the Inca Trail to diving in the Great Barrier Reef, this list covers the most exciting destinations for adventure lovers.</p><img src="/images/adventure_travel.jpg" alt="Adventure Travel"><p>Get ready to plan your next unforgettable trip!</p>', 'A curated list of the best global destinations for those seeking adventure and adrenaline-pumping experiences.', '/images/featured_adventure.jpg', 'published', 300, 50),
(2, 1, 'Getting Started with Quantum Computing', '<p>Quantum computing promises to solve problems currently intractable for classical computers.</p><p>This introductory article explains the basic principles of qubits, superposition, and entanglement, providing a starting point for understanding this complex field.</p>', 'A beginner-friendly introduction to the fundamental concepts of quantum computing and its potential impact.', '/images/featured_quantum.jpg', 'published', 120, 15),
(1, 3, 'Mindfulness Techniques for a Less Stressful Life', '<p>In today\'s fast-paced world, stress is a common challenge.</p><p>Mindfulness practices, such as meditation and deep breathing, can significantly improve mental well-being. Learn simple techniques you can incorporate into your daily routine.</p>', 'Practical mindfulness exercises to help reduce stress, improve focus, and enhance overall mental health.', '/images/featured_mindfulness.jpg', 'draft', 50, 5);

-- Insert some sample categories
INSERT INTO categories (name, description) VALUES
('Technology', 'Articles about the latest tech trends, gadgets, and software.'),
('Science', 'Discoveries and advancements in various scientific fields.'),
('Health & Wellness', 'Tips and information on living a healthy lifestyle.'),
('Business & Finance', 'Insights into the world of business, finance, and economics.'),
('Travel', 'Guides, tips, and stories about exploring the world.'),
('Food & Drink', 'Recipes, restaurant reviews, and culinary explorations.'),
('Arts & Culture', 'Covering music, film, literature, and the arts scene.');

