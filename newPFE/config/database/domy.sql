-- Dummy Users (password is "password123" hashed)
INSERT INTO users (name, email, password_hash, username, role_id, created_at, last_login) VALUES
('moatamen naief', 'moatemennaief@gmail.com', '64050690', 'moatamen', 3, '2023-12-05 08:20:15', '2024-03-07 22:10:18'),

('John Smith', 'john@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'johnsmith', 1, '2024-02-10 14:30:00', '2024-03-07 09:15:22'),
('Sarah Johnson', 'sarah@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'sarahj', 2, '2024-01-15 10:45:20', '2024-03-08 11:30:45'),

('Emma Wilson', 'emma@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'emmaw', 1, '2024-02-28 16:50:30', '2024-03-06 14:25:11'),
('David Lee', 'david@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'davelee', 1, '2024-01-20 11:15:45', '2024-03-01 09:30:52'),
('Lisa Chen', 'lisa@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'lisac', 2, '2023-11-12 09:40:22', '2024-03-05 18:45:30'),
('Robert Taylor', 'robert@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', NULL, 1, '2024-03-01 15:20:10', '2024-03-07 10:05:15'),
('Jennifer Adams', 'jennifer@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'jennifera', 1, '2024-02-14 12:35:40', NULL),
('Thomas Wilson', 'thomas@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'twils', 1, '2024-01-30 17:55:18', '2024-02-28 08:20:45'),
('Maria Garcia', 'maria@example.com', '$2y$10$NQjGpOxBmO2BPxJsOjV6yOUTIZytGfhjdHgfL5KzwlE4MlCIxoTYi', 'mariag', 2, '2023-12-22 10:10:25', '2024-03-06 16:40:12');

-- Dummy User Profiles
INSERT INTO user_profiles (user_id, profile_picture, bio, position, company, website, facebook, twitter, instagram, linkedin) VALUES
(1, NULL, 'Tech enthusiast and avid reader', 'Software Developer', 'TechCorp', 'https://johnsmith.com', 'john.smith', 'johnsmith', 'john_smith', 'johnsmith'),
(2, NULL, 'Writer and content creator specializing in tech news', 'Content Manager', 'MediaGroup', 'https://sarahjohnson.net', 'sarah.johnson', 'sarahj', 'sarah_johnson', 'sarahjohnson'),
(3, NULL, 'Experienced tech journalist with 10+ years in the industry', 'Senior Editor', 'TechNews Inc.', 'https://michaelbrown.io', 'michael.brown', 'mikebrown', 'michael_brown', 'michaelbrown'),
(4, NULL, 'Learning about tech and sharing my journey', NULL, NULL, NULL, 'emma.wilson', 'emmawilson', 'emma_wilson', NULL),
(5, NULL, 'Just here for the articles', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 'Technology consultant and frequent contributor to tech blogs', 'IT Consultant', 'ConsultTech', 'https://lisachen.com', 'lisa.chen', 'lisac', 'lisa_chen', 'lisachen'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'New to tech but eager to learn more', 'Student', 'University of Technology', NULL, 'jennifer.adams', NULL, 'jennifer_adams', 'jenniferadams'),
(9, NULL, 'Tech hobbyist', NULL, NULL, NULL, 'thomas.wilson', 'thomasw', NULL, NULL),
(10, NULL, 'Writing about emerging technologies and innovations', 'Freelance Writer', NULL, 'https://mariagarcia.com', 'maria.garcia', 'mariagarcia', 'maria_garcia', 'mariagarcia');

-- Dummy Role Requests
INSERT INTO role_requests (user_id, requested_role_id, request_reason, status_id, created_at) VALUES
(4, 2, 'I would like to contribute articles about mobile technology and app development. I have 3 years of experience writing for tech blogs.', 1, '2024-02-28 14:30:00'),
(5, 2, 'I have expertise in cloud computing and would like to share my knowledge through articles.', 2, '2024-01-15 09:45:20'),
(8, 2, 'As a student in computer science, I would like to write about my learning experiences and new technologies.', 3, '2024-02-20 16:50:30'),
(9, 2, 'I want to contribute articles about cybersecurity. I have certifications in network security.', 1, '2024-03-02 11:15:45'),
(7, 3, 'I have 8 years of experience as an editor and would like to help manage content.', 1, '2024-03-05 13:40:22');





-- ====================================================
-- 1. Insert Categories
-- ====================================================

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

-- ====================================================
-- 2. Insert Articles
-- ====================================================

INSERT INTO articles (user_id, title, content, summary, statu, featured_image)
VALUES
  (1, 'Tech Secretary left ''shocked to the core'' after visiting crack team hunting down child abuse images', 
       'Full article content available at: https://www.thesun.co.uk/news/33873437/tech-secretary-shocked-ai-child-abuse-images/', 
       'A look into the tech safety measures highlighted by the UK Tech Secretary.', 
       'published', 'https://via.placeholder.com/150?text=Child+Safety'),
  (1, 'Axios Media Trends: WaPo''s big shift', 
       'Full article content available at: https://www.axios.com/newsletters/axios-media-trends-6a3f5cd0-fdda-11ef-9d47-6d4ca95699f8', 
       'Exploring major shifts in media and tech trends.', 
       'published', 'https://via.placeholder.com/150?text=Media+Trends'),
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

-- ====================================================
-- 3. Link Articles to Categories
-- ====================================================
-- Here we assume that the first inserted category gets category_id = 1, the second gets 2, etc.
-- Adjust the article_id values if necessary.

INSERT INTO article_categories (article_id, category_id) VALUES
  (1, 1),  -- Article 1 -> Online Safety / Child Protection Technology
  (2, 2),  -- Article 2 -> Media & Tech Industry Trends
  (3, 3),  -- Article 3 -> Robotics & Entertainment Tech
  (4, 4),  -- Article 4 -> Artificial Intelligence & Chatbots
  (5, 5),  -- Article 5 -> Legal Tech / Content Scraping
  (6, 6),  -- Article 6 -> Law Enforcement & Surveillance Tech
  (7, 7),  -- Article 7 -> AI in Creative Industries / Copyright Issues
  (8, 8),  -- Article 8 -> Retro Tech & Photography
  (9, 9),  -- Article 9 -> AI-Generated Content / Internet Spam
  (10, 10),-- Article 10 -> AI in Healthcare / Medical Imaging
  (11, 11),-- Article 11 -> Entrepreneurial Profiles / Messaging Apps
  (12, 12),-- Article 12 -> Tech Blogs & Reviews
  (13, 13),-- Article 13 -> Digital Media / Tech Journalism
  (14, 14),-- Article 14 -> Digital Tech News
  (15, 15),-- Article 15 -> Global Tech News
  (16, 16),-- Article 16 -> Business Tech & Innovation
  (17, 17),-- Article 17 -> Consumer Tech & Reviews
  (18, 18),-- Article 18 -> Startup News & Industry Updates
  (19, 19),-- Article 19 -> Legal Tech / Online Safety
  (20, 20);-- Article 20 -> Corporate Tech & Business News
