<?php
// Einbinden der Bestellung-Klasse, die alle CRUD-Operationen für Bestellungen kapselt.
require_once __DIR__ . '/../_classes/Bestellung.php';

// Erzeugen eines neuen Objekts der Klasse Bestellung.
$bestellungObj = new Bestellung();

// Abrufen aller Bestellungen aus der Datenbank.
// Die Methode readAll() liefert ein Array mit allen Bestellungen.
$bestellungen  = $bestellungObj->readAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellungen - Übersicht</title>
    <!-- Einbinden der externen CSS-Datei für das Styling -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Einbinden der Navigationsleiste (externes PHP-Fragment) -->
    <?php require_once __DIR__ . '/../_include/navigation.inc.php'; ?>

    <!-- Hauptcontainer für den Seiteninhalt -->
    <div class="container">
        <br>
        <!-- Überschriftencontainer -->
        <div class="ueberschrift-container">
            <h1>Bestellungen</h1>
        </div>
        <!-- Container für die Tabelle -->
        <div class="tabellen-container">
            <!-- Link zum Formular, um eine neue Bestellung anzulegen -->
            <p><a href="create.php">Neue Bestellung anlegen</a></p>

            <!-- Tabelle zur Anzeige der Bestellungen -->
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kunde</th>
                        <th>Gericht (Koch)</th>
                        <th>Anzahl</th>
                        <th>Preis</th>
                        <th>Gesamtpreis</th>
                        <th>Zahlungsart</th>
                        <th>Zeitpunkt</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Schleife über alle Bestellungen -->
                    <?php foreach ($bestellungen as $b): ?>
                        <tr>
                            <!-- Anzeige der Bestellungs-ID -->
                            <td><?php echo htmlspecialchars($b['bestellungId']); ?></td>
                            
                            <!-- Anzeige des Kundennamens -->
                            <td>
                                <?php
                                    // Ruft den Kundennamen anhand der kundenId ab.
                                    $kundeName = $bestellungObj->getKundeNameById($b['kundeId']);
                                    echo htmlspecialchars($kundeName);
                                ?>
                            </td>
                            
                            <!-- Anzeige des Gerichts inkl. Rezeptname und KochNachname -->
                            <td>
                                <?php
                                    // Ruft die kombinierte Information "Rezept (Koch)" anhand der gerichtId ab.
                                    $anzeige = $bestellungObj->getGerichtMitKoch($b['gerichtId']);
                                    echo htmlspecialchars($anzeige);
                                ?>
                            </td>
                            
                            <!-- Anzeige der Anzahl -->
                            <td><?php echo htmlspecialchars($b['anzahl']); ?></td>
                            
                            <!-- Anzeige des Einzelpreises -->
                            <td><?php echo htmlspecialchars($b['preis']); ?></td>
                            
                            <!-- Berechnung und Anzeige des Gesamtpreises (Anzahl * Preis) -->
                            <td>
                                <?php 
                                    $gesamtpreis = $b['anzahl'] * $b['preis'];
                                    // Formatierung auf 2 Nachkommastellen
                                    echo htmlspecialchars(number_format($gesamtpreis, 2));
                                ?>
                            </td>
                            
                            <!-- Anzeige der Zahlungsart -->
                            <td><?php echo htmlspecialchars($b['zahlungsart']); ?></td>
                            
                            <!-- Anzeige des Zeitpunkts der Bestellung -->
                            <td><?php echo htmlspecialchars($b['zeitpunkt']); ?></td>
                            
                            <!-- Aktionen: Link zum Bearbeiten der Bestellung -->
                            <td>
                                <a href="edit.php?bestellungId=<?php echo $b['bestellungId']; ?>">Bearbeiten</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- Ende des Tabellencontainers -->
    </div> <!-- Ende des Hauptcontainers -->
</body>
</html>
