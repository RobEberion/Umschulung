<?php


class kurse {

private $tabelle = "kurse";

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " .$this->tabelle ." WHERE kursnr = ?";
     if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('i', $id);
        $stmt -> execute();
      }
      $stmt->close();
      $mysqli->close(); 
}
 
public function anlegen($felder) {
    
    require("db.inc.php");
   	
    $kursnr = NULL;
	$ressort = $mysqli->real_escape_string($felder["ressort"]);
	$titel = $mysqli->real_escape_string($felder["titel"]);
	$beschreibung = $mysqli->real_escape_string($felder["beschreibung"]);
	$preis = $mysqli->real_escape_string($felder["preis"]);
	
	
    $sql = "INSERT INTO " .$this->tabelle ." (kursnr, 
									ressort,
									titel,
									beschreibung, 
									preis)
			VALUES (?, ?, ?, ?, ?)";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('isssd', 
							$kursnr,
                            $ressort, 
							$titel,
							$beschreibung,
							$preis);
    
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
   	
    $kursnr = $mysqli->real_escape_string($felder["mode"]);
	$ressort = $mysqli->real_escape_string($felder["ressort"]);
	$titel = $mysqli->real_escape_string($felder["titel"]);
	$beschreibung = $mysqli->real_escape_string($felder["beschreibung"]);
	$preis = $mysqli->real_escape_string($felder["preis"]);
		
    $sql = "UPDATE " .$this->tabelle ." SET  
									ressort = ?,
									titel = ?,
									beschreibung = ?, 
									preis = ? 
                                    WHERE kursnr = ?";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('sssdi', 
							$ressort,
							$titel,
							$beschreibung, 
							$preis, 
							$kursnr);
    
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
     if ($stmt = $mysqli -> prepare("SELECT ressort, titel, beschreibung, preis FROM " .$this->tabelle ." WHERE kursnr=?")) {
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
    require_once("db.inc.php");
    if ($stmt = $mysqli -> prepare("SELECT kursnr, ressort, titel, beschreibung, preis FROM " .$this->tabelle ." ORDER BY ressort, titel")) {
        $stmt -> execute();
        $stmt -> bind_result($kursnr, $ressort, $titel, $beschreibung, $preis);
        echo "<table id=\"zebra\">\n\t";
        echo "<thead><tr><th>KursID</th><th>Ressort</th><th>Titel</th><th>Beschreibung</th><th>Preis</th><th>Bearbeiten</th></tr></thead>";
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
            . htmlspecialchars($kursnr)
            ."</td>\n\t<td>"
            . htmlspecialchars($ressort)
            ."</td>\n\t<td>"
            . htmlspecialchars($titel)
            ."</td>\n\t<td>"
            . htmlspecialchars($beschreibung ?? "")
            ."</td>\n\t<td>"
            . htmlspecialchars($preis)
            ."</td>\n\t<td>"
            ."<a href=\"kursebearbeiten.php?kursnr=" .htmlspecialchars($kursnr) ."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
    }

     $mysqli->close();
}
}

?>
