<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';

class AdminModel extends DbConnection {

  public function getAllUsers (): array {
    $query = "SELECT uid, first_name, middle_name, last_name, address, email, id_path, created_at, approval_status, account_status FROM users";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      $users = $stmt->fetchAll();

      return ['success' => true, 'users' => $users];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::getAllUsers() failed - Context: retrieving all users (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to retrieve users'];
    }
  }

  public function getItemOwner($ownerId) {
    $query = "SELECT first_name, middle_name, last_name FROM users WHERE uid = :ownerId";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':ownerId' => $ownerId]);

      $user = $stmt->fetch();

      return ['success' => true, 'user' => $user];

    } catch (PDOException $e) {
      error_log('AdminModel::getItemOwner() failed - Context: retrieving item owner by id (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to retrieve item owner'];
    }
  }

  public function getPendingUsers(): array {
    $query = "SELECT uid, first_name, middle_name, last_name, address, email, id_path, created_at, approval_status FROM users WHERE approval_status = 'pending'";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      $users = $stmt->fetchAll();
      return ['success' => true, 'users' => $users];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::getUsers() failed - Context: retrieving pending users (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to load users list'];
    }
  }

  public function getItems(): array {
    $query = "
        SELECT 
            i.*,
            CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) as owner_name,
            u.email as owner_email,
            MIN(rp.price) as min_price,
            GROUP_CONCAT(DISTINCT rp.rate_type SEPARATOR ', ') as available_rates
        FROM items i
        INNER JOIN users u ON i.owner_uid = u.uid
        LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
        GROUP BY i.item_id, u.uid, u.first_name, u.middle_name, u.last_name, u.email
        ORDER BY i.created_at DESC
    ";

    try {
        $db = $this->connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        $items = $stmt->fetchAll();

        return ['success' => true, 'items' => $items];

    } catch (PDOException $e) {
        error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::getPendingItems() failed - context: retrieving pending items (' . $e->getMessage() . ')');
        return ['success' => false, 'error' => 'Unable to retrieve pending items'];
    }
  }

  public function getPendingItems(): array {
    $query = "
        SELECT 
            i.*,
            CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) as owner_name,
            u.email as owner_email,
            MIN(rp.price) as min_price,
            GROUP_CONCAT(DISTINCT rp.rate_type SEPARATOR ', ') as available_rates
        FROM items i
        INNER JOIN users u ON i.owner_uid = u.uid
        LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
        WHERE i.approval_status = 'pending'
        GROUP BY i.item_id, u.uid, u.first_name, u.middle_name, u.last_name, u.email
        ORDER BY i.created_at DESC
    ";

    try {
        $db = $this->connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        $items = $stmt->fetchAll();

        return ['success' => true, 'items' => $items];

    } catch (PDOException $e) {
        error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::getPendingItems() failed - context: retrieving pending items (' . $e->getMessage() . ')');
        return ['success' => false, 'error' => 'Unable to retrieve pending items'];
    }
  }

  public function approveUser($userId): array {
    $query = "UPDATE users SET approval_status = 'approved', account_status = 'active' WHERE uid = :id AND approval_status = 'pending'";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':id' => $userId]);

      // if no row affected
      if (!$stmt->rowCount() > 0) {
        return ['success' => false, 'error' => 'Unable to approve user (not found or already approved)'];
      }

      // row affected
      return ['success' => true, 'message' => 'User approved successfully'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::approveUser() failed - context: approving user sign up (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to approve user'];
    }
  }

  public function rejectUser($userId): array {
    $query = "UPDATE users SET approval_status = 'rejected' WHERE uid = :uid";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':uid' => $userId]);

      if (!$stmt->rowCount() > 0) {
        return ['success' => false, 'error' => 'Unable to reject user (not found or already rejected)'];
      }

      return ['success' => true, 'message' => 'User rejected successfully!'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::rejectUser() failed - context: rejecting user sign up (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to reject user'];
    }
  }

  public function deleteUserById($userId): array {
    $query = "DELETE FROM users WHERE uid = :uid";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':uid' => $userId]);

      if (!$stmt->rowCount() > 0) {
        return ['success' => false, 'error' => 'User not found'];
      }

      return ['success' => true, 'message' => 'User deleted successfully!'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::deleteUserById() failed - context: deleting user by id (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to delete user']; 
    }
  }

  public function allUserCount(): int {
    $query = "SELECT COUNT(*) as count FROM users";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      return (int) $stmt->fetch()['count'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::allUserCount() failed - context: retrieving all user count (' . $e->getMessage() . ')');
      return 0;
    }
  } 

  public function pendingUsersCount(): int {
    $query = "SELECT COUNT(*) as count FROM users WHERE approval_status = 'pending'";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      return (int) $stmt->fetch()['count'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::pendingUsersCount() failed - context: retrieving pending users count (' . $e->getMessage() . ')');
      return 0;
    }
  }

  public function allItemsCount (): int {
    $query = "SELECT COUNT(*) as count FROM items";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      return (int) $stmt->fetch()['count'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::allItemsCount() failed - context: retrieving all items count (' . $e->getMessage() . ')');
      return 0;
    }
  }

  public function pendingItemsCount (): int {
    $query = "SELECT COUNT(*) as count FROM items WHERE approval_status = 'pending'";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      return (int) $stmt->fetch()['count'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] AdminModel::pendingItemsCount() failed - context: retrieving pending items count (' . $e->getMessage() . ')');
      return 0;
    }
  }

  public function approveItem ($itemId): array {
    $query = "UPDATE items SET approval_status = 'approved' WHERE item_id = :itemId";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':itemId' => $itemId]);
      
      if (!$stmt->rowCount() > 0) {
        return  ['success' => false, 'error' => 'Unable to approve item (item id not found or item already approved)'];
      }

      return ['success' => true, 'message' => 'Item approved successfully!'];

    } catch (PDOException $e) {
      error_log('AdminModel::approveItem() failed - context: approving pending item (' . $e->getMessage() . ')');
      return  ['success' => false, 'error' => 'Unable to approve item'];
    }
  }

    public function rejectItem ($itemId): array {
    $query = "UPDATE items SET approval_status = 'rejected' WHERE item_id = :itemId";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':itemId' => $itemId]);
      
      if (!$stmt->rowCount() > 0) {
        return  ['success' => false, 'error' => 'Unable to reject item (item id not found or item already rejected)'];
      }

      return ['success' => true, 'message' => 'Item rejected successfully!'];

    } catch (PDOException $e) {
      error_log('AdminModel::approveItem() failed - context: approving pending item (' . $e->getMessage() . ')');
      return  ['success' => false, 'error' => 'Unable to reject item'];
    }
  }
}