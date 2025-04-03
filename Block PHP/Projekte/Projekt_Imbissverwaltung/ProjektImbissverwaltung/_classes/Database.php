<?php

/**
 * Klasse Database
 * 
 * Diese Klasse stellt die Verbindung zur MySQL-Datenbank her, 
 * indem sie ein Singleton-Muster für das PDO-Objekt verwendet.
 */
class Database {
    // Datenbank-Zugangsdaten, bitte entsprechend der Umgebung anpassen:
    private static $dbHost = 'localhost';       // Hostname oder IP-Adresse des Datenbankservers
    private static $dbName = 'imbissverwaltung';  // Name der Datenbank
    private static $dbUser = 'root';              // Datenbank-Benutzername
    private static $dbPass = '';                  // Passwort des Datenbank-Benutzers

    // Statisches PDO-Objekt, um eine einzige Verbindung während der gesamten Laufzeit zu gewährleisten.
    private static $conn = null;

    /**
     * Stellt eine Verbindung zur Datenbank her.
     * 
     * Wenn noch keine Verbindung besteht, wird eine neue PDO-Verbindung aufgebaut.
     * Andernfalls wird die bestehende Verbindung zurückgegeben.
     *
     * @return PDO Gibt das PDO-Datenbankobjekt zurück.
     */
    public static function connect() {
        // Überprüfen, ob bereits eine Verbindung besteht
        if (self::$conn === null) {
            try {
                // Erstellen des DSN (Data Source Name) für die MySQL-Verbindung mit UTF-8 Unterstützung.
                $dsn = 'mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName . ';charset=utf8mb4';

                // Erzeugen des PDO-Objekts mit den Zugangsdaten
                self::$conn = new PDO($dsn, self::$dbUser, self::$dbPass);

                // Setzen des PDO-Fehlermodus auf Exception, damit bei Fehlern eine Exception geworfen wird.
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Falls die Verbindung fehlschlägt, wird eine Fehlermeldung ausgegeben
                // Hinweis: In einer produktiven Umgebung sollte diese Meldung in ein Log geschrieben werden
                echo "Fehler bei der DB-Verbindung: " . $e->getMessage();
                exit;
            }
        }
        // Rückgabe des PDO-Objekts, entweder neu erstellt oder bereits bestehend.
        return self::$conn;
    }

    /**
     * Trennt die bestehende Datenbankverbindung.
     * 
     * Durch das Setzen von self::$conn auf null wird die Verbindung geschlossen.
     */
    public static function disconnect() {
        // Verbindung schließen, indem das PDO-Objekt auf null gesetzt wird.
        self::$conn = null;
    }
}
