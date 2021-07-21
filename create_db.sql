CREATE DATABASE posts_comments;

USE posts_comments;

CREATE TABLE posts
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT,
    title VARCHAR(255),
    body TEXT
);

CREATE TABLE comments
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    postId INT,
    name VARCHAR(255),
    email VARCHAR(255),
    body TEXT,
    FOREIGN KEY (postId) REFERENCES posts (id) ON DELETE CASCADE
);
