<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/models/UserModel.php';

class UserController extends Controller {
  public function profile(){
    $userId = $_GET['uid'] ?? null;

    if (!$userId) {
      error_log('UserController::profile() failed - context: retrieving user id');
      header('Location: /home/index');
      exit;
    }

    $userModel = new UserModel();

    $result = $userModel->getUserById($userId);

    $data = [
      'user' => $result['user']
    ];

    if (!$result['success']) {
      header('Location: /user/profile');
    }

    $this->view(Views::USER_PROFILE);
  }
}