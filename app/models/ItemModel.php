<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';

class ItemModel extends DbConnection {
  public function createItem($ownerId, $title, $description, $location, $itemCondition){
    $query = "INSERT INTO items (
      owner_uid,
      title,
      description,
      location,
      item_condition,
      created_at,
      updated_at
    )
    VALUES (
      :ownerId,
      :title,
      :description,
      :location,
      :itemCondition,
      NOW(),
      NOW()
    )";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);

      $status = $stmt->execute([
        ':ownerId'       => $ownerId,
        ':title'         => $title,
        ':description'   => $description,
        ':location'      => $location,
        ':itemCondition' => $itemCondition
      ]);

      if (!$status) {
        return ['success' => false, 'error' => 'DATABASE_ERROR'];
      }

      if($stmt->rowCount() <= 0){
        return ['success' => false, 'error' => 'NO_ROWS_INSERTED'];
      }

      $itemId = $db->lastInsertId();

    } catch (PDOException $e) {

    }
  }
}