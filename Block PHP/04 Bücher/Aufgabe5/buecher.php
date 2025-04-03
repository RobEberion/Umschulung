<?php
// XML-Datei laden
$xml = simplexml_load_file('buecher.xml') or die('Fehler beim Laden der XML-Datei.');

// Array zur Speicherung der Bücher
$buecher = [];

// Über alle <buch>-Elemente iterieren und Daten ins Array schreiben
foreach ($xml->buch as $buch) {
    // Wir konvertieren Werte in passende Datentypen
    $buecher[] = [
        'titel'  => (string) $buch->titel,
        'autor'  => (string) $buch->autor,
        'preis'  => (float)  $buch->preis,
        'jahr'   => (int)    $buch->veroeffentlichungsjahr
    ];
}
