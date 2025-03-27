<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP en MySQL Verbinding</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="#">
</head>
<body>

<?php
// Checken of de knop is ingedrukt
if (isset($_POST['con'])) {
    // 1. AWS-configuratie voor de database
    // Database server instellingen (wijzig indien nodig)
    $host = 'localhost';      // Host (meestal localhost)
    $user = 'root';           // Database gebruikersnaam (standaard root)
    $pass = '';               // Wachtwoord (leeglaten als er geen is)
    $db   = 'std';            // Naam van de database

    // 2. Connectie maken met de database
    // 'mysqli_connect' wordt gebruikt om verbinding te maken:
    @$conn = mysqli_connect($host, $user, $pass, $db);

    // 3. Controleren of de verbinding is gelukt
    if (!$conn) {
        // Als de verbinding mislukt, geef een foutmelding
        echo 'De connectie is mislukt: ' . mysqli_connect_error();
    } else {
        // Als de verbinding succesvol is
        echo 'De connectie is succesvol!';
    }
}
?>

<!-- HTML Formulier -->
<form method="post">
    <center>
        <!-- De knop voor de verbinding -->
        <input type="submit" value="Connecteren" name="con">
    </center>
</form>

<?php
// 4. Verbinden en resultaten ophalen uit de database
// Controleren of een verbinding actief is
if (isset($conn) && $conn) {
    // Query om alle gegevens uit de Games-tabel op te halen
    $sql = "SELECT name FROM Games";

    // Voer de query uit en sla het resultaat op
    $result = $conn->query($sql);

    // Controleren of er resultaten zijn
    if ($result->num_rows > 0) {
        // Als er resultaten zijn, ze in een lijst weergeven
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            // 'htmlspecialchars' wordt gebruikt om speciale tekens in de output te vermijden
            echo "<li>" . htmlspecialchars($row["name"]) . "</li>";
        }
        echo "</ul>";
    } else {
        // Als er geen resultaten zijn
        echo "Geen resultaten gevonden.";
    }

    // 5. Verbinding sluiten
    $conn->close();
}
?>

</body>
</html>