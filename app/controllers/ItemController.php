<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__,2) . '/config/Views.php';
require_once dirname(__DIR__) . '/helpers/Sanitizer.php';
require_once dirname(__DIR__) . '/helpers/ItemListingValidator.php';
require_once dirname(__DIR__) . '/models/ItemModel.php';

class ItemController extends Controller {
  public function browse(){
    $this->view(Views::BROWSE_ITEMS);
  }

  public function create(){
    $this->view(Views::ADD_ITEM);
  }

  public function detail(){
    $this->view(Views::VIEW_ITEM_DETAILS);
  }

  public function add(){
    // foreach($_POST as $k => $v){
    //   echo $k . '= ' . $v;
    //   echo '<br>';
    // }

    // echo '<pre>';
    // var_dump($_FILES);
    // echo '<pre>';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
      }

      $sanitizedInputs = $this->sanitizeInputs($_POST);

      $this->itemDataSession($sanitizedInputs);

      $validation = $this->validateInputs($sanitizedInputs);
      
      // if(!$validation['valid']){
      //   $_SESSION['errors'] = $validation['errors'];
      //   header('Location: /item/create');
      //   exit;
      // }

      $itemModel = new ItemModel();

      $itemModel->createItem(
        1,
        $sanitizedInputs['itemName'],
        $sanitizedInputs['description'],
        $sanitizedInputs['pickUpLocation'],
        $sanitizedInputs['itemCondition']
      );

      /*
        TODO: FINISH THE CONTROLLER AND MODEL
              DYNAMIC ID MUST BE SEND
              ITEMS RELATED TABLE MUST BE CONNECTED
      */
    }
    


  }

  private function itemDataSession(){}

  private function sanitizeInputs(array $data): array{
    $fields = [
      'itemName'           => 'string',
      'quantity'           => 'number',
      'category'           => 'string',
      'brand'              => 'string|null',
      'itemCondition'      => 'string',
      'description'        => 'string',
      'rentalPrice'        => 'float',
      'priceRate'          => 'string',
      'securityDeposit'    => 'float|null',
      'minDuration'        => 'string',
      'minDurationUnit'    => 'String',
      'maxDuration'        => 'string|null',
      'maxDurationUnit'    => 'string|null',
      'lateReturnFee'      => 'float|null',
      'availableFrom'      => 'date',
      'availableUntil'     => 'date|null',
      'pickUpLocation'     => 'string',
      'returnStatement'    => 'string',
      'cancellationPolicy' => 'string'
    ];

    $sanitizedInputs = [];

    foreach($fields as $field => $type){
      $value = $data[$field] ?? null;

      switch($type){
        case 'string':
          $sanitizedInputs[$field] = Sanitizer::sanitizeString($value);
          break;
        case 'string|null':
          $sanitizedInputs[$field] = Sanitizer::sanitizeString($value ?: null);
          break;
        case 'number':
          $sanitizedInputs[$field] = Sanitizer::sanitizeInt($value);
          break;
        case 'float':
          $sanitizedInputs[$field] = Sanitizer::sanitizeFloat($value);
          break;
        case 'float|null':
          $sanitizedInputs[$field] = Sanitizer::sanitizeFloat($value) ?: null;
          break;  
      }
    }

    return $sanitizedInputs;
  }

  private function validateInputs(array $sanitizedInputs): array {
    return ItemListingValidator::validateItemListing($sanitizedInputs);
  }
}