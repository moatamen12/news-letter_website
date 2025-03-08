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