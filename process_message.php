<?php
// Maak database connectie globaal beschikbaar
global $conn;
// Laad het database connectie bestand
require_once("./connection.php");
// Start de sessie
session_start();

// Controleer of gebruiker is ingelogd
if (!isset($_SESSION['user'])) {
    // Stuur niet-ingelogde gebruikers naar login pagina
    header("Location: login.php");
    exit();
}

// Verwerk het formulier als het is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSendMessage'])) {
    // Haal het bericht op en trim whitespace
    $message = trim($_POST['message']);
    // Haal gebruikers-ID uit sessie
    $userId = $_SESSION['user']['id'];

    // Controleer of bericht niet leeg is
    if (!empty($message)) {
        // Controleer database connectie
        if (!$conn) {
            die("Database verbinding mislukt: " . mysqli_connect_error());
        }

        // Bereid de SQL query voor
        $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");

        // Controleer of query voorbereiden is gelukt
        if ($stmt === false) {
            die("Fout bij voorbereiden query: " . $conn->error);
        }

        // Koppel parameters aan de query
        $bindResult = $stmt->bind_param("is", $userId, $message);
        if ($bindResult === false) {
            die("Fout bij koppelen parameters: " . $stmt->error);
        }

        // Voer de query uit
        $executeResult = $stmt->execute();
        if ($executeResult) {
            // Succes - stuur terug met succesmelding
            header("Location: send_message.php?msg=success");
        } else {
            // Fout - stuur terug met foutmelding
            header("Location: send_message.php?msg=error&reason=" . urlencode($stmt->error));
        }
        exit();
    } else {
        // Bericht was leeg - stuur terug met melding
        header("Location: send_message.php?msg=empty");
        exit();
    }
}

// Standaard doorsturen als geen formulier is verzonden
header("Location: send_message.php");
exit();