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