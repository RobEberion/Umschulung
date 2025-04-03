<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Teilnehmer löschen</title>
<?php
    require_once("teilnehmer.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<?php
    if(isset($_GET["tnummer"])) {
		$teilnehmer = new teilnehmer();
		$teilnehmer -> loeschen($_GET["tnummer"]);
		echo "<h2>Teilnehmer gelöscht</h2>";
    }
    header("refresh:3; url=teilnehmer.php");
?>
</body>
</html>