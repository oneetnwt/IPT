<?php

session_start();

require '../includes/db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        header('Location: ../dashboard/dashboard.html');
        exit();
    } else {
        $_SESSION['error'] = "Credentials are incorrect";
        header("Location: login.php");
        exit();
    }
}

?>