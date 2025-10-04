[01-Oct-2025 18:09:03 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (viedws) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[02-Oct-2025 10:26:12 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app/helper/Sanitizer.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 4
[02-Oct-2025 10:26:12 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app/helper/Sanitizer.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\controllers\AuthController.php:4
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(52): require_once()
#1 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#2 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#3 {main}
  thrown in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 4
[02-Oct-2025 10:28:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (views) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[02-Oct-2025 10:29:05 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (views) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[04-Oct-2025 08:31:08 Europe/Berlin] PHP Fatal error:  Uncaught Error: Class "DbConnection" not found in C:\xampp\htdocs\rentify\app\models\AuthModel.php:36
Stack trace:
#0 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(3): require_once()
#1 C:\xampp\htdocs\rentify\app\core\App.php(52): require_once('C:\\xampp\\htdocs...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#3 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#4 {main}
  thrown in C:\xampp\htdocs\rentify\app\models\AuthModel.php on line 36
[04-Oct-2025 08:39:42 Europe/Berlin] PHP Fatal error:  Uncaught TypeError: trim(): Argument #1 ($string) must be of type string, null given in C:\xampp\htdocs\rentify\app\helpers\Sanitizer.php:14
Stack trace:
#0 C:\xampp\htdocs\rentify\app\helpers\Sanitizer.php(14): trim(NULL)
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(87): Sanitizer::sanitizeString(NULL)
#2 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(17): AuthController->sanitizeInputs(Array)
#3 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#4 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#5 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#6 {main}
  thrown in C:\xampp\htdocs\rentify\app\helpers\Sanitizer.php on line 14
[04-Oct-2025 09:13:56 Europe/Berlin] PHP Fatal error:  Uncaught TypeError: trim(): Argument #1 ($string) must be of type string, null given in C:\xampp\htdocs\rentify\app\helpers\Sanitizer.php:40
Stack trace:
#0 C:\xampp\htdocs\rentify\app\helpers\Sanitizer.php(40): trim(NULL)
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(89): Sanitizer::sanitizeEmail(NULL)
#2 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(15): AuthController->sanitizeInputs(Array)
#3 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#4 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#5 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#6 {main}
  thrown in C:\xampp\htdocs\rentify\app\helpers\Sanitizer.php on line 40
[04-Oct-2025 09:19:53 Europe/Berlin] PHP Warning:  Undefined array key "validId" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 93
[04-Oct-2025 09:42:26 Europe/Berlin] PHP Fatal error:  Uncaught TypeError: Validator::isRequired(): Argument #1 ($value) must be of type string, array given, called in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 64 and defined in C:\xampp\htdocs\rentify\app\helpers\Validator.php:98
Stack trace:
#0 C:\xampp\htdocs\rentify\app\helpers\Validator.php(64): Validator::isRequired(Array)
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(100): Validator::validateUserRegistration(Array)
#2 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(18): AuthController->validateInputs(Array)
#3 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#4 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#5 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#6 {main}
  thrown in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 98
[04-Oct-2025 09:47:20 Europe/Berlin] PHP Warning:  Undefined array key "error" in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 64
[04-Oct-2025 09:51:36 Europe/Berlin] PHP Warning:  Undefined array key "error" in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 64
[04-Oct-2025 09:54:00 Europe/Berlin] PHP Warning:  Undefined array key "status" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 44
