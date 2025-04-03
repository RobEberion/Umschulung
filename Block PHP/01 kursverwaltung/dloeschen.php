<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Dozent löschen</title>
<?php
    require_once("dozenten.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>

<?php
    if(isset($_GET["doznr"])) {
    $dozent = new dozent();
    $dozent -> loeschen($_GET["doznr"]);
    echo "<h2>Dozent gelöscht</h2>";
    }
    header("refresh:3; url=dozenten.php");
?>

</body>
</html>