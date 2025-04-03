<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta charset="utf-8" />
	<title>Teilnehmer suchen</title>
<?php
    require_once("teilnehmer.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<div class="ausgabe">
<?php
$teilnehmer = new teilnehmer();

if (isset($_POST["tnummer"])) {
   
      $teilnehmer->suchen();
}
else {
    
?>
   
<form action="" method="POST">
<label for="tnummer">Teilnehmernummer: </label>
<input type="text" id="tnummer" name="tnummer" value=""/>
<br />
<label for="name">Name: </label>
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
<input type="submit" value="Suchen" />
</form>    

<?PHP
}
?>
</div>
</body>
</html>