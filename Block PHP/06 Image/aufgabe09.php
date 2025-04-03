<?php
// 1) Gibt direkt ein PNG-Bild aus
header("Content-Type: image/png");

// 2) Bild erstellen
$breite = 400;
$hoehe  = 300;
$image  = imagecreatetruecolor($breite, $hoehe);

// 3) Farben definieren
$weiss  = imagecolorallocate($image, 255, 255, 255);
$schwarz= imagecolorallocate($image,   0,   0,   0);

// 4) Hintergrund weiß füllen
imagefill($image, 0, 0, $weiss);

// 5) Schrift-Vorgaben
$fontPath = 'arial.ttf';             // Pfad zu Arial.ttf
$fontSize = 20;                      // Schriftgröße
$angle    = 45;                      // Rotation in Grad
$x        = 100;                     // X-Koordinate
$y        = 150;                     // Y-Koordinate (Basislinie der Schrift)

// 6) Text ausgeben
imagettftext($image, $fontSize, $angle, $x, $y, $schwarz, $fontPath, "Rotierter Text");

// 7) Bild ausgeben und Speicher freigeben
imagepng($image);
imagedestroy($image);
?>
