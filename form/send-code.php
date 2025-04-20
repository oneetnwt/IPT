<?php
  session_start();

  require '../includes/db.php';

  if($_SERVER['REQUEST_METHOD'] === "POST"){
    $enteredCode = $_POST['code'];
    $email = $_SESSION['email'];

    if(!isset($_SESSION['email'])){
      $_SESSION['error'] = "No email session found, please try again.";
      header("Location: send-code.php");
      exit();
    }

    $stmt  = $pdo->prepare("SELECT reset_code FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
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
      <h3 style="text-align: center">Enter code</h3>
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
      <form action="send-code.php" method="POST">
        <input type="number" placeholder="Enter code" maxlength="6" name="code"/>
        <button>Submit</button>
      </form>
    </div>
  </div>
</body>

</html>