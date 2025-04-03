<?php
// Einbinden der Rezept-Klasse, welche alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
// für Rezept-Datensätze kapselt. Dadurch erhält man Zugriff auf Methoden wie readAll(), create(), update() usw.
require_once __DIR__ . '/../_classes/Rezept.php';

// Erzeugen eines neuen Objekts der Klasse Rezept.
$rezeptObj = new Rezept();

// Abrufen aller Rezepte aus der Datenbank.
// Die Methode readAll() liefert ein Array, das alle Rezept-Datensätze enthält.
$alleRezepte = $rezeptObj->readAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rezepte Übersicht</title>
    <!-- Einbinden der externen CSS-Datei, die das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Einbinden der Navigationsleiste aus einem externen PHP-Fragment -->
    <?php require_once __DIR__ . '/../_include/navigation.inc.php'; ?>

    <!-- Hauptcontainer für alle Inhalte der Seite -->
    <div class="container">
        <br>
        <!-- Überschriftencontainer, der den Titel der Seite anzeigt -->
        <div class="ueberschrift-container">
            <h1>Rezepte</h1>
        </div>
        <!-- Container für die Tabelle -->
        <div class="tabellen-container">
            <!-- Link zum Formular, um ein neues Rezept anzulegen -->
            <p><a href="create.php">Neues Rezept anlegen</a></p>
        
            <!-- Tabelle zur Anzeige der Rezepte -->
            <table border="1">
                <thead>
                    <tr>
                        <!-- Tabellenkopf mit den Spaltenüberschriften -->
                        <th>RezeptId</th>
                        <th>Rezeptname</th>
                        <th>Dauer (Min)</th>
                        <th>Speiseart</th>
                        <th>Rezeptbeschreibung</th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Iteration über alle Rezepte -->
                    <?php foreach ($alleRezepte as $rezept): ?>
                    <tr>
                        <!-- Absicherung der dynamischen Ausgabe mit htmlspecialchars() -->
                        <td><?php echo htmlspecialchars($rezept['rezeptId']); ?></td>
                        <td><?php echo htmlspecialchars($rezept['rezeptname']); ?></td>
                        <td><?php echo htmlspecialchars($rezept['dauer']); ?></td>
                        <td><?php echo htmlspecialchars($rezept['speiseart']); ?></td>
                        <!-- nl2br() sorgt dafür, dass Zeilenumbrüche in der Rezeptbeschreibung erhalten bleiben -->
                        <td><?php echo nl2br(htmlspecialchars($rezept['rezeptbeschreibung'])); ?></td>
                        <td>
                            <!-- Link zum Bearbeiten des jeweiligen Rezepts -->
                            <a href="edit.php?rezeptId=<?php echo $rezept['rezeptId']; ?>">Bearbeiten</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- Ende des Tabellencontainers -->
    </div> <!-- Ende des Hauptcontainers -->
</body>
</html>
