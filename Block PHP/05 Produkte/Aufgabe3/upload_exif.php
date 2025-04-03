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
