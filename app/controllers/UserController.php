<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/core/Controller.php';

class UserController extends Controller {
  public function profile(){
    $this->view(Views::USER_PROFILE);
  }
}