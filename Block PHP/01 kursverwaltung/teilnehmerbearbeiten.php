<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Teilnehmer bearbeiten</title>
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
$teilnehmer = new teilnehmer();

if (isset($_POST["mode"])) {
   
      if($_POST["mode"] == "null"){
          $teilnehmer->anlegen($_POST);
      }
     else {
          $teilnehmer->bearbeiten($_POST);
      }
   
   header("refresh:3;url=teilnehmer.php");
 }
else {
    
?>
<div class="shadow-container">
<div class="ausgabe">
<?php

$tData = array();
if (isset($_GET["tnummer"])) {
    $tData = $teilnehmer->lesenDatensatz($_GET["tnummer"]);
    $tnummer = $_GET["tnummer"];
?>

<form action="" method="POST">
<input type="hidden" id="mode" name="mode" 
        value="<?php echo $tnummer; ?>" />
<label for="tnummer">UserID: </label>
<input type="text" id="tnummer" name="tnummer" 
        value="<?php echo $tnummer; ?>" disabled />
<br />
<label for="name">Nachname: </label>
<input type="text" id="name" name="name" 
        value="<?php echo $tData['name']; ?>"/>
<br />
<label for="vname">Vorname: </label>
<input type="text" id="vname" name="vname" 
        value="<?php echo $tData['vname']; ?>"/>
<br />
<label for="plz">Postleitzahl: </label>
<input type="text" id="plz" name="plz" 
        value="<?php echo $tData['plz']; ?>"/>
<br />
<label for="plz">Ort: </label>
<input type="text" id="ort" name="ort" 
        value="<?php echo $tData['ort']; ?>"/>
<br />
<label for="plz">Straße: </label>
<input type="text" id="strasse" name="strasse" 
        value="<?php echo $tData['strasse']; ?>"/>
<br />
<label for="hausnr">Hausnummer: </label>
<input type="text" id="hausnr" name="hausnr" 
        value="<?php echo $tData['hausnr']; ?>"/>
<br />
<label for="telefon1">Telefon 1: </label>
<input type="text" id="telefon1" name="telefon1" 
        value="<?php echo $tData['telefon1']; ?>"/>
<br />
<label for="telefon2">Telefon 2: </label>
<input type="text" id="telefon2" name="telefon2" 
        value="<?php echo $tData['telefon2']; ?>"/>
<br />
<label for="email">E-Mail: </label>
<input type="text" id="email" name="email" 
        value="<?php echo $tData['email']; ?>"/>
<p><input type="submit" 
        value="Änderung speichern" /></p>
</form>

<p><a class="button" 
        href="teilnehmerloeschen.php?tnummer=
        <?php echo $tnummer; ?>">Teilnehmer löschen
   </a>
</p>
<?PHP
}
else {
 ?> 
   
<form action="" method="POST">
<input type="hidden" id="mode" name="mode" value="null" />
<label for="tnummer">UserID: </label>
<input type="text" id="tnummer" name="tnummer" value="AUTO" disabled />
<br />
<label for="name">Nachname: </label>
<input type="text" id="name" name="name" value=""/>
<br />
<label for="vname">Vorname: </label>
<input type="text" id="vname" name="vname" value=""/>
<br />
<label for="plz">Postleitzahl: </label>
<input type="text" id="plz" name="plz" value=""/>
<br />
<label for="plz">Ort: </label>
<input type="text" id="ort" name="ort" value=""/>
<br />
<label for="plz">Straße: </label>
<input type="text" id="strasse" name="strasse" value=""/>
<br />
<label for="hausnr">Hausnummer: </label>
<input type="text" id="hausnr" name="hausnr" value=""/>
<br />
<label for="telefon1">Telefon 1: </label>
<input type="text" id="telefon1" name="telefon1" value=""/>
<br />
<label for="telefon2">Telefon 2: </label>
<input type="text" id="telefon2" name="telefon2" value=""/>
<br />
<label for="email">E-Mail: </label>
<input type="text" id="email" name="email" value=""/>
<br />
<input type="submit" value="Änderung speichern" />
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