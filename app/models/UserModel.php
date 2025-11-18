<?php 
require_once dirname(__DIR__) . '/core/DbConnection.php';

class UserModel extends DbConnection {
  
  /**
   * Get user by ID
   */
  public function getUserById($userId): array {
    $query = "SELECT 
                uid,
                first_name,
                middle_name,
                last_name,
                address,
                email,
                id_path,
                approval_status,
                account_status,
                created_at
              FROM users 
              WHERE uid = :uid";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':uid' => $userId]);

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user) {
        return ['success' => false, 'error' => 'User not found'];
      }

      return ['success' => true, 'user' => $user];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::getUserById() failed - context: retrieving user by Id (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to retrieve user'];
    }
  }

  /**
   * Get all approved items by owner/user ID
   */
  public function getItemsByUserId($ownerID): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  i.item_id,
                  i.title,
                  i.description,
                  i.category,
                  i.brand,
                  i.quantity,
                  i.location,
                  i.item_condition,
                  i.security_deposit,
                  i.status,
                  i.approval_status,
                  i.created_at,
                  i.updated_at,
                  u.uid as owner_id,
                  u.first_name,
                  u.last_name,
                  img.image_path as primary_image,
                  GROUP_CONCAT(DISTINCT CONCAT(rp.rate_type, ':', rp.price) SEPARATOR '|') as pricing
                FROM items i
                INNER JOIN users u ON i.owner_uid = u.uid
                LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
                LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
                WHERE i.owner_uid = :ownerID
                GROUP BY i.item_id
                ORDER BY i.created_at DESC";
      
      $stmt = $db->prepare($query);
      $stmt->execute([':ownerID' => $ownerID]);
      
      $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Process pricing data
      foreach ($items as &$item) {
        $item['pricing_details'] = [];
        if (!empty($item['pricing'])) {
          $pricingParts = explode('|', $item['pricing']);
          foreach ($pricingParts as $part) {
            list($type, $price) = explode(':', $part);
            $item['pricing_details'][$type] = (float)$price;
          }
        }
        unset($item['pricing']);
      }

      return ['success' => true, 'items' => $items];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::getItemsByUserId() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve items'];
    }
  }

  /**
   * Get single item by ID (with owner verification)
   */
  public function getItemById($itemId, $userId = null): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  i.*,
                  u.uid as owner_id,
                  u.first_name,
                  u.last_name,
                  u.email as owner_email
                FROM items i
                INNER JOIN users u ON i.owner_uid = u.uid
                WHERE i.item_id = :item_id";
      
      if ($userId !== null) {
        $query .= " AND i.owner_uid = :user_id";
      }
      
      $stmt = $db->prepare($query);
      $params = [':item_id' => $itemId];
      
      if ($userId !== null) {
        $params[':user_id'] = $userId;
      }
      
      $stmt->execute($params);
      $item = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$item) {
        return ['success' => false, 'error' => 'Item not found'];
      }

      // Get item images
      $imgQuery = "SELECT image_id, image_path, is_primary 
                   FROM item_images 
                   WHERE item_id = :item_id 
                   ORDER BY is_primary DESC, image_id ASC";
      $imgStmt = $db->prepare($imgQuery);
      $imgStmt->execute([':item_id' => $itemId]);
      $item['images'] = $imgStmt->fetchAll(PDO::FETCH_ASSOC);

      // Get pricing
      $priceQuery = "SELECT pricing_id, rate_type, price, minimum_duration, 
                            minimum_duration_unit, maximum_duration, maximum_duration_unit
                     FROM rental_pricing 
                     WHERE item_id = :item_id";
      $priceStmt = $db->prepare($priceQuery);
      $priceStmt->execute([':item_id' => $itemId]);
      $item['pricing'] = $priceStmt->fetchAll(PDO::FETCH_ASSOC);

      return ['success' => true, 'item' => $item];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::getItemById() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve item'];
    }
  }

  /**
   * Update user information
   */
  public function updateUser($userId, $data): array {
    try {
      $db = $this->connect();
      
      $query = "UPDATE users SET 
                  first_name = :first_name,
                  middle_name = :middle_name,
                  last_name = :last_name,
                  address = :address,
                  email = :email
                WHERE uid = :uid";
      
      $stmt = $db->prepare($query);
      $result = $stmt->execute([
        ':first_name' => $data['first_name'],
        ':middle_name' => $data['middle_name'] ?? null,
        ':last_name' => $data['last_name'],
        ':address' => $data['address'],
        ':email' => $data['email'],
        ':uid' => $userId
      ]);

      if ($result) {
        return ['success' => true];
      } else {
        return ['success' => false, 'error' => 'Update failed'];
      }

    } catch (PDOException $e) {
      // Check for duplicate email
      if ($e->getCode() == 23000) {
        return ['success' => false, 'error' => 'Email already exists'];
      }
      
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::updateUser() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to update user'];
    }
  }

  /**
   * Change user password
   */
  public function changePassword($userId, $currentPassword, $newPassword): array {
    try {
      $db = $this->connect();
      
      // Verify current password
      $query = "SELECT password FROM users WHERE uid = :uid";
      $stmt = $db->prepare($query);
      $stmt->execute([':uid' => $userId]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$user) {
        return ['success' => false, 'error' => 'User not found'];
      }

      // Verify current password (assuming you're using password_hash)
      if (!password_verify($currentPassword, $user['password'])) {
        return ['success' => false, 'error' => 'Current password is incorrect'];
      }

      // Update to new password
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $updateQuery = "UPDATE users SET password = :password WHERE uid = :uid";
      $updateStmt = $db->prepare($updateQuery);
      $updateStmt->execute([
        ':password' => $hashedPassword,
        ':uid' => $userId
      ]);

      return ['success' => true];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::changePassword() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to change password'];
    }
  }

  /**
   * Get user statistics
   */
  public function getUserStatistics($userId): array {
    try {
      $db = $this->connect();
      
      // Total items
      $itemQuery = "SELECT COUNT(*) as total FROM items WHERE owner_uid = :uid";
      $itemStmt = $db->prepare($itemQuery);
      $itemStmt->execute([':uid' => $userId]);
      $totalItems = $itemStmt->fetch(PDO::FETCH_ASSOC)['total'];

      // Active rentals
      $rentalQuery = "SELECT COUNT(*) as total 
                      FROM rentals r
                      INNER JOIN items i ON r.item_id = i.item_id
                      WHERE i.owner_uid = :uid AND r.status IN ('confirmed', 'ongoing')";
      $rentalStmt = $db->prepare($rentalQuery);
      $rentalStmt->execute([':uid' => $userId]);
      $activeRentals = $rentalStmt->fetch(PDO::FETCH_ASSOC)['total'];

      // Total earnings
      $earningsQuery = "SELECT COALESCE(SUM(r.total_amount), 0) as total 
                        FROM rentals r
                        INNER JOIN items i ON r.item_id = i.item_id
                        WHERE i.owner_uid = :uid AND r.status = 'completed'";
      $earningsStmt = $db->prepare($earningsQuery);
      $earningsStmt->execute([':uid' => $userId]);
      $totalEarnings = $earningsStmt->fetch(PDO::FETCH_ASSOC)['total'];

      return [
        'success' => true,
        'statistics' => [
          'total_items' => (int)$totalItems,
          'active_rentals' => (int)$activeRentals,
          'total_earnings' => (float)$totalEarnings
        ]
      ];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::getUserStatistics() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve statistics'];
    }
  }

  /**
   * Check if user exists by email
   */
  public function userExistsByEmail($email): bool {
    try {
      $db = $this->connect();
      $query = "SELECT uid FROM users WHERE email = :email";
      $stmt = $db->prepare($query);
      $stmt->execute([':email' => $email]);
      
      return $stmt->fetch() !== false;

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::userExistsByEmail() Error: ' . $e->getMessage());
      return false;
    }
  }
}