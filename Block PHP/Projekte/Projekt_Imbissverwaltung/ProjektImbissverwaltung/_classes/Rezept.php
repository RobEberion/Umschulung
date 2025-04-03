<?php
// Einbinden der zentralen Datenbankverbindung aus Database.php
require_once __DIR__ . '/Database.php';

/**
 * Klasse Rezept
 * 
 * Diese Klasse kapselt alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
 * für Rezept-Datensätze in der Datenbank.
 */
class Rezept {
    // Eigenschaft für die Datenbankverbindung (PDO-Objekt)
    private $conn;

    /**
     * Konstruktor: Stellt eine Verbindung zur Datenbank her.
     */
    public function __construct() {
        // Verbindung zur Datenbank herstellen über Database::connect()
        $this->conn = Database::connect();
        // Setzt den PDO-Fehlermodus auf Exception, um detaillierte Fehlermeldungen zu erhalten.
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * CREATE: Legt ein neues Rezept in der Datenbank an.
     *
     * @param string $rezeptname         Name des Rezepts.
     * @param int    $dauer              Zubereitungsdauer in Minuten.
     * @param string $speiseart          Art der Speise (z.B. Vorspeise, Hauptgericht, Dessert).
     * @param string $rezeptbeschreibung Beschreibung des Rezepts.
     * @return bool                      Gibt true zurück, wenn der Eintrag erfolgreich war, andernfalls false.
     */
    public function create($rezeptname, $dauer, $speiseart, $rezeptbeschreibung) {
        // SQL-Statement zum Einfügen eines neuen Rezepts in die Tabelle 'rezept'
        $sql = "INSERT INTO rezept (rezeptname, dauer, speiseart, rezeptbeschreibung)
                VALUES (:rezeptname, :dauer, :speiseart, :rezeptbeschreibung)";
        
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung der Parameter an die Platzhalter im SQL-Statement
        $stmt->bindParam(':rezeptname', $rezeptname, PDO::PARAM_STR);
        $stmt->bindParam(':dauer', $dauer, PDO::PARAM_INT);
        $stmt->bindParam(':speiseart', $speiseart, PDO::PARAM_STR);
        $stmt->bindParam(':rezeptbeschreibung', $rezeptbeschreibung, PDO::PARAM_STR);

        // Ausführen des Statements und Rückgabe des Ergebnisses
        return $stmt->execute();
    }

    /**
     * READ ALL: Liest alle Rezepte aus der Datenbank aus.
     *
     * @return array Gibt ein assoziatives Array aller Rezepte zurück, sortiert nach Rezeptname.
     */
    public function readAll() {
        // SQL-Abfrage, um alle Rezepte abzurufen
        $sql = "SELECT * FROM rezept ORDER BY rezeptname";
        // Ausführen der Abfrage (hier ist kein Prepared Statement notwendig, da keine Parameter eingebunden werden)
        $stmt = $this->conn->query($sql);
        // Rückgabe aller Ergebnisse als assoziatives Array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * READ ONE: Liest ein einzelnes Rezept anhand der Rezept-ID aus.
     *
     * @param int $rezeptId ID des Rezepts.
     * @return array Gibt den Datensatz des Rezepts als assoziatives Array zurück oder false, falls nicht gefunden.
     */
    public function readOne($rezeptId) {
        // SQL-Abfrage, um ein einzelnes Rezept anhand der Rezept-ID abzurufen
        $sql = "SELECT * FROM rezept WHERE rezeptId = :rezeptId";
        $stmt = $this->conn->prepare($sql);
        // Bindung der Rezept-ID an den Platzhalter
        $stmt->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        $stmt->execute();
        // Rückgabe des Datensatzes als assoziatives Array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * UPDATE: Aktualisiert ein bestehendes Rezept in der Datenbank.
     *
     * @param int    $rezeptId           ID des zu aktualisierenden Rezepts.
     * @param string $rezeptname         Neuer Rezeptname.
     * @param int    $dauer              Neue Zubereitungsdauer in Minuten.
     * @param string $speiseart          Neue Speiseart.
     * @param string $rezeptbeschreibung Neue Beschreibung des Rezepts.
     * @return bool                      Gibt true zurück, wenn das Update erfolgreich war, andernfalls false.
     */
    public function update($rezeptId, $rezeptname, $dauer, $speiseart, $rezeptbeschreibung) {
        // SQL-Statement zum Aktualisieren eines bestehenden Rezepts
        $sql = "UPDATE rezept
                SET rezeptname         = :rezeptname,
                    dauer              = :dauer,
                    speiseart          = :speiseart,
                    rezeptbeschreibung = :rezeptbeschreibung
                WHERE rezeptId         = :rezeptId";
    
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung der Parameter an die entsprechenden Platzhalter
        $stmt->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        $stmt->bindParam(':rezeptname', $rezeptname, PDO::PARAM_STR);
        $stmt->bindParam(':dauer', $dauer, PDO::PARAM_INT);
        $stmt->bindParam(':speiseart', $speiseart, PDO::PARAM_STR);
        $stmt->bindParam(':rezeptbeschreibung', $rezeptbeschreibung, PDO::PARAM_STR);

        // Ausführen des Statements und Rückgabe des Ergebnisses
        return $stmt->execute();
    }

    /**
     * DELETE: Löscht ein Rezept anhand der Rezept-ID.
     *
     * @param int $rezeptId ID des zu löschenden Rezepts.
     * @return bool Gibt true zurück, wenn der Löschvorgang erfolgreich war, andernfalls false.
     */
    public function delete($rezeptId) {
        // SQL-Statement zum Löschen eines Rezepts aus der Tabelle 'rezept'
        $sql = "DELETE FROM rezept WHERE rezeptId = :rezeptId";
        $stmt = $this->conn->prepare($sql);
        // Bindung der Rezept-ID an den Platzhalter
        $stmt->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        // Ausführen des Statements und Rückgabe des Ergebnisses
        return $stmt->execute();
    }
}
?>
