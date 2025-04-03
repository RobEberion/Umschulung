<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Buchung löschen</title>
<?php
    require_once("buchung.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>

<?php
    if(isset($_GET["bnummer"])) {
    $buchung = new buchung();
    $buchung -> loeschen($_GET["bnummer"]);
    echo "<h2>Buchung gelöscht</h2>";
    }
    header("refresh:3; url=buchung.php");
?>

</body>
</html>