<?php
  require_once dirname(__DIR__, 2) . '/config/Views.php';
  require_once dirname(__DIR__) . '/core/Controller.php';

  class DashboardController extends Controller {
    public function index(){
      $this->view(Views::USER_DASHBOARD);
    }
  }