<?php
// Einbinden der Datei mit der Datenbank-Verbindungsklasse
require_once __DIR__ . '/Database.php';

/**
 * Klasse Gericht
 * 
 * Diese Klasse kapselt alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
 * für Gerichte in der Datenbank. Zudem werden Hilfsfunktionen angeboten, um den
 * Namen des Kochs und des Rezepts anhand ihrer IDs abzurufen.
 */
class Gericht {
    // Eigenschaft für die Datenbankverbindung
    private $conn;

    /**
     * Konstruktor: Stellt eine Verbindung zur Datenbank her.
     */
    public function __construct() {
        // Verbindung zur Datenbank herstellen über die connect()-Methode der Database-Klasse
        $this->conn = Database::connect();
    }

    /**
     * Gibt den vollständigen Namen eines Kochs anhand der Koch-ID zurück.
     * 
     * @param int $kochId ID des Kochs.
     * @return string Gibt den Namen im Format "Nachname, Vorname" zurück, oder einen
     *                Standardwert, wenn der Koch nicht gefunden wurde.
     */
    public function getKochNameById($kochId) {
        // SQL-Abfrage, um Vor- und Nachname des Kochs zu holen
        $sql = "SELECT vorname, nachname FROM koch WHERE kochId = :kochId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        $stmt->execute();
        $koch = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($koch) {
            // Gibt den Namen im Format "Nachname, Vorname" zurück
            return $koch['nachname'] . ', ' . $koch['vorname'];
        }
        // Rückgabe eines Standardwerts, wenn kein Koch gefunden wurde
        return '(Unbekannter Koch)';
    }
    
    /**
     * Gibt den Namen eines Rezepts anhand der Rezept-ID zurück.
     * 
     * @param int $rezeptId ID des Rezepts.
     * @return string Gibt den Rezeptnamen zurück oder einen Standardwert, falls nicht gefunden.
     */
    public function getRezeptNameById($rezeptId) {
        // SQL-Abfrage, um den Namen des Rezepts zu holen
        $sql = "SELECT rezeptname FROM rezept WHERE rezeptId = :rezeptId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        $stmt->execute();
        $rezept = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($rezept) {
            return $rezept['rezeptname'];
        }
        // Rückgabe eines Standardwerts, wenn kein Rezept gefunden wurde
        return '(Unbekanntes Rezept)';
    }

    /**
     * Liest alle Köche aus der Tabelle 'koch' aus.
     * 
     * @return array Gibt ein assoziatives Array aller Köche zurück, sortiert nach der Koch-ID.
     */
    public function readAllKoch() {
        $sql = "SELECT kochId, vorname, nachname FROM koch ORDER BY kochId";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Liest alle Rezepte aus der Tabelle 'rezept' aus.
     * 
     * @return array Gibt ein assoziatives Array aller Rezepte zurück, sortiert nach der Rezept-ID.
     */
    public function readAllRezept() {
        $sql = "SELECT rezeptId, rezeptname FROM rezept ORDER BY rezeptId";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * CREATE: Fügt ein neues Gericht in die Tabelle 'gericht' ein.
     * 
     * @param int $kochId   ID des Kochs, der das Gericht zubereitet.
     * @param int $rezeptId ID des verwendeten Rezepts.
     * @return bool         Gibt true zurück, wenn der Eintrag erfolgreich erstellt wurde.
     */
    public function create($kochId, $rezeptId) {
        // SQL-Statement zum Einfügen eines neuen Gerichtseintrags
        $sql = "INSERT INTO gericht (kochId, rezeptId)
                VALUES (:kochId, :rezeptId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        $stmt->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Liest alle Gerichtseinträge aus der Tabelle 'gericht' aus.
     * 
     * @return array Gibt ein assoziatives Array aller Gerichte zurück, sortiert nach der Gericht-ID.
     */
    public function readAll() {
        $sql = "SELECT gerichtId, kochId, rezeptId FROM gericht ORDER BY gerichtId";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Liest einen einzelnen Gerichtseintrag anhand der Gericht-ID aus.
     * 
     * @param int $gerichtId ID des Gerichts.
     * @return array Gibt den Datensatz als assoziatives Array zurück oder false, falls nicht gefunden.
     */
    public function readOne($gerichtId) {
        $sql = "SELECT gerichtId, kochId, rezeptId FROM gericht WHERE gerichtId = :gerichtId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * UPDATE: Aktualisiert einen bestehenden Gerichtseintrag.
     * 
     * @param int $gerichtId ID des zu aktualisierenden Gerichts.
     * @param int $kochId    Neue Koch-ID.
     * @param int $rezeptId  Neue Rezept-ID.
     * @return bool          Gibt true zurück, wenn das Update erfolgreich war.
     */
    public function update($gerichtId, $kochId, $rezeptId) {
        $sql = "UPDATE gericht
                SET kochId = :kochId,
                    rezeptId = :rezeptId
                WHERE gerichtId = :gerichtId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        $stmt->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        $stmt->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * DELETE: Löscht einen Gerichtseintrag anhand der Gericht-ID.
     * 
     * @param int $gerichtId ID des zu löschenden Gerichts.
     * @return bool          Gibt true zurück, wenn der Löschvorgang erfolgreich war.
     */
    public function delete($gerichtId) {
        $sql = "DELETE FROM gericht WHERE gerichtId = :gerichtId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
