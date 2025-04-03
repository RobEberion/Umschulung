<?php
// Bildgröße definieren
$width = 400;
$height = 300;

// Bild erstellen
$image = imagecreatetruecolor($width, $height);

// Farben definieren
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Hintergrund auf Weiß setzen
imagefill($image, 0, 0, $white);

// Pfad zur Schriftart
$font = 'arial.ttf';

// Text und Position
$text = "Hallo, GD-Bibliothek!";
$fontSize = 20;
$x = 50;
$y = 100;

// Text ins Bild einfügen
imagettftext($image, $fontSize, 0, $x, $y, $black, $font, $text);

// Header setzen, um das Bild als PNG auszugeben
header('Content-Type: image/png');

// Bild ausgeben
imagepng($image);

// Speicher freigeben
imagedestroy($image);
?>
