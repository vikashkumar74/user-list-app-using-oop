CREATE DATABASE userlist;
USE userlist;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  age INT,
  gender VARCHAR(10)
);