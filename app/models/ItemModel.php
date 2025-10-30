<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';

// class ItemModel extends DbConnection {
//   public function createItem($ownerId, $title, $description, $location, $itemCondition, $imagesPath){
//     $query = "INSERT INTO items (
//       owner_uid,
//       title,
//       description,
//       location,
//       item_condition,
//       created_at,
//       updated_at
//     )
//     VALUES (
//       :ownerId,
//       :title,
//       :description,
//       :location,
//       :itemCondition,
//       NOW(),
//       NOW()
//     )";

//     try {
//       $db = $this->connect();
//       $stmt = $db->prepare($query);

//       $status = $stmt->execute([
//         ':ownerId'       => $ownerId,
//         ':title'         => $title,
//         ':description'   => $description,
//         ':location'      => $location,
//         ':itemCondition' => $itemCondition
//       ]);

//       if (!$status) {
//         return ['success' => false, 'error' => 'DATABASE_ERROR'];
//       }

//       if($stmt->rowCount() <= 0){
//         return ['success' => false, 'error' => 'NO_ROWS_INSERTED'];
//       }

//       $itemId = (int) $db->lastInsertId();
      
//       $imageInsertionResult = $this->createItemImages($db, $itemId, $imagesPath);

//       if(!$imageInsertionResult['success']){
//         return ['success' => false, 'error' => 'Failed to insert images'];
//       }

//     } catch (PDOException $e) {

//     }
//   }

//   // public function createItemImage($itemId, $images){
//   //   $query = "INSERT INTO item_images (item_id, image_path, is_primary) VALUES (:itemId, :imagePath, :isPrimary)";

//   //   try {
//   //     $db = $this->connect();
//   //     $stmt = $db->prepare($query);

//   //     $images = [
//   //       $images[0] => true,
//   //       $images[1] => false,
//   //       $images[3] => false
//   //     ];

//   //     foreach($images as $path => $isPrimary){
//   //       $stmt->execute([
//   //         ':itemId'    => $itemId,
//   //         ':imagePath' => $path,
//   //         ':isPrimary' => $isPrimary
//   //       ]); 
//   //     }
//   //   } catch (PDOException $e) {

//   //   }
//   // }

//   /**
//    * Insert item images
//    */
//   private function createItemImages(PDO $db, int $itemId, array $imagePaths): array {
//     try {
//       $query = "INSERT INTO item_images (item_id, image_path, is_primary) 
//                 VALUES (:itemId, :imagePath, :isPrimary)";
      
//       $stmt = $db->prepare($query);

//       // First image is primary
//       foreach ($imagePaths as $index => $path) {
//         $isPrimary = ($index === 0) ? 1 : 0;
        
//         $stmt->execute([
//           ':itemId'    => $itemId,
//           ':imagePath' => $path,
//           ':isPrimary' => $isPrimary
//         ]);
//       }

//       return ['success' => true];

//     } catch (PDOException $e) {
//       error_log("ItemModel::createItemImages Error: " . $e->getMessage());
//       return ['success' => false, 'error' => 'Failed to insert images'];
//     }
//   }
// }

class ItemModel extends DbConnection {
  
  /**
   * Create item with all related data
   */
  public function createItem(int $ownerId, array $data, array $imagePaths): array {
    try {
      $db = $this->connect();
      
      // Start transaction
      $db->beginTransaction();

      // 1. Insert item
      $itemId = $this->insertItem($db, $ownerId, $data);
      if (!$itemId) {
        $db->rollBack();
        return ['success' => false, 'error' => 'Failed to insert item'];
      }

      // 2. Insert images
      $imageResult = $this->insertItemImages($db, $itemId, $imagePaths);
      if (!$imageResult['success']) {
        $db->rollBack();
        return ['success' => false, 'error' => 'Failed to insert images'];
      }

      // 3. Insert rental pricing
      $pricingResult = $this->insertRentalPricing($db, $itemId, $data);
      if (!$pricingResult['success']) {
        $db->rollBack();
        return ['success' => false, 'error' => 'Failed to insert pricing'];
      }

      // 4. Insert availability
      $availabilityResult = $this->insertAvailability($db, $itemId, $data);
      if (!$availabilityResult['success']) {
        $db->rollBack();
        return ['success' => false, 'error' => 'Failed to insert availability'];
      }

      // Commit transaction
      $db->commit();
      
      return ['success' => true, 'item_id' => $itemId];

    } catch (PDOException $e) {
      if (isset($db) && $db->inTransaction()) {
        $db->rollBack();
      }
      error_log("ItemModel::createItem Error: " . $e->getMessage());
      return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
  }

  /**
   * Insert item into items table
   */
  private function insertItem(PDO $db, int $ownerId, array $data): ?int {
    $query = "INSERT INTO items (
      owner_uid,
      title,
      description,
      category,
      quantity,
      brand,
      location,
      item_condition,
      return_statement,
      security_deposit,
      created_at,
      updated_at
    ) VALUES (
      :ownerId,
      :title,
      :description,
      :category,
      :quantity,
      :brand,
      :location,
      :itemCondition,
      :returnStatement,
      :securityDeposit,
      NOW(),
      NOW()
    )";

    $stmt = $db->prepare($query);
    $status = $stmt->execute([
      ':ownerId'         => $ownerId,
      ':title'           => $data['itemName'],
      ':description'     => $data['description'],
      ':category'        => $data['category'],
      ':quantity'        => $data['quantity'],
      ':brand'           => $data['brand'],
      ':location'        => $data['pickUpLocation'],
      ':itemCondition'   => $data['itemCondition'],
      ':returnStatement' => $data['returnStatement'],
      ':securityDeposit' => $data['securityDeposit']
    ]);

    if (!$status || $stmt->rowCount() <= 0) {
      return null;
    }

    return (int) $db->lastInsertId();
  }

  /**
   * Insert item images
   */
  private function insertItemImages(PDO $db, int $itemId, array $imagePaths): array {
    try {
      $query = "INSERT INTO item_images (item_id, image_path, is_primary) 
                VALUES (:itemId, :imagePath, :isPrimary)";
      
      $stmt = $db->prepare($query);

      // First image is primary
      foreach ($imagePaths as $index => $path) {
        $isPrimary = ($index === 0) ? 1 : 0;
        
        $stmt->execute([
          ':itemId'    => $itemId,
          ':imagePath' => $path,
          ':isPrimary' => $isPrimary
        ]);
      }

      return ['success' => true];

    } catch (PDOException $e) {
      error_log("ItemModel::insertItemImages Error: " . $e->getMessage());
      return ['success' => false, 'error' => 'Failed to insert images'];
    }
  }

  /**
   * Insert rental pricing
   */
  private function insertRentalPricing(PDO $db, int $itemId, array $data): array {
    try {
      // Map rate type
      $rateTypeMap = [
        'day' => 'per_day',
        'week' => 'per_week',
        'month' => 'per_month'
      ];
      
      $rateType = $rateTypeMap[$data['priceRate']] ?? 'per_day';

      $query = "INSERT INTO rental_pricing (
        item_id,
        rate_type,
        price,
        minimum_duration,
        minimum_duration_unit,
        maximum_duration,
        maximum_duration_unit
      ) VALUES (
        :itemId,
        :rateType,
        :price,
        :minDuration,
        :minDurationUnit,
        :maxDuration,
        :maxDurationUnit
      )";

      $stmt = $db->prepare($query);
      $stmt->execute([
        ':itemId'          => $itemId,
        ':rateType'        => $rateType,
        ':price'           => $data['rentalPrice'],
        ':minDuration'     => $data['minDuration'],
        ':minDurationUnit' => $data['minDurationUnit'],
        ':maxDuration'     => $data['maxDuration'],
        ':maxDurationUnit' => $data['maxDurationUnit']
      ]);

      return ['success' => true];

    } catch (PDOException $e) {
      error_log("ItemModel::insertRentalPricing Error: " . $e->getMessage());
      return ['success' => false, 'error' => 'Failed to insert pricing'];
    }
  }

  /**
   * Insert availability
   */
  private function insertAvailability(PDO $db, int $itemId, array $data): array {
    try {
      $query = "INSERT INTO item_availability (
        item_id,
        available_from,
        available_until
      ) VALUES (
        :itemId,
        :availableFrom,
        :availableUntil
      )";

      $stmt = $db->prepare($query);
      $stmt->execute([
        ':itemId'         => $itemId,
        ':availableFrom'  => $data['availableFrom'],
        ':availableUntil' => $data['availableUntil']
      ]);

      return ['success' => true];

    } catch (PDOException $e) {
      error_log("ItemModel::insertAvailability Error: " . $e->getMessage());
      return ['success' => false, 'error' => 'Failed to insert availability'];
    }
  }

  /**
   * Get cancellation policy ID by name
   */
  public function getCancellationPolicyId(string $policyName): ?int {
    try {
      $db = $this->connect();
      
      $query = "SELECT policy_id FROM cancellation_policies WHERE name = :name LIMIT 1";
      $stmt = $db->prepare($query);
      $stmt->execute([':name' => $policyName]);
      
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result ? (int) $result['policy_id'] : null;

    } catch (PDOException $e) {
      error_log("ItemModel::getCancellationPolicyId Error: " . $e->getMessage());
      return null;
    }
  }

  /**
   * Get item with all related data
   */
  public function getItemById(int $itemId): ?array {
    try {
      $db = $this->connect();
      
      $query = "SELECT i.*, 
                       u.first_name, u.last_name,
                       rp.price, rp.rate_type, rp.minimum_duration, rp.minimum_duration_unit,
                       rp.maximum_duration, rp.maximum_duration_unit,
                       ia.available_from, ia.available_until,
                       GROUP_CONCAT(
                         CONCAT(img.image_id, ':', img.image_path, ':', img.is_primary)
                         ORDER BY img.is_primary DESC, img.image_id
                         SEPARATOR '|'
                       ) as images
                FROM items i
                LEFT JOIN users u ON i.owner_uid = u.uid
                LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
                LEFT JOIN item_availability ia ON i.item_id = ia.item_id
                LEFT JOIN item_images img ON i.item_id = img.item_id
                WHERE i.item_id = :itemId
                GROUP BY i.item_id";
      
      $stmt = $db->prepare($query);
      $stmt->execute([':itemId' => $itemId]);
      
      $item = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if ($item && $item['images']) {
        // Parse images
        $imageData = [];
        $images = explode('|', $item['images']);
        foreach ($images as $img) {
          list($id, $path, $isPrimary) = explode(':', $img);
          $imageData[] = [
            'image_id' => (int) $id,
            'path' => $path,
            'is_primary' => (bool) $isPrimary
          ];
        }
        $item['images'] = $imageData;
      } else {
        $item['images'] = [];
      }
      
      return $item ?: null;

    } catch (PDOException $e) {
      error_log("ItemModel::getItemById Error: " . $e->getMessage());
      return null;
    }
  }

  /**
   * Get all available items with their primary image and owner info
   * 
   * @param int $limit Number of items to fetch
   * @param int $offset Offset for pagination
   * @return array List of items
   */
  public function getAllItems(int $limit = 12, int $offset = 0): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  i.item_id,
                  i.title,
                  i.description,
                  i.category,
                  i.location,
                  i.item_condition,
                  i.status,
                  i.created_at,
                  u.uid as owner_id,
                  u.first_name,
                  u.last_name,
                  rp.price,
                  rp.rate_type,
                  img.image_path as primary_image
                FROM items i
                INNER JOIN users u ON i.owner_uid = u.uid
                LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
                LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
                WHERE i.approval_status = 'approved'
                ORDER BY i.created_at DESC
                LIMIT :limit OFFSET :offset";
      
      $stmt = $db->prepare($query);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
      $stmt->execute();
      
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      error_log("ItemModel::getAllItems Error: " . $e->getMessage());
      return [];
    }
  }

  /**
   * Get recently added items
   * 
   * @param int $limit Number of items to fetch
   * @return array List of recent items
   */
  public function getRecentItems(int $limit = 3): array {
    return $this->getAllItems($limit, 0);
  }

  /**
   * Get items by category
   * 
   * @param string $category Category name
   * @param int $limit Number of items to fetch
   * @return array List of items in category
   */
  public function getItemsByCategory(string $category, int $limit = 12): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  i.item_id,
                  i.title,
                  i.description,
                  i.category,
                  i.location,
                  i.item_condition,
                  i.status,
                  u.uid as owner_id,
                  u.first_name,
                  u.last_name,
                  rp.price,
                  rp.rate_type,
                  img.image_path as primary_image
                FROM items i
                INNER JOIN users u ON i.owner_uid = u.uid
                LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
                LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
                WHERE i.status = 'available' AND i.category = :category
                ORDER BY i.created_at DESC
                LIMIT :limit";
      
      $stmt = $db->prepare($query);
      $stmt->bindValue(':category', $category, PDO::PARAM_STR);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->execute();
      
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      error_log("ItemModel::getItemsByCategory Error: " . $e->getMessage());
      return [];
    }
  }

  /**
   * Search items by query
   * 
   * @param string $searchQuery Search term
   * @param int $limit Number of items to fetch
   * @return array List of matching items
   */
  public function searchItems(string $searchQuery, int $limit = 12): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  i.item_id,
                  i.title,
                  i.description,
                  i.category,
                  i.location,
                  i.item_condition,
                  i.status,
                  u.uid as owner_id,
                  u.first_name,
                  u.last_name,
                  rp.price,
                  rp.rate_type,
                  img.image_path as primary_image
                FROM items i
                INNER JOIN users u ON i.owner_uid = u.uid
                LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
                LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
                WHERE i.status = 'available' 
                AND (i.title LIKE :search OR i.description LIKE :search OR i.brand LIKE :search)
                ORDER BY i.created_at DESC
                LIMIT :limit";
      
      $stmt = $db->prepare($query);
      $searchTerm = '%' . $searchQuery . '%';
      $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
      $stmt->execute();
      
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      error_log("ItemModel::searchItems Error: " . $e->getMessage());
      return [];
    }
  }

  /**
   * Get total count of available items
   * 
   * @return int Total count
   */
  public function getTotalItemsCount(): int {
    try {
      $db = $this->connect();
      
      $query = "SELECT COUNT(*) as total FROM items WHERE status = 'available'";
      $stmt = $db->query($query);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
      return (int) ($result['total'] ?? 0);

    } catch (PDOException $e) {
      error_log("ItemModel::getTotalItemsCount Error: " . $e->getMessage());
      return 0;
    }
  }
}