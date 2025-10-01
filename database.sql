CREATE DATABASE rentify;

USE rentify

CREATE TABLE users(
  uid INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  middle_name VARCHAR(50) NULL,
  last_name VARCHAR(50) NOT NULL,
  address VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  id_path VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE admins(
  admin_id INT PRIMARY KEY AUTO_INCREMENT,
  admin_name VARCHAR(50) NOT NULL,
  admin_middlename VARCHAR(50) NULL,
  admin_lastname VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL
);

CREATE TABLE items (
  item_id INT PRIMARY KEY AUTO_INCREMENT,
  item_name VARCHAR(25) NOT NULL,
  description TEXT NOT NULL,
  category VARCHAR(50) NOT NULL,
  price_per_day DECIMAL(10,2) NOT NULL,
  image_path VARCHAR(50) NOT NULL,
  status ENUM('available', 'rented', 'unavailable') DEFAULT 'available',
  added_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE
);

CREATE TABLE rental (
  rented_at DATETIME NOT NULL,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE,
  FOREIGN KEY (uid) REFERENCES users(uid) ON DELETE CASCADE
);

CREATE TABLE payment(
  
);