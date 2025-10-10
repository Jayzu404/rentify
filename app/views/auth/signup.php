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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
  <script src="/assets/scripts/signup.js"></script>
</body>
</html>