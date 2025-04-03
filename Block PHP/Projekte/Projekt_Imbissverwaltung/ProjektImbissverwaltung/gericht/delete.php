<?php
// gericht/delete.php

// Einbinden der Datei, die die Gericht-Klasse enthält, welche alle CRUD-Operationen für Gerichte kapselt.
require_once __DIR__ . '/../_classes/Gericht.php';

// Überprüfen, ob die gerichtId per GET-Parameter übergeben wurde.
// Falls nicht, erfolgt eine Weiterleitung zur Übersichtsseite (index.php).
if (!isset($_GET['gerichtId'])) {
    header('Location: index.php');
    exit;
}

// Die gerichtId wird aus dem GET-Parameter gelesen und in einen Integer konvertiert.
$gerichtId = (int) $_GET['gerichtId'];

// Erzeugen eines neuen Objekts der Klasse Gericht.
// Hinweis: Achte darauf, dass der Klassenname korrekt geschrieben wird (z.B. "Gericht").
$gerichtObj = new Gericht();

// Aufruf der delete()-Methode, um den Gerichtseintrag anhand der übergebenen gerichtId zu löschen.
$gerichtObj->delete($gerichtId);

// Nach dem Löschen erfolgt eine Weiterleitung zur Übersichtsseite (z. B. gericht/index.php).
header('Location: index.php');
exit;
?>
