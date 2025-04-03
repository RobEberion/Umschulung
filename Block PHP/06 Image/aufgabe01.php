<?php
header("Content-type: image/png");

$bild = imagecreatetruecolor(400, 300);

$weiss = imagecolorallocate($bild, 255,255,255);

imagefilledrectangle($bild, 0, 0, 400, 300, $weiss);

imagepng($bild);

imagedestroy($bild);

?>