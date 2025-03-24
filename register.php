<?php

require 'database.php';

SESSION_START();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];

    if (empty($Username) || empty($Password) || empty($Email)) {
        echo "All fields must be filled";
        exit();
    }

    if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email";
    exit();
    }

    //Hashed wachtwoord
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    //Hiermee sla je Gebruiker op
    $stmnt = $conn->prepare("INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)");
    $stmnt->bind_param("sss", $Username, $hashedPassword, $Email);
    $stmnt->execute();
    $stmnt->close();

    $_SESSION["Username"] = $Username;
    echo "Registration Successful";
    exit();
}


