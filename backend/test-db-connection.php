<?php

// Verbindung zur Datenbank herstellen
$servername = "db"; // Der Name des Dienstes in deiner Docker-Compose-Datei
$username = "root";
$password = "test12345678"; // Das Passwort, das du in deiner Docker-Compose-Datei angegeben hast
$database = "meinprojekt"; // Der Name deiner Datenbank

$conn = new mysqli($servername, $username, $password, $database);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

echo "Verbindung zur Datenbank erfolgreich hergestellt";

// Eine einfache Abfrage ausführen, um sicherzustellen, dass die Verbindung funktioniert
$sql = "SELECT * FROM items"; // Eine Beispielabfrage
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Datensätze ausgeben
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "Keine Datensätze gefunden";
}

// Verbindung schließen
$conn->close();
?>
