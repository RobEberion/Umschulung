<?php

// Pfad zur Originaldatei und zur temporären Zieldatei
$quelleDatei    = 'produkte.xml';
$zielDateiTemp  = 'produkte_temp.xml';

// Neues Produkt, das hinzugefügt werden soll (z.B. aus einem Formular)
$neuesProduktName  = 'Kirsche';
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
?>


/*
SCHRITT-FÜR-SCHRITT-ERKLÄRUNG DES CODES:

1) Variablen für Dateipfade und neues Produkt:
   - $quelleDatei und $zielDateiTemp: Pfade zur Originaldatei und zur temporären Zieldatei.
   - $neuesProduktName und $neuesProduktPreis: Name und Preis des neuen Produkts.

2) XMLReader vorbereiten:
   - Ein neues XMLReader-Objekt wird erstellt und mit $reader->open($quelleDatei) wird die vorhandene XML-Datei geladen.

3) XMLWriter vorbereiten:
   - Ein neues XMLWriter-Objekt wird erstellt und auf die temporäre Zieldatei (produkte_temp.xml) gesetzt. 
   - Mit startDocument() wird die XML-Deklaration geschrieben. 
   - setIndent(true) sorgt für eingerückte, lesbare XML-Ausgabe.

4) while ($reader->read()):
   - Der XMLReader liest Knoten für Knoten aus der Quelldatei. 
   - In jedem Schleifendurchlauf prüft ein switch($reader->nodeType) den Knotentyp:
     a) ELEMENT: Wir starten im Writer ein neues Element mit dem gleichen Namen. 
        Falls das Element Attribute hat, kopieren wir diese ebenfalls. 
     b) TEXT/CDATA: Wenn Text vorhanden ist, übernehmen wir ihn in den Writer. 
     c) END_ELEMENT: Sobald das Ende eines Elements erreicht ist, wird es im Writer geschlossen. 
        - Speziell wenn das End-Element <produkte> gefunden wird, fügen wir vor diesem End-Tag 
          unser neues <produkt> ein.
     d) SIGNIFICANT_WHITESPACE / WHITESPACE: Optionales Durchreichen von Leerzeichen. 
     e) default: Andere Knotentypen (z.B. Kommentare) werden ignoriert oder bei Bedarf behandelt.

5) Schließen von Reader und Writer:
   - Nach Ende der Schleife wird $reader->close() aufgerufen, 
     dann endDocument() und flush() beim Writer, um die Ausgabe abzuschließen.

6) Austausch der temporären Datei:
   - rename($zielDateiTemp, $quelleDatei): Die ursprüngliche XML-Datei wird durch die 
     neue, aktualisierte Version ersetzt.

7) Ausgabe:
   - Zum Abschluss wird eine kurze Meldung ausgegeben, dass das neue Produkt hinzugefügt wurde.
*/
