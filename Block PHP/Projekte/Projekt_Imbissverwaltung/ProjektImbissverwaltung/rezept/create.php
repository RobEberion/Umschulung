<?php
// Einbinden der Rezept-Klasse, die alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Rezept-Datensätze kapselt. Dadurch erhältst du Zugriff auf Funktionen wie create(), readAll(), etc.
require_once __DIR__ . '/../_classes/Rezept.php';

// Erzeugen eines neuen Objekts der Klasse Rezept, um später die Methoden aufrufen zu können.
$rezeptObj = new Rezept();

// Formularverarbeitung: Prüfen, ob das Formular per POST abgeschickt wurde.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen der Formulardaten aus dem $_POST-Array.
    // Falls ein Feld nicht übermittelt wird, wird ein Standardwert verwendet.
    $rezeptname         = $_POST['rezeptname'] ?? '';
    $dauer              = $_POST['dauer'] ?? 0;
    $speiseart         = $_POST['speiseart'] ?? '';
    $rezeptbeschreibung = $_POST['rezeptbeschreibung'] ?? '';

    // Aufruf der create()-Methode der Rezept-Klasse, um ein neues Rezept in der Datenbank anzulegen.
    // Die Methode übernimmt die übermittelten Werte (Rezeptname, Dauer, Speiseart, Rezeptbeschreibung).
    $rezeptObj->create($rezeptname, $dauer, $speiseart, $rezeptbeschreibung);

    // Nach erfolgreichem Eintrag erfolgt eine Weiterleitung zur Übersichtsseite (index.php).
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Rezept anlegen</title>
    <!-- Einbinden der externen CSS-Datei, die das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <!-- Überschriftencontainer: Zeigt den Seitentitel an -->
        <div class="ueberschrift-container">
            <h1>Neues Rezept anlegen</h1>
        </div>
        <!-- Formular zur Eingabe der Rezeptdaten -->
        <form method="POST">
            <div class="edit-container">
                <!-- Eingabefeld für den Rezeptnamen (Pflichtfeld) -->
                <label>Rezeptname: 
                    <br>
                    <input type="text" name="rezeptname" required>
                </label>
                <br><br>

                <!-- Eingabefeld für die Zubereitungsdauer in Minuten -->
                <label>Dauer (Minuten):
                    <br>
                    <input type="number" name="dauer">
                </label>
                <br><br>

                <!-- Eingabefeld für die Speiseart -->
                <label>Speiseart:
                    <br>
                    <input type="text" name="speiseart">
                </label>
                <br><br>

                <!-- Textbereich für die Rezeptbeschreibung -->
                <label>Rezeptbeschreibung:<br>
                    <textarea name="rezeptbeschreibung" rows="5" cols="40"></textarea>
                </label>
                <br><br>

                <!-- Buttons:
                     - Abbrechen: Leitet den Benutzer zur Übersichtsseite zurück.
                     - Speichern: Sendet das Formular ab, sodass das Rezept in der Datenbank angelegt wird. -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <button type="submit">Speichern</button>
            </div>
        </form>
    </div>
</body>
</html>
