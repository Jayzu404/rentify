<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/models/UserModel.php';
require_once dirname(__DIR__) . '/models/UserDashboardModel.php';

class DashboardController extends Controller {
  private $userModel;
  private $dashboardModel;

  public function __construct() {
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    
    $this->userModel = new UserModel();
    $this->dashboardModel = new UserDashboardModel();
  }

  public function index() {

    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    // Check if user is logged in via session
    if (!isset($_SESSION['user']['id'])) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardController::index() - User not logged in');
      header('Location: /auth/login');
      exit;
    }

    $userId = $_SESSION['user']['id'];

    // Get user information
    $userResult = $this->userModel->getUserById($userId);
    if (!$userResult['success']) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardController::index() - Failed to get user info');
      header('Location: /auth/login');
      exit;
    }

    // Get dashboard statistics
    $statsResult = $this->dashboardModel->getUserStats($userId);
    if (!$statsResult['success']) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardController::index() - Failed to get user stats');
      $userStats = [
        'total_items' => 0,
        'active_rentals' => 0,
        'pending_requests' => 0,
        'total_earnings' => 0.00
      ];
    } else {
      $userStats = $statsResult['stats'];
    }

    // Get pending rental requests for user's items
    $requestsResult = $this->dashboardModel->getPendingRequests($userId);
    if (!$requestsResult['success']) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardController::index() - Failed to get pending requests');
      $pendingRequests = [];
    } else {
      $pendingRequests = $requestsResult['requests'];
    }

    // Get user's listings/items
    $listingsResult = $this->dashboardModel->getUserListings($userId);
    if (!$listingsResult['success']) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardController::index() - Failed to get user listings');
      $myListings = [];
    } else {
      $myListings = $listingsResult['listings'];
    }

    // Get user's booking/
    $bookingsResult = $this->dashboardModel->getUserBookings($userId);
    if (!$bookingsResult['success']) {
      error_log('[' . date('Y-m-d H:i:s') . '] DashboardController::index() - Failed to get user bookings');
      $myBookings = [];
    } else {
      $myBookings = $bookingsResult['bookings'];
    }

    // Prepare data for the view
    $data = [
      'user' => $userResult['user'],
      'user_stats' => $userStats,
      'pending_requests' => $pendingRequests,
      'my_listings' => $myListings,
      'my_bookings' => $myBookings
    ];

    // Load the dashboard view
    $this->view(Views::USER_DASHBOARD, $data);
  }

  /**
   * Handle rental request (Accept or Decline)
   * Method: POST
   * URL: /dashboard/handleRequest
   */
  // public function handleRequest() {
  //   // Only accept POST requests
  //   if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  //     http_response_code(405);
  //     echo json_encode(['success' => false, 'message' => 'Method not allowed']);
  //     exit;
  //   }
    
  //   if(session_status() != PHP_SESSION_ACTIVE){
  //     session_start();
  //   }

  //   // Check if user is logged in
  //   if (!isset($_SESSION['user']['id'])) {
  //     http_response_code(401);
  //     echo json_encode(['success' => false, 'message' => 'Unauthorized']);
  //     exit;
  //   }

  //   // -- e delete ra ni puhon (e keep sa ron for study purpose)
  //   // Get JSON input
  //   // $input = json_decode(file_get_contents('php://input'), true);
    
  //   exit;
  //   if (!isset($input['request_id']) || !isset($input['action'])) {
  //     http_response_code(400);
  //     echo json_encode(['success' => false, 'message' => 'Missing required fields']);
  //     exit;
  //   }

  //   $requestId = (int)$input['request_id'];
  //   $action = $input['action'];
  //   $userId = $_SESSION['user_id'];

  //   // Validate action
  //   if (!in_array($action, ['accept', 'decline'])) {
  //     http_response_code(400);
  //     echo json_encode(['success' => false, 'message' => 'Invalid action']);
  //     exit;
  //   }

  //   // Process the rental request
  //   $result = $this->dashboardModel->handleRentalRequest($requestId, $action, $userId);

  //   if ($result['success']) {
  //     http_response_code(200);
  //     echo json_encode([
  //       'success' => true, 
  //       'message' => 'Request ' . $action . 'ed successfully'
  //     ]);
  //   } else {
  //     http_response_code(400);
  //     echo json_encode([
  //       'success' => false, 
  //       'message' => $result['error'] ?? 'Failed to process request'
  //     ]);
  //   }
  //   exit;
  // }

  public function handleRentalRequest(){
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'POST request na send'
      ]);
      exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
  
    // Temporary debug - remove after testing
    // error_log("Raw input: " . file_get_contents('php://input'));
    // error_log("Decoded data: " . print_r($data, true));

    if (!isset($data['rentalRequestId']) || !isset($data['action'])) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => "Missing fields"]);
      exit;
    }

    $requestId = (int)$data['rentalRequestId'];
    $action = $data['action'];
    $userID = $_SESSION['user']['id'];

    // Validate action
    if (!in_array($action, ['accept', 'decline'])) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Invalid action']);
      exit;
    }

    // Process the rental request
    $result = $this->dashboardModel->handleRentalRequest($requestId, $action, $userID);
    $stats = $this->dashboardModel->getUserStats($userID);

    error_log($stats['stats']['pending_requests']);

    if ($result['success']) {
      http_response_code(200);
      echo json_encode([
        'success' => true, 
        'message' => 'Request ' . $action . 'ed successfully',
        'pendingRequestCount' => $stats['stats']['pending_requests']
      ]);
    } else {
      http_response_code(400);
      echo json_encode([
        'success' => false, 
        'message' => $result['error'] ?? 'Failed to process request'
      ]);
    }
    exit;

  }

    public function approveUser() {
    $userId = $_GET['uid'] ?? null;

    if (!$userId) {
      http_response_code(400); // Bad Request
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'message' => 'User ID is required'
      ]);
      exit;
    }

    $adminModel = new AdminModel();

    $result = $adminModel->approveUser($userId);

    if ($result['success']) {
      http_response_code(200); // OK
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;
    } else {
      http_response_code(422); // Unprocessable Entity
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;
    }
  }

  /**
   * Toggle listing availability (Pause/Activate)
   * Method: PATCH
   * URL: /dashboard/toggleAvailability
   */
  public function toggleAvailability() {
    // Only accept PATCH requests
    if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
      http_response_code(405);
      echo json_encode(['success' => false, 'message' => 'Method not allowed']);
      exit;
    }

    if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }

    // Check if user is logged in
    if (!isset($_SESSION['user']['id'])) {
      http_response_code(401);
      echo json_encode(['success' => false, 'message' => 'Unauthorized']);
      exit;
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['listing_id']) || !isset($input['status'])) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Missing required fields']);
      exit;
    }

    $listingId = (int)$input['listing_id'];
    $status = $input['status'];
    $userId = $_SESSION['user_id'];

    // Validate status
    if (!in_array($status, ['available', 'unavailable'])) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Invalid status']);
      exit;
    }

    // Update listing status
    $result = $this->dashboardModel->updateListingStatus($listingId, $status, $userId);

    if ($result['success']) {
      http_response_code(200);
      echo json_encode([
        'success' => true, 
        'message' => 'Listing status updated successfully'
      ]);
    } else {
      http_response_code(400);
      echo json_encode([
        'success' => false, 
        'message' => $result['error'] ?? 'Failed to update listing'
      ]);
    }
    exit;
  }

  /**
   * Delete a listing
   * Method: DELETE
   * URL: /dashboard/deleteListing
   */
  public function deleteListing() {
    // Only accept DELETE requests
    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
      http_response_code(405);
      echo json_encode(['success' => false, 'message' => 'Method not allowed']);
      exit;
    }

    // Check if user is logged in
    if (!isset($_SESSION['user']['id'])) {
      http_response_code(401);
      echo json_encode(['success' => false, 'message' => 'Unauthorized']);
      exit;
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['listing_id'])) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Missing listing ID']);
      exit;
    }

    $listingId = (int)$input['listing_id'];
    $userId = $_SESSION['user']['id'];

    // Delete the listing
    $result = $this->dashboardModel->deleteListing($listingId, $userId);

    if ($result['success']) {
      http_response_code(200);
      echo json_encode([
        'success' => true, 
        'message' => 'Listing deleted successfully'
      ]);
    } else {
      http_response_code(400);
      echo json_encode([
        'success' => false, 
        'message' => $result['error'] ?? 'Failed to delete listing'
      ]);
    }
    exit;
  }

  public function initiateReturn() {
    // Only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      http_response_code(405);
      echo json_encode(['success' => false, 'message' => 'Method not allowed']);
      exit;
    }

    // Check if user is logged in
    if (!isset($_SESSION['user']['id'])) {
      http_response_code(401);
      echo json_encode(['success' => false, 'message' => 'Unauthorized']);
      exit;
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['booking_id'])) {
      http_response_code(400);
      echo json_encode(['success' => false, 'message' => 'Missing booking ID']);
      exit;
    }

    $bookingID = (int)$input['booking_id'];
    $userId = $_SESSION['user']['id'];

    // Delete the listing
    $result = $this->dashboardModel->returnBooking($bookingID);

    if ($result['success']) {
      http_response_code(200);
      echo json_encode([
        'success' => true, 
        'message' => 'Request sent successfully'
      ]);
    } else {
      http_response_code(400);
      echo json_encode([
        'success' => false, 
        'message' => $result['error'] ?? 'Failed to sent request'
      ]);
    }
    exit;
  }
}