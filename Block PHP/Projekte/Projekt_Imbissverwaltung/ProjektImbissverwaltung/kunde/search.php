<?php
// Einbinden der Kunden-Klasse, die alle CRUD-Operationen (einschließlich der Suchfunktion) kapselt.
// Dadurch erhält man Zugriff auf Methoden wie search() und readAll().
require_once __DIR__ . '/../_classes/Kunde.php';

// Erzeugen eines neuen Objekts der Klasse Kunde.
$kundeObj = new Kunde();

// Initialisieren eines leeren Arrays für Suchergebnisse.
$ergebnisse = [];

// Prüfen, ob das Suchformular per POST abgeschickt wurde.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen des Suchbegriffs aus dem POST-Array.
    // Falls kein Suchbegriff eingegeben wurde, wird ein leerer String verwendet.
    $searchTerm = $_POST['searchTerm'] ?? '';
    
    // Aufruf der search()-Methode der Kunde-Klasse mit dem Suchbegriff.
    // Diese Methode liefert ein Array von Kundendatensätzen, die den Suchkriterien entsprechen.
    $ergebnisse = $kundeObj->search($searchTerm);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kunden-Suche</title>
    <!-- Optional: Hier kann ein Stylesheet eingebunden werden -->
</head>
<body>
    <h1>Kunden-Suche</h1>

    <!-- Suchformular, das per POST abgesendet wird -->
    <form method="POST">
        <label for="searchTerm">Suchbegriff:</label>
        <!-- Textfeld für den Suchbegriff. Hier könnte man auch den eingegebenen Wert als Value übernehmen -->
        <input type="text" name="searchTerm" id="searchTerm" value="">
        <button type="submit">Suchen</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Suchergebnisse</h2>

        <?php if (count($ergebnisse) > 0): ?>
            <!-- Tabelle zur Darstellung der gefundenen Kundendatensätze -->
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>Email</th>
                        <th>Lieblingsgericht</th>
                        <th>PLZ</th>
                        <th>Ort</th>
                        <th>Strasse</th>
                        <th>Nr</th>
                        <th>Telefon</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteration über alle gefundenen Kundendatensätze -->
                    <?php foreach ($ergebnisse as $row): ?>
                    <tr>
                        <!-- Jeder Wert wird mittels htmlspecialchars() abgesichert, um Sonderzeichen korrekt darzustellen -->
                        <td><?php echo htmlspecialchars($row['kundeId']); ?></td>
                        <td><?php echo htmlspecialchars($row['nachname']); ?></td>
                        <td><?php echo htmlspecialchars($row['vorname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['lieblingsgericht']); ?></td>
                        <td><?php echo htmlspecialchars($row['plz']); ?></td>
                        <td><?php echo htmlspecialchars($row['ort']); ?></td>
                        <td><?php echo htmlspecialchars($row['strasse']); ?></td>
                        <td><?php echo htmlspecialchars($row['strassennr']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefonnr']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Falls keine Kunden den Suchkriterien entsprechen -->
            <p>Keine Kunden gefunden.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
