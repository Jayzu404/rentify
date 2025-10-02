<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once BASE_PATH . '/app/core/App.php';

//Global exceptions/errors handling
// set_exception_handler(function(Throwable $e){
//     $logMessage = "<br>[" . date('M-d-Y H:i:s') . "]" . "<br>";
//     $logMessage .= "Uncaught " . get_class($e) . ": " . $e->getMessage() . "<br>";
//     $logMessage .= "File: " . $e->getFile() . " (Line " . $e->getLine() . ") <br>";
//     $logMessage .= "Stack trace:<br>";
    
//     // Format stack trace with proper line breaks
//     $stackTrace = $e->getTraceAsString();
//     $stackTrace = str_replace('#', '<br>#', $stackTrace); // Add line break before each #
//     $stackTrace = str_replace('\n', '<br>', $stackTrace); // Replace \n with <br>
    
//     $logMessage .= $stackTrace . "<br><hr><br>";

//     error_log($logMessage);
//     // require_once BASE_PATH . '/app/views/errors/404error.php';
// });

// $app = new App();

$data = htmlspecialchars('<script>');

echo $data;