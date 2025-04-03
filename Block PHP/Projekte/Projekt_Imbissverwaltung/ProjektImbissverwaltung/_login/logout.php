<?php
// Session starten, falls noch nicht geschehen
session_start();

// Zerstört alle Session-Daten
session_destroy();

// Leitet den Benutzer zur Login-Seite weiter
header('Location: ../_login/login.php');
exit;
?>
