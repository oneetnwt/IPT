<?php
  session_start();

  require '../includes/db.php';

  if(!isset($_SESSION['email']) || !isset($_SESSION['reset_code_verified']) ||  !$_SESSION['reset_code_verified']){
    header("Location: send-code.php");
    exit();
  }

  if($_SERVER['REQUEST_METHOD'] === "POST"){
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if($newPassword === $confirmPassword){
      $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

      $stmt = $pdo->prepare("UPDATE users SET PASSWORD = ? WHERE email = ?");
      $stmt->execute([$hashedPassword, $_SESSION['reset_email']]);

      unset($_SESSION['reset_email']);
      unset($_SESSION['reset_code_verified']);

      $_SESSION['success'] = "Your password has been reset successfully. You can now log in with your new password.";
      header("Location: login.php");
      exit();
    } else {
      $_SESSION['error'] = "Passwords do not match. Please try again.";
      header("Location: new-password.php");
      exit();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="icon" href="../assets/padayunITLogo.png" />
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
  <title>Padayun IT</title>
</head>

<body>
  <div class="container">
    <div class="card">
      <img src="../assets/padayunITLogo.png" alt="" />
      <h3 style="text-align: center">New Password</h3>
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
      <form action="new-password.php" method="POST">
        <input type="password" placeholder="New Password" name="password"/>
        <input type="password" placeholder="Re-enter Password" name="confirm-password" />
        <button>Change password</button>
      </form>
    </div>
  </div>
</body>

</html>