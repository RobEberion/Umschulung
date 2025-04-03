<?php
header("Content-Type: application/json");

// Funktion zur Generierung der aktuellen Serverzeit
function serverZeit() {
    // Datum und Uhrzeit im Format "Tag.Monat.Jahr Stunde:Minute:Sekunde"
    return date("l, d. F Y H:i:s (T)");

}

$file = __DIR__ . '/data.json';

// Sicherstellen, dass die Datei existiert
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Prüfen, ob die Datei beschreibbar ist
if (!is_writable($file)) {
    error_log("Die Datei data.json ist nicht beschreibbar.");
    echo json_encode([
        "status" => "error",
        "message" => "Die Datei ist nicht beschreibbar."
    ]);
    exit; // Script beenden, da die Datei nicht geschrieben werden kann
}

// Eingabedaten aus der Anfrage lesen
$requestBody = file_get_contents("php://input"); // JSON-Body der Anfrage abrufen
$data = json_decode($requestBody, true); // JSON in ein Array umwandeln


// Überprüfen, ob die benötigten Felder 'name', 'dynamicValue' und 'timestamp' in den übergebenen Daten vorhanden sind
if (isset($data['name']) && isset($data['dynamicValue']) && isset($data['timestamp'])) {
    // Sicherheitsmaßnahme: Benutzereingaben bereinigen, um XSS-Angriffe zu verhindern
    $name = htmlspecialchars($data['name']);
    $serverTime = serverZeit(); // Aktuelle Serverzeit
    $dynamicValue = htmlspecialchars($data['dynamicValue']);
    $timestamp = htmlspecialchars($data['timestamp']); // Zeitstempel bereinigen

    // Vorhandene Daten aus der JSON-Datei laden
    $existingData = json_decode(file_get_contents($file), true);

    // Neues Datenelement hinzufügen (die Daten des Benutzers)
    $existingData[] = [
        'name' => $name,
        'serverTime' => $serverTime,
        'dynamicValue' => $dynamicValue,
        'timestamp' => $timestamp
    ];

    // Die aktualisierten Daten in die JSON-Datei speichern
    $result = file_put_contents($file, json_encode($existingData, JSON_PRETTY_PRINT));
    // Prüfen, ob das Speichern erfolgreich war
    if ($result !== false) {
        echo json_encode([
            "status" => "success",
            "message" => "Daten erfolgreich empfangen und gespeichert."
        ]);
    } else {
        // Fehlerprotokollierung, falls das Speichern in die Datei fehlschlägt
        error_log("Fehler beim Schreiben in die Datei data.json.");
        echo json_encode([
            "status" => "error",
            "message" => "Fehler beim Speichern der Daten."
        ]);
    }
} else {
     // Wenn die Eingabedaten ungültig sind (z. B. fehlen benötigte Felder)
    echo json_encode([
        "status" => "error",
        "message" => "Ungültige Daten empfangen."
    ]);
}

?>
?>
