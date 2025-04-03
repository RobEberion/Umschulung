<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
?>

/*
SCHRITT-FÜR-SCHRITT-ERKLÄRUNG DES CODES:

1) Fehleranzeige aktivieren:
   - error_reporting(E_ALL) und ini_set('display_errors', 1) sorgen dafür, dass alle
     möglichen PHP-Fehler angezeigt werden. Dies ist bei Entwicklung/Tests hilfreich.

2) Pfad zur XML-Datei:
   - $xmlDatei definiert den Dateinamen "produkte.xml", der im selben Ordner wie das Skript liegt.
   - __DIR__ ist ein PHP-Magic-Constant, die das aktuelle Verzeichnis des Skripts angibt.

3) Existenz der Datei prüfen:
   - Mit file_exists($xmlDatei) wird geprüft, ob die Datei überhaupt vorhanden ist.
   - Fehlt sie, wird das Skript mit die(...) abgebrochen und eine Fehlermeldung ausgegeben.

4) XMLReader erstellen und Datei öffnen:
   - $reader = new XMLReader() erzeugt ein neues Objekt vom Typ XMLReader.
   - Mit $reader->open($xmlDatei) versucht das Skript, die Datei zu öffnen.
   - Bei Misserfolg wird das Skript mit einer Fehlermeldung abgebrochen.

5) Zählvariable initialisieren:
   - $anzahlProdukte = 0 legt eine Variable an, in der wir die Anzahl der <produkt>-Elemente zählen.

6) XML-Datei Knoten für Knoten lesen (while ($reader->read())):
   - Die Schleife liest solange, bis keine weiteren Knoten mehr vorhanden sind.
   - Innerhalb prüfen wir mit if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'produkt'),
     ob es sich um ein Start-Element namens <produkt> handelt.
   - Falls ja, erhöhen wir die Zählvariable mit $anzahlProdukte++.

7) Schließen des Readers:
   - Nach der Schleife wird mit $reader->close() der Reader geschlossen.

8) Ausgabe des Ergebnisses:
   - echo "<p>Die Datei enthält $anzahlProdukte Produkt(e).</p>"; gibt die Anzahl 
     der gefundenen <produkt>-Elemente in einem HTML-Absatz aus.
*/
