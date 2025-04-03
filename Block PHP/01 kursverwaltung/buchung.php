<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Buchungen ausgeben</title>
<?php
    require_once("buchung.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<h1>Buchungen</h1>
<div class="ausgabe">
<?php
    $buchung = new buchung();
    $buchung -> lesenAlleDaten();
?>
</div>
<p><a class="button" href="bbearbeiten.php">Neue Buchung anlegen</a></p>
</body>
</html>