<?php
// Für Testzwecke: Meldungen anzeigen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Prüfen, ob das Formular ein Bild geschickt hat
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    
    // Dateiinformationen
    $tmpName   = $_FILES['image']['tmp_name'];
    $origName  = basename($_FILES['image']['name']);
    $uploadDir = __DIR__ . '/uploads'; 
    // Erstelle den Ordner, falls nicht vorhanden und setze ggf. Schreibrechte
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $targetPath = $uploadDir . '/' . $origName;
    
    // MIME-Type prüfen (nur JPEG oder TIFF erlauben)
    $finfo    = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);
    
    $allowedTypes = ['image/jpeg', 'image/tiff'];
    if (!in_array($mimeType, $allowedTypes, true)) {
        die('Fehler: Nur JPEG- oder TIFF-Bilder sind erlaubt.');
    }
    
    // Datei vom temporären Verzeichnis in den Upload-Ordner verschieben
    if (!move_uploaded_file($tmpName, $targetPath)) {
        die('Fehler beim Speichern des Bildes.');
    }
    
    echo '<h2>Bild erfolgreich hochgeladen!</h2>';
    echo '<p>Dateiname: ' . htmlspecialchars($origName) . '</p>';
    echo '<img src="uploads/' . htmlspecialchars($origName) . '" style="max-width:300px;" alt="Hochgeladenes Bild">';
    
    // EXIF-Daten auslesen
    $exifData = @exif_read_data($targetPath, 0, true);
    if ($exifData === false) {
        echo '<p><strong>Keine EXIF-Daten verfügbar oder nicht unterstütztes Format.</strong></p>';
        exit;
    }
    
    // --------------------------------------------------------------------
    // 3. EXIF-Daten in eine XML-Datei schreiben
    // --------------------------------------------------------------------
    
    // Neuer Dateiname (z. B. in demselben Ordner)
    $xmlDatei = __DIR__ . '/exif_data.xml';
    
    // XMLWriter initialisieren
    $writer = new XMLWriter();
    // Datei öffnen, in der die EXIF-Daten gespeichert werden
    $writer->openURI($xmlDatei);
    
    // XML-Deklaration
    $writer->startDocument('1.0', 'UTF-8');
    // Für lesbare Einrückung
    $writer->setIndent(true);
    
    // Wurzel-Element <exif>
    $writer->startElement('exif');
    
    // Durch die EXIF-Daten iterieren
    foreach ($exifData as $sectionName => $section) {
        // Korrigierter Abschnittsname, falls numerisch oder nicht buchstabenstart
        if (!is_string($sectionName) || is_numeric($sectionName) || !ctype_alpha($sectionName[0])) {
            $sectionNameSafe = 'section_' . $sectionName;
        } else {
            $sectionNameSafe = $sectionName;
        }

        $writer->startElement($sectionNameSafe);

        if (is_array($section)) {
            // Einzelne Tags dieser Sektion durchgehen
            foreach ($section as $tag => $value) {
                // Ebenfalls korrigieren, wenn $tag numerisch ist (oder nicht mit Buchstabe beginnt)
                if (!is_string($tag) || is_numeric($tag) || !ctype_alpha($tag[0])) {
                    $tagSafe = 'tag_' . $tag;
                } else {
                    $tagSafe = $tag;
                }
                
                $writer->startElement($tagSafe);
                // Falls $value kein String ist (z. B. Array), in einen lesbaren String wandeln
                $writer->text(print_r($value, true));
                $writer->endElement(); // </tagSafe>
            }
        }
        
        $writer->endElement(); // </sectionNameSafe>
    }
    
    $writer->endElement(); // </exif>
    $writer->endDocument();
    $writer->flush();
    
    echo '<p><strong>EXIF-Daten erfolgreich in exif_data.xml gespeichert!</strong></p>';
    echo '<p><a href="exif_data.xml" target="_blank">exif_data.xml ansehen</a></p>';
    
} else {
    // Kein valides Bild hochgeladen
    echo 'Fehler: Bitte wähle ein gültiges Bild (JPEG/TIFF) aus.';
}
?>

/*
SCHRITT-FÜR-SCHRITT-ERKLÄRUNG DES CODES:

1) Fehleranzeige aktivieren:
   - Mit error_reporting(E_ALL) und ini_set('display_errors', 1) werden alle Fehler angezeigt.
     Das ist hilfreich in Entwicklungs- und Testumgebungen.

2) Überprüfung des hochgeladenen Bildes:
   - if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) prüft, 
     ob tatsächlich eine Datei hochgeladen wurde und kein Fehler aufgetreten ist.

3) Dateiinformationen und Verzeichnis:
   - $tmpName, $origName, $uploadDir: Bestimmen Pfade und Namen der Datei.
   - mkdir($uploadDir, 0777, true) erstellt den Upload-Ordner, falls er nicht existiert.

4) MIME-Type prüfen:
   - Über finfo_open und finfo_file wird der MIME Type ermittelt (z. B. image/jpeg).
   - Mit in_array wird geprüft, ob dieser MIME Type in den erlaubten Formaten (JPEG/TIFF) enthalten ist.

5) Hochladen und Verschieben der Datei:
   - move_uploaded_file verschiebt die Datei vom temporären Speicherort in das Upload-Verzeichnis.
   - Bei Fehlern wird das Skript abgebrochen.

6) Bildausgabe:
   - Gibt eine Bestätigung aus und zeigt das hochgeladene Bild in einer max. Breite von 300px an.

7) EXIF-Daten einlesen:
   - @exif_read_data liest die EXIF-Daten des Bildes aus, falls vorhanden.
   - Tritt ein Fehler auf oder ist kein EXIF enthalten, wird eine entsprechende Meldung ausgegeben.

8) EXIF-Daten in XML-Datei speichern:
   - Ein XMLWriter-Objekt wird erstellt, um die EXIF-Daten in exif_data.xml zu schreiben.
   - startDocument() legt XML-Version und Zeichensatz fest, setIndent(true) sorgt für 
     übersichtliches Einrücken.
   - Im Element <exif> werden die einzelnen EXIF-Sektionen und Tags angelegt. Dabei werden ggf. 
     Abschnitts- und Tag-Namen angepasst, falls sie nicht den XML-Namensregeln entsprechen (z. B. 
     ersetzen numerische Namen durch "section_123").
   - Mit writer->text(print_r($value, true)) wird der Wert als String geschrieben, auch wenn es 
     sich um ein Array handeln könnte.
   - Anschließend wird das Dokument beendet und gespeichert (flush).

9) Abschließende Meldung:
   - Gibt an, dass die EXIF-Daten erfolgreich gespeichert wurden, und bietet einen Link zur
     exif_data.xml.
   - Wenn kein Bild hochgeladen wurde, wird eine Fehlermeldung ausgegeben.
*/
