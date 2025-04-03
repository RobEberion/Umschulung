<?php
// Bildgröße definieren
$width = 400;
$height = 300;

// Bild erstellen
$image = imagecreatetruecolor($width, $height);

// Farbverlauf von dunkelblau (0, 0, 128) zu hellblau (173, 216, 230)
for ($y = 0; $y < $height; $y++) {
    // Berechnung der interpolierten Farbwerte
    $r = 0;
    $g = (int)(108 * ($y / $height)); // Grün von 0 bis 108
    $b = 128 + (int)((230 - 128) * ($y / $height)); // Blau von 128 bis 230

    // Farbe zuweisen
    $color = imagecolorallocate($image, $r, $g, $b);

    // Linie mit dieser Farbe zeichnen
    imageline($image, 0, $y, $width, $y, $color);
}

// Header setzen, um das Bild als PNG auszugeben
header('Content-Type: image/png');

// Bild ausgeben
imagepng($image);

// Speicher freigeben
imagedestroy($image);
?>

