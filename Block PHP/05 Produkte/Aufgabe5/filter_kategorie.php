<?php
// Für Debug/Fehlermeldungen – in Produktionsumgebung ggf. ausschalten
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1) Gesuchte Kategorie – kann auch dynamisch (z.B. per $_GET['kat']) gesetzt werden.
$gesuchteKategorie = 'Elektronik';  

// 2) Pfad zur XML-Datei ermitteln
$xmlDatei = __DIR__ . '/produkte.xml';

// Prüfen, ob produkte.xml existiert
if (!file_exists($xmlDatei)) {
    die('Fehler: Die Datei ' . $xmlDatei . ' wurde nicht gefunden.');
}

// 3) XMLReader erstellen
$reader = new XMLReader();

// Versuchen, die Datei zu öffnen
if (!$reader->open($xmlDatei)) {
    die('Fehler: Konnte ' . $xmlDatei . ' nicht öffnen.');
}

// HTML-Ausgabe vorbereiten
echo '<h1>Produkte in der Kategorie: ' . htmlspecialchars($gesuchteKategorie) . '</h1>';
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Name</th><th>Kategorie</th><th>Preis</th></tr>';

// Lokale Variablen für Produkt-Daten
$aktuellerName     = '';
$aktuelleKategorie = '';
$aktuellerPreis    = '';
$currentTag        = '';

// 4) XML-Knoten nacheinander lesen
while ($reader->read()) {
    // Ist das ein <produkt>-Start-Element?
    if ($reader->nodeType === XMLReader::ELEMENT && $reader->name === 'produkt') {
        
        // Zurücksetzen für das neue Produkt
        $aktuellerName     = '';
        $aktuelleKategorie = '';
        $aktuellerPreis    = '';
        $currentTag        = '';
        
        // Solange wir nicht am Ende von </produkt> sind, Knoten lesen
        while ($reader->read()) {
            // Start-Element?
            if ($reader->nodeType === XMLReader::ELEMENT) {
                $currentTag = $reader->name;
            } 
            // Text-Knoten?
            elseif ($reader->nodeType === XMLReader::TEXT) {
                switch ($currentTag) {
                    case 'name':
                        $aktuellerName = $reader->value;
                        break;
                    case 'kategorie':
                        $aktuelleKategorie = $reader->value;
                        break;
                    case 'preis':
                        $aktuellerPreis = $reader->value;
                        break;
                }
            }
            // Ende von </produkt>?
            elseif ($reader->nodeType === XMLReader::END_ELEMENT && $reader->name === 'produkt') {
                break;
            }
        }
        
        // 5) Filter: Nur Produkte ausgeben, deren Kategorie der gesuchten entspricht
        if (strtolower($aktuelleKategorie) === strtolower($gesuchteKategorie)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($aktuellerName) . '</td>';
            echo '<td>' . htmlspecialchars($aktuelleKategorie) . '</td>';
            echo '<td>' . htmlspecialchars($aktuellerPreis) . '</td>';
            echo '</tr>';
        }
    }
}

// Tabelle schließen
echo '</table>';

// XMLReader schließen
$reader->close();
?>
