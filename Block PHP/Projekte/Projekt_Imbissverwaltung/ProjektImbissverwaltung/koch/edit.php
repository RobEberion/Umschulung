<?php
// Einbinden der Koch-Klasse, die alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Koch-Datensätze kapselt. Dadurch hast du Zugriff auf Methoden wie create(), readOne() und update().
require_once __DIR__ . '/../_classes/Koch.php';

// Erzeugen eines neuen Objekts der Klasse Koch, um später auf dessen Methoden zugreifen zu können.
$kochObj = new Koch();

// 1) Prüfung, ob eine kochId per GET-Parameter übergeben wurde.
// Wenn keine kochId übergeben wird, leitet das Skript den Benutzer zur Übersichtsseite (index.php) weiter.
if (!isset($_GET['kochId'])) {
    header('Location: index.php');
    exit;
}
// Die kochId wird aus dem GET-Parameter ausgelesen und in einen Integer umgewandelt.
$kochId = (int)$_GET['kochId'];

// 2) Laden der aktuellen Koch-Daten anhand der kochId.
// Die Methode readOne() liefert ein Array mit den Daten des jeweiligen Kochs.
// Falls kein Datensatz gefunden wird, wird eine Fehlermeldung ausgegeben und das Skript beendet.
$kochData = $kochObj->readOne($kochId);
if (!$kochData) {
    echo "Fehler: Kein Koch mit der ID $kochId gefunden.";
    exit;
}

// 3) Formularverarbeitung: Falls das Formular per POST abgesendet wurde...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ...werden die neuen Werte aus dem Formular ausgelesen.
    // Falls ein Wert nicht übergeben wird, wird ein Standardwert (z. B. leerer String oder 0) verwendet.
    $nachname      = $_POST['nachname']      ?? '';
    $vorname       = $_POST['vorname']       ?? '';
    $sterne        = (int)($_POST['sterne']  ?? 0);
    $age           = (int)($_POST['age']     ?? 0);
    $geschlecht    = $_POST['geschlecht']    ?? '';
    $spezialgebiet = $_POST['spezialgebiet'] ?? '';

    // Optional: Serverseitige Validierung für die Sternezahl.
    // Es wird geprüft, ob der Wert für Sterne zwischen 1 und 3 liegt.
    // Falls nicht, wird der Wert auf den Standardwert 1 gesetzt.
    if ($sterne < 1 || $sterne > 3) {
        $sterne = 1;
    }

    // Update des Koch-Datensatzes in der Datenbank mittels der update()-Methode.
    // Hier werden alle gesammelten Daten (nachname, vorname, sterne, age, geschlecht, spezialgebiet)
    // für den Koch mit der übergebenen kochId aktualisiert.
    $kochObj->update($kochId, $nachname, $vorname, $sterne, $age, $geschlecht, $spezialgebiet);
    
    // Nach erfolgreichem Update erfolgt eine Weiterleitung zur Übersichtsseite.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Koch bearbeiten</title>
    <!-- Einbinden des externen Stylesheets für das Seitenlayout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <!-- Überschriftencontainer, der den Titel der Seite anzeigt -->
        <div class="ueberschrift-container">
            <h1>Koch bearbeiten</h1>
        </div>
        <!-- Formular zur Bearbeitung des Koch-Datensatzes -->
        <form method="post">
            <div class="edit-container">
                <!-- Eingabefeld für Nachname:
                     Der aktuelle Wert wird mit htmlspecialchars() abgesichert und als Value im Feld gesetzt.
                     Das Feld ist required, sodass der Benutzer einen Wert eingeben muss. -->
                <label>Nachname:
                    <br>
                    <input type="text" name="nachname" 
                        value="<?php echo htmlspecialchars($kochData['nachname']); ?>" required>
                </label>
                <br><br>

                <!-- Eingabefeld für Vorname, vorbefüllt mit dem aktuellen Wert -->
                <label>Vorname:
                    <br>
                    <input type="text" name="vorname" 
                        value="<?php echo htmlspecialchars($kochData['vorname']); ?>" required>
                </label>
                <br><br>

                <!-- Dropdown zur Auswahl der Sterne-Bewertung:
                     Das Feld ist required, und es werden drei Optionen (1, 2, 3) angeboten.
                     Die aktuell gespeicherte Sternezahl wird über das selected-Attribut markiert. -->
                <label>Sterne:
                    <br>
                    <select name="sterne" required>
                        <option value="1" <?php if ($kochData['sterne'] == 1) echo 'selected'; ?>>1</option>
                        <option value="2" <?php if ($kochData['sterne'] == 2) echo 'selected'; ?>>2</option>
                        <option value="3" <?php if ($kochData['sterne'] == 3) echo 'selected'; ?>>3</option>
                    </select>
                </label>
                <br><br>

                <!-- Eingabefeld für das Alter des Kochs:
                     Der aktuelle Wert wird als Value vorbefüllt. -->
                <label>Alter:
                    <br>
                    <input type="number" name="age" 
                        value="<?php echo htmlspecialchars($kochData['age']); ?>">
                </label>
                <br><br>

                <!-- Dropdown zur Auswahl des Geschlechts:
                     Die aktuelle Auswahl wird durch das selected-Attribut markiert. -->
                <label>Geschlecht:
                    <br>
                    <select name="geschlecht">
                        <option value="männlich" <?php if ($kochData['geschlecht'] === 'männlich') echo 'selected'; ?>>männlich</option>
                        <option value="weiblich" <?php if ($kochData['geschlecht'] === 'weiblich') echo 'selected'; ?>>weiblich</option>
                        <option value="geschlechtsneutral" <?php if ($kochData['geschlecht'] === 'geschlechtsneutral') echo 'selected'; ?>>geschlechtsneutral</option>
                    </select>
                </label>
                <br><br>

                <!-- Eingabefeld für das Spezialgebiet:
                     Das Feld ist vorbefüllt mit dem aktuellen Wert. -->
                <label>Spezialgebiet:
                    <br>
                    <input type="text" name="spezialgebiet" 
                        value="<?php echo htmlspecialchars($kochData['spezialgebiet']); ?>">
                </label>
                <br><br><br>

                <!-- Buttons für Abbrechen, Speichern und Löschen: -->
                <!-- Der "Abbrechen"-Button leitet den Benutzer zur Übersichtsseite zurück. -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <!-- Der "Speichern"-Button sendet das Formular ab, um die Änderungen zu übernehmen. -->
                <button type="submit">Koch speichern</button>
                
                <!-- Löschen-Button: Bei Bestätigung wird der Benutzer zur delete.php mit der entsprechenden kochId weitergeleitet. -->
                <button type="button"
                        onclick="if (confirm('Wirklich löschen?')) {
                            window.location.href='delete.php?kochId=<?php echo $kochId; ?>';
                        }">
                    Koch löschen
                </button>
            </div>
        </form>
    </div>
</body>
</html>
