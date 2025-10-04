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
    <form action="/auth/authSignup" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <input type="text" name="firstName" id="firstName" required>
        <label for="firstName">First Name</label>
      </div>
      <div class="form-group">
        <input type="text" name="middleName" id="middleName">
        <label for="middleName">Middle Name</label>
      </div>
      <div class="form-group">
        <input type="text" name="lastName" id="lastName" required>
        <label for="lastName">Last Name</label>
      </div>
      <div class="form-group">
        <input type="text" name="address" id="address" required>
        <label for="address">Address</label>
      </div>
      <div class="form-group">
        <input type="email" name="email" id="email" required>
        <label for="email">Email</label>
      </div>
      <div class="form-group">
        <input type="file" name="validId" id="validId" required>
        <label for="validId">Upload valid id</label>
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" required>
        <label for="password">Password</label>
      </div>
      <div class="form-group">
        <input type="password" name="confirmPassword" id="confirmPassword" required>
        <label for="confirmPassword">Confirm Password</label>
      </div>

      <button type="submit">Create Account</button>

      <div class="login-link">
        <p>Already have an account? <a href="/auth/login">login here</a></p>
      </div>
    </form>
  </div>
</body>
</html>