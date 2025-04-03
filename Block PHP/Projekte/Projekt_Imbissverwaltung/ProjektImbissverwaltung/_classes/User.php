<?php
// Einbinden der Datei, die die Datenbankverbindung (Database.php) kapselt.
require_once __DIR__ . '/Database.php';

class User {
    // Eigenschaft für die Datenbankverbindung (PDO-Objekt)
    private $conn;

    /**
     * Konstruktor: Stellt eine Verbindung zur Datenbank her.
     * Die Verbindung wird über die statische Methode Database::connect() aufgebaut.
     */
    public function __construct() {
        $this->conn = Database::connect();
    }

    /**
     * Sucht einen Benutzer anhand des Benutzernamens oder der E-Mail.
     *
     * Diese Methode sucht in der Tabelle 'user' nach einem Datensatz, dessen
     * username oder email mit dem übergebenen Parameter übereinstimmt.
     *
     * @param string $username Der Benutzername oder die E-Mail, nach dem gesucht werden soll.
     * @return array|false Gibt den Datensatz als assoziatives Array zurück, wenn ein Benutzer gefunden wurde,
     *                      ansonsten false.
     */
    public function findByUsername($username) {
        // SQL-Abfrage mit Platzhalter, um SQL-Injection zu verhindern.
        $sql = "SELECT * FROM user WHERE username = :username OR email = :username LIMIT 1";
        // Vorbereitung des SQL-Statements.
        $stmt = $this->conn->prepare($sql);
        // Bindung des Parameters ':username' an den übergebenen Wert.
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        // Ausführen des Statements.
        $stmt->execute();
        // Rückgabe des Ergebnisses als assoziatives Array (oder false, wenn kein Datensatz gefunden wurde).
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Erstellt einen neuen Benutzer (Registrierung).
     *
     * Diese Methode nimmt einen Benutzernamen, eine E-Mail und ein Passwort entgegen.
     * Das Passwort wird vor der Speicherung mit password_hash() gehasht.
     *
     * @param string $username Der gewünschte Benutzername.
     * @param string $email Die E-Mail-Adresse des Benutzers.
     * @param string $password Das Passwort (im Klartext), das gehasht wird.
     * @return bool Gibt true zurück, wenn der Benutzer erfolgreich erstellt wurde, andernfalls false.
     */
    public function create($username, $email, $password) {
        // Erzeugen eines Passwort-Hashes
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // SQL-Statement zum Einfügen eines neuen Datensatzes in die Tabelle 'user'
        $sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung der Parameter
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        // Ausführen des Statements und Rückgabe des Ergebnisses (true bei Erfolg, false bei Fehler)
        return $stmt->execute();
    }

    /**
     * Findet einen Benutzer anhand der Benutzer-ID.
     *
     * Diese Methode sucht in der Tabelle 'user' nach einem Datensatz, dessen userId
     * mit dem übergebenen Parameter übereinstimmt.
     *
     * @param int $userId Die ID des Benutzers, der gefunden werden soll.
     * @return array|false Gibt den Datensatz als assoziatives Array zurück, wenn ein Benutzer gefunden wurde,
     *                      ansonsten false.
     */
    public function findById($userId) {
        // SQL-Abfrage mit Platzhalter
        $sql = "SELECT * FROM user WHERE userId = :userId LIMIT 1";
        // Vorbereitung des Statements
        $stmt = $this->conn->prepare($sql);
        // Bindung des Parameters ':userId' an den übergebenen Wert
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        // Ausführen des Statements
        $stmt->execute();
        // Rückgabe des Ergebnisses als assoziatives Array (oder false, wenn kein Datensatz gefunden wurde)
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
