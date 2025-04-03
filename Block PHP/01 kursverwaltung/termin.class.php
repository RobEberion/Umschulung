<?php

class termin {

private $tabelle = "termine";

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " .$this->tabelle ." WHERE termnr = ?";
     if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('i', $id);
        $stmt -> execute();
      }
      $stmt->close();
      $mysqli->close(); 
}
 
public function anlegen($felder) {
    
    require("db.inc.php");
   	
    $termnr = NULL;
	$kursnr = $mysqli->real_escape_string($felder["kursnr"]);
	$doznr = $mysqli->real_escape_string($felder["doznr"]);
	$beginn = $mysqli->real_escape_string($felder["beginn"]);
	$ende = $mysqli->real_escape_string($felder["ende"]);
    $dauer = $mysqli->real_escape_string($felder["dauer"]);
    $minanzahl = $mysqli->real_escape_string($felder["minanzahl"]);
    $maxanzahl = $mysqli->real_escape_string($felder["maxanzahl"]);
    $vort = $mysqli->real_escape_string($felder["vort"]);
	
	
    $sql = "INSERT INTO " .$this->tabelle ." (termnr, 
									kursnr,
									doznr,
									beginn, 
									ende,
                                    dauer,
                                    minanzahl,
                                    maxanzahl,
                                    vort)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('iiisssiis', 
							$termnr,
                            $kursnr, 
							$doznr,
							$beginn,
							$ende,
                            $dauer,
                            $minanzahl,
                            $maxanzahl,
                            $vort);
    
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

public function bearbeiten($felder) {
    
    require("db.inc.php");
   	
    $termnr = $mysqli->real_escape_string($felder["mode"]);
	$kursnr = $mysqli->real_escape_string($felder["kursnr"]);
	$doznr = $mysqli->real_escape_string($felder["doznr"]);
	$beginn = $mysqli->real_escape_string($felder["beginn"]);
	$ende = $mysqli->real_escape_string($felder["ende"]);
    $dauer = $mysqli->real_escape_string($felder["dauer"]);
    $minanzahl = $mysqli->real_escape_string($felder["minanzahl"]);
    $maxanzahl = $mysqli->real_escape_string($felder["maxanzahl"]);
    $vort = $mysqli->real_escape_string($felder["vort"]);
		
    $sql = "UPDATE " .$this->tabelle ." SET  
									kursnr = ?,
									doznr = ?,
									beginn = ?, 
									ende = ?,
                                    dauer = ?,
                                    minanzahl = ?,
                                    maxanzahl = ?,
                                    vort = ? 
                                    WHERE termnr = ?";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('iisssiisi', 
							$kursnr, 
							$doznr,
							$beginn,
							$ende,
                            $dauer,
                            $minanzahl,
                            $maxanzahl,
                            $vort,
                            $termnr);
    
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
     if ($stmt = $mysqli -> prepare("SELECT termine.termnr,
                                        termine.kursnr,
                                        kurs.titel,
                                        termine.doznr, 
                                        dozenten.name,
                                        dozenten.vname, 
                                        termine.beginn, 
                                        termine.ende, 
                                        termine.dauer, 
                                        termine.minanzahl, 
                                        termine.maxanzahl, 
                                        termine.vort 
                                        FROM termine 
                                        INNER JOIN kurs ON termine.kursnr = kurs.kursnr 
                                        INNER JOIN dozenten ON termine.doznr = dozenten.doznr 
                                        WHERE termnr=?")) {
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
    $sql = "SELECT termine.termnr,
                      kurs.titel, 
                      dozenten.name, 
                      termine.beginn, 
                      termine.ende, 
                      termine.dauer, 
                      termine.minanzahl, 
                      termine.maxanzahl, 
                      termine.vort 
                      FROM termine 
                      JOIN kurs ON termine.kursnr = kurs.kursnr 
                      JOIN dozenten ON termine.doznr = dozenten.doznr
                      ORDER BY termine.beginn";
    $this->baueTerminTabelle($sql);
  }
  
  private function  baueTerminTabelle($sql)
  {
    require_once("db.inc.php");
    if ($stmt = $mysqli -> prepare($sql)) {
        $stmt -> execute();
        $stmt -> bind_result($termnr, $kursTitel, $dozentenName, $beginn, $ende, $dauer, $minanzahl, $maxanzahl, $vort);
        echo "<table id=\"zebra\">\n\t";
        echo "<thead><tr><th>Nummer</th><th>Kurs</th><th>Dozent</th><th>Beginn</th><th>Ende</th><th>Dauer</th><th>Min-Teiln</th><th>Max-Teiln</th><th>Raum</th><th>Bearbeiten</th></tr></thead>";
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
            . htmlspecialchars($termnr)
            ."</td>\n\t<td>"
            . htmlspecialchars($kursTitel)
            ."</td>\n\t<td>"
            . htmlspecialchars($dozentenName)
            ."</td>\n\t<td>"
            . htmlspecialchars($beginn)
            ."</td>\n\t<td>"
            . htmlspecialchars($ende)
            ."</td>\n\t<td>"
            . htmlspecialchars($dauer)
            ."</td>\n\t<td>"
            . htmlspecialchars($minanzahl)
            ."</td>\n\t<td>"
            . htmlspecialchars($maxanzahl)
            ."</td>\n\t<td>"
            . htmlspecialchars($vort)
            ."</td>\n\t<td>"
            ."<a href=\"termbearbeiten.php?termnr=" .htmlspecialchars($termnr) ."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
    }

     $mysqli->close();
}

public function einfSelect($tab, $val, $text, $def)
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
