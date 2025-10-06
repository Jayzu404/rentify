<?php

declare(strict_types=1);

class Validator {
  
  /**
   * Validate user registration data
   * 
   * @param array<string, mixed> $data
   * @return array{valid: bool, errors: array<string, string>}
   */
  public static function validateUserRegistration(array $data): array {
    $errors = [];
    
    // Required fields
    if (!self::isRequired($data['firstName'] ?? '')) {
      $errors['firstName'] = 'First name is required';
    } elseif (!self::maxLength($data['firstName'], 50)) {
      $errors['firstName'] = 'First name must not exceed 50 characters';
    }
    
    if (!self::isRequired($data['lastName'] ?? '')) {
      $errors['lastName'] = 'Last name is required';
    } elseif (!self::maxLength($data['lastName'], 50)) {
      $errors['lastName'] = 'Last name must not exceed 50 characters';
    }
    
    // Middle name is optional
    if (!empty($data['middleName']) && !self::maxLength($data['middleName'], 50)) {
      $errors['middleName'] = 'Middle name must not exceed 50 characters';
    }
    
    if (!self::isRequired($data['address'] ?? '')) {
      $errors['address'] = 'Address is required';
    } elseif (!self::maxLength($data['address'], 255)) {
      $errors['address'] = 'Address must not exceed 255 characters';
    }
    
    // Email validation
    if (!self::isRequired($data['email'] ?? '')) {
      $errors['email'] = 'Email is required';
    } elseif (!self::isValidEmail($data['email'])) {
      $errors['email'] = 'Invalid email format';
    } elseif (!self::maxLength($data['email'], 255)) {
      $errors['email'] = 'Email must not exceed 255 characters';
    }
    
    // Password validation
    // if (!self::isRequired($data['password'] ?? '')) {
    //   $errors['password'] = 'Password is required';
    // } elseif (!self::minLength($data['password'], 8)) {
    //   $errors['password'] = 'Password must be at least 8 characters';
    // } elseif (!self::isStrongPassword($data['password'])) {
    //   $errors['password'] = 'Please choose strong password with mixed characters';
    // }
    
    // Confirm password
    if (isset($data['confirmPassword']) && $data['password'] !== $data['confirmPassword']) {
      $errors['confirmPassword'] = 'Passwords do not match';
    }
    
    // ID file validation
    if (!isset($data['validId'])) {
      $errors['validId'] = "Valid ID is required";
    }
    
    if(session_status() !== PHP_SESSION_ACTIVE){
      session_start();
    }
    
    $_SESSION['errors'] = $errors;
    
    return [
      'valid' => empty($errors),
      'errors' => $errors
    ];
  }

  public static function validateUserLogin($data){
    $errors = [];

    if (!self::isRequired($data['email'] ?? '')) {
      $errors['Email'] = 'Email is required';
    } elseif(!self::isValidEmail($data['email'])) {
      $errors['email'] = 'Invalid email, Please try again';
    }

    if (!self::isRequired($data['password'] ?? '')) {
      $errors['password'] = 'Password is required';
    }

    return [
      'valid' => empty($errors),
      'errors' => $errors
    ];
  }
  
  /**
   * Validate email format
   */
  public static function isValidEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
  }
  
  /**
   * Check minimum length
   */
  public static function minLength(string $value, int $min): bool {
    return mb_strlen($value) >= $min; // Use mb_strlen for multibyte support
  }
  
  /**
   * Check maximum length
   */
  public static function maxLength(string $value, int $max): bool {
    return mb_strlen($value) <= $max;
  }
  
  /**
   * Check if value is required (not empty after trimming)
   */
  public static function isRequired(string $value): bool {
    return trim($value) !== '';
  }
  
  /**
   * Check if value is numeric
   */
  public static function isNumeric(mixed $value): bool {
    return is_numeric($value);
  }
  
  /**
   * Check if numeric value is within range
   */
  public static function inRange(int|float $value, int|float $min, int|float $max): bool {
    return $value >= $min && $value <= $max;
  }
  
  /**
   * Check if password meets strength requirements
   */
  public static function isStrongPassword(string $password): bool {
    // At least one uppercase, one lowercase, one number, one special char
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]/', $password) === 1;
  }
  
  /**
   * Validate phone number (optional helper)
   */
  public static function isValidPhone(string $phone): bool {
    // Simple Philippine phone number validation
    return preg_match('/^(09|\+639)\d{9}$/', $phone) === 1;
  }
  
  /**
   * Check if string contains only letters
   */
  public static function isAlpha(string $value): bool {
    return ctype_alpha($value);
  }
  
  /**
   * Check if string contains only letters and spaces
   */
  public static function isAlphaSpace(string $value): bool {
    return preg_match('/^[a-zA-Z\s]+$/', $value) === 1;
  }
}