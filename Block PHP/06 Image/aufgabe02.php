<?php
// Bildgröße definieren
$width = 400;
$height = 300;

// Ein Bild erstellen
$image = imagecreatetruecolor($width, $height);

// Farben definieren
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Hintergrund auf Weiß setzen
imagefill($image, 0, 0, $white);

// Eine schwarze Linie zeichnen von (50, 50) nach (350, 50)
imageline($image, 50, 50, 350, 50, $black);

// Header setzen, um das Bild als PNG auszugeben
header('Content-Type: image/png');

// Bild ausgeben
imagepng($image);

// Speicher freigeben
imagedestroy($image);
?>
