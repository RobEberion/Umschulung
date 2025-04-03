<?php
// Einbinden der Datei, die die zentrale Datenbankverbindung (PDO) bereitstellt.
require_once __DIR__ . '/Database.php';

/**
 * Klasse Kunde
 * 
 * Diese Klasse kapselt alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
 * sowie eine Suchfunktion für Kundendaten in der Datenbank.
 */
class Kunde {
    // Eigenschaft für die Datenbankverbindung (PDO-Objekt)
    private $conn;

    /**
     * Konstruktor: Stellt eine Verbindung zur Datenbank her.
     */
    public function __construct() {
        // Verbindung zur Datenbank herstellen via Database::connect()
        $this->conn = Database::connect();
        // Setzt den PDO-Fehlermodus auf Exception, um detaillierte Fehlermeldungen zu erhalten.
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Liest alle Kunden aus der Datenbank aus.
     *
     * @return array Gibt ein assoziatives Array aller Kunden zurück, sortiert nach Nachname und Vorname.
     */
    public function readAll() {
        // SQL-Abfrage, um alle Kundendatensätze abzurufen, sortiert nach Nachname und Vorname.
        $sql = "SELECT * FROM kunde ORDER BY nachname, vorname";
        // Ausführen der Abfrage (hier wird kein Prepared Statement benötigt, da keine Variablen eingebunden werden)
        $stmt = $this->conn->query($sql);
        // Rückgabe der Ergebnisse als assoziatives Array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Liest einen einzelnen Kunden anhand der Kunden-ID aus.
     *
     * @param int $kundeId ID des Kunden.
     * @return array Gibt den Datensatz als assoziatives Array zurück oder false, falls kein Datensatz gefunden wurde.
     */
    public function readOne($kundeId) {
        // SQL-Abfrage, um einen bestimmten Kunden anhand der Kunden-ID abzurufen.
        $sql = "SELECT * FROM kunde WHERE kundeId = :kundeId";
        $stmt = $this->conn->prepare($sql);
        // Bindung der Kunden-ID an den Platzhalter
        $stmt->bindParam(':kundeId', $kundeId, PDO::PARAM_INT);
        $stmt->execute();
        // Rückgabe des Ergebnisses als assoziatives Array.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Erstellt einen neuen Kunden-Datensatz in der Datenbank.
     *
     * @param string $nachname       Nachname des Kunden.
     * @param string $vorname        Vorname des Kunden.
     * @param string $email          E-Mail-Adresse des Kunden.
     * @param string $lieblingsgericht Lieblingsgericht des Kunden.
     * @param string $plz            Postleitzahl.
     * @param string $ort            Wohnort.
     * @param string $strasse        Straße.
     * @param string $strassennr     Hausnummer.
     * @param string $telefonnr      Telefonnummer.
     * @return bool                  Gibt true zurück, wenn der Eintrag erfolgreich erstellt wurde.
     */
    public function create($nachname, $vorname, $email, $lieblingsgericht, $plz, $ort, $strasse, $strassennr, $telefonnr) {
        // SQL-Statement zum Einfügen eines neuen Kunden in die Tabelle 'kunde'
        $sql = "INSERT INTO kunde (nachname, vorname, email, lieblingsgericht, plz, ort, strasse, strassennr, telefonnr)
                VALUES (:nachname, :vorname, :email, :lieblingsgericht, :plz, :ort, :strasse, :strassennr, :telefonnr)";
        $stmt = $this->conn->prepare($sql);
        // Bindung der Parameter an die Platzhalter im SQL-Statement.
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':lieblingsgericht', $lieblingsgericht);
        $stmt->bindParam(':plz', $plz);
        $stmt->bindParam(':ort', $ort);
        $stmt->bindParam(':strasse', $strasse);
        $stmt->bindParam(':strassennr', $strassennr);
        $stmt->bindParam(':telefonnr', $telefonnr);
        // Ausführen des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }

    /**
     * Aktualisiert einen bestehenden Kunden-Datensatz in der Datenbank.
     *
     * @param int    $kundeId        ID des zu aktualisierenden Kunden.
     * @param string $nachname       Neuer Nachname.
     * @param string $vorname        Neuer Vorname.
     * @param string $email          Neue E-Mail-Adresse.
     * @param string $lieblingsgericht Neues Lieblingsgericht.
     * @param string $plz            Neue Postleitzahl.
     * @param string $ort            Neuer Wohnort.
     * @param string $strasse        Neue Straße.
     * @param string $strassennr     Neue Hausnummer.
     * @param string $telefonnr      Neue Telefonnummer.
     * @return bool                  Gibt true zurück, wenn das Update erfolgreich war.
     */
    public function update($kundeId, $nachname, $vorname, $email, $lieblingsgericht, $plz, $ort, $strasse, $strassennr, $telefonnr) {
        // SQL-Statement zum Aktualisieren eines bestehenden Kunden-Datensatzes.
        $sql = "UPDATE kunde
                SET nachname = :nachname,
                    vorname = :vorname,
                    email = :email,
                    lieblingsgericht = :lieblingsgericht,
                    plz = :plz,
                    ort = :ort,
                    strasse = :strasse,
                    strassennr = :strassennr,
                    telefonnr = :telefonnr
                WHERE kundeId = :kundeId";
        $stmt = $this->conn->prepare($sql);
        // Bindung der neuen Werte an die entsprechenden Platzhalter.
        $stmt->bindParam(':nachname', $nachname);
        $stmt->bindParam(':vorname', $vorname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':lieblingsgericht', $lieblingsgericht);
        $stmt->bindParam(':plz', $plz);
        $stmt->bindParam(':ort', $ort);
        $stmt->bindParam(':strasse', $strasse);
        $stmt->bindParam(':strassennr', $strassennr);
        $stmt->bindParam(':telefonnr', $telefonnr);
        // Bindung der Kunden-ID, um den richtigen Datensatz zu aktualisieren.
        $stmt->bindParam(':kundeId', $kundeId, PDO::PARAM_INT);
        // Ausführen des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }

    /**
     * Sucht nach Kunden anhand eines Suchbegriffs.
     *
     * Diese Methode durchsucht verschiedene Felder (Nachname, Vorname, E-Mail, Ort, Lieblingsgericht und kundeId)
     * nach Übereinstimmungen mit dem Suchbegriff.
     *
     * @param string $term Der Suchbegriff.
     * @return array Gibt ein assoziatives Array der gefundenen Kunden zurück.
     */
    public function search($term) {
        // SQL-Statement zur Suche in mehreren Spalten der Tabelle 'kunde'
        $sql = "SELECT *
                FROM kunde
                WHERE nachname         LIKE :term
                   OR vorname          LIKE :term
                   OR email            LIKE :term
                   OR ort              LIKE :term
                   OR lieblingsgericht LIKE :term
                   OR CAST(kundeId AS CHAR) LIKE :term
                ORDER BY nachname, vorname";
                
        $stmt = $this->conn->prepare($sql);
        // Platzhalter für LIKE-Suche mit Wildcards (%) befüllen.
        $like = '%' . $term . '%';
        $stmt->bindParam(':term', $like, PDO::PARAM_STR);
        $stmt->execute();
        // Rückgabe der gefundenen Datensätze als assoziatives Array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Löscht einen Kunden-Datensatz anhand der Kunden-ID.
     *
     * @param int $kundeId ID des zu löschenden Kunden.
     * @return bool Gibt true zurück, wenn der Löschvorgang erfolgreich war.
     */
    public function delete($kundeId) {
        // SQL-Statement zum Löschen eines Kunden aus der Tabelle 'kunde'
        $sql = "DELETE FROM kunde WHERE kundeId = :kundeId";
        $stmt = $this->conn->prepare($sql);
        // Bindung der Kunden-ID an den Platzhalter.
        $stmt->bindParam(':kundeId', $kundeId, PDO::PARAM_INT);
        // Ausführen des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }
}
