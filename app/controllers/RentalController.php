<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/models/RentalModel.php';
require_once dirname(__DIR__) . '/models/UserModel.php';

class RentalController extends Controller {
  
  /**
   * Show checkout page
   */
  public function checkout() {

    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    $itemId = $_GET['item_id'] ?? null;

    if (!$itemId) {
      error_log('RentalController::checkout() failed - context: missing item_id');
      header('Location: /home');
      exit;
    }

    // Check if user is logged in
    if (!isset($_SESSION['user']['id'])) {
      $_SESSION['redirect_after_login'] = "/rental/checkout?item_id=$itemId";
      header('Location: /auth/login');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->getItemForCheckout($itemId);

    if (!$result['success']) {
      $_SESSION['error'] = $result['error'];
      header("Location: /home");
      exit;
    }

    // Get cancellation policies
    $policiesResult = $rentalModel->getCancellationPolicies();
    
    $data = [
      'item' => $result['item'],
      'policies' => $policiesResult['success'] ? $policiesResult['policies'] : []
    ];

    $this->view(Views::CHECKOUT_PAGE, $data);
  }

  /**
   * Process checkout and create rental
   */
  public function pending() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /home/index');
      exit;
    }

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // exit;

    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    // Check if user is logged in
    if (!isset($_SESSION['user']['id'])) {
      header('Location: /auth/login');
      exit;
    }

    // var_dump($_FILES);

    $itemId          = $_POST['item_id'] ?? null;
    $pricingId       = $_POST['pricing_id'] ?? null;
    $itemPrice       = $_POST['item_price'] ?? 0.00;
    $totalAmount     = $_POST['total_amount'] ?? 0.00;
    $securityDeposit = $_POST['security_deposit'] ?? 0.00;
    $paymentMethod   = $_POST['payment_method'];
    $policyId        = $_POST['policy_id'] ?? null;
    $startDate       = $_POST['start_date'] ?? null;
    $endDate         = $_POST['end_date'] ?? null;

    // exit;

    // Validate required fields
    if (!$itemId || !$pricingId || !$startDate || !$endDate) {
      $_SESSION['error'] = 'Missing required fields';
      header("Location: /rental/checkout?item_id=$itemId");
      exit;
    }

    $rentalModel = new RentalModel();

    // Check availability
    // $availabilityResult = $rentalModel->checkAvailability($itemId, $startDate, $endDate);
    
    // if (!$availabilityResult['success'] || !$availabilityResult['available']) {
    //   $_SESSION['error'] = 'Item is not available for selected dates';
    //   $_SESSION['post'] = $_POST;
    //   header("Location: /rental/checkout?item_id=$itemId");
    //   exit;
    // }

    // Calculate total (simplified - should include proper calculation)
    $duration = $rentalModel->calculateDuration($startDate, $endDate);

    // Create rental
    $rentalData = [
      'item_id'         => $itemId,
      'renter_uid'      => $_SESSION['user']['id'],
      'pricing_id'      => $pricingId,
      'policy_id'       => $policyId,
      'start_date'      => $startDate,
      'end_date'        => $endDate,
      'total_amount'    => $totalAmount,
      'status'          => 'pending',
      'paymentMethod'   => $paymentMethod,
      'amount'          => $itemPrice,
      'securityDeposit' => $securityDeposit,
      'totalAmount'     => $totalAmount,
      'adminID'         => 1
    ];

    $createResult = $rentalModel->createRental($rentalData);

    if (!$createResult['success']) {
      $_SESSION['error'] = 'Failed to create rental';
      header("Location: /rental/checkout?item_id=$itemId");
      exit;
    }

    // Redirect to confirmation page
    $_SESSION['success'] = 'Rental created successfully';
    
    $this->view(Views::PROCESS_BOOKING);
  }

  /**
   * Show rental confirmation page
   */
  public function confirmation() {
    $rentalId = $_GET['rental_id'] ?? null;

    if (!$rentalId) {
      error_log('RentalController::confirmation() failed - context: missing rental_id');
      header('Location: /home/index');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->getRentalById($rentalId);

    if (!$result['success']) {
      $_SESSION['error'] = $result['error'];
      header('Location: /home/index');
      exit;
    }

    $data = [
      'rental' => $result['rental']
    ];

    $this->view(Views::RENTAL_CONFIRMATION, $data);
  }

  /**
   * Show user's rental history (as renter)
   */
  public function myRentals() {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /auth/login');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->getRentalsByRenter($_SESSION['user_id']);

    $data = [
      'rentals' => $result['success'] ? $result['rentals'] : []
    ];

    $this->view(Views::RENTAL_MY_RENTALS, $data);
  }

  /**
   * Show rentals for items user owns (as owner)
   */
  public function receivedRentals() {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /auth/login');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->getRentalsByOwner($_SESSION['user_id']);

    $data = [
      'rentals' => $result['success'] ? $result['rentals'] : []
    ];

    $this->view(Views::RENTAL_RECEIVED_RENTALS, $data);
  }

  /**
   * View single rental details
   */
  public function details() {
    $rentalId = $_GET['rental_id'] ?? null;

    if (!$rentalId) {
      error_log('RentalController::details() failed - context: missing rental_id');
      header('Location: /rental/myRentals');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->getRentalById($rentalId);

    if (!$result['success']) {
      $_SESSION['error'] = $result['error'];
      header('Location: /rental/myRentals');
      exit;
    }

    $data = [
      'rental' => $result['rental']
    ];

    $this->view(Views::RENTAL_DETAILS, $data);
  }

  /**
   * Cancel rental
   */
  public function cancel() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /rental/myRentals');
      exit;
    }

    $rentalId = $_POST['rental_id'] ?? null;

    if (!$rentalId) {
      $_SESSION['error'] = 'Missing rental ID';
      header('Location: /rental/myRentals');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->cancelRental($rentalId);

    if ($result['success']) {
      $_SESSION['success'] = 'Rental cancelled successfully';
    } else {
      $_SESSION['error'] = 'Failed to cancel rental';
    }

    header('Location: /rental/myRentals');
    exit;
  }

  /**
   * Confirm rental (owner confirms)
   */
  public function confirm() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /rental/receivedRentals');
      exit;
    }

    $rentalId = $_POST['rental_id'] ?? null;

    if (!$rentalId) {
      $_SESSION['error'] = 'Missing rental ID';
      header('Location: /rental/receivedRentals');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->confirmRental($rentalId);

    if ($result['success']) {
      $_SESSION['success'] = 'Rental confirmed successfully';
    } else {
      $_SESSION['error'] = 'Failed to confirm rental';
    }

    header('Location: /rental/receivedRentals');
    exit;
  }

  /**
   * Complete rental
   */
  public function complete() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /rental/receivedRentals');
      exit;
    }

    $rentalId = $_POST['rental_id'] ?? null;

    if (!$rentalId) {
      $_SESSION['error'] = 'Missing rental ID';
      header('Location: /rental/receivedRentals');
      exit;
    }

    $rentalModel = new RentalModel();
    $result = $rentalModel->completeRental($rentalId);

    if ($result['success']) {
      $_SESSION['success'] = 'Rental marked as completed';
    } else {
      $_SESSION['error'] = 'Failed to complete rental';
    }

    header('Location: /rental/receivedRentals');
    exit;
  }
}