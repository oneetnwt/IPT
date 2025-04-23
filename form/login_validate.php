<?php

session_start();

require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptchaSecret = $_ENV['RECAPTCHA_SECREY_KEY'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    $captchaSuccess = json_decode($verify);

    if(!$captchaSuccess){
        $_SESSION['error'] = "Captcha Verification Failed";
        header("Location: login.php");
        exit();
    }


    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        header('Location: ../dashboard/dashboard.html');
        exit();
    } else {
        $_SESSION['error'] = "Credentials are incorrect";
        header("Location: login.php");
        exit();
    }
}
