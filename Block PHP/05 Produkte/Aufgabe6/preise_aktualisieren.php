<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1) Pfade definieren
$quelleDatei   = __DIR__ . '/produkte.xml';
$zielDateiTemp = __DIR__ . '/produkte_temp.xml';

// Prüfen, ob produkte.xml vorhanden ist
if (!file_exists($quelleDatei)) {
    die('Fehler: Die Datei produkte.xml wurde nicht gefunden.');
}

// 2) XMLReader öffnen zum Lesen
$reader = new XMLReader();
if (!$reader->open($quelleDatei)) {
    die('Fehler: Konnte die Datei produkte.xml nicht öffnen.');
}

// 3) XMLWriter vorbereiten
$writer = new XMLWriter();
$writer->openURI($zielDateiTemp);
$writer->startDocument('1.0', 'UTF-8');
// Für eine schön eingerückte Ausgabe
$writer->setIndent(true);

// Variable, um zu wissen, in welchem Element wir uns befinden
$currentElement = '';

// 4) Schleife: Knoten der Originaldatei einlesen und in die Zieldatei schreiben
while ($reader->read()) {
    switch ($reader->nodeType) {
        case XMLReader::ELEMENT:
            // Wir haben ein Start-Tag, z. B. <produkt>, <name>, <preis>
            $currentElement = $reader->name;
            
            // Neues Start-Element im Writer
            $writer->startElement($reader->name);
            
            // Falls das Element Attribute hat, werden sie kopiert
            if ($reader->hasAttributes) {
                while ($reader->moveToNextAttribute()) {
                    $writer->writeAttribute($reader->name, $reader->value);
                }
                $reader->moveToElement(); 
            }
            break;
        
        case XMLReader::TEXT:
        case XMLReader::CDATA:
            // Textinhalt. Handelt es sich um den <preis>? Dann erhöhen wir ihn um 10 %
            if ($currentElement === 'preis') {
                $alterPreis = floatval($reader->value);
                $neuerPreis = $alterPreis * 1.10; // 10 % Aufschlag
                
                // Optional: Runden/Formatieren, z. B. 2 Nachkommastellen
                $neuerPreis = number_format($neuerPreis, 2, '.', '');
                
                $writer->text($neuerPreis);
            } else {
                // Alle anderen Texte unverändert durchreichen
                $writer->text($reader->value);
            }
            break;
        
        case XMLReader::END_ELEMENT:
            // End-Tag schreiben, z. B. </produkt>, </name>, </preis>
            $writer->endElement();
            break;
        
        case XMLReader::SIGNIFICANT_WHITESPACE:
        case XMLReader::WHITESPACE:
            // Whitespace/Zeilenvorschübe bei Bedarf durchreichen
            // (optional, hier ebenfalls übernehmen)
            $writer->text($reader->value);
            break;
        
        default:
            // Kommentare, DTD etc. kann man bei Bedarf behandeln/ignorieren
            break;
    }
}

// 5) Schließen von Reader und Writer
$reader->close();
$writer->endDocument();
$writer->flush();

// 6) Alte Datei durch die neue ersetzen
rename($zielDateiTemp, $quelleDatei);

echo '<p>Preise wurden in produkte.xml um 10% erhöht.</p>';
