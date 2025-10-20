<?php
require_once dirname(__DIR__, 2) . '/config/config.php';

/**
 *  Base Controller that sub Controllers extends
 */

abstract class Controller{
    
  // public function view(String $viewPath){
  //   $fullPath = BASE_PATH . "/app/views/{$viewPath}.php";
  //   if(file_exists($fullPath)){
  //     require_once $fullPath;
  //   }
  // }

  public function view(string $viewPath, array $data = []){
    // Extract data array to make variables available in view
    extract($data);
    
    $fullPath = BASE_PATH . "/app/views/{$viewPath}.php";
    
    if(file_exists($fullPath)){
      require_once $fullPath;
    } else {
      die("View not found: {$viewPath}");
    }
  }

  protected function getUserId(): ?int {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
    
    return $_SESSION['user']['id'] ?? null;
  }

  protected function requireAuth(): int {
    $userId = $this->getUserId();
    
    if ($userId === null) {
      // Redirect to login if not authenticated
      header('Location: /auth/login');
      exit;
    }
    
    return $userId;
  }
}