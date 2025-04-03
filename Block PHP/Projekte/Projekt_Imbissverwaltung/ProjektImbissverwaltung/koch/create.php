<?php
// Einbinden der Koch-Klasse, die alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Koch-Datensätze kapselt. Dadurch wird sichergestellt, dass wir Zugriff auf die Methoden haben,
// die zum Anlegen eines neuen Kochs in der Datenbank benötigt werden.
require_once __DIR__ . '/../_classes/Koch.php';

// Erzeugen eines neuen Objekts der Klasse Koch. Dieses Objekt wird verwendet, um später
// den neuen Koch-Datensatz in die Datenbank einzufügen.
$kochObj = new Koch();

// Überprüfen, ob das Formular per POST abgeschickt wurde.
// Der $_SERVER['REQUEST_METHOD'] wird überprüft, um sicherzustellen, dass das Formular gesendet wurde.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen der Formulardaten aus dem $_POST-Array.
    // Falls ein Wert nicht gesetzt ist, wird ein Standardwert verwendet:
    // - $nachname und $vorname werden als leere Strings verwendet.
    // - $sterne wird als Integer mit dem Standardwert 1 verwendet.
    // - $age wird als Integer mit dem Standardwert 0 verwendet.
    // - $geschlecht wird als "geschlechtsneutral" gesetzt, falls kein Wert übergeben wird.
    // - $spezialgebiet wird als leerer String gesetzt.
    $nachname      = $_POST['nachname'] ?? '';
    $vorname       = $_POST['vorname'] ?? '';
    $sterne        = (int)($_POST['sterne'] ?? 1);
    $age           = (int)($_POST['age'] ?? 0);
    $geschlecht    = $_POST['geschlecht'] ?? 'geschlechtsneutral';
    $spezialgebiet = $_POST['spezialgebiet'] ?? '';

    // Serverseitige Validierung:
    // Hier wird geprüft, ob der Wert für "sterne" im gültigen Bereich (1 bis 3) liegt.
    if ($sterne < 1 || $sterne > 3) {
        // Falls der Wert ungültig ist, wird er auf den Standardwert 1 gesetzt.
        $sterne = 1;
    }

    // Neuen Koch-Datensatz in der Datenbank anlegen.
    // Hier wird die create()-Methode der Koch-Klasse aufgerufen und die
    // gesammelten Daten werden als Parameter übergeben.
    $kochObj->create($nachname, $vorname, $sterne, $age, $geschlecht, $spezialgebiet);

    // Nach erfolgreicher Speicherung des Datensatzes erfolgt eine Weiterleitung
    // zur Übersichtsseite (index.php).
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuen Koch anlegen</title>
    <!-- Einbinden der CSS-Datei für das Styling -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Inhalt der Seite umschließt -->
    <div class="container">
        <!-- Überschriftencontainer mit dem Titel der Seite -->
        <div class="ueberschrift-container">
            <h1>Neuen Koch anlegen</h1>
        </div>
        <!-- Formular zum Anlegen eines neuen Kochs -->
        <form method="POST">
            <div class="edit-container">
                <!-- Eingabefeld für den Nachnamen des Kochs -->
                <label>Nachname:
                    <br>
                    <input type="text" name="nachname" required>
                </label>
                <br><br>

                <!-- Eingabefeld für den Vornamen des Kochs -->
                <label>Vorname:
                    <br>
                    <input type="text" name="vorname" required>
                </label>
                <br><br>

                <!-- Dropdown zur Auswahl der Sterne (Bewertung des Kochs) -->
                <label>Sterne:
                    <br>
                    <select name="sterne" required>
                        <!-- Optionen für die Sterne -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </label>
                <br><br>

                <!-- Eingabefeld für das Alter des Kochs -->
                <label>Alter:
                    <br>
                    <input type="number" name="age">
                </label>
                <br><br>

                <!-- Dropdown zur Auswahl des Geschlechts -->
                <label>Geschlecht:
                    <br>
                    <select name="geschlecht">
                        <!-- Optionen für das Geschlecht -->
                        <option value="männlich">männlich</option>
                        <option value="weiblich">weiblich</option>
                        <option value="geschlechtsneutral">geschlechtsneutral</option>
                    </select>
                </label>
                <br><br>

                <!-- Eingabefeld für das Spezialgebiet des Kochs -->
                <label>Spezialgebiet:
                    <br>
                    <input type="text" name="spezialgebiet">
                </label>
                <br><br><br>

                <!-- Buttons: Abbrechen und Speichern -->
                <!-- Der Abbrechen-Button leitet den Benutzer zur Übersichtsseite zurück -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <!-- Der Speichern-Button sendet das Formular ab -->
                <button type="submit">Speichern</button>
            </div>
        </form>
    </div>
</body>
</html>
