<?php
// rezept/delete.php

// Einbinden der Datei, die die Rezept-Klasse enthält, welche alle CRUD-Operationen für Rezept-Datensätze kapselt.
require_once __DIR__ . '/../_classes/Rezept.php';

// Überprüfen, ob der GET-Parameter "rezeptId" vorhanden ist. Falls nicht, wird zur Übersichtsseite weitergeleitet.
if (!isset($_GET['rezeptId'])) {
    header('Location: index.php');
    exit;
}

// Den Rezept-Parameter aus dem GET-Array lesen und in einen Integer umwandeln.
$rezeptId = (int) $_GET['rezeptId'];

// Erzeugen eines neuen Objekts der Klasse Rezept.
$rezeptObj = new Rezept();

// Den entsprechenden Rezept-Datensatz anhand der Rezept-ID löschen.
$rezeptObj->delete($rezeptId);

// Nach dem Löschen erfolgt eine Weiterleitung zur Übersichtsseite.
header('Location: index.php');
exit;
?>
