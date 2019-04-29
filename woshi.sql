CREATE DATABASE woshi;

USE woshi;
CREATE TABLE files(
    file_id INT AUTO_INCREMENT PRIMARY KEY,
    uploader VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    file VARCHAR(255) NOT NULL);

CREATE TABLE posts( 
    post_id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(255) NOT NULL, 
    body TEXT NOT NULL, 
    host VARCHAR(255) NOT NULL, 
    contact VARCHAR(255) NOT NULL,
    num_replies INT NOT NULL DEFAULT'0',                                                    
    date timestamp(0) not null);

CREATE TABLE replies ( 
	reply_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL,
    guest VARCHAR(255) NOT NULL,
    contact VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    date timestamp(0) NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(post_id));

