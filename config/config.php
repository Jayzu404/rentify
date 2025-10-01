<?php
ini_set('log_error', 1);
ini_set('error_log', dirname(__DIR__) . '/storage/logs/error_logs.php');
define('DEBUG_MODE', true); // set to false in production
define('BASE_URL', 'http://rentify.local');
define('BASE_PATH', dirname(__DIR__));