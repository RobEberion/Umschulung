<?php
// koch/delete.php

// Einbinden der Datei, die die Koch-Klasse enthält, welche alle CRUD-Operationen für Koch-Datensätze kapselt.
require_once __DIR__ . '/../_classes/Koch.php';

// Überprüfen, ob die kochId per GET-Parameter übergeben wurde.
// Falls nicht, wird der Benutzer zur Übersichtsseite (index.php) weitergeleitet.
if (!isset($_GET['kochId'])) {
    header('Location: index.php');
    exit;
}

// Die kochId wird aus dem GET-Parameter gelesen und in einen Integer konvertiert.
$kochId = (int) $_GET['kochId'];

// Erzeugen eines neuen Objekts der Klasse Koch.
$kochObj = new Koch();

// Aufruf der delete()-Methode, um den Koch-Datensatz anhand der übergebenen kochId zu löschen.
$kochObj->delete($kochId);

// Nach dem Löschen erfolgt eine Weiterleitung zur Übersichtsseite (z. B. koch/index.php).
header('Location: index.php');
exit;
?>
