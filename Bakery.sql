CREATE DATABASE freshbyte CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE freshbyte;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  display_name VARCHAR(100),
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE menu_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  category ENUM('Cake','Pastry','Bread') NOT NULL,
  description TEXT,
  price DECIMAL(6,2),
  image VARCHAR(255)
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  item_id INT NOT NULL,
  quantity INT DEFAULT 1,
  order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('Pending','Completed','Cancelled') DEFAULT 'Pending',
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (item_id) REFERENCES menu_items(id)
);

CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  subject VARCHAR(255),
  message TEXT,
  is_read BOOLEAN DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
