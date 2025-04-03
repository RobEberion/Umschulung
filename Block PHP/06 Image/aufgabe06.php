<?php
// Originalbild laden
$imagePath = 'bildchen2.jpg';
$image = imagecreatefromjpeg($imagePath);

// Originalgröße abrufen
$origWidth = imagesx($image);
$origHeight = imagesy($image);

// Neue Größe
$newWidth = $origWidth * 2;
$newHeight = $origHeight * 2;

// Neues Bild erstellen
$resizedImage = imagecreatetruecolor($newWidth, $newHeight);

// Bild skalieren
imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

// Header setzen, um das Bild als JPEG im Browser auszugeben
header('Content-Type: image/jpeg');

// Bild im Browser ausgeben
imagejpeg($resizedImage);

// Bild speichern
imagejpeg($resizedImage, 'bildchen2_vergroessert.jpg');

// Speicher freigeben
imagedestroy($image);
imagedestroy($resizedImage);
?>