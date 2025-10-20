<?php
// require_once dirname(__DIR__, 2) . '/config/config.php';
// class FileController {
//   public function image($filename) {
//     $path = BASE_PATH . '/storage/uploads/' . basename($filename);
//     if (file_exists($path)) {
//       header('Content-Type: image/' . pathinfo($path, PATHINFO_EXTENSION));
//       readfile($path);
//       exit;
//     }
//     http_response_code(404);
//     // echo "Image not found";
//   }
// }

class FileController {
  public function image(...$parts) {
    // join all URL parts into a path (e.g. uploads/items/68f37febdac23.png)
    $relativePath = implode('/', $parts);
    $fullPath = BASE_PATH . '/storage/' . $relativePath;

    if (file_exists($fullPath)) {
      header('Content-Type: ' . mime_content_type($fullPath));
      readfile($fullPath);
      exit;
    }

    http_response_code(404);
    echo "File not found: " . htmlspecialchars($relativePath);
  }
}
