<?php 
  require_once dirname(__DIR__, 3) . '/config/config.php';

  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }

  $emailInput = $_SESSION['userFormData']['email'] ?? '';
  $errors = $_SESSION['errors'] ?? '';
  unset($_SESSION['userFormData'], $_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/styles/login.css">
  <title>Login</title>
</head>
<body>
  <?php if ($_SESSION['successSignup'] ?? false): ?>
    <div class="alert alert-success position-fixed fixed-top text-center" role="alert" style="z-index: 1050;" id="successAlert">
      Account created successfully!
    </div>
    <?php unset($_SESSION['successSignup']); ?>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger position-fixed fixed-top text-center" role="alert" style="z-index: 1050;" id="dangerAlert">
      <?= $errors['general']; ?>
    </div>
    <?php unset($_SESSION['errors']['general']); ?>
  <?php endif; ?>  

  <div class="container">
    <h1>Login</h1>
    <form action="/auth/authLogin" method="POST">
      <div class="form-group">
        <input id="email" type="email" name="email" value="<?= $emailInput; ?>">
        <label for="email">Email</label>
        <div class="error-msg"><?= $errors['email'] ?? ''; ?></div>
      </div>

      <div class="form-group">
        <input id="password" type="password" name="password">
        <label for="password">Password</label>
        <div class="error-msg"><?= $errors['password'] ?? ''; ?></div>
        <a href="">Forgot password</a>
      </div>

      <button type="submit">Login</button>

      <div class="signup-link">
        <p>Don't have an account? <a href="/auth/signup">Signup here</a></p>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>