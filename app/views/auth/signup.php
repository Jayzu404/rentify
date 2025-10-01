<?php require_once dirname(__DIR__, 3) . '/config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= '/assets/styles/signup.css'; ?>">
  <title>Sign Up</title>
</head>
<body>
  <div class="container">
    <h1>Sign Up</h1>
    <form action="">
      <div class="form-group">
        <input type="text" required>
        <label for="">First Name</label>
      </div>
      <div class="form-group">
        <input type="text" required>
        <label for="">Middle Name</label>
      </div>
      <div class="form-group">
        <input type="text" required>
        <label for="">Last Name</label>
      </div>
      <div class="form-group">
        <input type="text" required>
        <label for="">Address Name</label>
      </div>
      <div class="form-group">
        <input type="email" required>
        <label for="">Email</label>
      </div>
      <div class="form-group">
        <input type="file" required>
        <label for="">Upload valid id</label>
      </div>
      <div class="form-group">
        <input type="password" required>
        <label for="">Password</label>
      </div>
      <div class="form-group">
        <input type="password" required>
        <label for="">Confirm Password</label>
      </div>

      <button type="submit">Create Account</button>

      <div class="login-link">
        <p>Already have an account? <a href="/auth/login">login here</a></p>
      </div>
    </form>
  </div>
</body>
</html>