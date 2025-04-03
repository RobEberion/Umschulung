<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Kurs bearbeiten</title>
<?php
    require_once("kurse.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");
?>
<?php
$kurse = new kurse();

if (isset($_POST["mode"])) {
   
      if($_POST["mode"] == "null"){
          $kurse->anlegen($_POST);
      }
     else {
          $kurse->bearbeiten($_POST);
      }
   
   header("refresh:3;url=kurse.php");
 }
else {
    
?>
<div class="shadow-container">
<div class="ausgabe">
<?php

$tData = array();

if (isset($_GET["kursnr"])) {
    $tData = $kurse->lesenDatensatz($_GET["kursnr"]);
    $kursnr = $_GET["kursnr"];
?>

<form action="kursebearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="<?php echo $kursnr; ?>" />
<label for="kursnr">KursID: </label><input type="text" id="kursnr" name="kursnr" value="<?php echo $kursnr; ?>" disabled/><br />
<label for="ressort">Ressort: </label><input type="text" id="ressort" name="ressort" value="<?php echo $tData['ressort']; ?>"/><br />
<label for="titel">Titel: </label><input type="text" id="titel" name="titel" value="<?php echo $tData['titel']; ?>"/><br />
<label for="beschreibung">Beschreibung: </label><input type="text" id="beschreibung" name="beschreibung" value="<?php echo $tData['beschreibung']; ?>"/><br />
<label for="preis">Preis: </label><input type="text" id="preis" name="preis" value="<?php echo $tData['preis']; ?>"/><br />
<p><input type="submit" value="Änderung speichern" /></p>
</form>

<p><a class="button" href="kurseloeschen.php?kursnr=<?php echo $kursnr; ?>">Kurs löschen</a></p>
<?PHP
}
else {
 ?> 
   
<form action="kursebearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="null" />
<label for="kursnr">KursID: </label><input type="text" id="kursnr" name="kursnr" value="AUTO" disabled /><br />
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
</div>
<?PHP
}
?>

</body>
</html>

</body>
</html>