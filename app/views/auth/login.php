<?php 
  require_once dirname(__DIR__, 3) . '/config/config.php';

  if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
  }

  $emailInput = $_SESSION['userFormData']['email'] ?? '';
  unset($_SESSION['userFormData']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">  <link rel="stylesheet" href="/assets/styles/signup.css">
  <link rel="stylesheet" href="<?= '/assets/styles/login.css'; ?>">
  <title>Login</title>
</head>
<body>
  <?php if ($_SESSION['successSignup'] ?? false): ?>
    <div class="alert alert-success position-fixed fixed-top text-center" role="alert" style="z-index: 1050;" id="successAlert">
      Account created successfully!
    </div>
    <?php unset($_SESSION['successSignup']); ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger position-fixed fixed-top text-center" role="alert" style="z-index: 1050;" id="dangerAlert">
      <?= $_SESSION['errors']['general']; ?>
    </div>
    <?php unset($_SESSION['errors']['general']); ?>
  <?php endif; ?>  

  <div class="container">
    <h1>Login</h1>
    <form action="/auth/authLogin" method="POST">
      <div class="form-group">
        <input id="email" type="email" name="email" value="<?= $emailInput; ?>">
        <label for="email">Email</label>
      </div>

      <div class="form-group">
        <input id="password" type="password" name="password">
        <label for="password">Password</label>
        <a href="">Forgot password</a>
      </div>

      <button type="submit">Login</button>

      <div class="signup-link">
        <p>Don't have an account? <a href="/auth/signup">Signup here</a></p>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="/assets/scripts/login.js"></script>
</body>
</html>