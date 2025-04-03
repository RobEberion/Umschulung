<?php
// 1. Neues DOMDocument erstellen
$dom = new DOMDocument('1.0', 'UTF-8');

// 2. Whitespace-Einstellungen und automatische Formatierung aktivieren
$dom->preserveWhiteSpace = false;  // Entfernt überflüssige Leerzeichen/Zeilenumbrüche
$dom->formatOutput       = true;   // Aktiviert automatisches Einrücken

// 3. Vorhandene XML-Datei laden
$dom->load('buecher.xml');

// Optional: Wenn du dem Dokument eine Kodierung zuweisen möchtest
$dom->encoding = 'UTF-8';

// 4. Die formatierten Inhalte in eine neue Datei (oder die gleiche) schreiben
$dom->save('buecher_formatiert.xml');

echo "Die formatierten XML-Daten wurden in buecher_formatiert.xml gespeichert.";
