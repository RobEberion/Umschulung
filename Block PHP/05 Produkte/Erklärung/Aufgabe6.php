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

/*
SCHRITT-FÜR-SCHRITT-ERKLÄRUNG DES CODES:

1) Fehleranzeige:
   - error_reporting(E_ALL) und ini_set('display_errors', 1) lassen alle Fehler ausgeben,
     was bei Entwicklung und Tests nützlich ist.

2) Zu suchende Kategorie und Pfad zur XML-Datei:
   - Die Variable $gesuchteKategorie gibt an, welche Kategorie wir anzeigen wollen (z.B. "Elektronik").
   - $xmlDatei wird auf den Pfad zu produkte.xml gesetzt. Existiert die Datei nicht, bricht das Skript ab.

3) XMLReader erstellen und öffnen:
   - $reader = new XMLReader() erzeugt einen neuen XMLReader.
   - Mit $reader->open($xmlDatei) wird die Datei geöffnet. Kann sie nicht geöffnet werden, folgt ein Abbruch.

4) HTML-Ausgabe und Variablen für Produkt-Daten:
   - Wir beginnen mit dem HTML-Header und einer Tabelle.
   - $aktuellerName, $aktuelleKategorie, $aktuellerPreis und $currentTag sind Hilfsvariablen,
     um während des Lesens die Werte zu speichern.

5) XML Knotenweise lesen (while ($reader->read())):
   - In der Schleife prüfen wir, ob wir auf ein <produkt>-Element stoßen.
   - Wenn ja, wird eine innere while-Schleife genutzt, um die untergeordneten Elemente wie <name>,
     <kategorie> und <preis> auszulesen.
     a) Ist es ein Start-Element (ELEMENT), merkt sich $currentTag den Namen (z.B. "name").
     b) Ist es ein Text-Knoten (TEXT), wird geprüft, welches Element gerade aktiv ist, und die entsprechenden
        Variablen ($aktuellerName, $aktuelleKategorie, $aktuellerPreis) gefüllt.
     c) Wenn wir das End-Element </produkt> erreichen, verlassen wir die innere Schleife.

6) Filtern und Ausgeben:
   - Nur wenn die gelesene Kategorie ($aktuelleKategorie) der gesuchten entspricht (z.B. "Elektronik"),
     wird eine neue Tabellenzeile mit dem Produktnamen, der Kategorie und dem Preis ausgegeben.

7) Abschluss:
   - Nach Ende der äußeren Schleife wird die Tabelle geschlossen.
   - Der XMLReader wird mit $reader->close() geschlossen.
*/
