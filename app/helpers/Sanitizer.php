<?php
declare(strict_types=1);

// HELPER FOR SANITIZING

class Sanitizer{ 
  /**
   * Sanitize a string input (names, address, etc.)
   * - Trim whitespace
   * - Remove tags
   * - Convert special chars to safe HTML entities (on output use safeEcho)
   */
  public static function sanitizeString(?string $data): string|null {
    if($data === null){
      return null;
    }
    $data = trim($data);                     // Remove whitespace
    $data = strip_tags($data);               // Remove HTML tags
    return $data;                            // Store raw, safe string
  }

  /**
   * Sanitize an integer (e.g. age, quantity, id)
   */
  public static function sanitizeInt(?String $data): int {
    return (int) filter_var($data, FILTER_SANITIZE_NUMBER_INT) ?? 0;
  }

  /**
   * Sanitize a float/decimal (e.g. price, amount)
   */
  public static function sanitizeFloat(?String $data): float {
    return (float) filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ?? 0.0;
  }

  /**
   * Validate email
   */
  public static function sanitizeEmail(?string $email): string {
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
  }

  /**
   * Sanitize and validate a date (expects YYYY-MM-DD format from type="date" input)
   * @param string|null $date The date string to validate
   * @param string $format Expected date format (default: Y-m-d)
   * @return string|null Returns validated date string or null if invalid
   */
  public static function sanitizeDate(?string $date, string $format = 'Y-m-d'): ?string {
    if ($date === null || trim($date) === '') {
      return null;
    }
    
    $date = trim($date);
    
    // Validate format pattern (YYYY-MM-DD)
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
      return null;
    }
    
    // Verify it's a real, valid date
    $dateObj = DateTime::createFromFormat($format, $date);
    
    // Check if date was parsed correctly and matches original string
    // This catches invalid dates like 2024-02-30 or 2024-13-01
    if (!$dateObj || $dateObj->format($format) !== $date) {
      return null;
    }
    
    return $date;
  }
  
  /**
   * Sanitize and validate a datetime (expects YYYY-MM-DD HH:MM:SS format)
   * @param string|null $datetime The datetime string to validate
   * @return string|null Returns validated datetime string or null if invalid
   */
  public static function sanitizeDateTime(?string $datetime): ?string {
    if ($datetime === null || trim($datetime) === '') {
      return null;
    }
    
    $datetime = trim($datetime);
    
    // Validate format pattern (YYYY-MM-DD HH:MM:SS)
    if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $datetime)) {
      return null;
    }
    
    // Verify it's a real, valid datetime
    $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
    
    if (!$dateObj || $dateObj->format('Y-m-d H:i:s') !== $datetime) {
      return null;
    }
    
    return $datetime;
  }

  public static function sanitizeFile($file) {
    // Check if file was uploaded
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
      return null;
    }
    
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
      throw new Exception('File upload error: ' . $file['error']);
    }
    
    // Validate file size (max 5MB)
    $maxSize = 5 * 1024 * 1024; // 5MB in bytes
    if ($file['size'] > $maxSize) {
      throw new Exception('File size exceeds maximum allowed size');
    }
    
    // Get file extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    // Allowed image extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    
    if (!in_array($extension, $allowedExtensions)) {
      throw new Exception('Invalid file type. Only images are allowed');
    }
    
    // Verify MIME type (don't trust the extension alone)
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $allowedMimeTypes = [
      'image/jpeg',
      'image/png',
      'image/gif',
      'image/webp'
    ];
    
    if (!in_array($mimeType, $allowedMimeTypes)) {
      throw new Exception('Invalid file MIME type');
    }
    
    // Verify it's actually an image by trying to load it
    $imageInfo = @getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
      throw new Exception('File is not a valid image');
    }
    
    // Generate a safe, unique filename
    $safeFilename = bin2hex(random_bytes(16)) . '.' . $extension;
    
    // Return sanitized file data
    return [
      'tmp_name'  => $file['tmp_name'],
      'name'      => $safeFilename,
      'size'      => $file['size'],
      'type'      => $mimeType,
      'extension' => $extension,
      'original_name' => basename($file['name']) // sanitized original name
    ];
  }
    
  // Helper method to move the file to permanent storage
  public static function saveUploadedFile($sanitizedFile, $uploadDir) {
    if (!$sanitizedFile) {
      return null;
    }
    
    // Ensure upload directory exists and is writable
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0755, true);
    }
    
    $destination = $uploadDir . '/' . $sanitizedFile['name'];
    
    if (!move_uploaded_file($sanitizedFile['tmp_name'], $destination)) {
      throw new Exception('Failed to move uploaded file');
    }
    
    return $sanitizedFile['name']; // Return the filename for database storage
  }

  /**
   * Escape safely for output (to prevent XSS)
   */
  public static function safeEcho($data): void {
    echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  }
}