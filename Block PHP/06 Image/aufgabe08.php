<?php
// 1) Header, damit das Ergebnis als PNG ausgegeben wird
header("Content-Type: image/png");

// 2) Bild erstellen
$breite = 400;
$hoehe  = 300;
$image  = imagecreatetruecolor($breite, $hoehe);

// 3) Farben definieren
$weiss   = imagecolorallocate($image, 255, 255, 255);
$schwarz = imagecolorallocate($image,   0,   0,   0);

// 4) Hintergrund auf Weiß setzen
imagefill($image, 0, 0, $weiss);

// 5) Stil für gestrichelte Linie festlegen
//    Array mit Pixel-Farbwerten oder IMG_COLOR_TRANSPARENT.
//    Hier: 4 schwarze Pixel, 4 transparente Pixel usw.
$style = [
    $schwarz, $schwarz, $schwarz, $schwarz, 
    IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT
];
imagesetstyle($image, $style);

// 6) Rechteck mit dem Stil zeichnen
//    Verwendung von IMG_COLOR_STYLED, damit es das Stil-Array nutzt
imagerectangle($image, 50, 50, 350, 250, IMG_COLOR_STYLED);

// 7) Bild ausgeben und Speicher freigeben
imagepng($image);
imagedestroy($image);
?>
