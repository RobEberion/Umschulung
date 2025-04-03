<?php
// Einbinden der Kunden-Klasse, die alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Kundendatensätze kapselt. Dadurch erhält man Zugriff auf Methoden wie create(), readAll(), etc.
require_once __DIR__ . '/../_classes/Kunde.php';

// Erzeugen eines neuen Objekts der Klasse Kunde, um auf deren Methoden zugreifen zu können.
$kundeObj = new Kunde();

// Formularverarbeitung: Wenn das Formular per POST abgeschickt wurde,
// werden die eingegebenen Kundendaten aus dem POST-Array ausgelesen.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen der Formulardaten; falls ein Feld nicht gesetzt ist, wird ein Standardwert (hier ein leerer String) verwendet.
    $nachname         = $_POST['nachname']         ?? '';
    $vorname          = $_POST['vorname']          ?? '';
    $email            = $_POST['email']            ?? '';
    $lieblingsgericht = $_POST['lieblingsgericht'] ?? '';
    $plz              = $_POST['plz']              ?? '';
    $ort              = $_POST['ort']              ?? '';
    $strasse          = $_POST['strasse']          ?? '';
    $strassennr       = $_POST['strassennr']       ?? '';
    $telefonnr        = $_POST['telefonnr']        ?? '';

    // Aufruf der create()-Methode der Kunden-Klasse, um einen neuen Kundendatensatz in die Datenbank anzulegen.
    // Dabei werden die ausgelesenen Werte als Parameter übergeben.
    $kundeObj->create($nachname, $vorname, $email, $lieblingsgericht, $plz, $ort, $strasse, $strassennr, $telefonnr);

    // Nach erfolgreicher Speicherung erfolgt eine Weiterleitung zur Übersichtsseite (index.php).
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuen Kunden anlegen</title>
    <!-- Einbinden der externen CSS-Datei, die das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Inhalt der Seite umschließt -->
    <div class="container">
        <!-- Überschriftencontainer mit dem Seitentitel -->
        <div class="ueberschrift-container">
            <h1>Neuen Kunden anlegen</h1>
        </div>
        <!-- Formular zur Eingabe der Kundendaten -->
        <form method="POST">
            <!-- Editier-Container: Bereich, in dem das Formular gestaltet wird -->
            <div class="edit-container">
                <!-- Eingabefelder für Nachname und Vorname, die Pflichtfelder (required) sind -->
                <label>Nachname:<br>
                    <input type="text" name="nachname" required>
                </label>
                <br>
                <label>Vorname:<br>
                    <input type="text" name="vorname" required>
                </label>
                <br><br>

                <!-- Eingabefelder für Email und Lieblingsgericht -->
                <label>Email:<br>
                    <input type="email" name="email" required>
                </label>
                <br>
                <label>Lieblingsgericht:<br>
                    <input type="text" name="lieblingsgericht">
                </label>
                <br><br>

                <!-- Eingabefelder für Adressdaten -->
                <label>PLZ:<br>
                    <input type="text" name="plz">
                </label>
                <br>
                <label>Ort:<br>
                    <input type="text" name="ort">
                </label>
                <br>
                <label>Strasse:<br>
                    <input type="text" name="strasse">
                </label>
                <br>
                <label>Strassennr:<br>
                    <input type="text" name="strassennr">
                </label>
                <br><br>

                <!-- Eingabefeld für Telefonnummer -->
                <label>Telefonnr:<br>
                    <input type="text" name="telefonnr">
                </label>
                <br><br>

                <!-- Buttons:
                     - Der "Abbrechen"-Button leitet den Benutzer zur Übersichtsseite zurück.
                     - Der "Speichern"-Button sendet das Formular ab, sodass die Daten gespeichert werden. -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <button type="submit">Speichern</button>
            </div>
        </form>
    </div>
</body>
</html>
