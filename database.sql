-- ===============================
-- CREATE DATABASE
-- ===============================
CREATE DATABASE IF NOT EXISTS rentify_db;

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
  approval_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  account_status ENUM('active', 'inactive', 'banned', 'suspended') DEFAULT 'inactive',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
);

-- DUMP SAMPLE USERS
INSERT INTO users (first_name, middle_name, last_name, address, email, id_path, password, approval_status, account_status)
  VALUES
    ('Teejay', NULL, 'Arancina', 'Salangi, Almeria, Biliran', 'teejay@example.com', 'uploads/ids/david_id.jpg', '123', 'pending', 'inactive'),
    ('Eugene', NULL, 'Andoy', 'Tamarindo, Almeria, Biliran', 'eugene@example.com', 'uploads/ids/john_id.jpg', '123', 'pending', 'inactive'),
    ('Ladylyn', NULL, 'Alvez', 'Sabang, Naval, Biliran', 'ladylyn@example.com', 'uploads/ids/jane_id.jpg', '123', 'pending', 'inactive'),
    ('Joey', NULL, 'Ibanez', 'Almeria, Naval, Biliran', 'joey@example.com', 'uploads/ids/mike_id.jpg', '123', 'pending', 'inactive'),
    ('Ritchie', NULL, 'Romagos', 'Agpangi, Naval, Biliran', 'ritchie@example.com', 'uploads/ids/sarah_id.jpg', '123', 'pending', 'inactive');

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
  category ENUM('pe_costume', 'sports_gear', 'textbook', 'uniform', 'lab_equipment', 'electronics', 'other') NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  brand VARCHAR(25),
  location VARCHAR(150),
  item_condition ENUM('brand_new', 'like_new', 'good', 'fair', 'poor') NOT NULL DEFAULT 'good',
  return_statement TEXT,
  security_deposit DECIMAL(10,2) DEFAULT NULL,
  status ENUM('available', 'unavailable', 'rented') DEFAULT 'available',
  approval_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  approved_by INT NULL,
  approved_at DATETIME NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (owner_uid) REFERENCES users(uid) ON DELETE CASCADE,
  FOREIGN KEY (approved_by) REFERENCES admins(admin_id) ON DELETE SET NULL
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
  rate_type ENUM('per_day', 'per_week', 'per_month') NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  minimum_duration INT NOT NULL,
  minimum_duration_unit ENUM('day', 'week', 'month') NOT NULL DEFAULT 'day',
  maximum_duration INT DEFAULT NULL,
  maximum_duration_unit ENUM('day', 'week', 'month') DEFAULT NULL,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE
);

-- ===============================
-- AVAILABILITY
-- ===============================
CREATE TABLE item_availability (
  availability_id INT AUTO_INCREMENT PRIMARY KEY,
  item_id INT NOT NULL,
  available_from DATE NOT NULL,
  available_until DATE NULL,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE
);

-- ===============================
-- CANCELLATION POLICY
-- ===============================
CREATE TABLE cancellation_policies (
  policy_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT,
  refund_percentage DECIMAL(5,2) NOT NULL CHECK (refund_percentage BETWEEN 0 AND 100)
);

-- ===============================
-- INSERT PREDEFINED CANCELLATION POLICIES
-- ===============================
INSERT INTO cancellation_policies (name, description, refund_percentage) VALUES
('flexible', 'Flexible - Full refund up to 24hrs before', 100.00),
('moderate', 'Moderate - 50% refund up to 48hrs before', 50.00),
('strict', 'Strict - No refunds', 0.00);

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
  status ENUM('pending', 'verified', 'ongoing', 'completed', 'cancelled', 'declined', 'return_pending') DEFAULT 'pending',
  owner_response ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
  owner_response_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  rejection_reason TEXT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (item_id) REFERENCES items(item_id) ON DELETE CASCADE,
  FOREIGN KEY (renter_uid) REFERENCES users(uid) ON DELETE CASCADE,
  FOREIGN KEY (pricing_id) REFERENCES rental_pricing(pricing_id) ON DELETE RESTRICT,
  FOREIGN KEY (policy_id) REFERENCES cancellation_policies(policy_id) ON DELETE SET NULL
);

-- add og confirm by the owner 

-- ===============================
-- PAYMENT TABLE (Complete)
-- ===============================
CREATE TABLE payment (
  payment_id INT PRIMARY KEY AUTO_INCREMENT,
  rental_id INT NOT NULL,
  payment_method ENUM('gcash', 'bank', 'cash') NOT NULL,
  payment_proof_path VARCHAR(255) NULL,
  amount DECIMAL(10,2) NOT NULL,
  security_deposit DECIMAL(10,2) DEFAULT 0.00,
  total_amount DECIMAL(10,2) NOT NULL,
  payment_status ENUM('pending', 'verified', 'rejected', 'refunded') DEFAULT 'pending',
  payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  verified_by INT NULL,
  verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  refund_date DATETIME NULL,
  notes TEXT NULL,
  FOREIGN KEY (rental_id) REFERENCES rentals(rental_id) ON DELETE CASCADE,
  FOREIGN KEY (verified_by) REFERENCES admins(admin_id) ON DELETE SET NULL
);

-- ===============================
-- ESCROW TABLE (for secure payments)
-- ===============================
CREATE TABLE escrow (
  escrow_id INT PRIMARY KEY AUTO_INCREMENT,
  payment_id INT NOT NULL,
  rental_id INT NOT NULL,
  amount_held DECIMAL(10,2) NOT NULL,
  status ENUM('holding', 'released_to_owner', 'refunded_to_renter', 'cancelled') DEFAULT 'holding',
  held_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  released_at DATETIME NULL,
  released_to INT NULL,
  release_amount DECIMAL(10,2) NULL,
  notes TEXT NULL,
  FOREIGN KEY (payment_id) REFERENCES payment(payment_id) ON DELETE CASCADE,
  FOREIGN KEY (rental_id) REFERENCES rentals(rental_id) ON DELETE CASCADE,
  FOREIGN KEY (released_to) REFERENCES users(uid) ON DELETE SET NULL
);

-- ===============================
-- DEPOSIT REFUND TABLE
-- ===============================
CREATE TABLE deposit_refunds (
  refund_id INT PRIMARY KEY AUTO_INCREMENT,
  rental_id INT NOT NULL,
  payment_id INT NOT NULL,
  deposit_amount DECIMAL(10,2) NOT NULL,
  refund_amount DECIMAL(10,2) NOT NULL,
  deduction_amount DECIMAL(10,2) DEFAULT 0.00,
  deduction_reason TEXT NULL,
  refund_status ENUM('pending', 'approved', 'processed', 'rejected') DEFAULT 'pending',
  refund_method ENUM('gcash', 'bank', 'cash') NOT NULL,
  requested_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  processed_at DATETIME NULL,
  processed_by INT NULL,
  FOREIGN KEY (rental_id) REFERENCES rentals(rental_id) ON DELETE CASCADE,
  FOREIGN KEY (payment_id) REFERENCES payment(payment_id) ON DELETE CASCADE,
  FOREIGN KEY (processed_by) REFERENCES admins(admin_id) ON DELETE SET NULL
);

-- ===============================
-- TRANSACTION LOG (for audit trail)
-- ===============================
CREATE TABLE transaction_log (
  log_id INT PRIMARY KEY AUTO_INCREMENT,
  rental_id INT NOT NULL,
  payment_id INT NULL,
  transaction_type ENUM('payment_received', 'payment_verified', 'payment_rejected', 
                        'escrow_held', 'escrow_released', 'escrow_refunded',
                        'deposit_held', 'deposit_refunded', 'commission_deducted') NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  from_user INT NULL,
  to_user INT NULL,
  description TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (rental_id) REFERENCES rentals(rental_id) ON DELETE CASCADE,
  FOREIGN KEY (payment_id) REFERENCES payment(payment_id) ON DELETE SET NULL,
  FOREIGN KEY (from_user) REFERENCES users(uid) ON DELETE SET NULL,
  FOREIGN KEY (to_user) REFERENCES users(uid) ON DELETE SET NULL
);