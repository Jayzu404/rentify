<?php
require_once dirname(__DIR__) . '/core/DbConnection.php';

class UserDashboardModel extends DbConnection {

  /**
   * Get user statistics for dashboard
   * Returns: total items, active rentals, pending requests, total earnings
   */
  public function getUserStats($userId): array {
    try {
      $db = $this->connect();
      
      // Get total items count (approved only)
      $itemQuery = "SELECT COUNT(*) as total_items 
                    FROM items 
                    WHERE owner_uid = :user_id AND approval_status = 'approved'";
      $itemStmt = $db->prepare($itemQuery);
      $itemStmt->execute([':user_id' => $userId]);
      $totalItems = $itemStmt->fetch(PDO::FETCH_ASSOC)['total_items'];

      // Get active rentals count (confirmed or ongoing)
      $activeQuery = "SELECT COUNT(*) as active_rentals 
                      FROM rentals r
                      INNER JOIN items i ON r.item_id = i.item_id
                      WHERE i.owner_uid = :user_id 
                      AND r.status IN ('confirmed', 'ongoing')";
      $activeStmt = $db->prepare($activeQuery);
      $activeStmt->execute([':user_id' => $userId]);
      $activeRentals = $activeStmt->fetch(PDO::FETCH_ASSOC)['active_rentals'];

      // Get pending requests count
      $pendingQuery = "SELECT COUNT(*) as pending_requests 
                       FROM rentals r
                       INNER JOIN items i ON r.item_id = i.item_id
                       WHERE i.owner_uid = :user_id 
                       AND r.status = 'pending'";
      $pendingStmt = $db->prepare($pendingQuery);
      $pendingStmt->execute([':user_id' => $userId]);
      $pendingRequests = $pendingStmt->fetch(PDO::FETCH_ASSOC)['pending_requests'];

      // Get total earnings (from completed rentals)
      $earningsQuery = "SELECT COALESCE(SUM(r.total_amount), 0) as total_earnings 
                        FROM rentals r
                        INNER JOIN items i ON r.item_id = i.item_id
                        WHERE i.owner_uid = :user_id 
                        AND r.status = 'completed'";
      $earningsStmt = $db->prepare($earningsQuery);
      $earningsStmt->execute([':user_id' => $userId]);
      $totalEarnings = $earningsStmt->fetch(PDO::FETCH_ASSOC)['total_earnings'];

      return [
        'success' => true,
        'stats' => [
          'total_items' => (int)$totalItems,
          'active_rentals' => (int)$activeRentals,
          'pending_requests' => (int)$pendingRequests,
          'total_earnings' => (float)$totalEarnings
        ]
      ];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardModel::getUserStats() failed - ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve user statistics'];
    }
  }

  /**
   * Get pending rental requests for user's items
   * Returns list of pending requests with renter info and item details
   */
  public function getPendingRequests($userId): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  r.rental_id as id,
                  p.payment_status,
                  i.title as item_name,
                  img.image_path as item_image,
                  CONCAT(u.first_name, ' ', u.last_name) as renter_name,
                  CONCAT(DATE_FORMAT(r.start_date, '%b %d'), ' - ', DATE_FORMAT(r.end_date, '%b %d')) as rental_period,
                  r.total_amount as price,
                  CASE
                    WHEN TIMESTAMPDIFF(HOUR, r.created_at, NOW()) < 1 
                      THEN CONCAT(TIMESTAMPDIFF(MINUTE, r.created_at, NOW()), 'm ago')
                    WHEN TIMESTAMPDIFF(HOUR, r.created_at, NOW()) < 24 
                      THEN CONCAT(TIMESTAMPDIFF(HOUR, r.created_at, NOW()), 'h ago')
                    ELSE CONCAT(TIMESTAMPDIFF(DAY, r.created_at, NOW()), 'd ago')
                  END as requested_at
                FROM rentals r
                INNER JOIN payment p ON p.rental_id = r.rental_id
                INNER JOIN items i ON r.item_id = i.item_id
                INNER JOIN users u ON r.renter_uid = u.uid
                LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
                WHERE i.owner_uid = :user_id 
                AND r.status = 'pending' AND p.payment_status = 'verified'
                ORDER BY r.created_at DESC";
      
      $stmt = $db->prepare($query);
      $stmt->execute([':user_id' => $userId]);
      $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Provide default image if none exists
      foreach ($requests as &$request) {
        if (empty($request['item_image'])) {
          $request['item_image'] = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300';
        }
      }

      return ['success' => true, 'requests' => $requests];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardModel::getPendingRequests() failed - ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve pending requests'];
    }
  }

  /**
   * Get all listings for a user with detailed statistics
   * Returns: items with pricing, stats, current rentals, upcoming bookings
   */
  public function getUserListings($userId): array {
    try {
      $db = $this->connect();
      
      $query = "SELECT 
                  i.item_id as id,
                  i.title as name,
                  img.image_path as image,
                  i.category,
                  i.brand,
                  i.item_condition,
                  i.quantity as total_quantity,
                  (i.quantity - COALESCE(rented.rented_count, 0)) as available_quantity,
                  i.status,
                  i.approval_status,
                  i.security_deposit,
                  i.created_at,
                  rp_day.price as price_per_day,
                  rp_week.price as price_per_week,
                  rp_month.price as price_per_month,
                  COALESCE(stats.total_views, 0) as views,
                  COALESCE(stats.total_bookings, 0) as bookings,
                  COALESCE(stats.total_earnings, 0) as total_earnings,
                  upcoming.upcoming_count as upcoming_bookings
                FROM items i
                LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
                LEFT JOIN rental_pricing rp_day ON i.item_id = rp_day.item_id AND rp_day.rate_type = 'per_day'
                LEFT JOIN rental_pricing rp_week ON i.item_id = rp_week.item_id AND rp_week.rate_type = 'per_week'
                LEFT JOIN rental_pricing rp_month ON i.item_id = rp_month.item_id AND rp_month.rate_type = 'per_month'
                LEFT JOIN (
                  SELECT item_id, COUNT(*) as rented_count
                  FROM rentals
                  WHERE status IN ('confirmed', 'ongoing')
                  GROUP BY item_id
                ) rented ON i.item_id = rented.item_id
                LEFT JOIN (
                  SELECT 
                    item_id,
                    0 as total_views,
                    COUNT(*) as total_bookings,
                    SUM(total_amount) as total_earnings
                  FROM rentals
                  WHERE status = 'completed'
                  GROUP BY item_id
                ) stats ON i.item_id = stats.item_id
                LEFT JOIN (
                  SELECT item_id, COUNT(*) as upcoming_count
                  FROM rentals
                  WHERE status = 'confirmed' AND start_date > CURDATE()
                  GROUP BY item_id
                ) upcoming ON i.item_id = upcoming.item_id
                WHERE i.owner_uid = :user_id
                ORDER BY i.created_at DESC";
      
      $stmt = $db->prepare($query);
      $stmt->execute([':user_id' => $userId]);
      $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Process listings data
      foreach ($listings as &$listing) {
        // Provide default image if none exists
        if (empty($listing['image'])) {
          $listing['image'] = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300';
        }

        // Get current rental info if item is rented
        $listing['current_rental'] = null;
        if ($listing['status'] === 'rented') {
          $rentalQuery = "SELECT 
                            CONCAT(u.first_name, ' ', u.last_name) as renter,
                            r.end_date,
                            DATEDIFF(r.end_date, CURDATE()) as days_remaining
                          FROM rentals r
                          INNER JOIN users u ON r.renter_uid = u.uid
                          WHERE r.item_id = :item_id 
                          AND r.status = 'ongoing'
                          ORDER BY r.end_date ASC
                          LIMIT 1";
          $rentalStmt = $db->prepare($rentalQuery);
          $rentalStmt->execute([':item_id' => $listing['id']]);
          $listing['current_rental'] = $rentalStmt->fetch(PDO::FETCH_ASSOC);
        }

        // Convert numeric strings to proper types
        $listing['total_quantity'] = (int)$listing['total_quantity'];
        $listing['available_quantity'] = (int)$listing['available_quantity'];
        $listing['views'] = (int)$listing['views'];
        $listing['bookings'] = (int)$listing['bookings'];
        $listing['total_earnings'] = (float)$listing['total_earnings'];
        $listing['upcoming_bookings'] = (int)($listing['upcoming_bookings'] ?? 0);
        $listing['price_per_day'] = (float)($listing['price_per_day'] ?? 0);
        $listing['price_per_week'] = (float)($listing['price_per_week'] ?? 0);
        $listing['price_per_month'] = (float)($listing['price_per_month'] ?? 0);
        $listing['security_deposit'] = (float)($listing['security_deposit'] ?? 0);
      }

      return ['success' => true, 'listings' => $listings];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardModel::getUserListings() failed - ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to retrieve listings'];
    }
  }

  /**
   * Handle rental request (accept or decline)
   * Updates rental status and item status accordingly
   */
  public function handleRentalRequest($requestId, $action, $userId): array {
    try {
      $db = $this->connect();
      
      // First verify that this rental request belongs to an item owned by this user
      $verifyQuery = "SELECT r.rental_id, r.item_id, r.start_date, i.owner_uid
                      FROM rentals r
                      INNER JOIN items i ON r.item_id = i.item_id
                      WHERE r.rental_id = :rental_id AND i.owner_uid = :user_id AND r.status = 'pending'";
      $verifyStmt = $db->prepare($verifyQuery);
      $verifyStmt->execute([
        ':rental_id' => $requestId,
        ':user_id' => $userId
      ]);
      
      $rental = $verifyStmt->fetch();
      
      if (!$rental) {
        return ['success' => false, 'error' => 'Rental request not found or unauthorized'];
      }

      // Update rental status
      $ownerResponse = ($action === 'accept') ? 'accepted' : 'rejected';
      $newStats = ($ownerResponse === 'accepted') ? 'accepted' : 'declined';
      
      $updateQuery = "UPDATE rentals 
                      SET owner_response = :owner_response, status = :new_status
                      WHERE rental_id = :rental_id";
      $updateStmt = $db->prepare($updateQuery);
      $updateStmt->execute([
        ':owner_response' => $ownerResponse,
        ':new_status' => $newStats,
        ':rental_id' => $requestId
      ]);

      // If accepted and start date is today or past, update item status to rented
      if ($action === 'accept') {
        if (strtotime($rental['start_date']) <= time()) {
          $updateItemQuery = "UPDATE items SET status = 'rented' WHERE item_id = :item_id";
          $updateItemStmt = $db->prepare($updateItemQuery);
          $updateItemStmt->execute([':item_id' => $rental['item_id']]);
          
          // Also update rental to ongoing
          $updateRentalQuery = "UPDATE rentals SET status = 'ongoing' WHERE rental_id = :rental_id";
          $updateRentalStmt = $db->prepare($updateRentalQuery);
          $updateRentalStmt->execute([':rental_id' => $requestId]);
        }
      }

      return ['success' => true];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardModel::handleRentalRequest() failed - ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to process rental request'];
    }
  }

  /**
   * Update listing status (available/unavailable)
   * Only owner can update their own listings
   */
  public function updateListingStatus($listingId, $status, $userId): array {
    try {
      $db = $this->connect();
      
      // Verify ownership
      $verifyQuery = "SELECT item_id FROM items WHERE item_id = :item_id AND owner_uid = :user_id";
      $verifyStmt = $db->prepare($verifyQuery);
      $verifyStmt->execute([
        ':item_id' => $listingId,
        ':user_id' => $userId
      ]);
      
      if ($verifyStmt->rowCount() === 0) {
        return ['success' => false, 'error' => 'Listing not found or unauthorized'];
      }

      // Cannot set to available if currently rented
      if ($status === 'available') {
        $rentedQuery = "SELECT rental_id FROM rentals 
                       WHERE item_id = :item_id AND status IN ('confirmed', 'ongoing')
                       LIMIT 1";
        $rentedStmt = $db->prepare($rentedQuery);
        $rentedStmt->execute([':item_id' => $listingId]);
        
        if ($rentedStmt->rowCount() > 0) {
          return ['success' => false, 'error' => 'Cannot make available while item is rented'];
        }
      }

      // Update status
      $updateQuery = "UPDATE items 
                      SET status = :status, updated_at = NOW()
                      WHERE item_id = :item_id";
      $updateStmt = $db->prepare($updateQuery);
      $updateStmt->execute([
        ':status' => $status,
        ':item_id' => $listingId
      ]);

      return ['success' => true];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardModel::updateListingStatus() failed - ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to update listing status'];
    }
  }

  /**
   * Delete listing
   * Only owner can delete, cannot delete if active rentals exist
   */
  public function deleteListing($listingId, $userId): array {
    try {
      $db = $this->connect();
      
      // Verify ownership
      $verifyQuery = "SELECT item_id FROM items WHERE item_id = :item_id AND owner_uid = :user_id";
      $verifyStmt = $db->prepare($verifyQuery);
      $verifyStmt->execute([
        ':item_id' => $listingId,
        ':user_id' => $userId
      ]);
      
      if ($verifyStmt->rowCount() === 0) {
        return ['success' => false, 'error' => 'Listing not found or unauthorized'];
      }

      // Check if there are active rentals
      $checkQuery = "SELECT rental_id FROM rentals 
                     WHERE item_id = :item_id 
                     AND status IN ('confirmed', 'ongoing')";
      $checkStmt = $db->prepare($checkQuery);
      $checkStmt->execute([':item_id' => $listingId]);
      
      if ($checkStmt->rowCount() > 0) {
        return ['success' => false, 'error' => 'Cannot delete listing with active rentals'];
      }

      // Delete listing (cascade will handle related records)
      $deleteQuery = "DELETE FROM items WHERE item_id = :item_id";
      $deleteStmt = $db->prepare($deleteQuery);
      $deleteStmt->execute([':item_id' => $listingId]);

      return ['success' => true];

    } catch (PDOException $e) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardModel::deleteListing() failed - ' . $e->getMessage());
      return ['success' => false, 'error' => 'Unable to delete listing'];
    }
  }

  /**
 * Get all bookings for a specific user (as renter)
 * @param int $userId - The user ID of the renter
 * @return array - Returns array with success status and bookings data
 */
public function getUserBookings(int $userId): array {
  $query = "
      SELECT 
          r.rental_id as id,
          r.rental_id as booking_id,
          r.item_id,
          r.start_date,
          r.end_date,
          r.total_amount as total_price,
          r.status,
          r.created_at,
          
          -- Item details
          i.title as item_name,
          i.security_deposit,
          COALESCE(img.image_path, '/assets/placeholder.jpg') as item_image,
          
          -- Owner details
          i.owner_uid as owner_id,
          CONCAT(
              u.first_name, 
              ' ', 
              IF(u.middle_name IS NOT NULL AND u.middle_name != '', CONCAT(u.middle_name, ' '), ''),
              u.last_name
          ) as owner_name,
          u.email as owner_email,
          
          -- Calculate rental duration
          CONCAT(
              DATEDIFF(r.end_date, r.start_date), 
              ' day', 
              IF(DATEDIFF(r.end_date, r.start_date) > 1, 's', '')
          ) as rental_duration,
          
          -- Payment details
          COALESCE(p.payment_status, 'pending') as payment_status,
          p.amount as payment_amount,
          p.payment_method,
          
          -- Days remaining calculation (for active rentals)
          DATEDIFF(r.end_date, CURDATE()) as days_remaining,
          
          -- Pricing details
          rp.rate_type,
          rp.price as rate_price

      FROM rentals r
      INNER JOIN items i ON r.item_id = i.item_id
      INNER JOIN users u ON i.owner_uid = u.uid
      LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
      LEFT JOIN payment p ON r.rental_id = p.rental_id
      LEFT JOIN rental_pricing rp ON r.pricing_id = rp.pricing_id

      WHERE r.renter_uid = :user_id
      ORDER BY 
          CASE r.status
              WHEN 'ongoing' THEN 1
              WHEN 'verified' THEN 2
              WHEN 'pending' THEN 3
              WHEN 'completed' THEN 4
              WHEN 'cancelled' THEN 5
              WHEN 'declined' THEN 6
          END,
          r.created_at DESC
  ";

  try {
    $db = $this->connect();
    $stmt = $db->prepare($query);
    $stmt->execute([':user_id' => $userId]);

    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Map 'ongoing' status to 'active' for frontend display
    foreach ($bookings as &$booking) {
      if ($booking['status'] === 'ongoing') {
        $booking['status'] = 'active';
      }
    }

    return ['success' => true, 'bookings' => $bookings];

  } catch (PDOException $e) {
    error_log('[' . date('Y-m-d H:i:s') . '] UserDashboardModel::getUserBookings() failed - Context: retrieving user bookings (' . $e->getMessage() . ')');
    return ['success' => false, 'error' => 'Unable to retrieve bookings'];
  }
}

/**
 * Cancel a booking (only if status is 'pending')
 * @param int $bookingId - The rental ID
 * @param int $userId - The user ID to verify ownership
 * @return array - Returns array with success status
 */
public function cancelBooking(int $bookingId, int $userId): array {
  // First verify the booking belongs to the user and is pending
  $verifyQuery = "
      SELECT status, renter_uid 
      FROM rentals 
      WHERE rental_id = :booking_id 
      AND renter_uid = :user_id
  ";

  try {
    $db = $this->connect();
    
    // Verify ownership and status
    $stmt = $db->prepare($verifyQuery);
    $stmt->execute([
      ':booking_id' => $bookingId,
      ':user_id' => $userId
    ]);
    
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
      return ['success' => false, 'error' => 'Booking not found or unauthorized'];
    }
    
    if ($booking['status'] !== 'pending') {
      return ['success' => false, 'error' => 'Only pending bookings can be cancelled'];
    }

    // Update the booking status to cancelled
    $updateQuery = "
        UPDATE rentals 
        SET status = 'cancelled' 
        WHERE rental_id = :booking_id 
        AND renter_uid = :user_id
    ";
    
    $stmt = $db->prepare($updateQuery);
    $stmt->execute([
      ':booking_id' => $bookingId,
      ':user_id' => $userId
    ]);

    if ($stmt->rowCount() > 0) {
      return ['success' => true, 'message' => 'Booking cancelled successfully'];
    } else {
      return ['success' => false, 'error' => 'Failed to cancel booking'];
    }

  } catch (PDOException $e) {
    error_log('[' . date('Y-m-d H:i:s') . '] UserDashboardModel::cancelBooking() failed - Context: cancelling booking (' . $e->getMessage() . ')');
    return ['success' => false, 'error' => 'Unable to cancel booking'];
  }
}

/**
 * Initiate return process for an active rental
 * @param int $bookingId - The rental ID
 * @param int $userId - The user ID to verify ownership
 * @return array - Returns array with success status
 */
public function initiateReturn(int $bookingId, int $userId): array {
  // First verify the booking belongs to the user and is ongoing
  $verifyQuery = "
      SELECT r.status, r.renter_uid, r.item_id, i.owner_uid
      FROM rentals r
      INNER JOIN items i ON r.item_id = i.item_id
      WHERE r.rental_id = :booking_id 
      AND r.renter_uid = :user_id
  ";

  try {
    $db = $this->connect();
    
    // Verify ownership and status
    $stmt = $db->prepare($verifyQuery);
    $stmt->execute([
      ':booking_id' => $bookingId,
      ':user_id' => $userId
    ]);
    
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
      return ['success' => false, 'error' => 'Booking not found or unauthorized'];
    }
    
    if ($booking['status'] !== 'ongoing' && $booking['status'] !== 'verified') {
      return ['success' => false, 'error' => 'Only active rentals can be returned'];
    }

    // Update the booking status to completed
    $updateQuery = "
        UPDATE rentals 
        SET status = 'completed'
        WHERE rental_id = :booking_id 
        AND renter_uid = :user_id
    ";
    
    $stmt = $db->prepare($updateQuery);
    $stmt->execute([
      ':booking_id' => $bookingId,
      ':user_id' => $userId
    ]);

    if ($stmt->rowCount() > 0) {
      // TODO: Send notification to owner
      // TODO: Create return request record if needed
      // TODO: Handle deposit refund process
      
      return ['success' => true, 'message' => 'Return initiated successfully'];
    } else {
      return ['success' => false, 'error' => 'Failed to initiate return'];
    }

  } catch (PDOException $e) {
    error_log('[' . date('Y-m-d H:i:s') . '] UserDashboardModel::initiateReturn() failed - Context: initiating return (' . $e->getMessage() . ')');
    return ['success' => false, 'error' => 'Unable to initiate return'];
  }
}

/**
 * Get a single booking by ID
 * @param int $bookingId - The rental/booking ID
 * @param int $userId - The user ID to verify ownership
 * @return array - Returns array with success status and booking data
 */
public function getBookingById(int $bookingId, int $userId): array {
  $query = "
      SELECT 
          r.*,
          i.title as item_name,
          i.security_deposit,
          i.description as item_description,
          COALESCE(img.image_path, '/assets/placeholder.jpg') as item_image,
          i.owner_uid as owner_id,
          CONCAT(u.first_name, ' ', COALESCE(u.middle_name, ''), ' ', u.last_name) as owner_name,
          u.email as owner_email,
          p.payment_status,
          p.payment_method,
          p.amount as payment_amount,
          rp.rate_type,
          rp.price as rate_price

      FROM rentals r
      INNER JOIN items i ON r.item_id = i.item_id
      INNER JOIN users u ON i.owner_uid = u.uid
      LEFT JOIN item_images img ON i.item_id = img.item_id AND img.is_primary = 1
      LEFT JOIN payment p ON r.rental_id = p.rental_id
      LEFT JOIN rental_pricing rp ON r.pricing_id = rp.pricing_id

      WHERE r.rental_id = :booking_id
      AND r.renter_uid = :user_id
  ";

  try {
    $db = $this->connect();
    $stmt = $db->prepare($query);
    $stmt->execute([
      ':booking_id' => $bookingId,
      ':user_id' => $userId
    ]);

    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
      return ['success' => false, 'error' => 'Booking not found'];
    }

    return ['success' => true, 'booking' => $booking];

  } catch (PDOException $e) {
    error_log('[' . date('Y-m-d H:i:s') . '] UserDashboardModel::getBookingById() failed - Context: retrieving booking by id (' . $e->getMessage() . ')');
    return ['success' => false, 'error' => 'Unable to retrieve booking'];
  }
  }

  public function returnBooking($bookingID) {
    try {
      $db = $this->connect();
      
      $query = "UPDATE rentals SET status = 'return_pending'
                WHERE rental_id = :booking_id";
      
      $stmt = $db->prepare($query);
      $result = $stmt->execute([
        ':booking_id' => $bookingID
      ]);

      if ($result) {
        return ['success' => true];
      } else {
        return ['success' => false, 'error' => 'Request failed failed'];
      }
  } catch (PDOException $e) {
    // hoo gi kapoy pa ko
  }
}
}

