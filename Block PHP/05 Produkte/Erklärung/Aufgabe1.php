<?php
// Erstelle ein neues XMLReader-Objekt
$reader = new XMLReader();

// Öffne die Datei produkte.xml
$reader->open('produkte.xml');

// HTML-Tabelle beginnen
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Name</th><th>Preis</th></tr>';

// Durch die XML-Struktur iterieren
while ($reader->read()) {
    // Prüfen, ob wir auf ein <produkt>-Start-Element treffen
    if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'produkt') {
        
        // Variablen für das aktuelle Produkt vorbereiten
        $produktName  = '';
        $produktPreis = '';
        
        // Jetzt die untergeordneten Knoten von <produkt> lesen
        while ($reader->read()) {
            // Wenn ein Start-Element gefunden wird, merken wir uns den Elementnamen
            if ($reader->nodeType === XMLReader::ELEMENT) {
                $currentElement = $reader->name;
            }
            // Wenn ein Textknoten gefunden wird, prüfen wir, zu welchem Element er gehört
            elseif ($reader->nodeType === XMLReader::TEXT) {
                switch ($currentElement) {
                    case 'name':
                        $produktName = $reader->value;
                        break;
                    case 'preis':
                        $produktPreis = $reader->value;
                        break;
                }
            }
            // Wenn wir das Ende des Elements <produkt> erreicht haben, springen wir raus
            elseif ($reader->nodeType === XMLReader::END_ELEMENT && $reader->name === 'produkt') {
                break;
            }
        }
        
        // Das gelesene Produkt in der Tabelle ausgeben
        echo '<tr>';
        echo '<td>' . htmlspecialchars($produktName) . '</td>';
        echo '<td>' . htmlspecialchars($produktPreis) . '</td>';
        echo '</tr>';
    }
}

// HTML-Tabelle abschließen
echo '</table>';

// Datei schließen
$reader->close();
?>

/*
SCHRITT-FÜR-SCHRITT-ERKLÄRUNG

1. $reader = new XMLReader();
   - Ein neues XMLReader-Objekt wird erzeugt. Damit können wir das XML-Dokument schrittweise lesen.

2. $reader->open('produkte.xml');
   - Öffnet die Datei produkte.xml und bereitet sie für das Lesen vor.

3. HTML-Tabelle beginnen:
   echo '<table border="1" cellpadding="5" cellspacing="0">'; ...
   - Wir starten eine einfache HTML-Tabelle mit zwei Spalten: "Name" und "Preis".

4. while ($reader->read()) { ... }
   - Diese Schleife liest den nächsten Knoten (Element, Text, End-Element etc.) des XML-Dokuments.

5. if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'produkt') { ... }
   - Prüft, ob das gelesene Element ein Start-Element namens <produkt> ist.

6. $produktName und $produktPreis werden vorbereitet:
   - Hier legen wir die Variablen für die Produktdaten an, um sie später zu füllen.

7. Innere Schleife while ($reader->read()) { ... }:
   - Liest nun alle Knoten innerhalb des gefundenen <produkt>-Elements.

8. if ($reader->nodeType === XMLReader::ELEMENT) { ... }
   - Wenn ein Start-Element (z.B. <name> oder <preis>) erkannt wird, merken wir uns den Elementnamen in $currentElement.

9. elseif ($reader->nodeType === XMLReader::TEXT) { ... }
   - Liest den Text innerhalb des Elements aus und speichert ihn, je nach Elementname, in $produktName oder $produktPreis.

10. elseif ($reader->nodeType === XMLReader::END_ELEMENT && $reader->name === 'produkt') { ... }
    - Sobald das End-Element </produkt> erreicht ist, wird die Schleife durch "break" verlassen.

11. Ausgabe der Produktdaten:
    echo '<tr><td>' . htmlspecialchars($produktName) . '</td>...</tr>';
    - Erstellt eine Tabellenzeile für das gelesene Produkt mit Name und Preis.

12. Nach Beendigung der äußeren Schleife wird die Tabelle geschlossen und der XMLReader geschlossen:
    echo '</table>';
    $reader->close();

Auf diese Weise werden alle <produkt>-Elemente in der XML-Datei eingelesen und in einer HTML-Tabelle angezeigt.
*/
