<?php
require_once dirname(__DIR__, 2) . '/config/Views.php';
require_once dirname(__DIR__) . '/core/Controller.php';
require_once dirname(__DIR__) . '/helper/Sanitizer.php';

class AuthController extends Controller {

  private function authLogin(){

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
      }
    }

    /**
     * TODO: check sa ang regarding sa file upload then fish the rest of the auth features
     */

    return $sanitizedInputs;
  }

} 