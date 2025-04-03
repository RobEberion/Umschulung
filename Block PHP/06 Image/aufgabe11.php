<?php
// Header für PNG-Bild setzen
header('Content-Type: image/png');

// Bildbreite und Bildhöhe festlegen
$width = 400;
$height = 300;

// Ein neues Truecolor-Bild erstellen
$image = imagecreatetruecolor($width, $height);

// Hintergrundfarbe (Weiß)
$white = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);

// Zufällige Farben für Rechteck und Kreis generieren
$rectColor = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
$circleColor = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));

// Rechteck zeichnen (x1, y1, x2, y2)
imagerectangle($image, 50, 50, 350, 150, $rectColor);

// Kreis zeichnen (Mittelpunkt x, y, Durchmesser, Durchmesser)
imagearc($image, 200, 225, 100, 100, 0, 360, $circleColor);
imagefilltoborder($image, 200, 225, $circleColor, $circleColor);

// Bild unter dem Namen test.png speichern
imagepng($image, 'aufgabe11test.png');

// Bild ausgeben
imagepng($image);

// Speicher freigeben
imagedestroy($image);
?>
