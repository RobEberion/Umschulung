<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Dozenten ausgeben</title>
<?php
    require_once("dozenten.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<h1>Dozenten</h1>
<div class="ausgabe">
<?php
    $dozent = new dozent();
    $dozent->lesenAlleDaten();
?>
</div>
<p><a class="button" href="dbearbeiten.php">Neuen Dozenten anlegen</a></p>
</body>
</html>