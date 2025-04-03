<?php

// Pfad zur Originaldatei und zur temporären Zieldatei
$quelleDatei    = 'produkte.xml';
$zielDateiTemp  = 'produkte_temp.xml';

// Neues Produkt, das hinzugefügt werden soll (z.B. aus einem Formular)
$neuesProduktName  = 'Apfel';
$neuesProduktPreis = '2.10';

/**
 * 1) XMLReader öffnen, um die vorhandene Datei einzulesen
 */
$reader = new XMLReader();
$reader->open($quelleDatei);

/**
 * 2) XMLWriter vorbereiten, um in eine temporäre Datei zu schreiben
 */
$writer = new XMLWriter();
$writer->openURI($zielDateiTemp);

// Start-Deklaration (Version und Encoding) setzen
$writer->startDocument('1.0', 'UTF-8');
// Für eine schön eingerückte Ausgabe
$writer->setIndent(true);

// Aktuelle Elemente „durchschleifen“ und kopieren
while ($reader->read()) {
    switch ($reader->nodeType) {
        case XMLReader::ELEMENT:
            // Neues Start-Element im Writer anlegen
            $writer->startElement($reader->name);
            
            // Falls das Element Attribute hat, kopieren wir diese
            if ($reader->hasAttributes) {
                while ($reader->moveToNextAttribute()) {
                    $writer->writeAttribute($reader->name, $reader->value);
                }
                // Zurück zum Element
                $reader->moveToElement();
            }
            break;
        
        case XMLReader::TEXT:
        case XMLReader::CDATA:
            // Text oder CDATA-Inhalt übernehmen
            $writer->text($reader->value);
            break;
        
        case XMLReader::END_ELEMENT:
            // Wenn wir das Ende von <produkte> erreichen, fügen wir hier
            // unser neues Produkt ein, bevor wir das End-Tag schreiben.
            if ($reader->name === 'produkte') {
                // Neues Produkt vor dem End-Tag von <produkte> einfügen
                $writer->startElement('produkt');
                    $writer->writeElement('name', $neuesProduktName);
                    $writer->writeElement('preis', $neuesProduktPreis);
                $writer->endElement(); // </produkt>
            }
            
            // End-Element schreiben
            $writer->endElement();
            break;
        
        case XMLReader::SIGNIFICANT_WHITESPACE:
        case XMLReader::WHITESPACE:
            // Bei Bedarf können Leerzeichen/Zeilenvorschübe ebenfalls durchgereicht werden
            // (unbedingt optional, da bei XML oft irrelevant).
            $writer->text($reader->value);
            break;
        
        default:
            // Andere Knotentypen (Kommentare, DTD etc.) ggf. ignorieren oder behandeln
            break;
    }
}

// Schließen von Reader und Writer
$reader->close();
$writer->endDocument();
$writer->flush();

/**
 * 3) Temporäre Datei gegen Originaldatei austauschen (z. B. durch Rename)
 */
rename($zielDateiTemp, $quelleDatei);

echo "Neues Produkt '$neuesProduktName' wurde hinzugefügt.";
