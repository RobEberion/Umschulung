<?php
// Pfad zur XML-Datei (hier im selben Verzeichnis wie das Skript)
$xmlDatei = __DIR__ . '/produkte.xml';

// Überprüfen, ob die Datei existiert
if (!file_exists($xmlDatei)) {
    die("Fehler: Die Datei $xmlDatei wurde nicht gefunden.");
}

// XMLReader-Objekt erstellen und Datei öffnen
$reader = new XMLReader();
if (!$reader->open($xmlDatei)) {
    die("Fehler: Konnte die Datei $xmlDatei nicht öffnen.");
}

// Zählvariable für <produkt>-Elemente
$anzahlProdukte = 0;

// Durch alle Knoten der XML-Datei iterieren
while ($reader->read()) {
    // Ist das ein ELEMENT-Knoten und heißt er "produkt"?
    if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'produkt') {
        $anzahlProdukte++;
    }
}

// Reader schließen
$reader->close();

// Ergebnis ausgeben
echo "<p>Die Datei enthält $anzahlProdukte Produkt(e).</p>";
