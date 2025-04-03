<?php
// Einbinden der Gericht-Klasse, die alle CRUD-Operationen für Gerichte kapselt.
require_once __DIR__ . '/../_classes/Gericht.php';

// Erzeugen eines neuen Objekts der Klasse Gericht, um auf deren Methoden zugreifen zu können.
$gerichtObj = new Gericht();

// Abrufen aller Gerichte aus der Datenbank.
// Die Methode readAll() liefert ein Array, das für jedes Gericht die Werte
// 'gerichtId', 'kochId' und 'rezeptId' enthält.
$alleGerichte = $gerichtObj->readAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gerichte Übersicht</title>
    <!-- Einbinden des externen Stylesheets für das Seitenlayout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Einbinden der Navigationsleiste aus einem externen PHP-Fragment -->
    <?php require_once __DIR__ . '/../_include/navigation.inc.php';?>

    <!-- Hauptcontainer, der den gesamten Seiteninhalt umschließt -->
    <div class="container">
        <br>
        <!-- Überschriftencontainer mit dem Seitentitel -->
        <div class="ueberschrift-container">
            <h1>Gerichte</h1>
        </div>
        <!-- Container für die Tabelle -->
        <div class="tabellen-container">
            <!-- Link zum Formular, um ein neues Gericht anzulegen -->
            <p><a href="create.php">Neues Gericht anlegen</a></p>

            <!-- Tabelle zur Anzeige der Gerichte -->
            <table border="1">
                <thead>
                    <tr>
                        <!-- Tabellenkopf mit den Spaltenüberschriften -->
                        <th>ID</th>
                        <th>Koch</th>
                        <th>Rezept</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteration über alle geladenen Gerichte -->
                    <?php foreach ($alleGerichte as $g): ?>
                    <tr>
                        <!-- Anzeige der Gericht-ID -->
                        <td><?php echo htmlspecialchars($g['gerichtId']); ?></td>
                        
                        <!-- Anzeige des zugehörigen Kochs -->
                        <td>
                            <?php
                                // Die Methode getKochNameById() ruft den Namen des Kochs anhand der kochId ab.
                                $kochName = $gerichtObj->getKochNameById($g['kochId']);
                                echo htmlspecialchars($kochName);
                            ?>
                        </td>
                        
                        <!-- Anzeige des zugehörigen Rezepts -->
                        <td>
                            <?php
                                // Die Methode getRezeptNameById() ruft den Namen des Rezepts anhand der rezeptId ab.
                                $rezeptName = $gerichtObj->getRezeptNameById($g['rezeptId']);
                                echo htmlspecialchars($rezeptName);
                            ?>
                        </td>
                        
                        <!-- Aktionen: Link zum Bearbeiten des Gerichts -->
                        <td>
                            <a href="edit.php?gerichtId=<?php echo $g['gerichtId']; ?>">Bearbeiten</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- Ende des Tabellencontainers -->
    </div> <!-- Ende des Hauptcontainers -->
</body>
</html>
