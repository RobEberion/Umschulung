<?php

class buchung {

private $tabelle = "buchung";

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " .$this->tabelle ." WHERE bnummer = ?";
     if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('i', $id);
        $stmt -> execute();
      }
      $stmt->close();
      $mysqli->close(); 
}
 
public function anlegen() {
    
    require("db.inc.php");
   	
    $bnummer = NULL;
	$termnr = $mysqli->real_escape_string($_POST["termnr"]);
	$tnummer = $mysqli->real_escape_string($_POST["tnummer"]);
		
    $sql = "INSERT INTO " .$this->tabelle ." (bnummer, 
									termnr,
									tnummer)
			VALUES (?, ?, ?)";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('iii', 
							$bnummer,
                            $termnr, 
							$tnummer);
    
		if($stmt -> execute()) {
			echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
        }	
		else {
			echo "<h2>Fehler beim Speichern!</h2>\n";
        }
        
          $stmt->close();
	}
    $mysqli -> close();
   
}

public function bearbeiten() {
    
    require("db.inc.php");
   	
    $bnummer = $mysqli->real_escape_string($_POST["mode"]);
	$termnr = $mysqli->real_escape_string($_POST["termnr"]);
	$tnummer = $mysqli->real_escape_string($_POST["tnummer"]);
	
		
    $sql = "UPDATE " .$this->tabelle ." SET termnr = ?, tnummer = ? WHERE bnummer = ?";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('iii', 
							$termnr, 
							$tnummer,
							$bnummer);
    
		if($stmt -> execute()) {
			echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
        }	
		else {
			echo "<h2>Fehler beim Speichern!</h2>\n";
        }
        $stmt->close();
	}
    $mysqli -> close();
    
    
}

public function lesenDatensatz($id)
 {
     $data = array();
     require("db.inc.php");
     if ($stmt = $mysqli -> prepare("SELECT buchung.bnummer, 
                                        termine.termnr, 
                                        kurs.titel, 
                                        dozenten.name, 
                                        termine.beginn, 
                                        termine.ende, 
                                        teilnehmer.tnummer,
                                        teilnehmer.name,
                                        teilnehmer.vname
                                        FROM buchung 
                                        INNER JOIN termine ON buchung.termnr = termine.termnr  
                                        INNER JOIN teilnehmer ON buchung.tnummer = teilnehmer.tnummer 
                                        INNER JOIN kurs ON termine.kursnr = kurs.kursnr 
                                        INNER JOIN dozenten ON termine.doznr = dozenten.doznr 
                                        WHERE bnummer=?")) {
         $stmt->bind_param('i',$id);
         $stmt -> execute();
         $ergebnis = $stmt->get_result();
         $data = $ergebnis->fetch_assoc();
         $ergebnis->free();
         $stmt -> close();
         $mysqli->close();
     
     return($data);
 }
 }
 
public function lesenAlleDaten()
{
    $sql="SELECT buchung.bnummer,
                kurs.titel, 
                dozenten.name, 
                termine.beginn, 
                termine.ende, 
                teilnehmer.name,
                teilnehmer.vname 
                FROM buchung 
            JOIN termine ON buchung.termnr = termine.termnr  
            JOIN teilnehmer ON buchung.tnummer = teilnehmer.tnummer 
            JOIN kurs ON termine.kursnr = kurs.kursnr 
            JOIN dozenten ON termine.doznr = dozenten.doznr 
            ORDER BY buchung.bnummer";
    
    $this->baueBuchungTabelle($sql);
}

private function baueBuchungTabelle($sql)
{            
    require_once("db.inc.php");
    if ($stmt = $mysqli -> prepare($sql)) {
        $stmt -> execute();
        $stmt -> bind_result($bnummer, $kursTitel, $dozentenName, $beginn, $ende, $teilnehmerName, $teilnehmerVorname);
        echo "<table id=\"zebra\">\n\t";
        echo "<thead><tr><th>Nummer</th><th>Kurs</th><th>Dozent</th><th>Beginn</th><th>Ende</th><th>Name</th><th>Vorname</th><th>Bearbeiten</th></tr></thead>";
        echo "<tbody>\n\t";
        $count = 0;
        while ($stmt -> fetch()) {
            $count+= 1;
            $zebratyp = "ungerade";
            echo "<tr ";
            if($count % 2 == 0) {
                $zebratyp = "gerade";
            }
            echo "class=\"" .$zebratyp
            ."\">\n\t<td>"
            . htmlspecialchars($bnummer)
            ."</td>\n\t<td>"
            . htmlspecialchars($kursTitel)
            ."</td>\n\t<td>"
            . htmlspecialchars($dozentenName)
            ."</td>\n\t<td>"
            . htmlspecialchars($beginn)
            ."</td>\n\t<td>"
            . htmlspecialchars($ende)
            ."</td>\n\t<td>"
            . htmlspecialchars($teilnehmerName)
            ."</td>\n\t<td>"
            . htmlspecialchars($teilnehmerVorname)
            ."</td>\n\t<td>"
            ."<a href=\"bbearbeiten.php?bnummer=" .htmlspecialchars($bnummer) ."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
        $stmt->close();
    }
    
     $mysqli->close();
}

public function einfuegenSelect($tab, $val, $text, $def)
{
    $s = "<select name=\"" .$val ."\" id=\"" .$val ."\">";
      
    require("db.inc.php");
    $sql = "SELECT " .$val .", " .$text ." FROM " .$tab;
    if ($stmt = $mysqli -> prepare($sql)) {
      
        $stmt -> execute();
        $stmt -> bind_result($val, $text);
        while ($stmt -> fetch()) {
            $s = $s ."<option value=\"". $val ."\"";
            if($val == $def){
                $s = $s ." selected";
            }
            $s = $s .">" .$val ." | " .$text ."</option>";
        }
        $s = $s ."</select>";
        return $s;      
    }
    else {
        return false;
    }
  
}
}
?>
