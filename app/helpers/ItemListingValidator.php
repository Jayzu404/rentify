<?php

declare(strict_types=1);

class ItemListingValidator {
  
  /**
   * Validate item listing data
   * 
   * @param array<string, mixed> $data
   * @return array{valid: bool, errors: array<string, string>}
   */
  public static function validateItemListing(array $data): array {
    $errors = [];
    
    // Item Name - Required, max 255 chars
    if (!self::isRequired($data['itemName'] ?? '')) {
      $errors['itemName'] = 'Item name is required';
    } elseif (!self::maxLength($data['itemName'], 255)) {
      $errors['itemName'] = 'Item name must not exceed 255 characters';
    }
    
    // Quantity - Required, numeric, between 1-100
    if (!isset($data['quantity']) || $data['quantity'] === '') {
      $errors['quantity'] = 'Quantity is required';
    } elseif (!self::isNumeric($data['quantity'])) {
      $errors['quantity'] = 'Quantity must be a valid number';
    } elseif (!self::inRange((int)$data['quantity'], 1, 100)) {
      $errors['quantity'] = 'Quantity must be between 1 and 100';
    }
    
    // Category - Required, must be valid option
    if (!self::isRequired($data['category'] ?? '')) {
      $errors['category'] = 'Category is required';
    } elseif (!self::isValidCategory($data['category'])) {
      $errors['category'] = 'Invalid category selected';
    }
    
    // Brand - Optional, max 100 chars
    if (!empty($data['brand']) && !self::maxLength($data['brand'], 100)) {
      $errors['brand'] = 'Brand must not exceed 100 characters';
    }
    
    // Item Condition - Required, must be valid option
    if (!self::isRequired($data['itemCondition'] ?? '')) {
      $errors['itemCondition'] = 'Item condition is required';
    } elseif (!self::isValidCondition($data['itemCondition'])) {
      $errors['itemCondition'] = 'Invalid condition selected';
    }
    
    // Description - Required, min 20 chars, max 2000 chars
    if (!self::isRequired($data['description'] ?? '')) {
      $errors['description'] = 'Description is required';
    } elseif (!self::minLength($data['description'], 20)) {
      $errors['description'] = 'Description must be at least 20 characters';
    } elseif (!self::maxLength($data['description'], 2000)) {
      $errors['description'] = 'Description must not exceed 2000 characters';
    }
    
    // Rental Price - Required, numeric, between 1-100000
    if (!isset($data['rentalPrice']) || $data['rentalPrice'] === 0 || $data['rentalPrice'] === 0.0) {
      $errors['rentalPrice'] = 'Rental price is required';
    } elseif (!self::isNumeric($data['rentalPrice'])) {
      $errors['rentalPrice'] = 'Rental price must be a valid number';
    } elseif (!self::inRange((float)$data['rentalPrice'], 1, 100000)) {
      $errors['rentalPrice'] = 'Rental price must be between ₱1 and ₱100,000';
    }
    
    // Price Rate - Required, must be valid option
    if (!self::isRequired($data['priceRate'] ?? '')) {
      $errors['priceRate'] = 'Price rate is required';
    } elseif (!self::isValidPriceRate($data['priceRate'])) {
      $errors['priceRate'] = 'Invalid price rate selected';
    }
    
    // Security Deposit - Optional, numeric, between 0-50000
    if (!empty($data['securityDeposit']) && $data['securityDeposit'] !== '') {
      if (!self::isNumeric($data['securityDeposit'])) {
        $errors['securityDeposit'] = 'Security deposit must be a valid number';
      } elseif (!self::inRange((float)$data['securityDeposit'], 0, 50000)) {
        $errors['securityDeposit'] = 'Security deposit must be between ₱0 and ₱50,000';
      }
    }
    
    // Minimum Duration - Required, numeric, between 1-365
    if (!isset($data['minDuration']) || $data['minDuration'] === '') {
      $errors['minDuration'] = 'Minimum rental duration is required';
    } elseif (!self::isNumeric($data['minDuration'])) {
      $errors['minDuration'] = 'Minimum duration must be a valid number';
    } elseif (!self::inRange((int)$data['minDuration'], 1, 365)) {
      $errors['minDuration'] = 'Minimum duration must be between 1 and 365';
    }
    
    // Minimum Duration Unit - Required, must be valid option
    if (!self::isRequired($data['minDurationUnit'] ?? '')) {
      $errors['minDurationUnit'] = 'Minimum duration unit is required';
    } elseif (!self::isValidDurationUnit($data['minDurationUnit'])) {
      $errors['minDurationUnit'] = 'Invalid minimum duration unit selected';
    }
    
    // Maximum Duration - Optional, numeric, between 1-365
    if (!empty($data['maxDuration']) && $data['maxDuration'] !== '') {
      if (!self::isNumeric($data['maxDuration'])) {
        $errors['maxDuration'] = 'Maximum duration must be a valid number';
      } elseif (!self::inRange((int)$data['maxDuration'], 1, 365)) {
        $errors['maxDuration'] = 'Maximum duration must be between 1 and 365';
      }
      
      // Validate max duration is greater than min duration (if both in same units)
      if (!isset($errors['minDuration']) && !isset($errors['maxDuration'])) {
        $minUnit = $data['minDurationUnit'] ?? '';
        $maxUnit = $data['maxDurationUnit'] ?? '';
        
        if ($minUnit === $maxUnit) {
          $minDur = (int)$data['minDuration'];
          $maxDur = (int)$data['maxDuration'];
          
          if ($maxDur < $minDur) {
            $errors['maxDuration'] = 'Maximum duration must be greater than minimum duration';
          }
        }
      }
    }
    
    // Maximum Duration Unit - Optional but required if maxDuration is set
    if (!empty($data['maxDuration']) && $data['maxDuration'] !== '') {
      if (!self::isRequired($data['maxDurationUnit'] ?? '')) {
        $errors['maxDurationUnit'] = 'Maximum duration unit is required';
      } elseif (!self::isValidDurationUnit($data['maxDurationUnit'])) {
        $errors['maxDurationUnit'] = 'Invalid maximum duration unit selected';
      }
    }
    
    // Available From - Required, valid date
    if (!self::isRequired($data['availableFrom'] ?? '')) {
      $errors['availableFrom'] = 'Available from date is required';
    } elseif (!self::isValidDate($data['availableFrom'])) {
      $errors['availableFrom'] = 'Invalid date format';
    }
    
    // Available Until - Optional, valid date, must be after availableFrom
    if (!empty($data['availableUntil'])) {
      if (!self::isValidDate($data['availableUntil'])) {
        $errors['availableUntil'] = 'Invalid date format';
      } elseif (!isset($errors['availableFrom']) && !self::isDateAfter($data['availableUntil'], $data['availableFrom'])) {
        $errors['availableUntil'] = 'Available until date must be after available from date';
      }
    }
    
    // Pickup Location - Required, max 255 chars
    if (!self::isRequired($data['pickUpLocation'] ?? '')) {
      $errors['pickUpLocation'] = 'Pickup location is required';
    } elseif (!self::maxLength($data['pickUpLocation'], 255)) {
      $errors['pickUpLocation'] = 'Pickup location must not exceed 255 characters';
    }
    
    // Return Statement - Required, min 20 chars, max 1000 chars
    if (!self::isRequired($data['returnStatement'] ?? '')) {
      $errors['returnStatement'] = 'Return condition policy is required';
    } elseif (!self::minLength($data['returnStatement'], 20)) {
      $errors['returnStatement'] = 'Return policy must be at least 20 characters';
    } elseif (!self::maxLength($data['returnStatement'], 1000)) {
      $errors['returnStatement'] = 'Return policy must not exceed 1000 characters';
    }
    
    // Cancellation Policy - Required, must be valid option
    if (!self::isRequired($data['cancellationPolicy'] ?? '')) {
      $errors['cancellationPolicy'] = 'Cancellation policy is required';
    } elseif (!self::isValidCancellationPolicy($data['cancellationPolicy'])) {
      $errors['cancellationPolicy'] = 'Invalid cancellation policy selected';
    }
    
    // Terms Agreement - Required, must be checked
    if (!isset($data['agreeTerms']) || $data['agreeTerms'] !== 'on') {
      $errors['agreeTerms'] = 'You must agree to the terms and conditions';
    }
    
    return [
      'valid' => empty($errors),
      'errors' => $errors
    ];
  }

  /**
   * Validate uploaded images
   * 
   * @param array<int, array{name: string, type: string, size: int, tmp_name: string, error: int}> $files
   * @return array{valid: bool, errors: array<int|string, string>}
   */
  public static function validateItemImages(array $files): array {
  $errors = [];
  
  // Check if files array is empty or not properly structured
  if (empty($files) || !isset($files['name']) || !is_array($files['name'])) {
    $errors['itemImages'] = 'At least one image is required';
    return [
      'valid' => false,
      'errors' => $errors
    ];
  }
  
  // Count actual uploaded files (excluding empty slots)
  $uploadedCount = 0;
  foreach ($files['error'] as $error) {
    if ($error !== UPLOAD_ERR_NO_FILE) {
      $uploadedCount++;
    }
  }
  
  // At least 1 image required, maximum 5 images
  if ($uploadedCount === 0) {
    $errors['itemImages'] = 'At least one image is required';
    return [
      'valid' => false,
      'errors' => $errors
    ];
  }
  
  if ($uploadedCount > 5) {
    $errors['itemImages'] = 'Maximum 5 images allowed';
    return [
      'valid' => false,
      'errors' => $errors
    ];
  }
  
  // Validate each uploaded file
  $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
  $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes
  
  for ($i = 0; $i < count($files['name']); $i++) {
    // Skip if no file uploaded in this slot
    if ($files['error'][$i] === UPLOAD_ERR_NO_FILE) {
      continue;
    }
    
    // Check for upload errors
    if ($files['error'][$i] !== UPLOAD_ERR_OK) {
      $errors["itemImages_$i"] = self::getUploadErrorMessage($files['error'][$i]);
      continue;
    }
    
    // Validate file type by MIME type
    if (!in_array($files['type'][$i], $allowedTypes, true)) {
      $errors["itemImages_$i"] = 'Image must be JPEG, PNG, or WebP format';
      continue;
    }
    
    // Validate file extension
    $extension = strtolower(pathinfo($files['name'][$i], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions, true)) {
      $errors["itemImages_$i"] = 'Invalid file extension. Allowed: jpg, jpeg, png, webp';
      continue;
    }
    
    // Validate file size
    if ($files['size'][$i] > $maxFileSize) {
      $errors["itemImages_$i"] = 'Image size must not exceed 5MB';
      continue;
    }
    
    // Validate that it's actually an image
    if (!empty($files['tmp_name'][$i]) && is_uploaded_file($files['tmp_name'][$i])) {
      $imageInfo = @getimagesize($files['tmp_name'][$i]);
      if ($imageInfo === false) {
        $errors["itemImages_$i"] = 'File is not a valid image';
        continue;
      }
      
      // Additional MIME type verification from actual file content
      if (!in_array($imageInfo['mime'], $allowedTypes, true)) {
        $errors["itemImages_$i"] = 'Invalid image type detected';
      }
    }
  }
  
  return [
    'valid' => empty($errors),
    'errors' => $errors
  ];
}

/**
 * Get human-readable upload error message
 */
private static function getUploadErrorMessage(int $errorCode): string {
  return match($errorCode) {
    UPLOAD_ERR_INI_SIZE => 'Image exceeds maximum allowed size',
    UPLOAD_ERR_FORM_SIZE => 'Image exceeds form maximum size',
    UPLOAD_ERR_PARTIAL => 'Image was only partially uploaded',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write image to disk',
    UPLOAD_ERR_EXTENSION => 'Image upload stopped by extension',
    default => 'Unknown upload error occurred'
  };
}
  
  /**
   * Validate category
   */
  private static function isValidCategory(string $category): bool {
    $validCategories = [
      'pe_costume',
      'sports_gear',
      'textbook',
      'uniform',
      'lab_equipment',
      'electronics',
      'other'
    ];
    return in_array($category, $validCategories, true);
  }
  
  /**
   * Validate item condition
   */
  private static function isValidCondition(string $condition): bool {
    $validConditions = ['new', 'good', 'fair'];
    return in_array($condition, $validConditions, true);
  }
  
  /**
   * Validate price rate
   */
  private static function isValidPriceRate(string $rate): bool {
    $validRates = ['day', 'week', 'month'];
    return in_array($rate, $validRates, true);
  }
  
  /**
   * Validate duration unit
   */
  private static function isValidDurationUnit(string $unit): bool {
    $validUnits = ['day', 'week', 'month'];
    return in_array($unit, $validUnits, true);
  }
  
  /**
   * Validate cancellation policy
   */
  private static function isValidCancellationPolicy(string $policy): bool {
    $validPolicies = ['flexible', 'moderate', 'strict'];
    return in_array($policy, $validPolicies, true);
  }
  
  /**
   * Validate date format (YYYY-MM-DD)
   */
  private static function isValidDate(string $date): bool {
    $d = \DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
  }
  
  /**
   * Check if date1 is after date2
   */
  private static function isDateAfter(string $date1, string $date2): bool {
    $d1 = \DateTime::createFromFormat('Y-m-d', $date1);
    $d2 = \DateTime::createFromFormat('Y-m-d', $date2);
    
    if (!$d1 || !$d2) {
      return false;
    }
    
    return $d1 > $d2;
  }
  
  /**
   * Check minimum length
   */
  private static function minLength(string $value, int $min): bool {
    return mb_strlen(trim($value)) >= $min;
  }
  
  /**
   * Check maximum length
   */
  private static function maxLength(string $value, int $max): bool {
    return mb_strlen($value) <= $max;
  }
  
  /**
   * Check if value is required (not empty after trimming)
   */
  private static function isRequired(string $value): bool {
    return trim($value) !== '';
  }
  
  /**
   * Check if value is numeric
   */
  private static function isNumeric(mixed $value): bool {
    return is_numeric($value);
  }
  
  /**
   * Check if numeric value is within range
   */
  private static function inRange(int|float $value, int|float $min, int|float $max): bool {
    return $value >= $min && $value <= $max;
  }
}