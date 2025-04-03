<?php
// Einbinden der Bestellungs-Klasse, die alle CRUD-Operationen für Bestellungen kapselt.
require_once __DIR__ . '/../_classes/Bestellung.php';

// Erzeugen eines neuen Objekts der Klasse Bestellung.
$bestellungObj = new Bestellung();

// 1) bestellungId prüfen:
// Überprüfen, ob per GET-Parameter eine bestellungId übergeben wurde.
// Falls nicht, wird der Benutzer zur Übersichtsseite weitergeleitet.
if (!isset($_GET['bestellungId'])) {
    header('Location: index.php');
    exit;
}

// Die bestellungId wird aus dem GET-Parameter gelesen und in einen Integer konvertiert.
$bestellungId = (int)$_GET['bestellungId'];

// 2) Daten der Bestellung laden:
// Ruft die Daten der Bestellung anhand der bestellungId ab.
$data = $bestellungObj->readOne($bestellungId);
if (!$data) {
    // Falls keine Bestellung gefunden wurde, wird eine Fehlermeldung ausgegeben.
    echo "Fehler: Keine Bestellung mit ID $bestellungId gefunden.";
    exit;
}

// 3) Gerichte & Kunden laden:
// Lädt die Listen für Gerichte (mit Rezeptnamen und KochNachname) und Kunden,
// um sie in den Dropdowns im Formular anzuzeigen.
$gerichteListe = $bestellungObj->readAllGerichteMitKochName();  // Liefert eine Liste der Gerichte mit zugehörigen Rezeptnamen und Köchen.
$kundenListe   = $bestellungObj->readAllKunden();               // Liefert eine Liste aller Kunden.

// 4) POST => Update:
// Falls das Formular per POST abgeschickt wurde, werden die übermittelten Werte verarbeitet.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen und Typumwandlung der Formulardaten:
    $kundeId     = (int)($_POST['kundeId'] ?? 0);
    $gerichtId   = (int)($_POST['gerichtId'] ?? 0);
    $anzahl      = (int)($_POST['anzahl'] ?? 1);
    $preis       = (float)($_POST['preis'] ?? 0.0);
    $zahlungsart = $_POST['zahlungsart'] ?? 'bargeld';

    // Aufruf der update()-Methode, um die Bestellung mit den neuen Daten zu aktualisieren.
    $bestellungObj->update($bestellungId, $kundeId, $gerichtId, $anzahl, $preis, $zahlungsart);
    
    // Nach dem Update erfolgt eine Weiterleitung zur Übersichtsseite.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung bearbeiten</title>
    <!-- Einbinden des Stylesheets für das Design -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer für den Seiteninhalt -->
    <div class="container">
        <!-- Überschriftencontainer mit Titel -->
        <div class="ueberschrift-container">
            <h1>Bestellung bearbeiten</h1>
        </div>
        <!-- Formular zur Bearbeitung der Bestellung -->
        <form method="post">
            <div class="edit-container">
                <!-- Kunde-Auswahl -->
                <label>
                    Kunde:<br>
                    <select name="kundeId" required>
                        <option value="">-- bitte wählen --</option>
                        <?php foreach ($kundenListe as $k): ?>
                            <?php 
                                // Setze den Option-Wert auf die Kunden-ID und das Label auf "Nachname, Vorname".
                                $value = $k['kundeId'];
                                $label = $k['nachname'] . ', ' . $k['vorname'];
                                // Falls die Kunden-ID der aktuellen Bestellung entspricht, wird diese Option vorausgewählt.
                                $selected = ($value == $data['kundeId']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $value; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br><br>
                
                <!-- Gericht-Auswahl (Anzeige als "Rezeptname (KochNachname)") -->
                <label>
                    Gericht:<br>
                    <select name="gerichtId" required>
                        <option value="">-- bitte wählen --</option>
                        <?php foreach ($gerichteListe as $g): ?>
                            <?php 
                                // Setze den Option-Wert auf die Gericht-ID und baue das Label als "Rezeptname (KochNachname)" auf.
                                $value    = $g['gerichtId'];
                                $label    = $g['rezeptname'] . ' (' . $g['kochNachname'] . ')';
                                // Falls das aktuelle Gericht der Bestellung entspricht, wird diese Option vorausgewählt.
                                $selected = ($value == $data['gerichtId']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $value; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br><br>

                <!-- Eingabefeld für die Anzahl -->
                <label>
                    Anzahl:<br>
                    <input type="number" name="anzahl" value="<?php echo htmlspecialchars($data['anzahl']); ?>" min="1" required>
                </label>
                <br><br>

                <!-- Eingabefeld für den Preis -->
                <label>
                    Preis:<br>
                    <input type="number" step="0.01" name="preis" value="<?php echo htmlspecialchars($data['preis']); ?>">
                </label>
                <br><br>

                <!-- Dropdown für Zahlungsart -->
                <label>
                    Zahlungsart:<br>
                    <select name="zahlungsart">
                        <option value="bargeld" <?php if ($data['zahlungsart'] === 'bargeld') echo 'selected'; ?>>bargeld</option>
                        <option value="karte" <?php if ($data['zahlungsart'] === 'karte') echo 'selected'; ?>>karte</option>
                        <option value="paypal" <?php if ($data['zahlungsart'] === 'paypal') echo 'selected'; ?>>paypal</option>
                    </select>
                </label>
                <br><br><br>
            
                <!-- Buttons: Abbrechen, Speichern und Bestellung löschen -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <button type="submit">Bestellung speichern</button>

                <!-- Löschen-Button mit Bestätigungsabfrage -->
                <button type="button"
                    onclick="if (confirm('Wirklich löschen?')) { window.location.href='delete.php?bestellungId=<?php echo $bestellungId; ?>'; }">
                    Bestellung löschen
                </button>
            </div>
        </form>
    </div>
</body>
</html>
