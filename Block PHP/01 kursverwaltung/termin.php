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
<div class="shadow-container">
    <h1>Termine</h1>
    <div class="ausgabe">
    <?php
        $termin = new termin();
        $termin -> lesenAlleDaten();
    ?>
    </div>
</div>
<p><a class="button" href="terminbearbeiten.php">Neuen Termin anlegen</a></p>
</body>
</html>