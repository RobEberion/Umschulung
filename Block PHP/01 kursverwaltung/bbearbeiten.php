<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Buchung bearbeiten</title>
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

$buchung = new buchung();

if (isset($_POST["mode"])) {
   
      if($_POST["mode"] == "null"){
          $buchung->anlegen();
      }
     else {
          $buchung->bearbeiten();
      }
   
   header("refresh:3;url=buchung.php");
 }
else {
    
?>
<div class="ausgabe">
<?php

$tData = array();

if (isset($_GET["bnummer"])) {
    $tData = $buchung->lesenDatensatz($_GET["bnummer"]);
    $bnummer = $_GET["bnummer"];
?>

<form action="" method="POST">
<input type="hidden" id="mode" name="mode" 
        value="<?php echo $bnummer; ?>" />
<label for="bnummer">Buchungsnummer: </label>
<input type="text" id="bnummer" name="bnummer" 
        value="<?php echo $bnummer; ?>" disabled/>
<br />
<label for="termnr">Termin: </label>
<?php echo $buchung->einfuegenSelect("termine", "termnr", "beginn", $tData['termnr']); ?>
<br />
<label for="tnummer">Teilnehmer: </label>
<?php echo $buchung->einfuegenSelect("teilnehmer", "tnummer", "name", $tData['tnummer']); ?>
<br />
<p><input type="submit" value="Änderung speichern" />
</p>
</form>
<p><a class="button" href="bloeschen.php?bnummer=<?php echo $bnummer; ?>">Buchung löschen</a></p>
<?PHP
}
else {
 ?> 
<form action="bbearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="null" />
<label for="bnummer">Buchungsnummer: </label>
<input type="text" id="bnummer" name="bnummer" value="AUTO" disabled />
<br />
<label for="termnr">Termin: </label>
<?php echo $buchung->einfuegenSelect("termine", "termnr", "beginn", NULL); ?>
<br />
<label for="tnummer">Teilnehmer: </label>
<?php echo $buchung->einfuegenSelect("teilnehmer", "tnummer", "name", NULL); ?>
<br />
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