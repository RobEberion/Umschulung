<?php
session_start(); // Session starten, um Benutzerdaten zu speichern
require_once __DIR__ . '/../_classes/User.php'; // Einbinden der User-Klasse, die CRUD-Operationen für Benutzer kapselt

// Überprüfen, ob das Formular per POST gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzername (oder E-Mail) und Passwort aus dem POST-Array auslesen
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Neues User-Objekt erzeugen
    $userObj = new User();
    // Benutzer anhand des Benutzernamens oder der E-Mail suchen
    $user = $userObj->findByUsername($username);

    // Überprüfen, ob ein Benutzer gefunden wurde und ob das eingegebene Passwort mit dem gespeicherten Hash übereinstimmt
    if ($user && password_verify($password, $user['password'])) {
        // Login erfolgreich: Setze Session-Variablen
        $_SESSION['userId'] = $user['userId'];
        $_SESSION['username'] = $user['username'];
        // Weiterleitung zur Startseite (z. B. main/index.php)
        header('Location: ../main/index.php');
        exit;
    } else {
        // Falls die Authentifizierung fehlschlägt, wird eine Fehlermeldung gesetzt
        $error = "Ungültiger Benutzername oder Passwort";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Einbinden der externen CSS-Datei für das Seitenlayout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Container für die Überschrift -->
        <div class="ueberschrift-container">
            <h1>Login</h1>
        </div>
        <!-- Container für das Formular -->
        <div class="edit-container">
            <!-- Anzeige der Fehlermeldung, falls vorhanden -->
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <!-- Login-Formular -->
            <form method="post">
                <label>Benutzername oder E-Mail:
                    <br>
                    <input type="text" name="username" required>
                </label>
                <br><br>
                <label>Passwort:
                    <br>
                    <input type="password" name="password" required>
                </label>
                <br><br><br>
                <button type="submit">Login</button>
            </form>
            <br>
            <!-- Link zur Registrierungsseite -->
            <p>Noch nicht registriert?</p>
            <a href="register.php">Hier registrieren</a>
        </div>
    </div>
</body>
</html>
