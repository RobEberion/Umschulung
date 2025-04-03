<?php
// Den Content-Type-Header auf JPEG setzen
header('Content-Type: image/jpeg');

// Hintergrund- und Overlay-Bilder laden
$hintergrund = imagecreatefromjpeg('bildchen.jpg');
$overlay = imagecreatefrompng('bildchen2.png');

// Breite und Höhe des Hintergrund- und Overlay-Bildes ermitteln
$hintergrund_width  = imagesx($hintergrund);
$hintergrund_height = imagesy($hintergrund);
$overlay_width      = imagesx($overlay);
$overlay_height     = imagesy($overlay);

// Overlaybild zentrieren
$overlay_x = ($hintergrund_width - $overlay_width) / 2;
$overlay_y = ($hintergrund_height - $overlay_height) / 2;

// Transparenz (0 = komplett transparent, 100 = kein Effekt)
$transparency = 50;

// Overlay auf das Hintergrundbild übertragen
imagecopymerge($hintergrund, $overlay, $overlay_x, $overlay_y, 0, 0, $overlay_width, $overlay_height, $transparency);

// Das fertige Bild ausgeben
imagejpeg($hintergrund);

// Speicher freigeben
imagedestroy($hintergrund);
imagedestroy($overlay);
?>

