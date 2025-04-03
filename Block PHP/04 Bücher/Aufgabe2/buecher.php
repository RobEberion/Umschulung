<?php
// Pfad zur XML-Datei anpassen
$xmlDatei = 'buecher.xml';

// XML-Datei laden
$xml = simplexml_load_file($xmlDatei) or die('Fehler beim Laden der XML-Datei.');

// Die gesuchte Kategorie
$gesuchteKategorie = 'Romane';

// Über alle <buch>-Elemente iterieren
foreach ($xml->buch as $buch) {
    // Attribut "kategorie" abfragen
    $kategorie = (string)$buch['kategorie'];
    
    // Prüfen, ob es sich um die gewünschte Kategorie handelt
    if ($kategorie === $gesuchteKategorie) {
        // Titel, Autor und Preis ausgeben
        echo 'Titel: ' . $buch->titel . '<br>';
        echo 'Autor: ' . $buch->autor . '<br>';
        echo 'Preis: ' . $buch->preis . '<br><br>';
    }
}
?>
