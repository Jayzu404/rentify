<?php
  require_once dirname(__DIR__, 2) . '/config/Views.php';
  require_once dirname(__DIR__) . '/core/Controller.php';
  require_once dirname(__DIR__) . '/models/ItemModel.php';
  
  class HomeController extends Controller {
    private ItemModel $itemModel;

    public function __construct()
    {
      $this->itemModel = new ItemModel();
    }

    public function index(){
      $recentItems = $this->itemModel->getRecentItems();

      $data = [
        'recentItems' => $recentItems
      ];
      $this->view(Views::HOME, $data);
    }

    public function about(){
      $this->view(Views::ABOUT);
    }

    public function terms(){
      $this->view(Views::TERMS_AND_CONDITIONS);
    }
  }