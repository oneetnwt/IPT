<?php
    session_start();

    require '../includes/db.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        if($password !== $confirm){
            $_SESSION['error'] = "Passwords do not match";
            header("signup.php");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if($stmt->rowCount() > 0){
            $_SESSION['error'] = "Usernaem already exists";
            header("signup.php");
            exit();
        }

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $username, $email, $hashPassword]);

        $_SESSION['success'] = "Your account has been created. You can now log in.";
        header("login.html");
        exit();
    }

?>