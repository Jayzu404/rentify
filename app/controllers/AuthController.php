<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/core/Controller.php';

class AuthController extends Controller {
  public function login(){
    $this->view(Views::LOGIN);
  }

  public function signup(){
    $this->view(Views::SIGNUP);
  }
} 