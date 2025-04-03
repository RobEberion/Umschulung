<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Kurs bearbeiten</title>
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
$kurs = new kurs();

if (isset($_POST["mode"])) {
   
      if($_POST["mode"] == "null"){
          $kurs->anlegen($_POST);
      }
     else {
          $kurs->bearbeiten($_POST);
      }
   
   header("refresh:3;url=kurse.php");
 }
else {
    
?>
<div class="ausgabe">
<?php

$tData = array();

if (isset($_GET["kursnr"])) {
    $tData = $kurs->lesenDatensatz($_GET["kursnr"]);
    $kursnr = $_GET["kursnr"];
?>

<form action="kbearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="<?php echo $kursnr; ?>" />
<label for="kursnr">Kursnummer: </label><input type="text" id="kursnr" name="kursnr" value="<?php echo $kursnr; ?>" disabled/><br />
<label for="ressort">Ressort: </label><input type="text" id="ressort" name="ressort" value="<?php echo $tData['ressort']; ?>"/><br />
<label for="titel">Titel: </label><input type="text" id="titel" name="titel" value="<?php echo $tData['titel']; ?>"/><br />
<label for="beschreibung">Beschreibung: </label><input type="text" id="beschreibung" name="beschreibung" value="<?php echo $tData['beschreibung']; ?>"/><br />
<label for="preis">Preis: </label><input type="text" id="preis" name="preis" value="<?php echo $tData['preis']; ?>"/><br />
<p><input type="submit" value="Änderung speichern" /></p>
</form>

<p><a class="button" href="kloeschen.php?kursnr=<?php echo $kursnr; ?>">Kurs löschen</a></p>
<?PHP
}
else {
 ?> 
   
<form action="kbearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="null" />
<label for="kursnr">Kursnummer: </label><input type="text" id="kursnr" name="kursnr" value="AUTO" disabled /><br />
<label for="ressort">Ressort: </label><input type="text" id="ressort" name="ressort" value=""/><br />
<label for="titel">Titel: </label><input type="text" id="titel" name="titel" value=""/><br />
<label for="beschreibung">Beschreibung: </label><input type="text" id="beschreibung" name="beschreibung" value=""/><br />
<label for="preis">Preis: </label><input type="text" id="preis" name="preis" value=""/><br />
<p><input type="submit" value="Änderung speichern" /></p>
</form>    
  
<?PHP
}
?>

</div>
<?PHP
}
?>

</body>
</html>

</body>
</html>