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
    return filter_var($data, FILTER_SANITIZE_NUMBER_INT) ?? 0;
  }

  /**
   * Sanitize a float/decimal (e.g. price, amount)
   */
  public static function sanitizeFloat(?String $data): float {
    return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ?? 0.0;
  }

  /**
   * Validate email
   */
  public static function sanitizeEmail(?string $email): string {
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : '';
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