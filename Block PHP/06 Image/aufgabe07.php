<?php
// Header setzen, um das Bild als PNG auszugeben
header(header: "Content-Type: image/png");
 
// Daten für die Balkenhöhen
$daten = [120, 90, 60, 180, 150];
 
// Balken-Parameter
$balkenBreite = 50;
$abstand = 20;
$anzahlBalken = count($daten);
 
// Bildgröße berechnen
$breite = ($anzahlBalken * ($balkenBreite + $abstand)) + $abstand;
$hoehe = 250; // Gesamthöhe des Bildes (inkl. Puffer)
 
// Bild erstellen
$image = imagecreatetruecolor($breite, $hoehe);
 
// Farben definieren
$weiss = imagecolorallocate($image, 255, 255, 255);
$blau = imagecolorallocate($image, 0, 0, 255);
$schwarz = imagecolorallocate($image, 0, 0, 0);
 
// Hintergrund auf Weiß setzen
imagefill($image, 0, 0, $weiss);
 
// Maximalhöhe für Skalierung berechnen
$maxHoehe = max($daten);
$skalierung = ($hoehe - 50) / $maxHoehe; // Höchster Balken wird maximal gezeichnet

// Balken zeichnen
foreach ($daten as $i => $wert) {
    // X-Koordinate: Start-Abstand + (Index * (Balkenbreite + Zwischenraum))
    $x = ($abstand + $i * ($balkenBreite + $abstand));
 
    $balkenHoehe = round($wert * $skalierung);
    // Unten ausrichten, 20 px „Rand“ unten
    $y = ($hoehe - $balkenHoehe - 20);
 
    imagefilledrectangle($image, $x, $y, $x + $balkenBreite, $hoehe - 20, $blau);
 
    // Wert über den Balken
    imagestring($image, 4, $x + 10, $y - 15, $wert, $schwarz);
}

// Bild ausgeben
imagepng($image);
 
// Speicher freigeben
imagedestroy($image);
?>