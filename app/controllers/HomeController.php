<?php
  require_once dirname(__DIR__, 2) . '/config/Views.php';
  require_once dirname(__DIR__) . '/core/Controller.php';
  
  class HomeController extends Controller {
    public function index(){
      $this->view(Views::HOME);
    }

    public function about(){
      $this->view(Views::ABOUT);
    }
  }