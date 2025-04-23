<?php
  require '../vendor/autoload.php';
  require '../includes/db.php';

  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
  $dotenv->load();

  session_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    $reset_code = rand(100000, 999999);

    $update = $pdo->prepare("UPDATE users SET reset_code = ? WHERE email = ?");
    $update->execute([$reset_code, $email]);

    $_SESSION['email'] = $email;

    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = 'true';
      $mail->Username = $_ENV['APP_EMAIL'];
      $mail->Password = $_ENV['APP_PASSWORD'];
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->setFrom($_ENV['APP_EMAIL'], $_ENV['APP_NAME']);
      $mail->addAddress($email, "THIS IS YOUR CLIENT");

      $mail->isHTML(true);
      $mail->Subject = "Password Reset Code";
      $mail->Body = "
          <p>Hello, This is your password reset code</p>

          <div>{$reset_code}</div>
        ";

      $mail->AltBody = "Hello, This is your password reset code: {$reset_code}";
      $mail->send();

      $_SESSION['email_sent'] = "true";
      $_SESSION['success'] = "Verification code has been sent to your email";
      header("Location: send-code.php");
      exit();
    } catch (Exception $e) {
      $_SESSION['Error'] = "Message could not be sent";
      header("Location: forgot-password.php");
      exit();
    }
  } else {
    $_SESSION['Error'] = "No user found with that email";
    header("Location: forgot-password.php");
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
  <title>Padayun IT</title>
</head>

<body>
  <div class="container">
    <div class="card">
      <img src="../assets/padayunITLogo.png" alt="" />
      <h1>Forgot Password</h1>
      <p id="alert_message">Please enter your email address</p>

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

      <form action="forgot-password.php" method="POST">
        <input type="email" placeholder="Email" name="email" required />
        <button type="submit">Send code</button>
      </form>
    </div>
  </div>
</body>

</html>