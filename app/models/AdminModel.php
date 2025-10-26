<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';

class AdminModel extends DbConnection {

  public function getAllUsers (): array {
    $query = "SELECT uid, first_name, middle_name, last_name, address, email, id_path, created_at, approval_status FROM users";

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

  public function approveUser($userId): array {
    $query = "UPDATE users SET approval_status = 'approved' WHERE uid = :id AND approval_status = 'pending'";

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
}