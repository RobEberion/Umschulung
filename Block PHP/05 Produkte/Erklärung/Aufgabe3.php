<?php
// Sicherstellen, dass die Fehlermeldungen für Tests sichtbar sind
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Prüfen, ob ein Bild hochgeladen wurde
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

    // Temporäre Datei und Zielpfad definieren
    $tmpName = $_FILES['image']['tmp_name'];
    $origName = basename($_FILES['image']['name']);
    $uploadDir = __DIR__ . '/uploads'; // Ordner muss existieren oder erstellt werden
    $targetPath = $uploadDir . '/' . $origName;

    // Optional: Dateityp prüfen (z.B. nur JPEG zulassen)
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($fileInfo, $tmpName);
    finfo_close($fileInfo);

    // Erlaubte Formate: JPEG und TIFF
    $allowedTypes = ['image/jpeg', 'image/tiff'];

    if (!in_array($mimeType, $allowedTypes, true)) {
        die('Fehler: Nur JPEG- oder TIFF-Bilder sind erlaubt.');
    }

    // Datei verschieben
    if (!move_uploaded_file($tmpName, $targetPath)) {
        die('Fehler beim Speichern der Datei auf dem Server.');
    }

    echo '<h2>Bild wurde erfolgreich hochgeladen!</h2>';
    echo '<p>Gespeichert unter: ' . htmlspecialchars($targetPath) . '</p>';
    echo '<img src="uploads/' . htmlspecialchars($origName) . '" alt="Hochgeladenes Bild" style="max-width:300px;">';

    // EXIF-Daten auslesen
    // WICHTIG: Im php.ini muss extension=exif aktiviert sein.
    $exifData = @exif_read_data($targetPath, 0, true);

    if ($exifData === false) {
        echo '<p><strong>Keine EXIF-Daten verfügbar oder Datei nicht im passenden Format (JPEG/TIFF).</strong></p>';
    } else {
        echo '<h3>EXIF-Daten:</h3>';
        echo '<table border="1" cellpadding="5">';

        // Durch alle EXIF-Sektionen iterieren
        foreach ($exifData as $key => $section) {
            if (is_array($section)) {
                foreach ($section as $name => $val) {
                    echo '<tr><td>' . htmlspecialchars($key . '.' . $name) . '</td><td>' . htmlspecialchars($val) . '</td></tr>';
                }
            }
        }

        echo '</table>';
    }

} else {
    // Entweder kein Bild hochgeladen oder Fehler beim Upload
    echo 'Kein gültiges Bild hochgeladen oder Upload-Fehler aufgetreten.';
}
?>

/*
SCHRITT-FÜR-SCHRITT-ERKLÄRUNG DES CODES:

1) Fehleranzeige aktivieren:
   - error_reporting(E_ALL) und ini_set('display_errors', 1) sorgen dafür, dass alle möglichen
     Fehlermeldungen angezeigt werden. Dies ist bei der Entwicklung oder Fehlersuche hilfreich.

2) Überprüfen, ob ein Bild hochgeladen wurde:
   - if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK)
     stellt sicher, dass tatsächlich eine Datei unter dem Schlüssel 'image' hochgeladen wurde
     und kein Fehler beim Upload aufgetreten ist.

3) Temporäre Datei und Zielpfad:
   - $tmpName und $origName sind die Pfade bzw. der ursprüngliche Dateiname des hochgeladenen Bildes.
   - $uploadDir und $targetPath legen fest, wohin die hochgeladene Datei verschoben wird
     (z.B. in einen Ordner 'uploads' im selben Verzeichnis).

4) Optional: Datei-Typ (MIME Type) prüfen:
   - Mit finfo_open und finfo_file wird der MIME Type des hochgeladenen Bildes ermittelt.
   - In $allowedTypes sind die erlaubten Typen (JPEG/TIFF) definiert. Wird ein anderes Format gefunden,
     bricht das Skript mit einer Fehlermeldung ab.

5) Datei verschieben:
   - move_uploaded_file($tmpName, $targetPath) verschiebt die Datei vom temporären Speicherort
     in den definierten Zielpfad. Scheitert dies, wird eine Fehlermeldung ausgegeben.

6) Erfolgsmeldung und Anzeige des hochgeladenen Bildes:
   - Gibt eine Meldung aus, zeigt, wo das Bild gespeichert wurde, und gibt eine Vorschau des Bildes
     mit <img src="..."> aus.

7) EXIF-Daten auslesen:
   - exif_read_data($targetPath) wird verwendet, um mögliche EXIF-Daten eines JPEG/TIFF-Bildes
     auszulesen. 
   - exif_read_data kann fehlschlagen, wenn die Bilddatei kein gültiges Format hat oder wenn die
     EXIF-Erweiterung in PHP nicht aktiviert ist.
   - Sind Daten vorhanden, werden diese in einer Tabelle ausgegeben. Es wird durch alle EXIF-Sektionen
     (z.B. EXIF, FILE, COMPUTED) iteriert, und innerhalb jeder Sektion werden die Schlüssel-Werte-Paare
     ausgegeben.

8) Ausgabe einer Fehlermeldung, wenn kein Bild hochgeladen wurde:
   - Fällt die Bedingung für den Upload weg oder tritt ein Fehler auf, wird eine einfache Nachricht
     ausgegeben, dass kein gültiges Bild hochgeladen wurde.
*/
