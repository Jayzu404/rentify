CREATE DATABASE rentify_db;

USE rentify_db;

-- ===============================
-- USERS
-- ===============================
CREATE TABLE users(
  uid INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  middle_name VARCHAR(50) NULL,
  last_name VARCHAR(50) NOT NULL,
  address VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL UNIQUE,
  id_path VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL
);

-- ===============================
-- ADMINS
-- ===============================
CREATE TABLE admins(
  admin_id INT PRIMARY KEY AUTO_INCREMENT,
  admin_name VARCHAR(50) NOT NULL,
  admin_middlename VARCHAR(50) NULL,
  admin_lastname VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL
);

-- ===============================
-- ITEMS
-- ===============================
CREATE TABLE items (
  item_id INT AUTO_INCREMENT PRIMARY KEY,
  owner_uid INT NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  brand VARCHAR(25),
  location VARCHAR(150),
  item_condition ENUM('brand_new', 'like_new', 'good', 'fair', 'poor') NOT NULL DEFAULT 'good',
  status ENUM('available', 'unavailable', 'maintenance') DEFAULT 'available',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (owner_uid) REFERENCES users(uid) ON DELETE CASCADE
);

-- ===============================
-- ITEM IMAGES
-- ===============================
CREATE TABLE item_images (
  image_id INT AUTO_INCREMENT PRIMARY KEY,
  item_id INT NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  is_primary BOOLEAN DEFAULT FALSE,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE
);


-- ===============================
-- RENTAL PRICING
-- ===============================
CREATE TABLE rental_pricing (
  pricing_id INT AUTO_INCREMENT PRIMARY KEY,
  item_id INT NOT NULL,
  rate_type ENUM('per_day', 'per_week') NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  minimum_duration INT NOT NULL,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE
);

-- ===============================
-- AVAILABILITY
-- ===============================
CREATE TABLE item_availability (
  availability_id INT AUTO_INCREMENT PRIMARY KEY,
  item_id INT NOT NULL,
  available_from DATE NOT NULL,
  available_until DATE NOT NULL,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE
);

-- ===============================
-- CANCELLATION POLICY
-- ===============================
CREATE TABLE cancellation_policies (
  policy_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  refund_percentage DECIMAL(5,2) NOT NULL CHECK (refund_percentage BETWEEN 0 AND 100)
);

-- ===============================
-- RENTALS (bookings)
-- ===============================
CREATE TABLE rentals (
  rental_id INT AUTO_INCREMENT PRIMARY KEY,
  item_id INT NOT NULL,
  renter_uid INT NOT NULL,
  pricing_id INT NOT NULL,
  policy_id INT,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  status ENUM('pending', 'confirmed', 'ongoing', 'completed', 'cancelled') DEFAULT 'pending',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE,
  FOREIGN KEY (renter_uid) REFERENCES users(uid) ON DELETE CASCADE,
  FOREIGN KEY (pricing_id) REFERENCES rental_pricing(pricing_id) ON DELETE RESTRICT,
  FOREIGN KEY (policy_id) REFERENCES cancellation_policies(policy_id) ON DELETE SET NULL
);