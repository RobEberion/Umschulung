<?php
// Einbinden der Kunden-Klasse, welche alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Kundendatensätze kapselt. Dadurch hast du Zugriff auf Methoden wie readAll() und search().
require_once __DIR__ . '/../_classes/Kunde.php';

// Erzeugen eines neuen Objekts der Klasse Kunde.
$kundeObj = new Kunde();

// 1) Suchbegriff aus dem GET-Parameter holen:
// Falls kein Suchbegriff vorhanden ist, wird ein leerer String verwendet.
$searchTerm = $_GET['searchTerm'] ?? '';

// 2) Abhängig davon, ob ein Suchbegriff vorliegt, werden entweder alle Kunden geladen oder eine Suche durchgeführt:
// Wenn ein Suchbegriff vorhanden ist, wird die search()-Methode aufgerufen, ansonsten readAll().
if ($searchTerm !== '') {
    $alleKunden = $kundeObj->search($searchTerm);
} else {
    $alleKunden = $kundeObj->readAll();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kunden Übersicht</title>
    <!-- Einbinden der externen CSS-Datei, die das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Einbinden der Navigationsleiste (externe Datei) -->
    <?php require_once __DIR__ . '/../_include/navigation.inc.php'; ?>
    
    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <br>
        <!-- Überschriftencontainer mit dem Seitentitel -->
        <div class="ueberschrift-container">
            <h1>Kunden</h1>
        </div>
        <!-- Container für die Tabelle -->
        <div class="tabellen-container">
            <!-- Link zum Formular, um einen neuen Kunden anzulegen -->
            <p><a href="create.php">Neuen Kunden anlegen</a></p>

            <!-- Suchformular: Hier kann der Benutzer einen Suchbegriff eingeben,
                 um nach bestimmten Kunden (z. B. nach Name oder E-Mail) zu suchen. -->
            <form method="GET" style="margin-bottom: 1em;">
                <input type="text" name="searchTerm" 
                    placeholder="Suche nach Name, E-Mail..." 
                    value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Suchen</button>
            </form>

            <!-- Tabelle zur Anzeige der Kunden -->
            <table border="1">
                <thead>
                    <tr>
                        <!-- Tabellenkopf: Überschriften der Spalten -->
                        <th>KundeId</th>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>Email</th>
                        <th>Lieblingsgericht</th>
                        <th>PLZ</th>
                        <th>Ort</th>
                        <th>Strasse</th>
                        <th>Strassennr</th>
                        <th>Telefonnr</th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteration über alle geladenen Kunden -->
                    <?php foreach ($alleKunden as $kunde): ?>
                    <tr>
                        <!-- Ausgabe der Kundendaten, abgesichert durch htmlspecialchars() -->
                        <td><?php echo htmlspecialchars($kunde['kundeId']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['nachname']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['vorname']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['email']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['lieblingsgericht']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['plz']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['ort']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['strasse']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['strassennr']); ?></td>
                        <td><?php echo htmlspecialchars($kunde['telefonnr']); ?></td>
                        <!-- Aktion: Link zum Bearbeiten des jeweiligen Kundendatensatzes -->
                        <td>
                            <a href="edit.php?kundeId=<?php echo $kunde['kundeId']; ?>">Bearbeiten</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- Ende des Tabellencontainers -->
    </div> <!-- Ende des Hauptcontainers -->
</body>
</html>
