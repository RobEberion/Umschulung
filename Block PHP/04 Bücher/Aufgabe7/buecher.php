<?php
// XML-Datei laden
$xml = simplexml_load_file('buch.xml') or die("Fehler beim Laden der XML-Datei.");

// Alle <buch>-Elemente durchlaufen
foreach ($xml->buch as $buch) {
    // Überprüfung, ob das Attribut 'waehrung' des <preis>-Elements 'Euro' ist
    if ((string)$buch->preis['waehrung'] === 'Euro') {
        echo "Titel: " . $buch->titel . "\n";
        echo "Preis: " . $buch->preis . " " . $buch->preis['waehrung'] . "\n";
        echo "--------------------------\n";
    }
}
?>

