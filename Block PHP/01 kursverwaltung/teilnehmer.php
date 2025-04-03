<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Teilnehmerliste ausgeben</title>
<?php
    require_once("teilnehmer.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<h1>Teilnehmer</h1>
<div class="ausgabe">
<?php
    $teilnehmer = new teilnehmer();
    $teilnehmer->lesenAlleDaten();
?>
</div>
<p>
	<a class="button" href="tbearbeiten.php">Neuen Teilnehmer anlegen</a> 
	<a class="button" href="tsuchen.php">Teilnehmer suchen</a>
</p>
</body>
</html>