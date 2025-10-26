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
    $retrievingAllUserResult = $adminModel->getAllUsers();
    $retrievingPendingUsersResult = $adminModel->getPendingUsers();
    $allUserCount = $adminModel->allUserCount();
    $pendingUserCount = $adminModel->pendingUsersCount();
    $allItemCount = $adminModel->allItemsCount();
    $pendingItemsCount = $adminModel->pendingItemsCount();

    $data = [
      'allUser'           => $retrievingAllUserResult['success'] ? $retrievingAllUserResult['users'] : [],
      'allUserCount'      => $allUserCount,
      'pendingUsers'      => $retrievingPendingUsersResult['success'] ? $retrievingPendingUsersResult['users'] : [],
      'pendingUsersCount' => $pendingUserCount,
      'allItemCount'      => $allItemCount,
      'pendingItemsCount' => $pendingItemsCount,
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
      echo json_encode([$result]);
      exit;
    } else {
      http_response_code(422); // Unprocessable Entity
      header('Content-Type: application/json');
      echo json_encode([$result]);
      exit;
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
      echo json_encode([$result]);
      exit;
    } else {
      http_response_code(422);
      header('Content-Type: application/json');
      echo json_encode([$result]);
      exit;     
    }
  }
}