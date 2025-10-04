<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/models/AuthModel.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/helpers/Sanitizer.php';
require_once dirname(__DIR__) . '/helpers/Validator.php';

class AuthController extends Controller {

  public function authSignup(){
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //Sanitize user data/input
      $sanitizedInputs = $this->sanitizeInputs($_POST);

      //Validate user data/input
      $validation = $this->validateInputs($sanitizedInputs);

      if(!$validation['valid']){
        header('Location: /auth/signup');
        exit;
      }

      //Hashing the password before storing into the database
      $hashedPassword = password_hash($sanitizedInputs['password'], PASSWORD_DEFAULT);
      
      //id upload directory
      $uploadDir = dirname(__DIR__, 2) . '/storage/uploads/ids/';
      $savedFile = Sanitizer::saveUploadedFile($sanitizedInputs['validId'], $uploadDir);

      $authModel = new AuthModel();

      $result = $authModel->createUser(
        $sanitizedInputs['firstName'],
        $sanitizedInputs['middleName'],
        $sanitizedInputs['lastName'],
        $sanitizedInputs['address'],
        $sanitizedInputs['email'],
        $savedFile,
        $hashedPassword
      );

      if($result['status'] === 'success'){
        header('Location: /home/index');
        exit;
      } else {
        header('Location: /auth/signup');
        exit;
      }

    }
  }

  public function authLogin(){

  }

  public function login(){
    $this->view(Views::LOGIN);
  }

  public function signup(){
    $this->view(Views::SIGNUP);
  }

  private function sanitizeInputs(array $postData): array {
    $fields = [
      'firstName'    => 'string',
      'middleName'   => 'string|null',
      'lastName'     => 'string',
      'address'      => 'string',
      'email'        => 'email',
      'password'     => 'string',
      'confirmPassword' => 'string',
      'validId'      => 'file'
    ];

    $sanitizedInputs = [];

    foreach ($fields as $field => $type) {
      $value = $postData[$field] ?? null;
      if ($type === 'string') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeString($value);
      } elseif ($type === 'string|null') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeString($value) ?: null;
      } elseif ($type === 'email') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeEmail($value);
      } elseif ($type === 'number') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeInt($value);
      } elseif ($type === 'file') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeFile($_FILES[$field]);
      }
    }

    return $sanitizedInputs;
  }

  private function validateInputs($sanitizedInputs): array{
    return Validator::validateUserRegistration($sanitizedInputs);
  }

} 