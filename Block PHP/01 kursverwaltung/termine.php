<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Termine ausgeben</title>
<?php
    require_once("termin.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>
<h1>Termine</h1>
<div class="ausgabe">
<?php
    $termin = new termin();
    $termin -> lesenAlleDaten();
?>
</div>
<p><a class="button" href="termbearbeiten.php">Neuen Termin anlegen</a></p>
</body>
</html>