<?php
// Start de sessie
session_start();

// Verwijder alle sessievariabelen
$_SESSION = array();

// Verwijder het sessiecookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Vernietig de sessie
session_destroy();

// Redirect naar inlogpagina met succesmelding
$_SESSION['logout_message'] = "U bent succesvol uitgelogd. Tot ziens!";
header("Location: login.php");
exit();