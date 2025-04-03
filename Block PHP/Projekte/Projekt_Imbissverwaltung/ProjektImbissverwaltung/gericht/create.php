<?php
// Einbinden der Gericht-Klasse, die alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Gerichte kapselt.
require_once __DIR__ . '/../_classes/Gericht.php';

// Erzeugen eines neuen Objekts der Klasse Gericht, um auf deren Methoden zugreifen zu können.
$gerichtObj = new Gericht();

// 1) Listen für Dropdowns laden:
// - $alleKoeche enthält alle Köche (z. B. kochId, vorname, nachname),
//   die in der Dropdown-Liste zur Auswahl angezeigt werden.
// - $alleRezepte enthält alle Rezepte (z. B. rezeptId, rezeptname),
//   die in der Dropdown-Liste zur Auswahl angezeigt werden.
$alleKoeche  = $gerichtObj->readAllKoch();   // Liefert ein Array aller Köche.
$alleRezepte = $gerichtObj->readAllRezept();    // Liefert ein Array aller Rezepte.

// 2) Formularverarbeitung: Wenn das Formular per POST abgeschickt wurde...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ...werden die übermittelten Werte aus dem Formular ausgelesen und in den korrekten Typ umgewandelt:
    $kochId   = (int)($_POST['kochId'] ?? 0);   // Konvertiert die übermittelte Koch-ID in einen Integer.
    $rezeptId = (int)($_POST['rezeptId'] ?? 0);   // Konvertiert die übermittelte Rezept-ID in einen Integer.

    // Aufruf der create()-Methode der Klasse Gericht, um ein neues Gericht in der Datenbank anzulegen.
    // Es wird hier die Beziehung zwischen einem Koch und einem Rezept gespeichert.
    $gerichtObj->create($kochId, $rezeptId);

    // Nach erfolgreicher Erstellung der Bestellung wird der Benutzer zur Übersichtsseite weitergeleitet.
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Gericht anlegen</title>
    <!-- Einbinden des externen Stylesheets für das Seitenlayout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <!-- Überschriften-Container -->
        <div class="ueberschrift-container">
            <h1>Neues Gericht anlegen</h1>
        </div>
        <!-- Formular zur Anlage eines neuen Gerichts -->
        <form method="POST">
            <!-- Editier-Container: Bereich, in dem das Formular gestaltet wird -->
            <div class="edit-container">
                <!-- Dropdown zur Auswahl eines Kochs -->
                <label for="kochId">Koch auswählen:</label><br>
                <select name="kochId" id="kochId" required>
                    <option value="">-- Bitte wählen --</option>
                    <!-- Schleife über alle geladenen Köche -->
                    <?php foreach ($alleKoeche as $koch): ?>
                        <?php
                            // Für jeden Koch wird der Option-Wert auf die kochId gesetzt,
                            // das Label wird als "Nachname, Vorname" formatiert.
                            $value = $koch['kochId'];
                            $label = $koch['nachname'] . ', ' . $koch['vorname'];
                        ?>
                        <option value="<?php echo $value; ?>">
                            <?php echo htmlspecialchars($label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                
                <!-- Dropdown zur Auswahl eines Rezepts -->
                <label for="rezeptId">Rezept auswählen:</label><br>
                <select name="rezeptId" id="rezeptId" required>
                    <option value="">-- Bitte wählen --</option>
                    <!-- Schleife über alle geladenen Rezepte -->
                    <?php foreach ($alleRezepte as $rez): ?>
                        <?php
                            // Für jedes Rezept wird der Option-Wert auf die rezeptId gesetzt,
                            // das Label entspricht dem rezeptname.
                            $value = $rez['rezeptId'];
                            $label = $rez['rezeptname'];
                        ?>
                        <option value="<?php echo $value; ?>">
                            <?php echo htmlspecialchars($label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br><br><br>

                <!-- Buttons: "Abbrechen" leitet zur Übersichtsseite, "Speichern" sendet das Formular ab -->
                <button type="button" onclick="window.location.href='index.php';">Abbrechen</button>
                <button type="submit">Speichern</button>
            </div>
        </form>
    </div>
</body>
</html>
