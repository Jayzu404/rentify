<?php 

require_once dirname(__DIR__) . '/core/DbConnection.php';

class UserModel extends DbConnection {
  public function getUserById($userId): array {
    $query = "SELECT * FROM users WHERE uid = :uid";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':uid' => $userId]);

      $user = $stmt->fetch();

      return ['success' => true, 'user' => $user];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] UserModel::getUserById() failed - context: retrieving user by Id (' . $e->getMessage() . ')');
      return ['success' => false, 'error' => 'Unable to retrieve user'];
    }
  }
}