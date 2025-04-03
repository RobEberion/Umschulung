<?php
// Einbinden der Koch-Klasse, die alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Koch-Datensätze kapselt. Dadurch erhält man Zugriff auf Methoden wie readAll(), create(), update() etc.
require_once __DIR__ . '/../_classes/Koch.php';

// Erzeugen eines neuen Objekts der Klasse Koch.
$kochObj = new Koch();

// Abrufen aller Köche aus der Datenbank.
// Die Methode readAll() liefert ein Array, das für jeden Koch u.a. die Werte für
// 'kochId', 'nachname', 'vorname', 'sterne', 'age', 'geschlecht' und 'spezialgebiet' enthält.
$alleKoeche = $kochObj->readAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Köche Übersicht</title>
    <!-- Einbinden der externen CSS-Datei, die das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Einbinden der Navigationsleiste aus einem externen PHP-Fragment -->
    <?php require_once __DIR__ . '/../_include/navigation.inc.php';?>

    <!-- Hauptcontainer, der den gesamten Inhalt der Seite umschließt -->
    <div class="container">
        <br>
        <!-- Überschriftencontainer, der den Seitentitel anzeigt -->
        <div class="ueberschrift-container">
            <h1>Köche</h1>
        </div>
        <!-- Container für die Tabelle -->
        <div class="tabellen-container">
            <!-- Link zum Formular, um einen neuen Koch anzulegen -->
            <p><a href="create.php">Neuen Koch anlegen</a></p>
            <!-- Tabelle zur Darstellung der Köche -->
            <table border="1">
                <thead>
                    <tr>
                        <!-- Tabellenkopf mit den Spaltenüberschriften -->
                        <th>KochId</th>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>Sterne</th>
                        <th>Alter</th>
                        <th>Geschlecht</th>
                        <th>Spezialgebiet</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteration über alle geladenen Köche -->
                    <?php foreach ($alleKoeche as $koch): ?>
                        <tr>
                            <!-- Ausgabe der Koch-ID -->
                            <td><?php echo htmlspecialchars($koch['kochId']); ?></td>
                            <!-- Ausgabe des Nachnamens -->
                            <td><?php echo htmlspecialchars($koch['nachname']); ?></td>
                            <!-- Ausgabe des Vornamens -->
                            <td><?php echo htmlspecialchars($koch['vorname']); ?></td>
                            <!-- Ausgabe der Sterne-Bewertung -->
                            <td><?php echo htmlspecialchars($koch['sterne']); ?></td>
                            <!-- Ausgabe des Alters -->
                            <td><?php echo htmlspecialchars($koch['age']); ?></td>
                            <!-- Ausgabe des Geschlechts -->
                            <td><?php echo htmlspecialchars($koch['geschlecht']); ?></td>
                            <!-- Ausgabe des Spezialgebiets -->
                            <td><?php echo htmlspecialchars($koch['spezialgebiet']); ?></td>
                            <!-- Aktionen: Link zum Bearbeiten des jeweiligen Koch-Datensatzes -->
                            <td>
                                <a href="edit.php?kochId=<?php echo $koch['kochId']; ?>">Bearbeiten</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- Ende des Tabellencontainers -->
    </div> <!-- Ende des Hauptcontainers -->
</body>
</html>
