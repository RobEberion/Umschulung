<?php
// Pfad zur XML-Datei anpassen
$xmlDatei = 'buecher.xml';

// Lade die XML-Datei mit SimpleXML
$xml = simplexml_load_file($xmlDatei) or die('Fehler beim Laden der XML-Datei.');

// Iteriere über alle <buch>-Elemente und gib den Inhalt des <titel>-Elements aus
foreach ($xml->buch as $buch) {
    echo $buch->titel . "<br>";
}
?>
