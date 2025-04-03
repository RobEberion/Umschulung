<?php
// kunde/delete.php

// Einbinden der Kunden-Klasse, welche alle CRUD-Operationen für Kundendatensätze kapselt.
require_once __DIR__ . '/../_classes/Kunde.php';

// Überprüfen, ob der GET-Parameter "kundeId" vorhanden ist.
// Falls nicht, wird der Benutzer zur Übersichtsseite weitergeleitet.
if (!isset($_GET['kundeId'])) {
    header('Location: index.php');
    exit;
}

// Die "kundeId" wird aus dem GET-Parameter gelesen und in einen Integer konvertiert.
$kundeId = (int) $_GET['kundeId'];

// Erzeugen eines neuen Objekts der Klasse Kunde.
$kundeObj = new Kunde();

// Aufruf der delete()-Methode, um den entsprechenden Kundendatensatz anhand der "kundeId" zu löschen.
$kundeObj->delete($kundeId);

// Nach erfolgreichem Löschen erfolgt eine Weiterleitung zur Übersichtsseite (z.B. kunde/index.php).
header('Location: index.php');
exit;
?>
