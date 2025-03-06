-- Database creation
CREATE DATABASE IF NOT EXISTS newsletter_db;
USE newsletter_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    bio TEXT,
    profile_image VARCHAR(255) DEFAULT 'assets/images/avatar/default.jpg',
    role ENUM('admin', 'editor', 'author', 'subscriber') DEFAULT 'subscriber',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    color VARCHAR(20) DEFAULT '#2bb2a9',                --make it  petter
    icon VARCHAR(50) DEFAULT 'fas fa-circle',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Articles table
CREATE TABLE IF NOT EXISTS articles (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT,
    featured_image VARCHAR(255),
    status ENUM('published', 'draft', 'archived') DEFAULT 'draft',
    user_id INT,
    category_id INT,
    views INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

-- Tags table
CREATE TABLE IF NOT EXISTS tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Article-Tag relationship table (many-to-many)
CREATE TABLE IF NOT EXISTS article_tags (
    article_id INT,
    tag_id INT,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE
);

-- Comments table
CREATE TABLE IF NOT EXISTS comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    article_id INT,
    user_id INT,
    parent_id INT NULL,
    status ENUM('approved', 'pending', 'spam') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(article_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    FOREIGN KEY (parent_id) REFERENCES comments(comment_id) ON DELETE SET NULL
);

-- Subscribers table
CREATE TABLE IF NOT EXISTS subscribers (
    subscriber_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    status ENUM('active', 'unsubscribed') DEFAULT 'active',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL
);

-- Sample data insertion
-- Sample users
INSERT INTO users (username, email, password, first_name, last_name, profile_image, role)
VALUES 
('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'User', 'assets/images/avatar/01.jpg', 'admin'),
('samuel', 'samuel@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Samuel', 'Johnson', 'assets/images/avatar/01.jpg', 'author'),
('dennis', 'dennis@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dennis', 'Reynolds', 'assets/images/avatar/02.jpg', 'editor');

-- Sample categories
INSERT INTO categories (name, slug, description, color)
VALUES 
('Technology', 'technology', 'Articles about technology and innovation', '#dc3545'),
('Business', 'business', 'Business news and insights', '#0d6efd'),
('Sports', 'sports', 'Sports news and updates', '#17a2b8'),
('Gaming', 'gaming', 'Gaming news and reviews', '#6610f2'),
('Startups', 'startups', 'News about startups and entrepreneurship', '#fd7e14'),
('AR/VR', 'ar-vr', 'Augmented and virtual reality news', '#20c997'),
('AI/LLM', 'ai-llm', 'Artificial intelligence and large language models', '#6f42c1');

-- Sample articles
INSERT INTO articles (title, slug, excerpt, content, featured_image, status, user_id, category_id, is_featured, published_at)
VALUES 
('5 reasons why you shouldn\'t startup', '5-reasons-why-you-shouldnt-startup', 'Given and shown creating curiously to more in are man were smaller by we instead the these sighed Avoid in the sufficient me real man longer of his how...', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, diam quis aliquam faucibus, nisl quam aliquet nunc, quis aliquam nisl nunc eu nisl.</p><p>Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi.</p>', 'assets/images/BACKGROUND.jpeg', 'published', 3, 3, 1, '2021-03-07 10:30:00'),

('Best Pinterest boards for learning about business', 'best-pinterest-boards-for-learning-about-business', 'Prosperous understood Middletons in conviction an uncommonly do. Supposing so be resolving breakfast am or perfectly...', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel leo at purus adipiscing ultricies. Nulla facilisi. Donec rutrum, dui ut commodo semper, dui lectus tempus nunc, a condimentum orci libero at enim.</p><p>Aliquam erat volutpat. In ac fermentum nisi. Donec vel purus vel purus sollicitudin tincidunt sit amet nec leo. Duis posuere, lorem non eleifend vestibulum, ipsum est aliquam odio, ut varius ligula nisi id nunc.</p>', 'assets/images/background.webp', 'published', 2, 1, 0, '2021-01-22 14:45:00'),

('The Future of Artificial Intelligence', 'future-artificial-intelligence', 'Exploring the possibilities and challenges of AI technology in the coming decade...', '<p>Artificial Intelligence is transforming industries at an unprecedented pace. From healthcare to finance, AI is making its mark everywhere.</p><p>In this article, we explore what the future holds for this transformative technology and how it will shape our world in the coming decade.</p>', 'assets/images/Designer.jpeg', 'published', 2, 7, 1, '2021-02-15 09:15:00'),

('How to Make a Successful Career in Gaming', 'career-in-gaming-industry', 'The gaming industry has exploded in recent years, offering numerous career opportunities beyond just playing games...', '<p>From game development to professional esports, the gaming industry now offers legitimate career paths that were unimaginable a decade ago.</p><p>This article breaks down the various career paths, required skills, and how to get your foot in the door of this exciting industry.</p>', 'assets/images/introduction-background.png', 'published', 3, 4, 0, '2021-01-05 16:20:00'),

('Startup Funding 101: A Beginner\'s Guide', 'startup-funding-guide-beginners', 'Understanding the different stages of funding can help new entrepreneurs navigate the complex world of venture capital...', '<p>From bootstrapping to Series A and beyond, securing funding is often critical to a startup\'s success.</p><p>This comprehensive guide explains the various funding stages, what investors look for at each stage, and how to prepare your startup for fundraising.</p>', 'assets/images/Screenshot 2025-02-11 213358.png', 'published', 2, 5, 0, '2021-02-28 11:30:00'),

('Virtual Reality: Transforming Education and Training', 'virtual-reality-education-training', 'VR technology is creating new possibilities for immersive learning experiences across multiple fields...', '<p>Virtual Reality is no longer just for gaming. Educational institutions and corporations are increasingly adopting VR for training and education.</p><p>This article explores successful case studies and the measurable improvements in learning outcomes when using VR technology.</p>', 'assets/images/su.jpg', 'published', 3, 6, 0, '2021-01-18 13:45:00'),

('The Rise of Subscription-Based Business Models', 'subscription-based-business-models', 'How the subscription economy is changing consumer behavior and creating opportunities for businesses...', '<p>From streaming services to software and even physical products, the subscription model has proven its value and staying power.</p><p>This article analyzes why consumers are embracing subscriptions, how businesses can benefit, and the key metrics that matter in subscription-based business models.</p>', 'assets/images/subscipe_bg.jpg', 'published', 2, 2, 1, '2021-03-01 09:00:00');

-- Sample tags
INSERT INTO tags (name, slug)
VALUES 
('AI', 'ai'),
('Business', 'business'),
('Programming', 'programming'),
('Web Development', 'web-development'),
('Startups', 'startups'),
('Gaming', 'gaming'),
('VR', 'vr'),
('Education', 'education'),
('Software', 'software'),
('Entrepreneurship', 'entrepreneurship');

-- Article-tag relationships
INSERT INTO article_tags (article_id, tag_id)
VALUES 
(1, 5), (1, 10),
(2, 2), (2, 10),
(3, 1), (3, 9),
(4, 6), (4, 8),
(5, 5), (5, 10),
(6, 7), (6, 8),
(7, 2), (7, 10);

-- Sample comments
INSERT INTO comments (content, article_id, user_id, status)
VALUES 
('Great article! This really helped me understand the AI landscape better.', 3, 2, 'approved'),
('I\'ve been considering a career in gaming. This gave me a lot to think about.', 4, 3, 'approved'),
('Would love to see a follow-up article about securing Series B funding!', 5, 2, 'approved'),
('VR is definitely the future of education. My university has started implementing this.', 6, 3, 'approved'),
('Subscription models are interesting, but I worry about subscription fatigue. Any thoughts on this?', 7, 2, 'approved');

-- Sample subscribers
INSERT INTO subscribers (email, status)
VALUES 
('reader1@example.com', 'active'),
('reader2@example.com', 'active'),
('reader3@example.com', 'active'),
('reader4@example.com', 'unsubscribed'),
('reader5@example.com', 'active');
