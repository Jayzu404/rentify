<?php
  require_once dirname(__DIR__, 3) . '/config/config.php';
  session_start();

  $errors = $_SESSION['errors'] ?? [];
  $userInputs = $_SESSION['userFormData'] ?? [];
  unset($_SESSION['errors'], $_SESSION['userFormData']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  <link rel="stylesheet" href="/assets/styles/signup.css">
  <link rel="stylesheet" href="<?= '/assets/styles/signup.css'; ?>">
  <title>Sign Up</title>
</head>
<body>
  <div class="container">
    <h1>Sign Up</h1>

    <!-- Error pop up for general error -->
    <?php if (isset($errors['general'])): ?>
      <div class="alert alert-danger" role="alert">
        <?= $errors['general']; ?>
      </div>
    <?php endif; ?> 

    <form action="/auth/authSignup" enctype="multipart/form-data" method="POST">
      <div class="form-group">
        <input type="text" name="firstName" id="firstName" value="<?= $userInputs['firstName'] ?? ''; ?>" required>
        <label for="firstName">First Name</label>
        <div class="error-msg"><?= $errors['firstName'] ?? ''; ?></div>
      </div>
      <div class="form-group">
        <input type="text" name="middleName" id="middleName" value="<?= $userInputs['middleName'] ?? ''; ?>">
        <label for="middleName">Middle Name</label>
        <div class="error-msg"><?= $errors['middleName'] ?? ''; ?></div>
      </div>
      <div class="form-group">
        <input type="text" name="lastName" id="lastName" value="<?= $userInputs['lastName'] ?? ''; ?>" required>
        <label for="lastName">Last Name</label>
          <div class="error-msg"><?= $errors['lastName'] ?? ''; ?></div>
      </div>
      <div class="form-group">
        <input type="text" name="address" id="address" value="<?= $userInputs['address'] ?? ''; ?>" required>
        <label for="address">Address</label>
        <div class="error-msg"><?= $errors['address'] ?? ''; ?></div>
      </div>
      <div class="form-group">
        <input type="email" name="email" id="email" value="<?= $userInputs['email'] ?? ''; ?>" required>
        <label for="email">Email</label>
        <div class="error-msg"><?= $errors['email'] ?? ''; ?></div>
      </div>
      <div class="form-group upload">
        <input type="file" name="validId" id="validId" accept="image/*" onchange="previewImage(event)"  required>
        <label for="validId">Upload valid id</label>
        <div class="error-msg"><?= $errors['validId'] ?? ''; ?></div>
      </div>
      <div id="previewContainer">
        <p id="previewLabel">Preview: </p>
        <img id="previewImage" src="#" alt="Preview">
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" required>
        <label for="password">Password</label>
        <div class="error-msg"><?= $errors['password'] ?? ''; ?></div>
      </div>
      <div class="form-group">
        <input type="password" name="confirmPassword" id="confirmPassword" required>
        <label for="confirmPassword">Confirm Password</label>
        <div class="error-msg"><?= $errors['confirmPassword'] ?? ''; ?></div>
      </div>

      <button type="submit">Create Account</button>

      <div class="login-link">
        <p>Already have an account? <a href="/auth/login">login here</a></p>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="/assets/scripts/signup.js"></script>
</body>
</html>