<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <link rel="icon" href="img/padayunITLogo.png" />
  <title>Padayun IT</title>
</head>

<body>
  <div class="container">
    <div class="card">
      <img src="../assets/padayunITLogo.png" alt="" />
      <h1>Sign up</h1>
      <p>Create an account</p>

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

      <form action="signup_validate.php" method="POST">
        <div class="name">
          <input type="text" placeholder="First name" id="firstName" name="firstname" />
          <input type="text" placeholder="Last name" id="lastName" name="lastname" />
        </div>
        <input type="email" placeholder="Email" name="email" />
        <input type="text" placeholder="Username" name="username" />
        <input type="password" placeholder="Password" name="password" />
        <input type="password" placeholder="Password" name="confirm_password" />
        <button>Sign up</button>
      </form>
      <span style="font-size: 0.75rem">
        Already have an account? <a href="login.php">Log in</a>
      </span>
    </div>
  </div>
</body>

</html>