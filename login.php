<?php

require 'database.php';

SESSION_START();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    //Dit controleert of een wachtwoord correct ingevoerd is
    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
    exit('Invalid username or password');
    }
}