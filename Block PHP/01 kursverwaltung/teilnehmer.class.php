<?php

class teilnehmer {

private $tabelle = "teilnehmer";

public function loeschen($id) {
     
     require("db.inc.php");
     
     $sql = "DELETE FROM " .$this->tabelle ." WHERE tnummer = ?";
     if ($stmt = $mysqli -> prepare($sql)) {
		$stmt->bind_param('i', $id);
        $stmt -> execute();
      }
      $stmt->close();
      $mysqli->close(); 
}
 
public function anlegen()
{
     require("db.inc.php");
  	
    $tnummer = NULL;
	$name = $mysqli->real_escape_string($_POST["name"]);
	$vname = $mysqli->real_escape_string($_POST["vname"]);
	$plz = $mysqli->real_escape_string($_POST["plz"]);
	$ort = $mysqli->real_escape_string($_POST["ort"]);
	$strasse = $mysqli->real_escape_string($_POST["strasse"]);
	$hausnr = $mysqli->real_escape_string($_POST["hausnr"]);
	$telefon1 = $mysqli->real_escape_string($_POST["telefon1"]);
	$telefon2 = $mysqli->real_escape_string($_POST["telefon2"]);
	$email = $mysqli->real_escape_string($_POST["email"]);
	
    $sql = "INSERT INTO " .$this->tabelle ." (tnummer, 
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
							$tnummer, 
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

public function bearbeiten()
{
    
    require("db.inc.php");
   	
    $tnummer = $mysqli->real_escape_string($_POST["mode"]);
	$name = $mysqli->real_escape_string($_POST["name"]);
	$vname = $mysqli->real_escape_string($_POST["vname"]);
	$plz = $mysqli->real_escape_string($_POST["plz"]);
	$ort = $mysqli->real_escape_string($_POST["ort"]);
	$strasse = $mysqli->real_escape_string($_POST["strasse"]);
	$hausnr = $mysqli->real_escape_string($_POST["hausnr"]);
	$telefon1 = $mysqli->real_escape_string($_POST["telefon1"]);
	$telefon2 = $mysqli->real_escape_string($_POST["telefon2"]);
	$email = $mysqli->real_escape_string($_POST["email"]);

	
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
			WHERE tnummer = ?";
	
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


 public function lesenDatensatz($id)
 {
     $data = array();
     require("db.inc.php");
     if ($stmt = $mysqli -> prepare("SELECT name, 
                                            vname, 
                                            plz, 
                                            ort, 
                                            strasse, 
                                            hausnr, 
                                            telefon1, 
                                            telefon2, 
                                            email 
                                            FROM " .$this->tabelle ." 
                                            WHERE tnummer=?")) {
         $stmt->bind_param('i',$id);
         $stmt -> execute();
         $ergebnis = $stmt->get_result();
         $data = $ergebnis->fetch_assoc();
         $ergebnis->close();
         $stmt -> close();
         $mysqli->close();
  }    
     return($data);

 }
 
public function lesenAlleDaten()
{
    $sql = "SELECT tnummer, 
                    name, 
                    vname, 
                    plz, 
                    ort, 
                    strasse, 
                    hausnr, 
                    telefon1, 
                    telefon2, 
                    email 
                    FROM " .$this->tabelle ." 
                    ORDER BY name";
    $this->baueTeilnehmerTabelle($sql);
}

public function suchen()
{
    $sql = "SELECT tnummer, 
                    name, 
                    vname, 
                    plz, 
                    ort, 
                    strasse, 
                    hausnr, 
                    telefon1, 
                    telefon2, 
                    email 
                    FROM " .$this->tabelle ." 
                    WHERE";
    $count = 0;   
    foreach($_POST As $feld => $wert) {
        if(!empty($wert)) {
            if($count > 0) {
                $sql = $sql ." AND ";
            }
            $count += 1;
            $sql = $sql ." " .$feld ." LIKE '%" .$wert ."%'";  
        }
    }
    $sql = $sql ." ORDER BY name";
    
    $this->baueTeilnehmerTabelle($sql);
}

private function baueTeilnehmerTabelle($sql)
{
     require_once("db.inc.php");
    if ($stmt = $mysqli -> prepare($sql)) {
        $stmt -> execute();
        $stmt -> bind_result($tnummer, 
                            $name, 
                            $vname, 
                            $plz, 
                            $ort, 
                            $strasse, 
                            $hausnr, 
                            $telefon1, 
                            $telefon2, 
                            $email);
        echo "<table id=\"zebra\">\n\t";
        echo "<thead>
                <tr>
                    <th>Nummer</th><th>Name</th><th>Vorname</th><th>Plz</th>
                    <th>Ort</th><th>Straße</th><th>Haus-Nr.</th><th>Telefon 1</th>
                    <th>Telefon 2</th><th>E-Mail</th><th>Bearbeiten</th>
                </tr>
            </thead>";
        echo "<tbody>\n\t";
        $count = 0;
        while ($stmt -> fetch()) {
            $count += 1;
            $zebratyp = "ungerade";
            echo "<tr ";
            if($count % 2 == 0) {
                $zebratyp = "gerade";
            }
            echo "class=\"" .$zebratyp
            ."\">\n\t<td>"
            . htmlspecialchars($tnummer)
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
            ."<a href=\"tbearbeiten.php?tnummer=" .htmlspecialchars($tnummer) ."\">bearbeiten</<a>"
            ."</td>\n</tr>";
            
        }
        echo "</table>";
    $stmt->close();
    }
    $mysqli->close();
}

}
?>
