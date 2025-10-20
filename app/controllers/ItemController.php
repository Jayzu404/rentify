<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__,2) . '/config/Views.php';
require_once dirname(__DIR__) . '/helpers/Sanitizer.php';
require_once dirname(__DIR__) . '/helpers/ItemListingValidator.php';
require_once dirname(__DIR__) . '/models/ItemModel.php';

// class ItemController extends Controller {
//   public function browse(){
//     $this->view(Views::BROWSE_ITEMS);
//   }

//   public function create(){
//     $this->view(Views::ADD_ITEM);
//   }

//   public function detail(){
//     $this->view(Views::VIEW_ITEM_DETAILS);
//   }

//   public function add(){
//     // foreach($_POST as $k => $v){
//     //   echo $k . '= ' . $v;
//     //   echo '<br>';
//     // }

//     // echo '<pre>';
//     // var_dump($_FILES);
//     // echo '<pre>';

//     foreach($_FILES['itemImages']['name'] as $image) {
//       echo $image . '<br>';
//     }

//     if($_SERVER['REQUEST_METHOD'] === 'GET'){
//       if(session_status() !== PHP_SESSION_ACTIVE){
//         session_start();
//       }

//       $userId = $this->requireAuth();

//       $sanitizedInputs = $this->sanitizeInputs($_POST);

//       $this->itemDataSession($sanitizedInputs);

//       $validation = $this->validateListingData($sanitizedInputs);
      
//       // if(!$validation['valid']){
//       //   $_SESSION['errors'] = $validation['errors'];
//       //   header('Location: /item/create');
//       //   exit;
//       // }

//       $itemModel = new ItemModel();

//       $itemModel->createItem(
//         $userId,
//         $sanitizedInputs['itemName'],
//         $sanitizedInputs['description'],
//         $sanitizedInputs['pickUpLocation'],
//         $sanitizedInputs['itemCondition']
//       );

//       /*
//         TODO: FINISH THE CONTROLLER AND MODEL
//               DYNAMIC ID MUST BE SEND
//               ITEMS RELATED TABLE MUST BE CONNECTED
//       */
//     }
    


//   }

//   private function itemDataSession(){}

//   private function sanitizeInputs(array $data): array{
//     $fields = [
//       'itemName'           => 'string',
//       'itemImages'         => 'file',
//       'quantity'           => 'number',
//       'category'           => 'string',
//       'brand'              => 'string|null',
//       'itemCondition'      => 'string',
//       'description'        => 'string',
//       'rentalPrice'        => 'float',
//       'priceRate'          => 'string',
//       'securityDeposit'    => 'float|null',
//       'minDuration'        => 'string',
//       'minDurationUnit'    => 'String',
//       'maxDuration'        => 'string|null',
//       'maxDurationUnit'    => 'string|null',
//       'lateReturnFee'      => 'float|null',
//       'availableFrom'      => 'date',
//       'availableUntil'     => 'date|null',
//       'pickUpLocation'     => 'string',
//       'returnStatement'    => 'string',
//       'cancellationPolicy' => 'string'
//     ];

//     $sanitizedInputs = [];

//     foreach($fields as $field => $type){
//       $value = $data[$field] ?? null;

//       switch($type){
//         case 'string':
//           $sanitizedInputs[$field] = Sanitizer::sanitizeString($value);
//           break;
//         case 'string|null':
//           $sanitizedInputs[$field] = Sanitizer::sanitizeString($value ?: null);
//           break;
//         case 'number':
//           $sanitizedInputs[$field] = Sanitizer::sanitizeInt($value);
//           break;
//         case 'float':
//           $sanitizedInputs[$field] = Sanitizer::sanitizeFloat($value);
//           break;
//         case 'float|null':
//           $sanitizedInputs[$field] = Sanitizer::sanitizeFloat($value) ?: null;
//           break;  
//       }
//     }

//     return $sanitizedInputs;
//   }

//   private function validateListingData(array $sanitizedInputs): array {
//     return ItemListingValidator::validateItemListing($sanitizedInputs);
//   }

//   private function validateImages(array $sanitizedInputs) : array {
//     return ItemListingValidator::validateItemImages($sanitizedInputs);
//   }
// }

class ItemController extends Controller {
  private const MAX_FILE_SIZE = 5242880; // 5MB
  private const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

   public function browse(){
    $itemModel = new ItemModel();
    
    // Get query parameters
    $category = $_GET['category'] ?? null;
    $search = $_GET['search'] ?? null;
    $page = (int) ($_GET['page'] ?? 1);
    $itemsPerPage = 12;
    $offset = ($page - 1) * $itemsPerPage;
    
    // Fetch items based on filters
    if ($search) {
      $items = $itemModel->searchItems($search, $itemsPerPage);
    } elseif ($category) {
      $items = $itemModel->getItemsByCategory($category, $itemsPerPage);
    } else {
      $items = $itemModel->getAllItems($itemsPerPage, $offset);
    }
    
    // Get total count for pagination
    $totalItems = $itemModel->getTotalItemsCount();
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Pass data to view
    $data = [
      'items' => $items,
      'currentPage' => $page,
      'totalPages' => $totalPages,
      'category' => $category,
      'search' => $search
    ];
    
    $this->view(Views::BROWSE_ITEMS, $data);
  }

  public function create(){
    $this->view(Views::ADD_ITEM);
  }

  public function detail(){
    $itemId = isset($_GET['id']) ? (int) $_GET['id'] : null;

    if ($itemId === null || $itemId === 0) {
      header('Location: /item/browse');
      exit;
    }

    $itemModel = new ItemModel();
    $item = $itemModel->getItemById($itemId);

    $this->view(Views::VIEW_ITEM_DETAILS, ['item' => $item]);
  }

  public function add(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Get authenticated user ID
      $userId = $this->requireAuth();
      
      if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
      }

      // Sanitize inputs
      $sanitizedInputs = $this->sanitizeInputs($_POST);
      
      // Store data in session for repopulation on error
      $this->itemDataSession($sanitizedInputs);

      // Validate text inputs
      $validation = $this->validateListingData($sanitizedInputs);
      
      // Validate images
      $imageValidation = $this->validateImages($_FILES['itemImages'] ?? []);
      
      // Combine validation results
      // if(!$validation['valid'] || !$imageValidation['valid']){
      //   $_SESSION['errors'] = array_merge(
      //     $validation['errors'] ?? [], 
      //     $imageValidation['errors'] ?? []
      //   );
      //   header('Location: /item/create');
      //   exit;
      // }

      $uploadDir = dirname(__DIR__, 2) . '/storage/uploads/items/';

      // Upload images and get file paths
      $uploadResult = $this->uploadImages($_FILES['itemImages'], $uploadDir);
      
      if(!$uploadResult['success']){
        $_SESSION['errors'] = ['itemImages' => $uploadResult['error']];
        header('Location: /item/create');
        exit;
      }

      // Create item in database
      $itemModel = new ItemModel();
      
      $result = $itemModel->createItem(
        $userId,
        $sanitizedInputs,
        $uploadResult['images']
      );

      if($result['success']){
        // Clear session data
        unset($_SESSION['formData']);
        $_SESSION['success'] = 'Item listed successfully!';
        header('Location: /item/browse');
        exit;
      } else {
        // Delete uploaded images if database insert fails
        $this->deleteUploadedImages($uploadResult['images']);
        $_SESSION['errors'] = ['general' => $result['error'] ?? 'Failed to create item listing. Please try again.'];
        header('Location: /item/create');
        exit;
      }
    }
  }

  /**
   * Upload images and return file paths
   */
  private function uploadImages(array $files, string $uploadDir): array {
    // Ensure upload directory exists
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }

    $uploadedImages = [];
    $fileCount = count($files['name']);

    for ($i = 0; $i < $fileCount; $i++) {
      // Skip empty files
      if ($files['error'][$i] === UPLOAD_ERR_NO_FILE) {
        continue;
      }

      // Check if file was uploaded
      if ($files['error'][$i] !== UPLOAD_ERR_OK) {
        $this->deleteUploadedImages($uploadedImages);
        return ['success' => false, 'error' => 'File upload error'];
      }

      // Validate file type
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mimeType = finfo_file($finfo, $files['tmp_name'][$i]);
      finfo_close($finfo);

      if (!in_array($mimeType, self::ALLOWED_TYPES)) {
        $this->deleteUploadedImages($uploadedImages);
        return ['success' => false, 'error' => 'Invalid file type'];
      }

      // Validate file size
      if ($files['size'][$i] > self::MAX_FILE_SIZE) {
        $this->deleteUploadedImages($uploadedImages);
        return ['success' => false, 'error' => 'File size exceeds 5MB limit'];
      }

      // Generate unique filename
      $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
      $filename = uniqid() . '.' . $extension;
      $filepath = $uploadDir . $filename;

      // Move uploaded file
      if (!move_uploaded_file($files['tmp_name'][$i], $filepath)) {
        $this->deleteUploadedImages($uploadedImages);
        return ['success' => false, 'error' => 'Failed to save uploaded file'];
      }

      // Store relative path for database
      $uploadedImages[] = '/uploads/items/' . $filename;
    }

    if (empty($uploadedImages)) {
      return ['success' => false, 'error' => 'No images uploaded'];
    }

    return ['success' => true, 'images' => $uploadedImages];
  }

  /**
   * Delete uploaded images (cleanup on error)
   */
  private function deleteUploadedImages(array $imagePaths): void {
    foreach ($imagePaths as $path) {
      $fullPath = __DIR__ . '/../../public' . $path;
      if (file_exists($fullPath)) {
        unlink($fullPath);
      }
    }
  }

  /**
   * Store form data in session for repopulation
   */
  private function itemDataSession(array $data): void {
    $_SESSION['formData'] = $data;
  }

  private function sanitizeInputs(array $data): array {
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
      'minDuration'        => 'number',
      'minDurationUnit'    => 'string',
      'maxDuration'        => 'number|null',
      'maxDurationUnit'    => 'string|null',
      'availableFrom'      => 'string',
      'availableUntil'     => 'string|null',
      'pickUpLocation'     => 'string',
      'returnStatement'    => 'string',
      'cancellationPolicy' => 'string',
      'agreeTerms'         => 'string'
    ];

    $sanitizedInputs = [];

    foreach($fields as $field => $type){
      $value = $data[$field] ?? null;

      switch($type){
        case 'string':
          $sanitizedInputs[$field] = Sanitizer::sanitizeString($value);
          break;
        case 'string|null':
          $sanitizedInputs[$field] = $value ? Sanitizer::sanitizeString($value) : null;
          break;
        case 'number':
          $sanitizedInputs[$field] = Sanitizer::sanitizeInt($value);
          break;
        case 'number|null':
          $sanitizedInputs[$field] = $value ? Sanitizer::sanitizeInt($value) : null;
          break;
        case 'float':
          $sanitizedInputs[$field] = Sanitizer::sanitizeFloat($value);
          break;
        case 'float|null':
          $sanitizedInputs[$field] = $value ? Sanitizer::sanitizeFloat($value) : null;
          break;
      }
    }

    return $sanitizedInputs;
  }

  private function validateListingData(array $sanitizedInputs): array {
    return ItemListingValidator::validateItemListing($sanitizedInputs);
  }

  private function validateImages(array $files): array {
    return ItemListingValidator::validateItemImages($files);
  }
}