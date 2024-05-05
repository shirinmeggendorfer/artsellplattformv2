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

echo "Verbindung zur Datenbank erfolgreich hergestellt\n";

// Eine Abfrage zum Abrufen aller Datensätze aus der Tabelle "items" ausführen
$sql = "SELECT * FROM items"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Datensätze ausgeben
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Title: " . $row["title"]. ", Description: " . $row["description"]. ", Price: " . $row["price"] . "\n";
    }
} else {
    echo "Keine Datensätze gefunden\n";
}

// Verbindung schließen
$conn->close();
