<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Kurse ausgeben</title>
<?php
    require_once("kurs.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>
<h1>Kurse</h1>
<div class="ausgabe">
<?php
    $kurs = new kurs();
    $kurs->lesenAlleDaten();
?>
</div>
<p><a class="button" href="kbearbeiten.php">Neuen Kurs anlegen</a></p>
</body>
</html>