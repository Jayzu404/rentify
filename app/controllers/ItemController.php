<?php
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__,2) . '/config/Views.php';

class ItemController extends Controller {
  public function browse(){
    $this->view(Views::BROWSE_ITEMS);
  }
}