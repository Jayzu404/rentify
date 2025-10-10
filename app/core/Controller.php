<?php
  require_once dirname(__DIR__, 2) . '/config/config.php';

  /**
   *  Base Controller that sub Controllers extends
   */

  abstract class Controller{
    
    public function view(String $viewPath){
      $fullPath = BASE_PATH . "/app/views/{$viewPath}.php";

      if(file_exists($fullPath)){
        require_once $fullPath;
      }
    }
  }