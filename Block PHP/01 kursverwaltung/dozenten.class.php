<?php

class dozent {

private $tabelle = "dozenten";

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " .$this->tabelle ." WHERE doznr = ?";
     if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('i', $id);
        $stmt -> execute();
      }
      $stmt->close();
      $mysqli->close(); 
}
 
public function anlegen($felder) {
    
    require("db.inc.php");
   	
    $doznr = NULL;
	$name = $mysqli->real_escape_string($felder["name"]);
	$vname = $mysqli->real_escape_string($felder["vname"]);
	$plz = $mysqli->real_escape_string($felder["plz"]);
	$ort = $mysqli->real_escape_string($felder["ort"]);
	$strasse = $mysqli->real_escape_string($felder["strasse"]);
	$hausnr = $mysqli->real_escape_string($felder["hausnr"]);
	$telefon1 = $mysqli->real_escape_string($felder["telefon1"]);
	$telefon2 = $mysqli->real_escape_string($felder["telefon2"]);
	$email = $mysqli->real_escape_string($felder["email"]);

	
    $sql = "INSERT INTO " .$this->tabelle ." (doznr, 
									name,
									vname,
									plz, 
									ort, 
									strasse, 
									hausnr, 
									telefon1, 
									telefon2, 
									email)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('isssssssss', 
							$doznr, 
							$name,
							$vname,
							$plz, 
							$ort, 
							$strasse, 
							$hausnr, 
							$telefon1, 
							$telefon2, 
							$email);
    
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
   	
    $doznr = $mysqli->real_escape_string($felder["mode"]);
	$name = $mysqli->real_escape_string($felder["name"]);
	$vname = $mysqli->real_escape_string($felder["vname"]);
	$plz = $mysqli->real_escape_string($felder["plz"]);
	$ort = $mysqli->real_escape_string($felder["ort"]);
	$strasse = $mysqli->real_escape_string($felder["strasse"]);
	$hausnr = $mysqli->real_escape_string($felder["hausnr"]);
	$telefon1 = $mysqli->real_escape_string($felder["telefon1"]);
	$telefon2 = $mysqli->real_escape_string($felder["telefon2"]);
	$email = $mysqli->real_escape_string($felder["email"]);

	
    $sql = "UPDATE " .$this->tabelle ." SET  
									name = ?,
									vname = ?,
									plz = ?, 
									ort = ?, 
									strasse = ?, 
									hausnr = ?, 
									telefon1 = ?, 
									telefon2 = ?, 
									email = ? 
			WHERE doznr = ?";
	
	if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('sssssssssi', 
							$name,
							$vname,
							$plz, 
							$ort, 
							$strasse, 
							$hausnr, 
							$telefon1, 
							$telefon2, 
							$email,
                            $doznr);
    
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
     if ($stmt = $mysqli -> prepare("SELECT name, vname, plz, ort, strasse, hausnr, telefon1, telefon2, email FROM " .$this->tabelle ." WHERE doznr=?")) {
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
    if ($stmt = $mysqli -> prepare("SELECT doznr, name, vname, plz, ort, strasse, hausnr, telefon1, telefon2, email FROM " .$this->tabelle ." ORDER BY name")) {
        $stmt -> execute();
        $stmt -> bind_result($doznr, $name, $vname, $plz, $ort, $strasse, $hausnr, $telefon1, $telefon2, $email);
        echo "<table id=\"zebra\">\n\t";
        echo "<thead><tr><th>Nummer</th><th>Name</th><th>Vorname</th><th>Plz</th><th>Ort</th><th>Straße</th><th>Haus-Nr.</th><th>Telefon 1</th><th>Telefon 2</th><th>E-Mail</th><th>Bearbeiten</th></tr></thead>";
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
            . htmlspecialchars($doznr)
            ."</td>\n\t<td>"
            . htmlspecialchars($name)
            ."</td>\n\t<td>"
            . htmlspecialchars($vname)
            ."</td>\n\t<td>"
            . htmlspecialchars($plz)
            ."</td>\n\t<td>"
            . htmlspecialchars($ort)
            ."</td>\n\t<td>"
            . htmlspecialchars($strasse)
            ."</td>\n\t<td>"
            . htmlspecialchars($hausnr)
            ."</td>\n\t<td>"
            . htmlspecialchars($telefon1)
            ."</td>\n\t<td>"
            . htmlspecialchars($telefon2)
            ."</td>\n\t<td>"
            . htmlspecialchars($email)
            ."</td>\n\t<td>"
            ."<a href=\"dbearbeiten.php?doznr=" .htmlspecialchars($doznr) ."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
    }

     $mysqli->close();
}
}

?>
