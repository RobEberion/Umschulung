<?php
// Header setzen, um das Bild als JPEG auszugeben
header("Content-Type: image/jpeg");

// Bild laden
$bild = imagecreatefromjpeg("bildchen.jpg");

// In Graustufen umwandeln
imagefilter($bild, IMG_FILTER_GRAYSCALE);

// Bild als JPEG ausgeben
imagejpeg($bild);

// Speicher freigeben
imagedestroy($bild);
?>