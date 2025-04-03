<?php
// Einbinden der Datei, die die Datenbank-Verbindungslogik enthält.
// Dadurch wird sichergestellt, dass die Verbindung zur Datenbank hergestellt werden kann.
require_once __DIR__ . '/Database.php';

/**
 * Klasse Bestellung
 * 
 * Diese Klasse kapselt alle CRUD-Operationen (Erstellen, Lesen, Aktualisieren, Löschen)
 * für Bestellungen in der Datenbank.
 */
class Bestellung {
    // Eigenschaft, die die Datenbankverbindung speichert.
    private $conn;

    /**
     * Konstruktor: Stellt beim Erstellen eines Objekts der Klasse Bestellung eine Verbindung zur Datenbank her.
     */
    public function __construct() {
        // Verbindung zur Datenbank herstellen, indem die statische Methode connect() der Database-Klasse aufgerufen wird.
        // Das Ergebnis wird in der privaten Eigenschaft $conn gespeichert, sodass alle Methoden darauf zugreifen können.
        $this->conn = Database::connect();
    }

    /**
     * CREATE: Erstellt einen neuen Bestellungseintrag in der Datenbank.
     * 
     * @param int    $kundeId     ID des Kunden, der die Bestellung aufgibt.
     * @param int    $gerichtId   ID des bestellten Gerichts.
     * @param int    $anzahl      Anzahl der bestellten Gerichte.
     * @param float  $preis       Preis der Bestellung.
     * @param string $zahlungsart Zahlungsart (z.B. bargeld, karte, paypal).
     * @return bool               Gibt true zurück, wenn die Ausführung erfolgreich war, andernfalls false.
     */
    public function create($kundeId, $gerichtId, $anzahl, $preis, $zahlungsart) {
        // SQL-Statement zum Einfügen eines neuen Datensatzes in die Tabelle 'bestellung'
        $sql = "INSERT INTO bestellung 
                (kundeId, gerichtId, anzahl, preis, zahlungsart)
                VALUES
                (:kundeId, :gerichtId, :anzahl, :preis, :zahlungsart)";
        
        // Vorbereitung des SQL-Statements als Prepared Statement, um SQL-Injections vorzubeugen.
        $stmt = $this->conn->prepare($sql);
        
        // Binden der Parameter an die Platzhalter im SQL-Statement.
        $stmt->bindParam(':kundeId', $kundeId, PDO::PARAM_INT);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        $stmt->bindParam(':anzahl', $anzahl, PDO::PARAM_INT);
        // Hinweis: Für den Preis wird kein spezieller PDO-Typ (wie z.B. FLOAT) verwendet.
        $stmt->bindParam(':preis', $preis);
        $stmt->bindParam(':zahlungsart', $zahlungsart, PDO::PARAM_STR);
        
        // Ausführen des Prepared Statements und Rückgabe des Ergebnisses (true bei Erfolg, false bei Fehler).
        return $stmt->execute();
    }

    /**
     * READ ALL: Liest alle Bestellungen aus der Datenbank aus.
     * 
     * @return array Enthält alle Bestellungen als assoziatives Array.
     */
    public function readAll() {
        // SQL-Statement zum Abrufen aller Bestellungen, sortiert nach der Bestellung-ID.
        $sql = "SELECT * FROM bestellung ORDER BY bestellungId";
        // Direkte Ausführung des SQL-Statements (ohne Prepared Statement, da keine externen Parameter verwendet werden).
        $stmt = $this->conn->query($sql);
        // Alle Ergebnisse werden als assoziatives Array zurückgegeben.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * READ ONE: Liest einen einzelnen Bestellungseintrag anhand der Bestellung-ID aus.
     * 
     * @param int $bestellungId ID der Bestellung, die abgerufen werden soll.
     * @return array|false    Gibt den Datensatz als assoziatives Array zurück oder false, falls kein Eintrag gefunden wurde.
     */
    public function readOne($bestellungId) {
        // SQL-Statement zum Abrufen eines spezifischen Bestellungseintrags anhand der Bestellung-ID.
        $sql = "SELECT * FROM bestellung WHERE bestellungId = :bestellungId";
        // Vorbereitung des Statements.
        $stmt = $this->conn->prepare($sql);
        // Bindung der Bestellung-ID an den Platzhalter im SQL-Statement.
        $stmt->bindParam(':bestellungId', $bestellungId, PDO::PARAM_INT);
        // Ausführen des Prepared Statements.
        $stmt->execute();
        // Abrufen des Datensatzes als assoziatives Array und Rückgabe.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * UPDATE: Aktualisiert einen bestehenden Bestellungseintrag in der Datenbank.
     * 
     * @param int    $bestellungId ID der Bestellung, die aktualisiert werden soll.
     * @param int    $kundeId      Neue Kunden-ID.
     * @param int    $gerichtId    Neue Gericht-ID.
     * @param int    $anzahl       Neue Anzahl der bestellten Gerichte.
     * @param float  $preis        Neuer Preis.
     * @param string $zahlungsart  Neue Zahlungsart.
     * @return bool                Gibt true zurück, wenn das Update erfolgreich war.
     */
    public function update($bestellungId, $kundeId, $gerichtId, $anzahl, $preis, $zahlungsart) {
        // SQL-Statement zum Aktualisieren eines bestehenden Bestellungseintrags.
        $sql = "UPDATE bestellung
                SET kundeId     = :kundeId,
                    gerichtId   = :gerichtId,
                    anzahl      = :anzahl,
                    preis       = :preis,
                    zahlungsart = :zahlungsart
                WHERE bestellungId = :bestellungId";
        // Vorbereitung des Statements.
        $stmt = $this->conn->prepare($sql);
        // Bindung der Parameter an die Platzhalter im SQL-Statement.
        $stmt->bindParam(':kundeId', $kundeId, PDO::PARAM_INT);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        $stmt->bindParam(':anzahl', $anzahl, PDO::PARAM_INT);
        $stmt->bindParam(':preis', $preis);
        $stmt->bindParam(':zahlungsart', $zahlungsart, PDO::PARAM_STR);
        $stmt->bindParam(':bestellungId', $bestellungId, PDO::PARAM_INT);
        // Ausführen des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }

    /**
     * Gibt den Namen eines Kunden anhand der Kunden-ID zurück.
     * 
     * @param int $kundeId ID des Kunden.
     * @return string     Kundenname im Format "Nachname, Vorname" oder "(Unbekannter Kunde)", wenn kein Datensatz gefunden wurde.
     */
    public function getKundeNameById($kundeId) {
        // SQL-Statement zum Abrufen des Nachnamens und Vornamens aus der Tabelle 'kunde'.
        $sql = "SELECT nachname, vorname FROM kunde WHERE kundeId = :kundeId";
        // Vorbereitung des Statements.
        $stmt = $this->conn->prepare($sql);
        // Bindung der Kunden-ID an den Platzhalter.
        $stmt->bindParam(':kundeId', $kundeId, PDO::PARAM_INT);
        // Ausführen des Statements.
        $stmt->execute();
        // Abrufen des Datensatzes.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Wenn ein Datensatz gefunden wurde, Rückgabe des Namens im Format "Nachname, Vorname".
            return $row['nachname'] . ', ' . $row['vorname'];
        }
        // Wenn kein Datensatz gefunden wurde, Rückgabe eines Standard-Strings.
        return '(Unbekannter Kunde)';
    }

    /**
     * Gibt den Namen des Rezepts zusammen mit dem Nachnamen des Kochs anhand der Gericht-ID zurück.
     * 
     * Vorgehen:
     * 1) Aus der Tabelle 'gericht' werden rezeptId und kochId ermittelt.
     * 2) Mit der rezeptId wird der Rezeptname aus der Tabelle 'rezept' abgerufen.
     * 3) Mit der kochId wird der Nachname des Kochs aus der Tabelle 'koch' abgerufen.
     * 
     * @param int $gerichtId ID des Gerichts.
     * @return string        String im Format "Rezeptname (KochNachname)" oder entsprechende Fehlermeldung, falls nicht gefunden.
     */
    public function getRezeptNameByGerichtId($gerichtId) {
        // 1) Abrufen der rezeptId und kochId aus der Tabelle 'gericht'
        $sqlGericht = "SELECT rezeptId, kochId FROM gericht WHERE gerichtId = :gerichtId";
        $stmt = $this->conn->prepare($sqlGericht);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        $stmt->execute();
        $rowG = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rowG) {
            // Wenn kein Datensatz gefunden wurde, Rückgabe eines Standard-Strings.
            return '(Unbekanntes Gericht)';
        }

        // Speichern der rezeptId in einer Variable
        $rezeptId = $rowG['rezeptId'];
        
        // 2) Abrufen des Rezeptnamens aus der Tabelle 'rezept'
        $sqlRezept = "SELECT rezeptname FROM rezept WHERE rezeptId = :rezeptId";
        $stmt2 = $this->conn->prepare($sqlRezept);
        $stmt2->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        $stmt2->execute();
        $rowR = $stmt2->fetch(PDO::FETCH_ASSOC);
        if (!$rowR) {
            return '(Unbekanntes Rezept)';
        }

        // 3) Optional: Abrufen des Nachnamens des Kochs aus der Tabelle 'koch'
        $sqlKoch = "SELECT nachname FROM koch WHERE kochId = :kochId";
        $stmt3 = $this->conn->prepare($sqlKoch);
        $stmt3->bindParam(':kochId', $rowG['kochId'], PDO::PARAM_INT);
        $stmt3->execute();
        $rowK = $stmt3->fetch(PDO::FETCH_ASSOC);

        // Kombination aus Rezeptname und KochNachname.
        // Falls kein Koch gefunden wurde, wird "(Koch unbekannt)" ausgegeben.
        $rezeptName  = $rowR['rezeptname'];
        $kochNachname= $rowK ? $rowK['nachname'] : '(Koch unbekannt)';

        return $rezeptName . ' (' . $kochNachname . ')';
    }

    /**
     * Liest alle Gerichte mit zugehörigem Rezeptnamen und Kochnachnamen aus.
     * Dies erfolgt durch einen Join auf die Tabellen 'gericht', 'rezept' und 'koch'.
     * 
     * @return array Enthält alle Gerichte als assoziatives Array.
     */
    public function readAllGerichteMitKochName() {
        // SQL-Statement mit JOINs, um Daten aus den Tabellen 'gericht', 'rezept' und 'koch' zu kombinieren.
        // Die Ergebnisse werden nach dem Rezeptnamen sortiert.
        $sql = "SELECT g.gerichtId,
                       r.rezeptname,
                       k.nachname AS kochNachname
                FROM gericht g
                JOIN rezept r ON g.rezeptId = r.rezeptId
                JOIN koch   k ON g.kochId   = k.kochId
                ORDER BY r.rezeptname";
        // Direkte Ausführung des Statements.
        $stmt = $this->conn->query($sql);
        // Rückgabe aller Datensätze als assoziatives Array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Liest alle Kunden aus der Tabelle 'kunde' aus.
     * Dies kann z.B. verwendet werden, um die Kunden in einem Dropdown-Menü anzuzeigen.
     * 
     * @return array Enthält alle Kunden als assoziatives Array, sortiert nach Nachname und Vorname.
     */
    public function readAllKunden() {
        // SQL-Statement zum Abrufen aller Kunden, sortiert nach Nachname und Vornamen.
        $sql = "SELECT kundeId, nachname, vorname FROM kunde ORDER BY nachname, vorname";
        // Direkte Ausführung des Statements.
        $stmt = $this->conn->query($sql);
        // Rückgabe der Ergebnisse als assoziatives Array.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Gibt das Gericht mit dem zugehörigen Koch zurück.
     * 
     * Vorgehen:
     * 1) Ermitteln der kochId und rezeptId aus der Tabelle 'gericht'.
     * 2) Laden des Nachnamens des Kochs aus der Tabelle 'koch'.
     * 3) Laden des Rezeptnamens aus der Tabelle 'rezept'.
     * 4) Kombinieren der Informationen in einem String.
     * 
     * @param int $gerichtId ID des Gerichts.
     * @return string        String im Format "Rezeptname (KochNachname)" oder eine Fehlermeldung, falls das Gericht nicht gefunden wurde.
     */
    public function getGerichtMitKoch($gerichtId) {
        // 1) Abrufen der kochId und rezeptId aus der Tabelle 'gericht'
        $sqlGericht = "SELECT kochId, rezeptId
                       FROM gericht
                       WHERE gerichtId = :gerichtId";
        $stmt = $this->conn->prepare($sqlGericht);
        $stmt->bindParam(':gerichtId', $gerichtId, PDO::PARAM_INT);
        $stmt->execute();
        $rowG = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$rowG) {
            // Wenn kein entsprechendes Gericht gefunden wird, wird ein Standard-String zurückgegeben.
            return '(Unbekanntes Gericht)'; 
        }
    
        // Extrahieren der Koch-ID und Rezept-ID aus dem Ergebnis.
        $kochId   = $rowG['kochId'];
        $rezeptId = $rowG['rezeptId'];
    
        // 2) Abrufen des Nachnamens des Kochs aus der Tabelle 'koch'
        $sqlKoch = "SELECT nachname FROM koch WHERE kochId = :kochId";
        $stmt2 = $this->conn->prepare($sqlKoch);
        $stmt2->bindParam(':kochId', $kochId, PDO::PARAM_INT);
        $stmt2->execute();
        $rowK = $stmt2->fetch(PDO::FETCH_ASSOC);
        // Falls der Koch nicht gefunden wird, wird ein Platzhaltertext verwendet.
        $kochNachname = $rowK ? $rowK['nachname'] : '(Koch unbekannt)';
    
        // 3) Abrufen des Rezeptnamens aus der Tabelle 'rezept'
        $sqlRezept = "SELECT rezeptname FROM rezept WHERE rezeptId = :rezeptId";
        $stmt3 = $this->conn->prepare($sqlRezept);
        $stmt3->bindParam(':rezeptId', $rezeptId, PDO::PARAM_INT);
        $stmt3->execute();
        $rowR = $stmt3->fetch(PDO::FETCH_ASSOC);
        // Falls das Rezept nicht gefunden wird, wird ein Platzhaltertext verwendet.
        $rezeptname = $rowR ? $rowR['rezeptname'] : '(Rezept unbekannt)';
    
        // 4) Kombination der Daten in einem String und Rückgabe.
        return $rezeptname . ' (' . $kochNachname . ')';
    }

    /**
     * DELETE: Löscht einen Bestellungseintrag anhand der Bestellung-ID.
     * 
     * @param int $bestellungId ID des zu löschenden Bestellungseintrags.
     * @return bool             Gibt true zurück, wenn der Löschvorgang erfolgreich war, andernfalls false.
     */
    public function delete($bestellungId) {
        // SQL-Statement zum Löschen eines Bestellungseintrags aus der Tabelle 'bestellung'.
        $sql = "DELETE FROM bestellung WHERE bestellungId = :bestellungId";
        // Vorbereitung des Statements.
        $stmt = $this->conn->prepare($sql);
        // Bindung der Bestellung-ID an den Platzhalter.
        $stmt->bindParam(':bestellungId', $bestellungId, PDO::PARAM_INT);
        // Ausführung des Statements und Rückgabe des Ergebnisses.
        return $stmt->execute();
    }
}
