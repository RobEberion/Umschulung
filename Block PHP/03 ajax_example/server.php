<?php
header("Content-Type: application/json");

// Funktion zur Generierung der aktuellen Serverzeit
function serverZeit() {
    return date("l, d. F Y H:i:s (T)"); // Gibt die Serverzeit zurück
}

// Die aktuelle Serverzeit als JSON zurückgeben
echo json_encode([
    'message' => serverZeit()
]);
?>
