<?php
// 1. XML-Datei laden
$xml = simplexml_load_file('buecher.xml') or die('Fehler beim Laden der XML-Datei.');

// 2. Über alle <titel>-Elemente iterieren 
//    (indem wir zuerst alle <buch>-Elemente durchgehen)
foreach ($xml->buch as $buch) {
    // Hier greifen wir direkt auf das <titel>-Element zu
    $titelElement = $buch->titel;
    
    // Prüfen, ob das lang-Attribut "de" ist (optional, nur wenn du sicher gehen willst, 
    // dass du wirklich nur "de" änderst)
    if ((string)$titelElement['lang'] === 'de') {
        // Attribut auf "en" ändern
        $titelElement['lang'] = 'en';
    }
}

// 3. Das veränderte XML in einer neuen Datei speichern
$xml->asXML('buecher_en.xml');

echo "Die Sprache aller Titel wurde erfolgreich auf 'en' geändert und in buecher_en.xml gespeichert.";

