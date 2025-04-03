<?php
// Rezept bearbeiten / löschen: rezept/edit.php

// Einbinden der Rezept-Klasse, die alle CRUD-Operationen für Rezept-Datensätze kapselt.
// Dadurch erhältst du Zugriff auf Methoden wie readOne(), update() und delete().
require_once __DIR__ . '/../_classes/Rezept.php';

// Erzeugen eines neuen Objekts der Klasse Rezept.
$rezeptObj = new Rezept();

// 1) Überprüfen, ob eine rezeptId per GET übergeben wurde.
// Falls keine rezeptId vorhanden ist, wird der Benutzer zur Übersichtsseite (index.php) weitergeleitet.
if (!isset($_GET['rezeptId'])) {
    header('Location: index.php');
    exit;
}
$rezeptId = (int)$_GET['rezeptId'];

// 2) Laden des Datensatzes mit readOne() anhand der rezeptId.
// Falls kein Datensatz gefunden wird, wird eine Fehlermeldung ausgegeben und die Ausführung beendet.
$rezeptData = $rezeptObj->readOne($rezeptId);
if (!$rezeptData) {
    echo "Kein Rezept mit der ID $rezeptId gefunden.";
    exit;
}

// 3) Formularverarbeitung: Wenn das Formular per POST abgeschickt wurde,
// werden die neuen Daten aus dem Formular ausgelesen und der Datensatz in der Datenbank aktualisiert.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen der Formulardaten:
    // Falls ein Feld nicht übermittelt wird, wird ein Standardwert (z. B. leerer String oder 0) verwendet.
    $rezeptname         = $_POST['rezeptname'] ?? '';
    $dauer              = $_POST['dauer'] ?? 0;
    $speiseart         = $_POST['speiseart'] ?? '';
    $rezeptbeschreibung = $_POST['rezeptbeschreibung'] ?? '';

    // Aufruf der update()-Methode, um den Datensatz mit den neuen Werten in der Datenbank zu aktualisieren.
    $rezeptObj->update($rezeptId, $rezeptname, $dauer, $speiseart, $rezeptbeschreibung);

    // Nach erfolgreichem Update erfolgt eine Weiterleitung zur Übersichtsseite.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rezept bearbeiten</title>
    <!-- Einbinden des externen Stylesheets, das das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer für den Seiteninhalt -->
    <div class="container">
        <!-- Überschriftencontainer mit dem Titel der Seite -->
        <div class="ueberschrift-container">
            <h1>Rezept bearbeiten</h1>
        </div>
        <!-- Formular zur Bearbeitung des Rezepts -->
        <form method="POST">
            <div class="edit-container">
                <!-- Eingabefeld für den Rezeptnamen, vorbefüllt mit dem aktuellen Wert aus der Datenbank.
                     Das Feld ist erforderlich (required). -->
                <label>Rezeptname:
                    <br>
                    <input type="text" name="rezeptname" 
                        value="<?php echo htmlspecialchars($rezeptData['rezeptname']); ?>" required>
                </label>
                <br><br>
                <!-- Eingabefeld für die Dauer (in Minuten). Der aktuelle Wert wird als Value gesetzt. -->
                <label>Dauer (Minuten):
                    <br>
                    <input type="number" name="dauer" 
                        value="<?php echo htmlspecialchars($rezeptData['dauer']); ?>">
                </label>
                <br><br>
                <!-- Eingabefeld für die Speiseart. -->
                <label>Speiseart:
                    <br>
                    <input type="text" name="speiseart"
                        value="<?php echo htmlspecialchars($rezeptData['speiseart']); ?>">
                </label>
                <br><br>
                <!-- Textbereich für die Rezeptbeschreibung, vorbefüllt mit dem aktuellen Wert.
                     nl2br() wird hier nicht verwendet, da der Textbereich Zeilenumbrüche ermöglicht. -->
                <label>Rezeptbeschreibung:
                    <br>
                    <textarea name="rezeptbeschreibung" rows="5" cols="40"><?php 
                        echo htmlspecialchars($rezeptData['rezeptbeschreibung']); 
                    ?></textarea>
                </label>
                <br><br>
                <!-- Buttons: -->
                <!-- Abbrechen-Button: Leitet den Benutzer zur Übersichtsseite zurück. -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <!-- Speichern-Button: Sendet das Formular ab, um die Änderungen zu speichern. -->
                <button type="submit">Rezept speichern</button>
                <!-- Löschen-Button: Bei Bestätigung wird der Benutzer zur delete.php weitergeleitet,
                     um den Datensatz zu löschen. -->
                <button type="button"
                        onclick="if (confirm('Wirklich löschen?')) {
                            window.location.href='delete.php?rezeptId=<?php echo $rezeptId; ?>';
                        }">
                    Rezept löschen
                </button>
            </div>
        </form>
    </div>
</body>
</html>
