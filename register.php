<?php

require 'database.php';

SESSION_START();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $Password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $Email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);

    if (empty($Username)) {
        echo "Please enter a username.";
    } elseif (empty($Password)) {
        echo "Please enter a password.";
    } elseif (empty($Email)) {
        echo "Please enter an E-mail.";
    } else {
        $hash = password_hash($Password, PASSWORD_DEFAULT); //Table moet nog gemaakt worden (users)
        $sql = "INSERT INTO users (user, password) VALUES ('username', '$hash')";
        mysqli_query($conn, $sql);
        echo "You are now registered.";


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid Email";
            exit();
        }


        //Hiermee sla je Gebruiker op               //Table moet nog gemaakt worden (users)
        $stmnt = $conn->prepare("INSERT INTO users (Username, Password, Email) VALUES (?, ?, ?)");
        $stmnt->bind_param("sss", $Username, $hashedPassword, $Email);
        $stmnt->execute();
        $stmnt->close();

        $_SESSION["Username"] = $Username;
        echo "Registration Successful";
        exit();

        $checkUser = $conn->prepare("SELECT id FROM users WHERE Username = ?");
        $checkUser->bind_param("s", $Username);
        $checkUser->execute();
        $checkUser->store_result();
        if ($checkUser->num_rows > 0) {
            $error[] = "Username already taken";
        }
        $checkUser->close();

        //checkt de E-mail of het klopt en niet gepakt is
        $checkEmail = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
        $checkEmail->bind_param("s", $Email);
        $checkEmail->execute();
        $checkEmail->store_result();
        if ($checkEmail->num_rows > 0) {
            $error[] = "Email already taken";
        }
        $checkEmail->close();

        mysqli_close($conn);
    }
}



