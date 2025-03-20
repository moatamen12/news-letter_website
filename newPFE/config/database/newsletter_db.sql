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
    statu ENUM('draft', 'published') NOT NULL DEFAULT 'draft',  
    featured_image VARCHAR(255) DEFAULT NULL, -- uploading an optionale image for the article
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE     
);

-- creating the article_categories table
-- CREATE TABLE comments ( 
--     comment_id INT AUTO_INCREMENT PRIMARY KEY, 
--     article_id INT NOT NULL, 
--     user_id INT NOT NULL,                   --the commint author
--     parent_comment_id INT DEFAULT NULL,     --the comment that this comment is replying to
--     comment_content TEXT NOT NULL, 
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
--     FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE, 
--     FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE, 
--     FOREIGN KEY (parent_comment_id) REFERENCES comments(comment_id) ON DELETE CASCADE 
    
-- );
-- INSERT INTO categories (category_name) VALUES
-- ('Cyber Security'),  
-- ('Esports'),
-- ('AI/LLM'),
-- ('Data Science'),
-- ('AR/VR'),
-- ('Web Development'),
-- ('App Development');
-- ('quantom')

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

























-- ====================================================
-- DUMMY DATA INSERTIONS
-- ====================================================

-- 1. Roles
INSERT INTO roles (role_name) VALUES 
('reader'), ('contributor'), ('admin');

-- 2. Request Statuses
INSERT INTO request_statuses (status_name) VALUES 
('pending'), ('approved'), ('rejected');

-- 3. Users
INSERT INTO users (name, email, password_hash, username, role_id) VALUES
('Alice Reader', 'alice@example.com', 'hashed_password1', 'alice', 1),
('Bob Contributor', 'bob@example.com', 'hashed_password2', 'bob', 2),
('Carol Admin', 'carol@example.com', 'hashed_password3', 'carol', 3);

-- 4. User Profiles (one per user)
INSERT INTO user_profiles (user_id, bio, work, website) VALUES
('25' , 'I love reading tech articles', 'Reader', 'https://alice.example.com'),
('26' , 'Tech contributor and blogger', 'Contributor', 'https://bob.example.com'),
('27' , 'Admin overseeing content', 'Admin', 'https://carol.example.com');

-- 5. Role Requests (example: Bob requests admin privileges)
INSERT INTO role_requests (user_id, requested_role_id, request_reason, status_id) VALUES
(2, 3, 'I have been contributing quality articles and would like to manage content.', 1);

-- 6. User Follows (example relationships)
INSERT INTO user_follows (follower_id, followed_id) VALUES
(1, 2),  -- Alice follows Bob
(1, 3),  -- Alice follows Carol
(2, 1);  -- Bob follows Alice

-- 7. Permissions (example permissions)
INSERT INTO permissions (permission_name) VALUES
('create_article'), ('edit_article'), ('delete_article'), ('manage_users');

-- 8. Role Permissions (assign permissions to roles)
-- Readers get no extra permissions beyond reading, contributors can create and edit articles, admins can do all.
INSERT INTO role_permissions (role_id, permission_id) VALUES
-- Contributors (role_id=2): create and edit articles
(2, 1),
(2, 2),
-- Admin (role_id=3): create, edit, delete articles and manage users
(3, 1),
(3, 2),
(3, 3),
(3, 4);

-- 9. Contact Messages (dummy contact message from Alice)
INSERT INTO contact_messages (user_id, username, email, subject, message, message_category) VALUES
(1, 'alice', 'alice@example.com', 'Question about subscription', 'I would like to know more about premium features.', 'general');

-- 10. Categories (for articles; using topics from our earlier article sample)
INSERT INTO categories (category_name) VALUES
('Online Safety / Child Protection Technology'),
('Media & Tech Industry Trends'),
('Robotics & Entertainment Tech'),
('Artificial Intelligence & Chatbots'),
('Legal Tech / Content Scraping'),
('Law Enforcement & Surveillance Tech'),
('AI in Creative Industries / Copyright Issues'),
('Retro Tech & Photography'),
('AI-Generated Content / Internet Spam'),
('AI in Healthcare / Medical Imaging'),
('Entrepreneurial Profiles / Messaging Apps'),
('Tech Blogs & Reviews'),
('Digital Media / Tech Journalism'),
('Digital Tech News'),
('Global Tech News'),
('Business Tech & Innovation'),
('Consumer Tech & Reviews'),
('Startup News & Industry Updates'),
('Legal Tech / Online Safety'),
('Corporate Tech & Business News');

-- 11. Articles (20 dummy articles inserted by Alice, user_id = 1)
INSERT INTO articles (user_id, title, content, summary, statu, featured_image)
VALUES  
     (22, 'Axios Media Trends: WaPo''s big shift', 
       'Full article content available at: https://www.axios.com/newsletters/axios-media-trends-6a3f5cd0-fdda-11ef-9d47-6d4ca95699f8', 
       'Exploring major shifts in media and tech trends.', 
       'draft', 'https://via.placeholder.com/150?text=Media+Trends'),
  (22, 'Tech Secretary left ''shocked to the core'' after visiting crack team hunting down child abuse images', 
       'Full article content available at: https://www.thesun.co.uk/news/33873437/tech-secretary-shocked-ai-child-abuse-images/', 
       'A look into the tech safety measures highlighted by the UK Tech Secretary.', 
       'published', 'https://via.placeholder.com/150?text=Child+Safety'),

  (1, 'Disney enters its robot era', 
       'Full article content available at: https://www.axios.com/disney-robot-era', 
       'Disney launches new robotic innovations for its entertainment ventures.', 
       'published', 'https://via.placeholder.com/150?text=Disney+Robots'),
  (1, 'AI chatbots struggle to cite news', 
       'Full article content available at: https://www.axios.com/ai-chatbots-cite-news', 
       'An investigation into AI chatbots and citation accuracy.', 
       'published', 'https://via.placeholder.com/150?text=AI+Chatbots'),
  (1, 'News Corp sued by Brave Software, a Google search engine rival', 
       'Full article content available at: https://www.reuters.com/legal/news-corp-sued-by-brave-software-google-search-engine-rival-2025-03-13/', 
       'A legal battle over content scraping and fair use in the tech industry.', 
       'published', 'https://via.placeholder.com/150?text=Legal+Tech'),
  (1, 'How NYPD is using AI, drones, DNA and cutting-edge tech in the manhunt for United Healthcare CEO Brian Thompson’s assassin', 
       'Full article content available at: https://nypost.com/2024/12/06/us-news/the-next-frontier-for-catching-a-killer-prevalent-surveillance-ai-drones/', 
       'An overview of how advanced tech tools are aiding the NYPD in a high-profile manhunt.', 
       'published', 'https://via.placeholder.com/150?text=NYPD+Tech'),
  (1, 'Photographer slams AI bots that are copying his work with ''remarkably similar'' images – can YOU tell the difference?', 
       'Full article content available at: https://www.thesun.ie/tech/14801351/photographer-tim-flach-ai-bot-copying-work-difference/', 
       'A photographer exposes how AI is replicating creative styles without permission.', 
       'published', 'https://via.placeholder.com/150?text=AI+Art+Copying'),
  (1, 'Vintage Digicams Aren’t Just a Fad. They’re an Artistic Statement', 
       'Full article content available at: https://www.wired.com/story/vintage-digicams-artistic-photos', 
       'Exploring the resurgence of vintage digital cameras among creative photographers.', 
       'published', 'https://via.placeholder.com/150?text=Vintage+Digicams'),
  (1, 'Drowning in Slop', 
       'Full article content available at: https://nymag.com/intelligencer/article/ai-generated-content-internet-online-slop-spam.html', 
       'A critique of the overwhelming flood of low-quality, AI-generated content online.', 
       'published', 'https://via.placeholder.com/150?text=AI+Content+Spam'),
  (1, 'AI may help spot deadly diseases more precisely', 
       'Full article content available at: https://www.adelaidenow.com.au/news/south-australia/artificial-intelligence-advising-on-xray-diagnoses-in-sa-medical-imaging/news-story/ae20cc4c30320354069d586ca1d23846', 
       'A breakthrough in using AI to assist with medical imaging diagnoses.', 
       'published', 'https://via.placeholder.com/150?text=AI+Healthcare'),
  (1, 'Meet Pavel Durov, the tech billionaire who founded Telegram', 
       'Full article content available at: https://www.businessinsider.com/pavel-durov-telegram-billionaire-russia-instagram-wealth-founder-dubai-lifestyle-2022-3', 
       'An in-depth profile on Pavel Durov and his impact on messaging technology.', 
       'published', 'https://via.placeholder.com/150?text=Pavel+Durov'),
  (1, 'Skatter Tech: A Digital Publication Covering the Latest in Tech', 
       'Full article content available at: https://skattertech.com', 
       'A look at Skatter Tech and its daily coverage of tech news and reviews.', 
       'published', 'https://via.placeholder.com/150?text=Skatter+Tech'),
  (1, '404 Media: The New Voice in Tech Journalism', 
       'Full article content available at: https://404media.co', 
       'Introducing 404 Media – a new, independent voice in tech journalism.', 
       'published', 'https://via.placeholder.com/150?text=404+Media'),
  (1, 'The Verge: Revolutionizing Tech News', 
       'Full article content available at: https://www.theverge.com/', 
       'Exploring how The Verge continues to reshape digital tech news.', 
       'published', 'https://via.placeholder.com/150?text=The+Verge'),
  (1, 'Reuters Tech: Latest in Technology and Innovation', 
       'Full article content available at: https://www.reuters.com/technology/', 
       'Up-to-the-minute global tech news and innovations.', 
       'published', 'https://via.placeholder.com/150?text=Reuters+Tech'),
  (1, 'Tech News on CNN Business: Exploring Innovations and Gadgets', 
       'Full article content available at: https://www.cnn.com/business/tech', 
       'CNN Business provides insights into the latest technological innovations and gadgets.', 
       'published', 'https://via.placeholder.com/150?text=CNN+Tech'),
  (1, 'Yahoo Tech: Breaking Stories and Reviews in Technology', 
       'Full article content available at: https://tech.yahoo.com/', 
       'Yahoo Tech delivers breaking news and comprehensive reviews on tech products.', 
       'published', 'https://via.placeholder.com/150?text=Yahoo+Tech'),
  (1, 'GeekWire: Your Daily Dose of Tech and Startup News', 
       'Full article content available at: https://www.geekwire.com/', 
       'GeekWire covers startup news and industry updates in the tech world.', 
       'published', 'https://via.placeholder.com/150?text=GeekWire'),
  (1, 'Court blocks California law on children''s online safety', 
       'Full article content available at: https://www.reuters.com/technology/court-blocks-california-law-childrens-online-safety', 
       'A look at the legal implications surrounding children''s online safety regulations.', 
       'published', 'https://via.placeholder.com/150?text=Online+Safety+Law'),
  (1, 'Intel''s New CEO to Receive $1 Million as Base Salary', 
       'Full article content available at: https://www.reuters.com/technology/intels-new-ceo-1-million-base-salary', 
       'Corporate news on Intel''s compensation package for its new CEO.', 
       'published', 'https://via.placeholder.com/150?text=Intel+CEO');

-- 12. Article Categories
-- We assume the first inserted category gets category_id = 1, second gets 2, etc.
INSERT INTO article_categories (article_id, category_id) VALUES
  (1, 1),   -- Article 1 -> 'Online Safety / Child Protection Technology'
  (2, 2),   -- Article 2 -> 'Media & Tech Industry Trends'
  (3, 3),   -- Article 3 -> 'Robotics & Entertainment Tech'
  (4, 4),   -- Article 4 -> 'Artificial Intelligence & Chatbots'
  (5, 5),   -- Article 5 -> 'Legal Tech / Content Scraping'
  (6, 6),   -- Article 6 -> 'Law Enforcement & Surveillance Tech'
  (7, 7),   -- Article 7 -> 'AI in Creative Industries / Copyright Issues'
  (8, 8),   -- Article 8 -> 'Retro Tech & Photography'
  (9, 9),   -- Article 9 -> 'AI-Generated Content / Internet Spam'
  (10, 10), -- Article 10 -> 'AI in Healthcare / Medical Imaging'
  (11, 11), -- Article 11 -> 'Entrepreneurial Profiles / Messaging Apps'
  (12, 12), -- Article 12 -> 'Tech Blogs & Reviews'
  (13, 13), -- Article 13 -> 'Digital Media / Tech Journalism'
  (14, 14), -- Article 14 -> 'Digital Tech News'
  (15, 15), -- Article 15 -> 'Global Tech News'
  (16, 16), -- Article 16 -> 'Business Tech & Innovation'
  (17, 17), -- Article 17 -> 'Consumer Tech & Reviews'
  (18, 18), -- Article 18 -> 'Startup News & Industry Updates'
  (19, 19), -- Article 19 -> 'Legal Tech / Online Safety'
  (20, 20); -- Article 20 -> 'Corporate Tech & Business News'
