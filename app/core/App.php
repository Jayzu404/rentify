<?php
declare(strict_types=1);
require_once dirname(__DIR__,2) . '/config/config.php';

class App {
  private $controller = "HomeController";
  private string $method = "index";
  private $params = [];

  private $allowedControllers = [
    'admin'     => 'AdminController',
    'home'      => 'HomeController',
    'auth'      => 'AuthController',
    'item'      => 'ItemController',
    'dashboard' => 'DashboardController',
    'user'      => 'UserController',
    'file'      => 'FileController'
  ];

  public function __construct()
  {
    $url = $this->parseUrl();
    //check the allowed controllers and parse controller
    if($url && !empty($url[0]) && isset($this->allowedControllers[lcfirst($url[0])])){
      $this->controller = $this->allowedControllers[lcfirst($url[0])];
      unset($url[0]);
    }
    //method parsing
    if($url && !empty($url[1])){
      $this->method = $url[1];
      unset($url[1]);
    }

    //parameters parsing
    if($url && count($url) > 0){
      $this->params = array_values($url);
    }
    
    $this->loadController();
  }

  private function parseUrl(): array
  {
    if(isset($_GET['url'])){
      $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
      return explode('/', $url);
    }
    return [];
  }

  private function loadController():void
  {
    $controllerFilePath = BASE_PATH . '/app/controllers/' . $this->controller . '.php';
    if(!file_exists($controllerFilePath)){
      throw new \Exception("Controller path ($controllerFilePath{$this->controller}.php) doesn't exist");
    }
    require_once $controllerFilePath;

    if(!class_exists($this->controller)){
      throw new \Exception("Class ({$this->controller}) doesn't exists");
    }

    if(!method_exists($this->controller, $this->method)){
      throw new \Exception("Method ({$this->method}) doesn't exists");
    }

    $this->controller = new $this->controller;

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  private function handleError(\Throwable $e): void
  {
    if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
      // Dev mode: show full error details
      echo "<pre>App Error: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "</pre>";
    } else {
      // Production mode: log error & show friendly page
      error_log($e->getMessage());
      header("Location: /error");
      exit;
    }
  }

}