<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Kurs löschen</title>
<?php
    require_once("kurs.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>

<?php
    if(isset($_GET["kursnr"])) {
    $kurs = new kurs();
    $kurs -> loeschen($_GET["kursnr"]);
    echo "<h2>Kurs gelöscht</h2>";
    }
    header("refresh:3; url=kurse.php");
?>

</body>
</html>