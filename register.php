<?php
SESSION_START();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];

    $_SESSION['Username'] = $Username;
    exit();
}


