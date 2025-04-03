<?php
// Einbinden der Gericht-Klasse, die alle CRUD-Operationen für Gerichte kapselt.
require_once __DIR__ . '/../_classes/Gericht.php';

// Erzeugen eines neuen Objekts der Klasse Gericht, um auf deren Methoden zugreifen zu können.
$gerichtObj = new Gericht();

// 1) Prüfung, ob eine gerichtId per GET-Parameter übergeben wurde.
// Falls nicht, erfolgt eine Weiterleitung zur Übersichtsseite (index.php).
if (!isset($_GET['gerichtId'])) {
    header('Location: index.php');
    exit;
}

// Die gerichtId wird aus dem GET-Parameter gelesen und in einen Integer konvertiert.
$gerichtId = (int)$_GET['gerichtId'];

// 2) Datensatz laden (nur die relevanten IDs):
// Mit der Methode readOne() wird geprüft, ob ein Gericht mit der übergebenen ID existiert.
$gerichtData = $gerichtObj->readOne($gerichtId);
if (!$gerichtData) {
    // Falls kein entsprechender Datensatz gefunden wurde, wird eine Fehlermeldung ausgegeben.
    echo "Kein Gericht mit der ID $gerichtId gefunden.";
    exit;
}

// 3) Aktuelle IDs (der aktuell zugeordneten Köchin und des Rezepts) aus dem geladenen Datensatz extrahieren.
$currentKochId   = $gerichtData['kochId'];
$currentRezeptId = $gerichtData['rezeptId'];

// 4) Listen für Dropdowns laden:
// - $alleKoeche enthält alle Köche (mit kochId, vorname, nachname) für das Dropdown.
// - $alleRezepte enthält alle Rezepte (mit rezeptId, rezeptname) für das Dropdown.
$alleKoeche  = $gerichtObj->readAllKoch();   // Liefert ein Array aller Köche.
$alleRezepte = $gerichtObj->readAllRezept();    // Liefert ein Array aller Rezepte.

// 5) Formularverarbeitung: Falls das Formular per POST abgeschickt wurde...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ...werden die übermittelten Werte aus dem Formular ausgelesen und in den entsprechenden Datentyp konvertiert.
    $newKochId   = (int)($_POST['kochId'] ?? 0);
    $newRezeptId = (int)($_POST['rezeptId'] ?? 0);

    // Aufruf der update()-Methode, um das Gericht mit den neuen Koch- und Rezept-IDs zu aktualisieren.
    $gerichtObj->update($gerichtId, $newKochId, $newRezeptId);
    
    // Nach erfolgreichem Update erfolgt eine Weiterleitung zur Übersichtsseite.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gericht bearbeiten</title>
    <!-- Einbinden des externen Stylesheets für das Seitenlayout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer für den gesamten Seiteninhalt -->
    <div class="container">
        <!-- Überschriftencontainer -->
        <div class="ueberschrift-container">
            <h1>Gericht bearbeiten</h1>
        </div>
        <!-- Formular zur Bearbeitung des Gerichts -->
        <form method="POST">
            <div class="edit-container">
                <!-- Dropdown zur Auswahl des Kochs -->
                <label>
                    Koch auswählen:<br>
                    <select name="kochId" required>
                        <option value="">-- Bitte wählen --</option>
                        <!-- Iteration über die Liste aller Köche -->
                        <?php foreach ($alleKoeche as $koch): ?>
                            <?php
                                // Für jeden Koch wird der Option-Wert auf die kochId gesetzt.
                                // Das Label wird als "Nachname, Vorname" formatiert.
                                $value = $koch['kochId'];
                                $label = $koch['nachname'] . ', ' . $koch['vorname'];
                                // Falls die Kunden-ID der aktuellen Bestellung entspricht, wird diese Option vorausgewählt.
                                $selected = ($value == $currentKochId) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $value; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br><br>
                
                <!-- Dropdown zur Auswahl des Rezepts -->
                <label>
                    Rezept auswählen:<br>
                    <select name="rezeptId" required>
                        <option value="">-- Bitte wählen --</option>
                        <!-- Iteration über die Liste aller Rezepte -->
                        <?php foreach ($alleRezepte as $rez): ?>
                            <?php
                                // Für jedes Rezept wird der Option-Wert auf die rezeptId gesetzt.
                                // Das Label entspricht dem rezeptname.
                                $value = $rez['rezeptId'];
                                $label = $rez['rezeptname'];
                                // Falls die aktuell zugewiesene Rezept-ID dem Datensatz entspricht, wird diese Option vorausgewählt.
                                $selected = ($value == $currentRezeptId) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $value; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <br><br><br>

                <!-- Buttons: Abbrechen, Speichern und Löschen -->
                <!-- Abbrechen: Leitet den Benutzer zur Übersichtsseite zurück -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <!-- Speichern: Sendet das Formular ab -->
                <button type="submit">Gericht speichern</button>
                <!-- Löschen: Führt bei Bestätigung die Löschung des Gerichts durch -->
                <button type="button"
                    onclick="if (confirm('Wirklich löschen?')) { window.location.href='delete.php?gerichtId=<?php echo $gerichtId; ?>'; }">
                    Gericht löschen
                </button>
            </div>
        </form>
    </div>
</body>
</html>
