<?php 
require_once dirname(__DIR__) . '/core/DbConnection.php';

class RentalModel extends DbConnection {
  
  /**
   * Create new rental
   */
  public function createRental($data): array {
    $query = "INSERT INTO rentals 
              (item_id, renter_uid, pricing_id, policy_id, start_date, end_date, total_amount, status)
              VALUES 
              (:item_id, :renter_uid, :pricing_id, :policy_id, :start_date, :end_date, :total_amount, :status)";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      
      $result = $stmt->execute([
        ':item_id' => $data['item_id'],
        ':renter_uid' => $data['renter_uid'],
        ':pricing_id' => $data['pricing_id'],
        ':policy_id' => $data['policy_id'] ?? null,
        ':start_date' => $data['start_date'],
        ':end_date' => $data['end_date'],
        ':total_amount' => $data['total_amount'],
        ':status' => $data['status'] ?? 'pending'
      ]);

      if ($result && $stmt->rowCount() > 0) {
        $rentalID = (int) $db->lastInsertId();
        $this->createPayment($rentalID, $data);
        return ['success' => true, 'rental_id' => $rentalID];
      }

      return ['success' => false, 'error' => 'Failed to create rental'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::createRental() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to create rental'];
    }
  }

  public function createPayment($rentalId, $data): array {
    $query = "INSERT INTO payment(
      rental_id,
      payment_method,
      amount,
      security_deposit,
      total_amount,
      verified_by
    )
    VALUES
    (
      :rentalId,
      :paymentMethod,
      :amount,
      :securityDeposit,
      :totalAmount,
      :verifiedBy
    )";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([
        ':rentalId' => $rentalId,
        ':paymentMethod' => $data['paymentMethod'],
        ':amount' => $data['amount'],
        ':securityDeposit' => $data['securityDeposit'],
        ':totalAmount' => $data['totalAmount'],
        ':verifiedBy' => $data['adminID'],
      ]);

      if($stmt->rowCount() > 0){
        return ['success' => true, 'message' => 'Payment recorded successfully'];
      } else {
        return ['success' => false, 'error' => 'Payment could not be processed. Please try again or contact support.'];
      }

    } catch (PDOException $e) {
      error_log('RentalModel::createPayment() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to record payment'];
    }
  }

  /**
   * Get rental by ID
   */
  public function getRentalById($rentalId): array {
    $query = "SELECT 
                r.*,
                i.title,
                i.category,
                i.location,
                i.owner_uid,
                i.security_deposit,
                u.first_name,
                u.last_name,
                u.email,
                rp.rate_type,
                rp.price,
                cp.name as policy_name,
                cp.refund_percentage,
                img.image_path as primary_image
              FROM rentals r
              LEFT JOIN items i ON r.item_id = i.item_id
              LEFT JOIN users u ON r.renter_uid = u.uid
              LEFT JOIN rental_pricing rp ON r.pricing_id = rp.pricing_id
              LEFT JOIN cancellation_policies cp ON r.policy_id = cp.policy_id
              LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
              WHERE r.rental_id = :rental_id
              LIMIT 1";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':rental_id' => $rentalId]);

      $rental = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$rental) {
        return ['success' => false, 'error' => 'Rental not found'];
      }

      return ['success' => true, 'rental' => $rental];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::getRentalById() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve rental'];
    }
  }

  /**
   * Get all rentals by renter (user who rents)
   */
  public function getRentalsByRenter($renterUid): array {
    $query = "SELECT 
                r.*,
                i.title,
                i.category,
                i.location,
                img.image_path as primary_image,
                rp.rate_type,
                rp.price
              FROM rentals r
              LEFT JOIN items i ON r.item_id = i.item_id
              LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
              LEFT JOIN rental_pricing rp ON r.pricing_id = rp.pricing_id
              WHERE r.renter_uid = :renter_uid
              ORDER BY r.created_at DESC";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':renter_uid' => $renterUid]);

      $rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return ['success' => true, 'rentals' => $rentals];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::getRentalsByRenter() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve rentals'];
    }
  }

  /**
   * Get all rentals by owner (user who owns the items)
   */
  public function getRentalsByOwner($ownerUid): array {
    $query = "SELECT 
                r.*,
                i.title,
                i.category,
                i.location,
                u.first_name as renter_first_name,
                u.last_name as renter_last_name,
                u.email as renter_email,
                img.image_path as primary_image,
                rp.rate_type,
                rp.price
              FROM rentals r
              LEFT JOIN items i ON r.item_id = i.item_id
              LEFT JOIN users u ON r.renter_uid = u.uid
              LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
              LEFT JOIN rental_pricing rp ON r.pricing_id = rp.pricing_id
              WHERE i.owner_uid = :owner_uid
              ORDER BY r.created_at DESC";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':owner_uid' => $ownerUid]);

      $rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return ['success' => true, 'rentals' => $rentals];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::getRentalsByOwner() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve rentals'];
    }
  }

  /**
   * Update rental status
   */
  public function updateStatus($rentalId, $status): array {
    $query = "UPDATE rentals 
              SET status = :status 
              WHERE rental_id = :rental_id";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      
      $result = $stmt->execute([
        ':status' => $status,
        ':rental_id' => $rentalId
      ]);

      if ($result) {
        return ['success' => true];
      }

      return ['success' => false, 'error' => 'Failed to update status'];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::updateStatus() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to update rental status'];
    }
  }

  /**
   * Check if item is available for given dates
   */
  public function checkAvailability($itemId, $startDate, $endDate): array {
    $query = "SELECT COUNT(*) as conflict_count
              FROM item_availability
              WHERE item_id = 22
              AND ('2025-11-07' >= available_from AND '2025-11-07' <= available_until)";
              /*
              FROM item_availability
              WHERE item_id = :item_id
              AND (
                  (start_date <= :start_date AND end_date >= :start_date)
                  OR (start_date <= :end_date AND end_date >= :end_date)
                  OR (start_date >= :start_date AND end_date <= :end_date)
              )";
              */

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([
        ':item_id' => $itemId,
        ':start_date' => $startDate,
        ':end_date' => $endDate
      ]);

      $row = $stmt->fetch();
      $isAvailable = $row['conflict_count'] == 0;

      return [
        'success' => true, 
        'available' => $isAvailable,
        'conflicts' => (int)$row['conflict_count']
      ];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::checkAvailability() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to check availability'];
    }
  }

  /**
   * Calculate rental duration in days
   */
  public function calculateDuration($startDate, $endDate): int {
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $interval = $start->diff($end);
    return $interval->days + 1; // Include both start and end date
  }

  /**
   * Get active rentals count for specific item
   */
  public function getActiveRentalsCount($itemId): array {
    $query = "SELECT COUNT(*) as active_count
              FROM rentals
              WHERE item_id = :item_id
              AND status IN ('confirmed', 'ongoing')";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':item_id' => $itemId]);

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      return [
        'success' => true, 
        'count' => (int) $row['active_count']
      ];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::getActiveRentalsCount() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to get active rentals count'];
    }
  }

  /**
   * Cancel rental
   */
  public function cancelRental($rentalId): array {
    return $this->updateStatus($rentalId, 'cancelled');
  }

  /**
   * Complete rental
   */
  public function completeRental($rentalId): array {
    return $this->updateStatus($rentalId, 'completed');
  }

  /**
   * Confirm rental
   */
  public function confirmRental($rentalId): array {
    return $this->updateStatus($rentalId, 'confirmed');
  }

  /**
   * Get item details for checkout
   */
  public function getItemForCheckout($itemId): array {
    $query = "SELECT 
                i.*,
                u.uid as owner_id,
                u.first_name as owner_first_name,
                u.last_name as owner_last_name,
                img.image_path as primary_image,
                rp.pricing_id,
                rp.rate_type,
                rp.price,
                rp.minimum_duration,
                rp.maximum_duration,
                rp.minimum_duration_unit,
                rp.maximum_duration_unit,
                ia.available_from,
                ia.available_until
              FROM items i
              LEFT JOIN users u ON i.owner_uid = u.uid
              LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
              LEFT JOIN rental_pricing rp ON i.item_id = rp.item_id
              LEFT JOIN item_availability ia ON ia.item_id = i.item_id
              WHERE i.item_id = :item_id 
              AND i.status = 'available'
              AND i.approval_status = 'approved'";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute([':item_id' => $itemId]);

      $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (empty($items)) {
        return ['success' => false, 'error' => 'Item not found or not available'];
      }

      // Group pricing options
      $item = $items[0];
      $item['pricing_options'] = [];
      
      foreach ($items as $row) {
        if ($row['pricing_id']) {
          $item['pricing_options'][] = [
            'pricing_id' => $row['pricing_id'],
            'rate_type' => $row['rate_type'],
            'price' => $row['price'],
            'minimum_duration' => $row['minimum_duration'],
            'minimum_duration_unit' => $row['minimum_duration_unit']
          ];
        }
      }

      // Remove duplicate fields
      unset($item['pricing_id'], $item['rate_type'], $item['price'], 
            $item['minimum_duration'], $item['minimum_duration_unit']);

      return ['success' => true, 'item' => $item];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::getItemForCheckout() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve item'];
    }
  }

  /**
   * Get all cancellation policies
   */
  public function getCancellationPolicies(): array {
    $query = "SELECT policy_id, name, description, refund_percentage 
              FROM cancellation_policies
              ORDER BY refund_percentage DESC";

    try {
      $db = $this->connect();
      $stmt = $db->prepare($query);
      $stmt->execute();

      $policies = $stmt->fetchAll(PDO::FETCH_ASSOC);

      return ['success' => true, 'policies' => $policies];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] RentalModel::getCancellationPolicies() Error: ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve policies'];
    }
  }
}