<?php
session_start();
require_once __DIR__ . '/../_classes/User.php'; // Einbinden der User-Klasse für die Benutzerverwaltung

// Erzeugen eines neuen Objekts der Klasse User
$userObj = new User();

// Prüfen, ob das Formular per POST gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Auslesen der Formulardaten. Falls ein Feld nicht übergeben wird, wird ein leerer String verwendet.
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordRepeat = $_POST['passwordRepeat'] ?? '';

    // Überprüfen, ob beide Passwörter übereinstimmen
    if ($password !== $passwordRepeat) {
        $error = "Die Passwörter stimmen nicht überein.";
    } else {
        // Versuch, den Benutzer in der Datenbank anzulegen. 
        // Die create()-Methode kümmert sich um das Hashen des Passworts.
        if ($userObj->create($username, $email, $password)) {
            // Registrierung erfolgreich: Leite den Benutzer zur Login-Seite weiter
            header('Location: login.php');
            exit;
        } else {
            // Falls die Registrierung fehlschlägt, wird eine Fehlermeldung gesetzt
            $error = "Registrierung fehlgeschlagen. Bitte versuche es erneut.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <!-- Einbinden der CSS-Datei für das Seitenlayout -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Überschriftencontainer -->
        <div class="ueberschrift-container">
            <h1>Registrierung</h1>
        </div>
        <!-- Container für das Formular -->
        <div class="edit-container">
            <!-- Falls ein Fehler auftritt, wird dieser angezeigt -->
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <!-- Registrierungsformular -->
            <form method="post">
                <label>Benutzername:
                    <br>
                    <input type="text" name="username" required>
                </label><br><br>
                <label>Email:
                    <br>
                    <input type="email" name="email" required>
                </label><br><br>
                <label>Passwort:
                    <br>
                    <input type="password" name="password" required>
                </label><br><br>
                <label>Passwort wiederholen:
                    <br>
                    <input type="password" name="passwordRepeat" required>
                </label><br><br><br>
                <button type="submit">Registrieren</button>
            </form>
            <br>
            <!-- Link zum Login, falls der Benutzer bereits registriert ist -->
            <p>Bereits registriert?</p>
            <a href="login.php">Zum Login</a>
        </div>
    </div>
</body>
</html>
