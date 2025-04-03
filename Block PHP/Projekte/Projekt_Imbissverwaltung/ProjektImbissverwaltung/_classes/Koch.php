<?php
// Einbinden der Datei, die die Datenbankverbindungsklasse enthält.
require_once __DIR__ . '/Database.php';

/**
 * Klasse Koch
 * 
 * Diese Klasse kapselt alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
 * für Koch-Datensätze in der Datenbank.
 */
class Koch {
    // Eigenschaft, in der die Datenbankverbindung (PDO-Objekt) gespeichert wird.
    private $conn;

    /**
     * Konstruktor: Stellt beim Erstellen eines Objekts der Klasse Koch eine Verbindung zur Datenbank her.
     */
    public function __construct() {
        // Verbindung zur Datenbank herstellen über die connect()-Methode der Database-Klasse.
        $this->conn = Database::connect();
        // Setzt den Fehlermodus auf Exception, damit bei Fehlern Exceptions geworfen werden.
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Liest alle Köche aus der Datenbank aus.
     * 
     * @return array Gibt ein assoziatives Array aller Köche zurück, sortiert nach Nachname und Vorname.
     */
    public function readAll() {
        // SQL-Abfrage, um alle Datensätze aus der Tabelle 'koch' auszulesen.
        // Die Ergebnisse werden nach Nachname und Vorname sortiert.
        $sql = "SELECT * FROM koch ORDER BY nachname, vorname";
        // Direkte Ausführung der Abfrage (ohne Prepared Statement, da keine dynamischen Parameter verwendet werden).
        $stmt = $this->conn->query($sql);
        // Rückgabe aller Ergebnisse als assoziatives Array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Liest einen einzelnen Koch anhand der Koch-ID aus.
     * 
     * @param int $kochId ID des Kochs.
     * @return array Gibt den Datensatz des Kochs als assoziatives Array zurück oder false, wenn kein Datensatz gefunden wurde.
     */
    public function readOne($kochId) {
        // SQL-Abfrage, um einen bestimmten Datensatz aus der Tabelle 'koch' auszulesen.
        $sql = "SELECT * FROM koch WHERE kochId = :kochId";
        // Vorbereitung des Statements als Prepared Statement.
        $stmt = $this->conn->prepare($sql);
        // Bindung des Parameters :kochId an die übergebene Variable $kochId.
        $stmt->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        // Ausführen des Prepared Statements.
        $stmt->execute();
        // Rückgabe des gefundenen Datensatzes als assoziatives Array.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Erstellt einen neuen Koch-Datensatz in der Datenbank.
     * 
     * @param string $nachname      Nachname des Kochs.
     * @param string $vorname       Vorname des Kochs.
     * @param int    $sterne        Anzahl der Sterne (Bewertung).
     * @param int    $age           Alter des Kochs.
     * @param string $geschlecht    Geschlecht des Kochs.
     * @param string $spezialgebiet Spezialgebiet des Kochs.
     * @return bool                 Gibt true zurück, wenn der Eintrag erfolgreich erstellt wurde, andernfalls false.
     */
    public function create($nachname, $vorname, $sterne, $age, $geschlecht, $spezialgebiet) {
        // SQL-Statement zum Einfügen eines neuen Datensatzes in die Tabelle 'koch'
        $sql = "INSERT INTO koch (nachname, vorname, sterne, age, geschlecht, spezialgebiet)
                VALUES (:nachname, :vorname, :sterne, :age, :geschlecht, :spezialgebiet)";
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung der Parameter an die Platzhalter im SQL-Statement.
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':sterne', $sterne);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':geschlecht', $geschlecht);
        $stmt->bindParam(':spezialgebiet', $spezialgebiet);
        // Ausführung des Statements und Rückgabe des Ergebnisses (true bei Erfolg, false bei Fehler).
        return $stmt->execute();
    }

    /**
     * Aktualisiert einen bestehenden Koch-Datensatz in der Datenbank.
     * 
     * @param int    $kochId        ID des zu aktualisierenden Kochs.
     * @param string $nachname      Neuer Nachname.
     * @param string $vorname       Neuer Vorname.
     * @param int    $sterne        Neue Anzahl der Sterne.
     * @param int    $age           Neues Alter.
     * @param string $geschlecht    Neues Geschlecht.
     * @param string $spezialgebiet Neues Spezialgebiet.
     * @return bool                 Gibt true zurück, wenn das Update erfolgreich war, andernfalls false.
     */
    public function update($kochId, $nachname, $vorname, $sterne, $age, $geschlecht, $spezialgebiet) {
        // SQL-Statement zum Aktualisieren eines bestehenden Datensatzes in der Tabelle 'koch'
        $sql = "UPDATE koch
                SET nachname = :nachname,
                    vorname = :vorname,
                    sterne = :sterne,
                    age = :age,
                    geschlecht = :geschlecht,
                    spezialgebiet = :spezialgebiet
                WHERE kochId = :kochId";
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung der neuen Werte an die entsprechenden Platzhalter.
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':sterne', $sterne);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':geschlecht', $geschlecht);
        $stmt->bindParam(':spezialgebiet', $spezialgebiet);
        // Bindung der Koch-ID, um den richtigen Datensatz zu aktualisieren.
        $stmt->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        // Ausführung des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }

    /**
     * Löscht einen Koch-Datensatz anhand der Koch-ID.
     * 
     * @param int $kochId ID des zu löschenden Kochs.
     * @return bool       Gibt true zurück, wenn der Löschvorgang erfolgreich war, andernfalls false.
     */
    public function delete($kochId) {
        // SQL-Statement zum Löschen eines Datensatzes aus der Tabelle 'koch'
        $sql = "DELETE FROM koch WHERE kochId = :kochId";
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung der Koch-ID an den Platzhalter.
        $stmt->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        // Ausführung des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }
}
?>
