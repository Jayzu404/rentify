<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/models/AdminModel.php';
require_once dirname(__DIR__) . '/core/Controller.php';

class AdminController extends Controller {
  public function dashboard() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    $adminModel = new AdminModel();

    // users actions
    $retrievingAllUserResult      = $adminModel->getAllUsers();
    $retrievingPendingUsersResult = $adminModel->getPendingUsers();
    $allUserCount                 = $adminModel->allUserCount();
    $pendingUserCount             = $adminModel->pendingUsersCount();

    // items actions
    $retrievingAllItems           = $adminModel->getItems();
    $allItemCount                 = $adminModel->allItemsCount();
    $pendingItemsCount            = $adminModel->pendingItemsCount();
    $retrievingPendingItemsResult = $adminModel->getPendingItems();

    // payment actions
    $retrievingPendingPayments = $adminModel->getPendingPayments();

    $data = [
      'allUser'           => $retrievingAllUserResult['success'] ? $retrievingAllUserResult['users'] : [],
      'allUserCount'      => $allUserCount,
      'pendingUsers'      => $retrievingPendingUsersResult['success'] ? $retrievingPendingUsersResult['users'] : [],
      'pendingUsersCount' => $pendingUserCount,

      'allItems'          => $retrievingAllItems['success'] ? $retrievingAllItems['items'] : [],
      'pendingItems'      => $retrievingPendingItemsResult['success'] ? $retrievingPendingItemsResult['items'] : [],
      'allItemCount'      => $allItemCount,
      'pendingItemsCount' => $pendingItemsCount,

      'pendingPayments'   => $retrievingPendingPayments['success'] ? $retrievingPendingPayments['paymentRecords'] : [],

      'error'             => $retrievingPendingUsersResult['success'] ? null : $retrievingPendingUsersResult['error'] 
    ];

    $this->view(Views::ADMIN_DASHBOARD, $data);
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

  public function rejectUser() {
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

    $result = $adminModel->rejectUser($userId);

    if ($result['success']) {
      http_response_code(200); //OK
      header('Content-Type: application/json');
      echo json_encode($result);
    } else {
      http_response_code(422);
      header('Content-Type: application/json');
      echo json_encode($result);
    }
  }

  public function deleteUser() {
    $userId = $_GET['uid'] ?? null;

    if (!$userId) {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'error' => 'User Id is required'
      ]);
      exit;
    }

    $adminModel = new AdminModel();

    $result = $adminModel->deleteUserById($userId);

    if ($result['success']) {
      http_response_code(200); //OK
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;
    } else {
      http_response_code(422);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;     
    }
  }

  public function approveItem() {
    $itemId = $_GET['itemId'] ?? null;

    if (!$itemId) {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'error' => 'Item Id is required'
      ]);
      exit;
    }

    $adminModel = new AdminModel();

    $result = $adminModel->approveItem($itemId);

    if ($result['success']) {
      http_response_code(200); //OK
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;
    } else {
      http_response_code(422);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;     
    }
  }

  public function rejectItem() {
    $itemId = $_GET['itemId'] ?? null;

    if (!$itemId) {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'error' => 'Item Id is required'
      ]);
      exit;
    }

    $adminModel = new AdminModel();

    $result = $adminModel->rejectItem($itemId);

    if ($result['success']) {
      http_response_code(200); //OK
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;
    } else {
      http_response_code(422);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;     
    }
  }  

  public function verifyPayment() {
    $paymentID = $_GET['paymentID'] ?? null;

    if (!$paymentID) {
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode([
        'success' => false,
        'error' => 'Payment ID is required'
      ]);
      exit;
    }

    $adminModel = new AdminModel();

    $result = $adminModel->verifyPayment($paymentID);

    if ($result['success']) {
      http_response_code(200); //OK
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;
    } else {
      http_response_code(422);
      header('Content-Type: application/json');
      echo json_encode($result);
      exit;     
    }
  }  
}