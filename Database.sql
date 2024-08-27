-- Table for user information
CREATE TABLE users (
username VARCHAR(50) PRIMARY KEY,
password VARCHAR(100) NOT NULL
);
-- Table for user posts
CREATE TABLE posts (
post_id SERIAL PRIMARY KEY,
username VARCHAR(50) REFERENCES users(username),
post_content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Table for comments on posts
CREATE TABLE comments (
comment_id SERIAL PRIMARY KEY,
post_id INT REFERENCES posts(post_id),
username VARCHAR(50) REFERENCES users(username),
comment_content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Table for comments on comments (nested comments)
CREATE TABLE nested_comments (
nested_comment_id SERIAL PRIMARY KEY,
comment_id INT REFERENCES comments(comment_id),
username VARCHAR(50) REFERENCES users(username),
nested_comment_content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
