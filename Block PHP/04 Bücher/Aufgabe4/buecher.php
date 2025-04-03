<?php
// 1. XML-Datei laden
$xml = simplexml_load_file('buecher.xml') or die('Fehler beim Laden der XML-Datei.');

// 2. Neuen <buch>-Knoten hinzufügen
//    Dieser Knoten wird automatisch an <katalog> angehängt
$neuesBuch = $xml->addChild('buch');

// 3. Attribut "kategorie" setzen
$neuesBuch->addAttribute('kategorie', 'Fantasy');

// 4. Unterelemente hinzufügen
$neuesBuch->addChild('titel', 'Der Hobbit');
$neuesBuch->addChild('autor', 'J.R.R. Tolkien');
$neuesBuch->addChild('preis', '14.99');
$neuesBuch->addChild('veroeffentlichungsjahr', '1937');

// 5. Änderungen in der (gleichen) XML-Datei speichern
$xml->asXML('buecher.xml');

echo "Das neue Buch wurde erfolgreich hinzugefügt!";
