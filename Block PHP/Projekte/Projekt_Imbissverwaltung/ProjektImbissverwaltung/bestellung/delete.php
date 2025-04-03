<?php
// bestellung/delete.php

// Einbinden der Bestellungs-Klasse, die alle CRUD-Operationen für Bestellungen kapselt.
require_once __DIR__ . '/../_classes/Bestellung.php';

// Überprüfen, ob der GET-Parameter "bestellungId" vorhanden ist.
// Falls nicht, wird der Benutzer zur Übersichtsseite (index.php) weitergeleitet.
if (!isset($_GET['bestellungId'])) {
    header('Location: index.php');
    exit;
}

// Die bestellungId wird aus dem GET-Parameter gelesen und in einen Integer konvertiert.
$bestellungId = (int) $_GET['bestellungId'];

// Erzeugen eines neuen Objekts der Klasse Bestellung.
$bestellungObj = new Bestellung();

// Aufruf der delete()-Methode, um den entsprechenden Bestellungseintrag in der Datenbank zu löschen.
$bestellungObj->delete($bestellungId);

// Nach erfolgreichem Löschen erfolgt eine Weiterleitung zur Übersichtsseite.
header('Location: index.php');
exit;
?>
