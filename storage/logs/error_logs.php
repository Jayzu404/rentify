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
[04-Oct-2025 14:11:17 Europe/Berlin] PHP Warning:  Undefined array key "status" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 47
[04-Oct-2025 14:12:43 Europe/Berlin] PHP Warning:  Undefined array key "status" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 47
[04-Oct-2025 14:17:01 Europe/Berlin] PHP Warning:  Undefined array key "status" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 47
[04-Oct-2025 19:21:09 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 19:21:40 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 19:47:51 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 19:51:36 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 19:51:36 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 19:51:48 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 19:51:56 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 20:11:39 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 20:11:39 Europe/Berlin] PHP Warning:  Undefined array key "status" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 47
[04-Oct-2025 20:12:48 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[04-Oct-2025 20:12:48 Europe/Berlin] PHP Warning:  Undefined array key "status" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 47
[04-Oct-2025 20:15:28 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 05:42:43 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 05:44:42 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 05:45:22 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 10:20:45 Europe/Berlin] PHP Parse error:  syntax error, unexpected token "case" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 51
[05-Oct-2025 10:22:09 Europe/Berlin] PHP Parse error:  syntax error, unexpected token "case" in C:\xampp\htdocs\rentify\app\controllers\AuthController.php on line 51
[05-Oct-2025 10:31:15 Europe/Berlin] PHP Warning:  Undefined array key "general" in C:\xampp\htdocs\rentify\app\views\auth\signup.php on line 23
[05-Oct-2025 10:31:15 Europe/Berlin] PHP Warning:  Undefined array key "general" in C:\xampp\htdocs\rentify\app\views\auth\signup.php on line 23
[05-Oct-2025 10:43:34 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 10:43:47 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 10:44:07 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 10:44:42 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\helpers\Validator.php on line 67
[05-Oct-2025 10:44:46 Europe/Berlin] Connection error: SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it
[05-Oct-2025 10:44:46 Europe/Berlin] PHP Fatal error:  Uncaught Error: Call to a member function prepare() on null in C:\xampp\htdocs\rentify\app\models\AuthModel.php:125
Stack trace:
#0 C:\xampp\htdocs\rentify\app\models\AuthModel.php(46): AuthModel->emailExists('dumffmy@gmail.c...')
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(37): AuthModel->createUser('Teejay', NULL, 'Arancina', 'Salangi', 'dumffmy@gmail.c...', 'cd5e0b31b853502...', '$2y$10$b30niDXO...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#3 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\models\AuthModel.php on line 125
[05-Oct-2025 10:47:27 Europe/Berlin] Connection error: SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it
[05-Oct-2025 10:47:27 Europe/Berlin] PHP Fatal error:  Uncaught Error: Call to a member function prepare() on null in C:\xampp\htdocs\rentify\app\models\AuthModel.php:125
Stack trace:
#0 C:\xampp\htdocs\rentify\app\models\AuthModel.php(46): AuthModel->emailExists('dumffmy@gmail.c...')
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(37): AuthModel->createUser('Teejay', NULL, 'Arancina', 'Salangi', 'dumffmy@gmail.c...', '9e28fd2d316f448...', '$2y$10$OsU/XsaE...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#3 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\models\AuthModel.php on line 125
[05-Oct-2025 17:07:49 Europe/Berlin] PHP Warning:  Undefined global variable $_SESSION in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 28
[05-Oct-2025 17:18:33 Europe/Berlin] PHP Parse error:  syntax error, unexpected end of file, expecting "elseif" or "else" or "endif" in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 41
[05-Oct-2025 17:19:01 Europe/Berlin] PHP Warning:  Undefined global variable $_SESSION in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 12
[05-Oct-2025 17:19:01 Europe/Berlin] PHP Warning:  Trying to access array offset on value of type null in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 12
[05-Oct-2025 17:20:48 Europe/Berlin] PHP Warning:  Undefined global variable $_SESSION in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 30
[05-Oct-2025 17:26:07 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 31
[05-Oct-2025 17:26:12 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 31
[05-Oct-2025 17:26:28 Europe/Berlin] PHP Notice:  session_start(): Ignoring session_start() because a session is already active in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 31
[05-Oct-2025 21:11:34 Europe/Berlin] PHP Warning:  Undefined array key "errors" in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 27
[05-Oct-2025 21:11:34 Europe/Berlin] PHP Warning:  Trying to access array offset on value of type null in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 27
[05-Oct-2025 21:16:26 Europe/Berlin] Failed login attempt for email: dumdddmy@gmail.com
[06-Oct-2025 04:31:42 Europe/Berlin] Failed login attempt for email: ccccccdummy@gmail.com
[06-Oct-2025 04:32:36 Europe/Berlin] Failed login attempt for email: ccccccdummy@gmail.com
[06-Oct-2025 04:32:52 Europe/Berlin] Failed login attempt for email: ccccccdummy@gmail.com
[06-Oct-2025 04:33:15 Europe/Berlin] Failed login attempt for email: ccccccdummy@gmail.com
[06-Oct-2025 04:33:57 Europe/Berlin] Failed login attempt for email: dusssmmy@gmail.com
[06-Oct-2025 04:35:31 Europe/Berlin] Failed login attempt for email: dssssummy@gmail.com
[06-Oct-2025 04:38:53 Europe/Berlin] Failed login attempt for email: dssssummy@gmail.com
[06-Oct-2025 04:41:07 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 04:42:32 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 04:44:31 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 04:57:37 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:57:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:11 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:40 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:40 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:40 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:40 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:41 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:58:41 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 23
[06-Oct-2025 04:59:13 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 04:59:13 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 04:59:22 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 04:59:22 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:33 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:33 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:41 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:42 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:59 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:00:59 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:33 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:34 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:35 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:36 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:37 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:37 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:44 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:45 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:45 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:49 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:49 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:51 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 22
[06-Oct-2025 05:01:55 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 05:02:22 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 05:03:45 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:03:45 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:08 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:08 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:08 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:08 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:09 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:04:10 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:08:50 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:08:50 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:08:51 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:08:51 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:08:51 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:08:51 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:09:20 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:09:20 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:09:50 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:09:50 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:13:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:13:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:13:38 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:13:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:13:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:13:39 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:14:22 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:14:22 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:14:23 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:14:24 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:14:25 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:14:25 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:17:02 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:17:02 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:17:03 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:17:04 Europe/Berlin] PHP Warning:  Undefined array key "isLoggedIn" in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 24
[06-Oct-2025 05:23:14 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 05:30:14 Europe/Berlin] Successful login for user ID: 15
