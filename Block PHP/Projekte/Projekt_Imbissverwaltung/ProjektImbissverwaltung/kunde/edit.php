<?php
// Einbinden der Kunden-Klasse, welche alle CRUD-Operationen für Kundendatensätze kapselt.
// Dadurch erhält man Zugriff auf Funktionen wie readOne(), update() usw.
require_once __DIR__ . '/../_classes/Kunde.php';

// Erzeugen eines neuen Objekts der Klasse Kunde.
$kundeObj = new Kunde();

// 1) Überprüfen, ob eine kundeId per GET-Parameter übergeben wurde.
// Falls keine kundeId vorhanden ist, wird der Benutzer zur Übersichtsseite (index.php) weitergeleitet.
if (!isset($_GET['kundeId'])) {
    header('Location: index.php');
    exit;
}
$kundeId = (int)$_GET['kundeId'];

// 2) Laden des Kundendatensatzes anhand der kundeId.
// Die Methode readOne() ruft alle Daten des Kunden ab. Falls kein Datensatz gefunden wird,
// wird eine Fehlermeldung ausgegeben und das Skript beendet.
$kundeData = $kundeObj->readOne($kundeId);
if (!$kundeData) {
    echo "Kein Kunde mit der ID $kundeId gefunden.";
    exit;
}

// 3) Formularverarbeitung: Wenn das Formular per POST abgesendet wurde,
// werden die neuen Werte aus dem Formular ausgelesen und der Kundendatensatz in der Datenbank aktualisiert.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen der Formulardaten; falls ein Wert fehlt, wird ein Standardwert (z. B. leerer String) gesetzt.
    $nachname         = $_POST['nachname']         ?? '';
    $vorname          = $_POST['vorname']          ?? '';
    $email            = $_POST['email']            ?? '';
    $lieblingsgericht = $_POST['lieblingsgericht'] ?? '';
    $plz              = $_POST['plz']              ?? '';
    $ort              = $_POST['ort']              ?? '';
    $strasse          = $_POST['strasse']          ?? '';
    $strassennr       = $_POST['strassennr']       ?? '';
    $telefonnr        = $_POST['telefonnr']        ?? '';

    // Aufruf der update()-Methode der Kunden-Klasse, um den Datensatz in der Datenbank zu aktualisieren.
    // Alle gesammelten Werte werden als Parameter übergeben.
    $kundeObj->update($kundeId, $nachname, $vorname, $email, $lieblingsgericht, $plz, $ort, $strasse, $strassennr, $telefonnr);
    
    // Nach erfolgreichem Update erfolgt eine Weiterleitung zur Übersichtsseite.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kunden bearbeiten</title>
    <!-- Einbinden des externen Stylesheets für das Layout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <!-- Überschriftencontainer, der den Titel der Seite anzeigt -->
        <div class="ueberschrift-container">
            <h1>Kunden bearbeiten</h1>
        </div>
        <!-- Formular zur Bearbeitung des Kundendatensatzes -->
        <form method="POST">
            <div class="edit-container">
                <!-- Eingabefeld für Nachname:
                     Das Feld wird mit dem aktuellen Wert des Kundendatensatzes vorbelegt. -->
                <label>Nachname:
                    <br>
                    <input type="text" name="nachname" 
                        value="<?php echo htmlspecialchars($kundeData['nachname']); ?>" required>
                </label>
                <br><br>

                <!-- Eingabefeld für Vorname, ebenfalls vorbefüllt -->
                <label>Vorname:
                    <br>
                    <input type="text" name="vorname" 
                        value="<?php echo htmlspecialchars($kundeData['vorname']); ?>" required>
                </label>
                <br><br>

                <!-- Eingabefeld für Email -->
                <label>Email:
                    <br> 
                    <input type="email" name="email" value="<?php echo htmlspecialchars($kundeData['email']); ?>" required>
                </label>
                <br>

                <!-- Eingabefeld für Lieblingsgericht -->
                <label>Lieblingsgericht:
                    <br> 
                    <input type="text" name="lieblingsgericht" value="<?php echo htmlspecialchars($kundeData['lieblingsgericht']); ?>">
                </label>
                <br><br>

                <!-- Eingabefelder für Adressdaten -->
                <label>PLZ:
                    <br>
                    <input type="text" name="plz" value="<?php echo htmlspecialchars($kundeData['plz']); ?>">
                </label>
                <br>
                <label>Ort:
                    <br>
                    <input type="text" name="ort" value="<?php echo htmlspecialchars($kundeData['ort']); ?>">
                </label>
                <br>
                <label>Strasse:
                    <br>
                    <input type="text" name="strasse" value="<?php echo htmlspecialchars($kundeData['strasse']); ?>">
                </label>
                <br>
                <label>Strassennr:
                    <br>
                    <input type="text" name="strassennr" value="<?php echo htmlspecialchars($kundeData['strassennr']); ?>">
                </label>
                <br><br>

                <!-- Eingabefeld für Telefonnummer -->
                <label>Telefonnr:
                    <br>
                    <input type="text" name="telefonnr" value="<?php echo htmlspecialchars($kundeData['telefonnr']); ?>">
                </label>
                <br><br><br>

                <!-- Buttons für Abbrechen, Speichern und Löschen:
                     - Abbrechen: Leitet zur Übersichtsseite zurück.
                     - Speichern: Sendet das Formular ab.
                     - Löschen: Fragt per Bestätigung, ob der Datensatz gelöscht werden soll, und leitet dann zur delete.php weiter. -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <button type="submit">Kunde speichern</button>
                <button type="button"
                        onclick="if (confirm('Wirklich löschen?')) {
                            window.location.href='delete.php?kundeId=<?php echo $kundeId; ?>';
                        }">
                    Kunden löschen
                </button>
            </div>
        </form>
    </div>
</body>
</html>
