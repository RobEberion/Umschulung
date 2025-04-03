<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Termin löschen</title>
<?php
    require_once("termin.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>

<?php
    if(isset($_GET["termnr"])) {
    $termin = new termin();
    $termin -> loeschen($_GET["termnr"]);
    echo "<h2>Termin gelöscht</h2>";
    }
    header("refresh:3; url=termin.php");
?>

</body>
</html>