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
      $sanitizedInputs = $this->signupSanitizeInputs($_POST);

      //Validate user data/input
      $validation = $this->validateInputs($sanitizedInputs, 'signup');

      //Store user data/input in session
      $this->userDataSession($sanitizedInputs, 'signup');

      if(!$validation['valid']){
        header('Location: /auth/signup?signup=failed');
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

      if($result['success']){
        unset($_SESSION['userFormData'], $_SESSION['errors']);
        $_SESSION['successSignup'] = true;
        header('Location: /auth/login?signup=success');
        exit;
      } else {
        $this->handleRegistrationErrors($result['error']);
        header('Location: /auth/signup?signup=failed');
        exit;
      }

    }
  }

  public function authLogin(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

      if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
      }

      $sanitizedInputs = $this->loginSanitizeInput($_POST);

      $validation = $this->validateInputs($sanitizedInputs, 'login');

      if(!$validation['valid']){
        header('/auth/login?login=failed');
        exit;
      }

      $this->userDataSession($sanitizedInputs, 'login');

      $authModel = new AuthModel();
      $result = $authModel->authenticateUser($sanitizedInputs['email'], $sanitizedInputs['password']);

      if($result['success']){
        unset($_SESSION['userFormData'], $_SESSION['errors']);
        $_SESSION['user'] = $result['user'];
        $_SESSION['isLoggedIn'] = true;
        header('Location: /home');
        exit;
      } else {
        $this->handleLoginAuthenticationErrors($result['error']);
        $_SESSION['isLoggedIn'] = false;
        header('Location: /auth/login?login=failed');
        exit;
      }
    }
  }

  public function login(){
    $this->view(Views::LOGIN);
  }

  public function signup(){
    $this->view(Views::SIGNUP);
  }

  private function userDataSession(array $sanitizedInputs, $type): void{
    switch($type){
      case 'signup':
        $fields = [
          'firstName',
          'middleName',
          'lastName',
          'address',
          'email',
          'password',
          'confirmPassword',
          'validId'
        ];

        $_SESSION['userFormData'] = [];

        foreach($fields as $field){
          $_SESSION['userFormData'][$field] = $sanitizedInputs[$field];
        }

        break;
      case 'login':
        $_SESSION['userFormData']['email'] = $sanitizedInputs['email'];
        break;
    }
  }

  private function signupSanitizeInputs(array $postData): array {
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

  private function loginSanitizeInput(array $postData): array{
    $fields = [
      'email' => 'email',
      'password' => 'password'
    ];

    $sanitizedInputs = [];

    foreach($fields as $field => $type){
      $value = $postData[$field] ?? null;

      if ($type === 'email') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeEmail($value);
      } elseif ($type === 'password') {
        $sanitizedInputs[$field] = Sanitizer::sanitizeString($value);
      }
    }

    return $sanitizedInputs;
  }

  private function validateInputs($sanitizedInputs, $type): array{
    switch($type){
      case 'signup':
        return Validator::validateUserRegistration($sanitizedInputs);
      case 'login':
        return Validator::validateUserLogin($sanitizedInputs);
    }
    return [];
  }

  private function handleRegistrationErrors($errors){
    switch($errors){
      case 'EMAIL_EXIST':
      case 'DUPLICATE_ENTRY':
        $_SESSION['errors']['email'] = 'Email already exist';
        break;
      case 'INSERT_FAILED':
      case 'DATABASE_ERROR':
        $_SESSION['errors']['general'] = 'Something went wrong, Please try again later';
        break;
    }
  }

  private function handleLoginAuthenticationErrors($errors){
    switch($errors){
      case 'DATABASE_ERROR':
        $_SESSION['errors']['general'] = 'Something went wrong, Please try again later';
        break;
      case 'INVALID_CREDENTIALS':
        $_SESSION['errors']['general'] = 'Incorrect email or password';
        break;
    }
  }

} 