<?php
// Session starten, damit auf Session-Variablen zugegriffen werden kann.
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist, indem geprüft wird, ob die Session-Variable 'userId' gesetzt ist.
if (isset($_SESSION['userId'])) {
    // Wenn der Benutzer eingeloggt ist, wird er direkt zur Hauptseite weitergeleitet.
    // Der relative Pfad "main/index.php" muss dabei zur entsprechenden Datei im Projekt passen.
    header('Location: main/index.php');
    exit;
} else {
    // Wenn der Benutzer nicht eingeloggt ist, wird er zur Login-Seite weitergeleitet.
    // Der relative Pfad "_login/login.php" muss zur Login-Seite passen.
    header('Location: _login/login.php');
    exit;
}
?>
