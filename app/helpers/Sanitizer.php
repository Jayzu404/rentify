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
  public static function sanitizeString(?string $data): string {
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

  /**
   * Sanitize uploaded file data
   * - Strips dangerous characters from filename
   * - Keeps metadata (type, tmp_name, size, error)
   * - Returns null if no file uploaded
   */
  public static function sanitizeFile(?array $file): ?array {
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
      return null;
    }

    return [
      'name'     => preg_replace("/[^a-zA-Z0-9_\.-]/", "_", basename($file['name'])),
      'type'     => $file['type'],
      'size'     => (int) $file['size'],
      'tmp_name' => $file['tmp_name'],
      'error'    => $file['error']
    ];
  }

  /**
   * Escape safely for output (to prevent XSS)
   */
  public static function safeEcho($data): void {
    echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  }
}