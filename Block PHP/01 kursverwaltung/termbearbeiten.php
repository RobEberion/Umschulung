<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Termin bearbeiten</title>
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
$termin = new termin();

if (isset($_POST["mode"])) {
   
      if($_POST["mode"] == "null"){
          $termin->anlegen($_POST);
      }
     else {
          $termin->bearbeiten($_POST);
      }
   
   header("refresh:3;url=termine.php");
 }
else {
    
?>
<div class="ausgabe">
<?php

$tData = array();

if (isset($_GET["termnr"])) {
    $tData = $termin->lesenDatensatz($_GET["termnr"]);
    $termnr = $_GET["termnr"];
?>

<form action="termbearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="<?php echo $termnr; ?>" />
<label for="termnr">Terminnummer: </label><input type="text" id="termnr" name="termnr" value="<?php echo $termnr; ?>" disabled/><br />
<label for="kursnr">Kurs: </label><?php echo $termin->einfSelect("kurs", "kursnr", "titel", $tData['kursnr']); ?><br />
<label for="doznr">Dozent: </label><?php echo $termin->einfSelect("dozenten", "doznr", "name", $tData['doznr']); ?><br />
<label for="beginn">Beginn: </label><input type="text" id="beginn" name="beginn" value="<?php echo $tData["beginn"]; ?>"/><br />
<label for="ende">Ende: </label><input type="text" id="ende" name="ende" value="<?php echo $tData["ende"]; ?>"/><br />
<label for="dauer">Dauer: </label><input type="text" id="dauer" name="dauer" value="<?php echo $tData["dauer"]; ?>"/><br />
<label for="minanzahl">Min Teilnehmer: </label><input type="text" id="minanzahl" name="minanzahl" value="<?php echo $tData["minanzahl"]; ?>"/><br />
<label for="maxanzahl">Max Teilnehmer: </label><input type="text" id="maxanzahl" name="maxanzahl" value="<?php echo $tData["maxanzahl"]; ?>"/><br />
<label for="vort">Raum: </label><input type="text" id="vort" name="vort" value="<?php echo $tData["vort"]; ?>"/><br />
<p><input type="submit" value="Änderung speichern" /></p>
</form>

<p><a class="button" href="termloeschen.php?termnr=<?php echo $termnr; ?>">Termin löschen</a></p>
<?PHP
}
else {
 ?> 
   
<form action="termbearbeiten.php" method="POST">
<input type="hidden" id="mode" name="mode" value="null" />
<label for="termnr">Terminnummer: </label><input type="text" id="termnr" name="termnr" value="AUTO" disabled /><br />
<label for="kursnr">Kurs: </label><?php echo $termin->einfSelect("kurs", "kursnr", "titel", Null); ?><br />
<label for="doznr">Dozent: </label><?php echo $termin->einfSelect("dozenten", "doznr", "name", Null); ?><br />
<label for="beginn">Beginn: </label><input type="date" id="beginn" name="beginn" value=""/><br />
<label for="ende">Ende: </label><input type="date" id="ende" name="ende" value=""/><br />
<label for="dauer">Dauer: </label><input type="number" id="dauer" name="dauer" value=""/><br />
<label for="minanzahl">Min Teilnehmer: </label><input type="text" id="minanzahl" name="minanzahl" value=""/><br />
<label for="maxanzahl">Max Teilnehmer: </label><input type="text" id="maxanzahl" name="maxanzahl" value=""/><br />
<label for="vort">Raum: </label><input type="text" id="vort" name="vort" value=""/><br />
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