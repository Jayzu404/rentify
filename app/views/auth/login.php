<?php require_once dirname(__DIR__, 3) . '/config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= '/assets/styles/login.css'; ?>">
  <title>Login</title>
</head>
<body>
  <div class="container">
    <h1>Login</h1>
    <div class="form-group">
      <input id="email" type="email">
      <label for="email">Email</label>
    </div>

    <div class="form-group">
      <input id="password" type="password">
      <label for="password">Password</label>
      <a href="">Forgot password</a>
    </div>

    <button type="submit">Login</button>

    <div class="signup-link">
      <p>Don't have an account? <a href="/auth/signup">Signup here</a></p>
    </div>
  </div>
</body>
</html>