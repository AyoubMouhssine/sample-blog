CREATE DATABASE IF NOT EXISTS sample_blog;

USE sample_blog;

-- Table for users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_unique` (`username`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for languages
CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` INT NOT NULL AUTO_INCREMENT,
  `language_name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`language_id`),
  UNIQUE KEY `language_name_unique` (`language_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table for posts
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT,
  `code` TEXT,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  `language_id` INT NOT NULL,
  PRIMARY KEY (`post_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample languages
INSERT INTO languages (language_name) VALUES
('JavaScript'),
('Python'),
('Java'),
('C#'),
('C++'),
('Ruby'),
('Swift'),
('PHP'),
('Go'),
('TypeScript'),
('Kotlin'),
('Rust'),
('Scala'),
('Perl'),
('HTML'),
('CSS'),
('SQL');

CREATE VIEW post_details AS
SELECT p.post_id, p.title, p.content, p.code, u.username AS user_name, l.language_name
FROM posts p
JOIN users u ON p.user_id = u.user_id
JOIN languages l ON p.language_id = l.language_id;



-- CRUD operations for users table
DELIMITER $$
CREATE PROCEDURE `create_user`(IN p_username VARCHAR(50), IN p_email VARCHAR(255), IN p_password_hash VARCHAR(255))
BEGIN
    INSERT INTO users (username, email, password_hash) VALUES (p_username, p_email, p_password_hash);
END$$

create procedure `get_all_users`()
begin
	select * from users;
end $$

CREATE PROCEDURE `get_user_by_email`(IN p_email INT)
BEGIN
    SELECT * FROM users WHERE email= p_email;
END$$

CREATE PROCEDURE `update_user`(IN p_user_id INT, IN p_username VARCHAR(50), IN p_email VARCHAR(255), IN p_password_hash VARCHAR(255))
BEGIN
    UPDATE users SET username = p_username, email = p_email, password_hash = p_password_hash WHERE user_id = p_user_id;
END$$

CREATE PROCEDURE `delete_user`(IN p_user_id INT)
BEGIN
    DELETE FROM users WHERE user_id = p_user_id;
END$$
DELIMITER ;

-- CRUD operations for languages table
DELIMITER $$
CREATE PROCEDURE `create_language`(IN p_language_name VARCHAR(50))
BEGIN
    INSERT INTO languages (language_name) VALUES (p_language_name);
END$$

CREATE PROCEDURE `get_all_languages`()
BEGIN
    select * from languages;
END$$

CREATE PROCEDURE `get_language_by_id`(IN p_language_id INT)
BEGIN
    SELECT * FROM languages WHERE language_id = p_language_id;
END$$

CREATE PROCEDURE `update_language`(IN p_language_id INT, IN p_language_name VARCHAR(50))
BEGIN
    UPDATE languages SET language_name = p_language_name WHERE language_id = p_language_id;
END$$

CREATE PROCEDURE `delete_language`(IN p_language_id INT)
BEGIN
    DELETE FROM languages WHERE language_id = p_language_id;
END$$
DELIMITER ;

-- CRUD operations for posts table
DELIMITER $$
CREATE PROCEDURE `create_post`(IN p_title VARCHAR(255), IN p_content TEXT, IN p_code TEXT, IN p_user_id INT, IN p_language_id INT)
BEGIN
    INSERT INTO posts (title, content, code, user_id, language_id) VALUES (p_title, p_content, p_code, p_user_id, p_language_id);
END$$


CREATE PROCEDURE get_all_posts()
BEGIN
    SELECT * FROM post_details;
END$$


CREATE PROCEDURE `get_post_by_id`(IN p_post_id INT)
BEGIN
    SELECT * FROM post_details WHERE post_id = p_post_id;
END$$

CREATE PROCEDURE `update_post`(IN p_post_id INT, IN p_title VARCHAR(255), IN p_content TEXT, IN p_language_id INT)
BEGIN
    UPDATE posts SET title = p_title, content = p_content, language_id = p_language_id WHERE post_id = p_post_id;
END$$

CREATE PROCEDURE `delete_post`(IN p_post_id INT)
BEGIN
    DELETE FROM posts WHERE post_id = p_post_id;
END$$
DELIMITER ;

-- Trigger to update 'updated_at' timestamp on post update
delimiter $$
CREATE TRIGGER `update_posts_updated_at`
BEFORE UPDATE ON `posts`
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END $$

delimiter ;