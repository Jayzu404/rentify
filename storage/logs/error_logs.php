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
[06-Oct-2025 05:47:19 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 05:48:12 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 05:49:38 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 09:59:42 Europe/Berlin] Connection error: SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it
[06-Oct-2025 09:59:42 Europe/Berlin] PHP Fatal error:  Uncaught Error: Call to a member function prepare() on null in C:\xampp\htdocs\rentify\app\models\AuthModel.php:125
Stack trace:
#0 C:\xampp\htdocs\rentify\app\models\AuthModel.php(46): AuthModel->emailExists('dummy@gmail.com')
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(37): AuthModel->createUser('Teejay', NULL, 'Arancina', 'Salangi', 'dummy@gmail.com', '8ddd6f4e76e5dec...', '$2y$10$SWhqCIOv...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#3 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\models\AuthModel.php on line 125
[06-Oct-2025 09:59:59 Europe/Berlin] Connection error: SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it
[06-Oct-2025 09:59:59 Europe/Berlin] PHP Fatal error:  Uncaught Error: Call to a member function prepare() on null in C:\xampp\htdocs\rentify\app\models\AuthModel.php:125
Stack trace:
#0 C:\xampp\htdocs\rentify\app\models\AuthModel.php(46): AuthModel->emailExists('dummy@gmail.com')
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(37): AuthModel->createUser('Teejay', NULL, 'Arancina', 'Salangi', 'dummy@gmail.com', 'a2c6db9ae4682d6...', '$2y$10$R8aR51ho...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->authSignup()
#3 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\models\AuthModel.php on line 125
[06-Oct-2025 10:01:00 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 10:23:10 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (dsfd) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 10:23:15 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (dsfd) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 15:08:49 Europe/Berlin] PHP Fatal error:  Uncaught TypeError: Cannot access offset of type string on string in C:\xampp\htdocs\rentify\app\views\auth\login.php:42
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\AuthController.php(98): Controller->view('auth/login')
#2 C:\xampp\htdocs\rentify\app\core\App.php(64): AuthController->login()
#3 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 42
[06-Oct-2025 17:59:07 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 18:33:24 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:33:24 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:34:09 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:34:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:34:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:34:53 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:35:21 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:35:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:36:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:36:53 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:36:53 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:36:56 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:37:18 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:41:49 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:43:57 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 18:47:32 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:00:29 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:00:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:02:38 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:04:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:07:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:10:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:10:51 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:11:12 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:11:24 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:11:35 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:11:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:11:55 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:12:02 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:12:12 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:12:37 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:13:04 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:13:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:14:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:17:10 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:18:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:18:10 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:18:27 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:19:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:19:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:20:05 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:20:27 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:20:45 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:21:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:22:41 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:23:02 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:23:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:23:34 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:24:21 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:24:40 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:25:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:26:11 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:27:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:28:01 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:28:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:28:23 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:29:01 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:31:23 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:31:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:32:14 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:32:27 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:32:31 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:33:40 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:34:33 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:35:15 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:36:54 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:37:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:37:59 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:41:44 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 19:41:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:49:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:50:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:52:39 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 19:59:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:00:26 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:00:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:01:04 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:01:14 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:01:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:01:55 Europe/Berlin] Successful login for user ID: 15
[06-Oct-2025 20:01:55 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:05:16 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (chrome) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:05:16 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (chrome) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:05:16 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (chrome) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:05:49 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (chrome) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[06-Oct-2025 20:05:49 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (chrome) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:32:12 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:33:47 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:34:41 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:34:57 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:35:54 Europe/Berlin] Successful login for user ID: 15
[07-Oct-2025 05:35:54 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:39:26 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:41:05 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:44:57 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:46:34 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:47:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:47:43 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:51:30 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:52:50 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:56:01 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:59:10 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 05:59:13 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 06:00:25 Europe/Berlin] Successful login for user ID: 15
[07-Oct-2025 06:00:26 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 06:04:18 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 08:41:27 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 08:42:18 Europe/Berlin] Successful login for user ID: 15
[07-Oct-2025 08:42:18 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 10:21:30 Europe/Berlin] Successful login for user ID: 15
[07-Oct-2025 10:21:30 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 10:22:36 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[07-Oct-2025 10:23:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 15:10:36 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 15:11:17 Europe/Berlin] Successful login for user ID: 15
[08-Oct-2025 15:11:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 15:34:33 Europe/Berlin] PHP Parse error:  syntax error, unexpected token ")" in C:\xampp\htdocs\rentify\app\controllers\HomeController.php on line 11
[08-Oct-2025 15:34:36 Europe/Berlin] PHP Parse error:  syntax error, unexpected token ")" in C:\xampp\htdocs\rentify\app\controllers\HomeController.php on line 11
[08-Oct-2025 15:51:10 Europe/Berlin] PHP Parse error:  syntax error, unexpected token ")" in C:\xampp\htdocs\rentify\app\controllers\HomeController.php on line 11
[08-Oct-2025 15:51:11 Europe/Berlin] PHP Parse error:  syntax error, unexpected token ")" in C:\xampp\htdocs\rentify\app\controllers\HomeController.php on line 11
[08-Oct-2025 20:41:01 Europe/Berlin] PHP Parse error:  syntax error, unexpected token ")" in C:\xampp\htdocs\rentify\app\controllers\HomeController.php on line 11
[08-Oct-2025 20:41:05 Europe/Berlin] PHP Parse error:  syntax error, unexpected token ")" in C:\xampp\htdocs\rentify\app\controllers\HomeController.php on line 11
[08-Oct-2025 20:41:57 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:50:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:50:26 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (browse) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:50:51 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (browse) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:50:55 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (browse) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:52:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:52:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (browse) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:53:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (HomeController) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:59
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(34): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 59
[08-Oct-2025 20:58:19 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:02:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:02:47 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:03:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:03:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:03:49 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:03:57 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:04:03 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:04:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:04:37 Europe/Berlin] Successful login for user ID: 15
[08-Oct-2025 21:04:37 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:07:23 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:08:33 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:08:43 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:10:36 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:10:41 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:10:46 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:10:49 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:10:54 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:11:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:04 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (app.css) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:05 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:08 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (app.css) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:09 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:13 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:45 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:50 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:12:55 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:13:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[08-Oct-2025 21:13:18 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:24:19 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:24:29 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:25:11 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:26:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:26:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:27:09 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:27:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:27:29 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:30:46 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:30:51 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:31:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:31:40 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:31:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:45:54 Europe/Berlin] PHP Fatal error:  Uncaught Error: Object of class Directory could not be converted to string in C:\xampp\htdocs\rentify\app\views\pages\browse_items.php:2
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\ItemController.php(7): Controller->view('/pages/browse_i...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): ItemController->browse()
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\browse_items.php on line 2
[09-Oct-2025 05:46:43 Europe/Berlin] PHP Fatal error:  Uncaught Error: Object of class Directory could not be converted to string in C:\xampp\htdocs\rentify\app\views\pages\browse_items.php:102
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\ItemController.php(7): Controller->view('/pages/browse_i...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): ItemController->browse()
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\browse_items.php on line 102
[09-Oct-2025 05:46:47 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:46:49 Europe/Berlin] PHP Fatal error:  Uncaught Error: Object of class Directory could not be converted to string in C:\xampp\htdocs\rentify\app\views\pages\browse_items.php:102
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\ItemController.php(7): Controller->view('/pages/browse_i...')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): ItemController->browse()
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\browse_items.php on line 102
[09-Oct-2025 05:47:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:49:45 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:49:46 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:49:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:49:52 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:49:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:50:06 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:51:02 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:52:14 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:52:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:52:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:52:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:54:53 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app\views/components/rencently-added.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:54:53 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app\views/components/rencently-added.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\views\pages\home.php:63
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\HomeController.php(7): Controller->view('pages/home')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): HomeController->index()
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:54:53 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app\views/components/rencently-added.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:54:53 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app\views/components/rencently-added.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\views\pages\home.php:63
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\HomeController.php(7): Controller->view('pages/home')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): HomeController->index('favicon.ico')
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:55:32 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app\views/components/recently-added.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:55:32 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app\views/components/recently-added.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\views\pages\home.php:63
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\HomeController.php(7): Controller->view('pages/home')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): HomeController->index()
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:55:33 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app\views/components/recently-added.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:55:33 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app\views/components/recently-added.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\views\pages\home.php:63
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\HomeController.php(7): Controller->view('pages/home')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): HomeController->index('favicon.ico')
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:58:03 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app\views/components/recently-added.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:58:03 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app\views/components/recently-added.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\views\pages\home.php:63
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\HomeController.php(7): Controller->view('pages/home')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): HomeController->index()
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:58:03 Europe/Berlin] PHP Warning:  require_once(C:\xampp\htdocs\rentify\app\views/components/recently-added.php): Failed to open stream: No such file or directory in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:58:03 Europe/Berlin] PHP Fatal error:  Uncaught Error: Failed opening required 'C:\xampp\htdocs\rentify\app\views/components/recently-added.php' (include_path='C:\xampp\php\PEAR') in C:\xampp\htdocs\rentify\app\views\pages\home.php:63
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\Controller.php(9): require_once()
#1 C:\xampp\htdocs\rentify\app\controllers\HomeController.php(7): Controller->view('pages/home')
#2 C:\xampp\htdocs\rentify\app\core\App.php(65): HomeController->index('favicon.ico')
#3 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#4 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#5 {main}
  thrown in C:\xampp\htdocs\rentify\app\views\pages\home.php on line 63
[09-Oct-2025 05:58:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 05:59:29 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:01:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:01:25 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:01:32 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:01:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:06:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:07:16 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:09:05 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:11:35 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:13:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:13:36 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (contact) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:13:41 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:13:47 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:14:38 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:14:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (contact) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:16:50 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:16:54 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:17:01 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:18:18 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:21:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (contact) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:21:55 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:24:34 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:25:06 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:25:44 Europe/Berlin] Successful login for user ID: 15
[09-Oct-2025 06:25:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:26:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:30:27 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:30:47 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:30:50 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:31:11 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:31:13 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:31:33 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:31:36 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:33:39 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:34:16 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:34:31 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:35:26 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:37:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:37:56 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:38:35 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:38:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:40:51 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:41:25 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:47:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 06:58:21 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:60
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(35): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 60
[09-Oct-2025 07:00:08 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:00:09 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Controller path (C:\xampp\htdocs\rentify/app/controllers/DashboardController.php.phpDashboardController.php.php) doesn't exist in C:\xampp\htdocs\rentify\app\core\App.php:52
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 52
[09-Oct-2025 07:01:39 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:01:42 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Controller path (C:\xampp\htdocs\rentify/app/controllers/DashboardController.php.phpDashboardController.php.php) doesn't exist in C:\xampp\htdocs\rentify\app\core\App.php:52
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 52
[09-Oct-2025 07:01:49 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Controller path (C:\xampp\htdocs\rentify/app/controllers/DashboardController.php.phpDashboardController.php.php) doesn't exist in C:\xampp\htdocs\rentify\app\core\App.php:52
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 52
[09-Oct-2025 07:01:53 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Controller path (C:\xampp\htdocs\rentify/app/controllers/DashboardController.php.phpDashboardController.php.php) doesn't exist in C:\xampp\htdocs\rentify\app\core\App.php:52
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 52
[09-Oct-2025 07:05:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:05:21 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:05:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:08:37 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:09:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:09:48 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:13:17 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:13:21 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:14:12 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:14:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:18:38 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:19:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:19:07 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 07:19:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:28:43 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:30:09 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:31:31 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:31:43 Europe/Berlin] Successful login for user ID: 15
[09-Oct-2025 12:31:44 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:32:15 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:32:54 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:32:58 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:33:04 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:33:14 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:33:19 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:33:58 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:34:05 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:36:05 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:36:11 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:37:21 Europe/Berlin] PHP Parse error:  syntax error, unexpected string content "", expecting "-" or identifier or variable or number in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 30
[09-Oct-2025 12:37:42 Europe/Berlin] PHP Parse error:  syntax error, unexpected string content "", expecting "-" or identifier or variable or number in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 30
[09-Oct-2025 12:42:39 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:42:43 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:44:24 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:44:34 Europe/Berlin] Failed login attempt for email: user@gmail.com
[09-Oct-2025 12:44:38 Europe/Berlin] Successful login for user ID: 15
[09-Oct-2025 12:44:38 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 12:45:00 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 18:30:24 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 18:30:31 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 18:30:36 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 18:33:22 Europe/Berlin] Successful login for user ID: 15
[09-Oct-2025 18:33:22 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[09-Oct-2025 18:35:27 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 70
[09-Oct-2025 18:35:28 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 70
[09-Oct-2025 18:35:28 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 70
[09-Oct-2025 18:35:29 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 70
[09-Oct-2025 18:35:29 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 70
[09-Oct-2025 18:41:47 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:09 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:10 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:36 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:37 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:37 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:37 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[09-Oct-2025 18:42:38 Europe/Berlin] PHP Warning:  session_destroy(): Trying to destroy uninitialized session in C:\xampp\htdocs\rentify\app\views\auth\login.php on line 8
[10-Oct-2025 06:25:28 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[10-Oct-2025 06:26:16 Europe/Berlin] Successful login for user ID: 15
[10-Oct-2025 06:26:16 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[10-Oct-2025 06:26:37 Europe/Berlin] Failed login attempt for email: user@gmail.com
[10-Oct-2025 06:28:11 Europe/Berlin] Failed login attempt for email: user@gmail.com
[10-Oct-2025 06:28:16 Europe/Berlin] Failed login attempt for email: user@gmail.com
[10-Oct-2025 06:30:20 Europe/Berlin] Failed login attempt for email: user@gmail.com
[10-Oct-2025 06:30:26 Europe/Berlin] Successful login for user ID: 15
[10-Oct-2025 06:30:26 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[10-Oct-2025 06:31:50 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
[10-Oct-2025 06:36:55 Europe/Berlin] Successful login for user ID: 15
[10-Oct-2025 06:36:55 Europe/Berlin] PHP Fatal error:  Uncaught Exception: Method (main.js) doesn't exists in C:\xampp\htdocs\rentify\app\core\App.php:61
Stack trace:
#0 C:\xampp\htdocs\rentify\app\core\App.php(36): App->loadController()
#1 C:\xampp\htdocs\rentify\public\index.php(23): App->__construct()
#2 {main}
  thrown in C:\xampp\htdocs\rentify\app\core\App.php on line 61
