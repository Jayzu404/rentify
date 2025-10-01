<?php
require_once dirname(__DIR__, 2) . '/config/config.php';

class Controller {
  protected function view($viewPath){
    $fullPath = BASE_PATH . "/app/views/{$viewPath}.php";

    if(file_exists($fullPath)){
      require_once $fullPath;
    }
  }
}