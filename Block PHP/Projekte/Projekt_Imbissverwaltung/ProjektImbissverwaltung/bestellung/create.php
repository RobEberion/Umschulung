<?php
// Einbinden der Bestellung-Klasse, die alle CRUD-Operationen für Bestellungen kapselt.
require_once __DIR__ . '/../_classes/Bestellung.php';

// Erzeugen eines neuen Objekts der Klasse Bestellung, um später auf die Methoden zugreifen zu können.
$bestellungObj = new Bestellung();

// Laden der Kundenliste für das Dropdown im Formular. 
// Diese Methode liefert ein Array mit allen Kundendatensätzen (z.B. kundeId, nachname, vorname).
$kundenListe = $bestellungObj->readAllKunden();

// Laden der Liste aller Gerichte inklusive Rezeptname und zugehörigem KochNachname.
// Diese Methode kombiniert Daten aus den Tabellen "gericht", "rezept" und "koch" und liefert so eine aussagekräftige Liste.
$gerichteListe = $bestellungObj->readAllGerichteMitKochName();

// Prüfen, ob das Formular per POST abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen und Typumwandlung der übermittelten Formularwerte
    // Falls kein Wert übermittelt wurde, werden Standardwerte (0 oder 1) gesetzt.
    $kundeId     = (int)($_POST['kundeId'] ?? 0);
    $gerichtId   = (int)($_POST['gerichtId'] ?? 0);
    $anzahl      = (int)($_POST['anzahl'] ?? 1);
    $preis       = (float)($_POST['preis'] ?? 0.0);
    $zahlungsart = $_POST['zahlungsart'] ?? 'bargeld';

    // Anlegen der Bestellung in der Datenbank mit den übermittelten Werten.
    // Hier wird die create()-Methode der Bestellung-Klasse aufgerufen.
    $bestellungObj->create($kundeId, $gerichtId, $anzahl, $preis, $zahlungsart);
    
    // Nach erfolgreicher Erstellung wird der Benutzer zur Übersichtsseite (index.php) umgeleitet.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neue Bestellung anlegen</title>
    <!-- Einbinden des externen Stylesheets für das Layout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <br>
        <!-- Überschriften-Container, der den Titel der Seite enthält -->
        <div class="ueberschrift-container">
            <h1>Neue Bestellung anlegen</h1>
        </div>
        <!-- Formular zur Eingabe einer neuen Bestellung -->
        <form method="post">
            <!-- Editier-Container: Bereich, in dem das Formular gestaltet wird -->
            <div class="edit-container">
                <!-- Kunde-Dropdown -->
                <label>
                    Kunde:<br>
                    <!-- Dropdown zur Auswahl eines Kunden. "required" erzwingt eine Auswahl. -->
                    <select name="kundeId" required>
                        <!-- Platzhalter-Option -->
                        <option value="">-- bitte wählen --</option>
                        <?php foreach ($kundenListe as $k): ?>
                            <?php 
                                // Definiert den Wert (ID) und das Anzeigefeld (Nachname, Vorname) für jede Option
                                $value = $k['kundeId'];
                                $label = $k['nachname'] . ', ' . $k['vorname'];
                            ?>
                            <!-- Ausgabe der Option. htmlspecialchars() sorgt für die Sicherheit der Ausgabe -->
                            <option value="<?php echo $value; ?>">
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br><br>
                
                <!-- Gericht-Dropdown -->
                <label>
                    Gericht:<br>
                    <!-- Dropdown zur Auswahl eines Gerichts, angezeigt als "Rezeptname (KochNachname)" -->
                    <select name="gerichtId" required>
                        <!-- Platzhalter-Option -->
                        <option value="">-- bitte wählen --</option>
                        <?php foreach ($gerichteListe as $g): ?>
                            <?php 
                                // Legt den Wert (ID des Gerichts) und das Label ("Rezeptname (KochNachname)") fest
                                $value = $g['gerichtId'];
                                $label = $g['rezeptname'] . ' (' . $g['kochNachname'] . ')';
                            ?>
                            <option value="<?php echo $value; ?>">
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br><br>

                <!-- Eingabefeld für die Anzahl -->
                <label>
                    Anzahl:
                    <br>
                    <!-- Eingabefeld, das die Anzahl der bestellten Gerichte angibt.
                         Der Standardwert ist 1, und es muss mindestens 1 sein (min="1"). -->
                    <input type="number" name="anzahl" value="1" min="1" required>
                </label>
                <br><br>

                <!-- Eingabefeld für den Preis -->
                <label>
                    Preis:
                    <br>
                    <!-- Eingabefeld, das den Preis der Bestellung angibt.
                         step="0.01" erlaubt Dezimalwerte, Standardwert ist 0.00. -->
                    <input type="number" step="0.01" name="preis" value="0.00">
                </label>
                <br><br>

                <!-- Dropdown für die Auswahl der Zahlungsart -->
                <label>
                    Zahlungsart:
                    <br>
                    <select name="zahlungsart">
                        <!-- Mögliche Zahlungsarten -->
                        <option value="bargeld">bargeld</option>
                        <option value="karte">karte</option>
                        <option value="paypal">paypal</option>
                    </select>
                </label>
                <br><br><br>

                <!-- Buttons: Abbrechen und Speichern -->
                <!-- Der "Abbrechen"-Button leitet zurück zur Übersichtsseite -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <!-- Der "Speichern"-Button sendet das Formular ab -->
                <button type="submit">Speichern</button>
            </div>
        </form>
    </div>
</body>
</html>
