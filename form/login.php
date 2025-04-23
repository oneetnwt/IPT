<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$sitekey = $_ENV['RECAPTCHA_SITE_KEY'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="icon" href="../assets/padayunITLogo.png" />
  <title>Padayun IT</title>
</head>

<body>
  <div class="container">
    <div class="card">
      <img src="../assets/padayunITLogo.png" alt="" />
      <h1>Log in</h1>
      <p>Please enter your credentials</p>
      <?php if (isset($_SESSION['error'])): ?>
        <p id="alertMessage" style="border: 1px solid #F74141; padding: 0.5rem 1rem !important; border-radius: 0.25rem; display: block; color: #F74141;">
          <?= $_SESSION['error'];
          unset($_SESSION['error']); ?>
        </p>
      <?php endif; ?>

      <?php if (isset($_SESSION['success'])): ?>
        <p id="alertMessage" style="border: 1px solid #77DD77; padding: 0.5rem 1rem !important; border-radius: 0.25rem; display: block; color: #77DD77;">
          <?= $_SESSION['success'];
          unset($_SESSION['success']); ?>
        </p>
      <?php endif; ?>
      <form action="login_validate.php" method="POST">
        <input type="text" placeholder="Username" name="username" />
        <input type="password" placeholder="Password" name="password" />
        <div style="margin-bottom: 3px;" class="g-recaptcha" data-sitekey="<?= htmlspecialchars($sitekey)?>"></div>
        <button type="submit">Log in</button>
      </form>
      <a href="forgot-password.php" style="font-size: 0.75rem">Forgot password?</a>
      <span style="font-size: 0.75rem">
        Don&apos;t have an account?
        <a href="signup.php">Sign up</a>
      </span>
    </div>
  </div>

  <script src="https://www.google.com/recaptcha/api.js"></script>
</body>

</html>