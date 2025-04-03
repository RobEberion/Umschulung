// Importiere das Express-Modul, um Routen und Middleware zu erstellen
const express = require('express');
// Erstelle einen neuen Router, der für die Event-Routen verwendet wird
const router = express.Router();
// Importiere das Event-Model, das den Zugriff auf die Event-Daten in der Datenbank ermöglicht
const Event = require('../models/Event');

// GET: Alle Ereignisse abrufen, sortiert nach Startdatum
router.get('/', async (req, res) => {
  try {
    // Finde alle Events in der Datenbank und sortiere sie nach dem "start"-Feld in aufsteigender Reihenfolge
    const events = await Event.find().sort({ start: 1 });
    // Sende die gefundenen Events als JSON-Antwort an den Client
    res.json(events);
  } catch (err) {
    // Bei einem Fehler: Sende einen HTTP-Statuscode 500 (Serverfehler) und die Fehlermeldung als JSON
    res.status(500).json({ error: err.message });
  }
});

// GET: Einzelnes Ereignis anhand der ID abrufen
router.get('/:id', async (req, res) => {
  try {
    // Suche das Event anhand der ID, die in den URL-Parametern übergeben wurde
    const event = await Event.findById(req.params.id);
    // Falls kein Event gefunden wird, sende einen HTTP-Statuscode 404 (Nicht gefunden) mit entsprechender Fehlermeldung
    if (!event) {
      return res.status(404).json({ error: 'Event nicht gefunden' });
    }
    // Sende das gefundene Event als JSON-Antwort
    res.json(event);
  } catch (err) {
    // Bei einem Fehler: Sende einen HTTP-Statuscode 500 (Serverfehler) und die Fehlermeldung als JSON
    res.status(500).json({ error: err.message });
  }
});

// POST: Neues Ereignis erstellen
router.post('/', async (req, res) => {
  // Extrahiere die benötigten Felder aus dem Request-Body
  const { titel, beschreibung, start, ende, ort } = req.body;
  try {
    // Erstelle ein neues Event in der Datenbank mit den angegebenen Daten
    const neuesEvent = await Event.create({ titel, beschreibung, start, ende, ort });
    // Sende einen HTTP-Statuscode 201 (Erstellt) und das neu erstellte Event als JSON-Antwort
    res.status(201).json(neuesEvent);
  } catch (err) {
    // Bei einem Fehler (z. B. Validierungsfehler): Sende einen HTTP-Statuscode 400 (Bad Request) und die Fehlermeldung als JSON
    res.status(400).json({ error: err.message });
  }
});

// PUT: Ein bestehendes Ereignis aktualisieren (mit allen Feldern, die übergeben werden)
router.put('/:id', async (req, res) => {
  // Extrahiere die Event-ID aus den URL-Parametern
  const { id } = req.params;
  try {
    // Aktualisiere das Event in der Datenbank anhand der ID mit den im Request-Body übergebenen Daten
    // Die Option { new: true } sorgt dafür, dass das aktualisierte Dokument zurückgegeben wird
    const updatedEvent = await Event.findByIdAndUpdate(id, req.body, { new: true });
    // Sende das aktualisierte Event als JSON-Antwort
    res.json(updatedEvent);
  } catch (err) {
    // Bei einem Fehler: Sende einen HTTP-Statuscode 400 (Bad Request) und die Fehlermeldung als JSON
    res.status(400).json({ error: err.message });
  }
});

// DELETE: Ein Ereignis löschen
router.delete('/:id', async (req, res) => {
  // Extrahiere die Event-ID aus den URL-Parametern
  const { id } = req.params;
  try {
    // Lösche das Event in der Datenbank anhand der ID
    const deletedEvent = await Event.findByIdAndDelete(id);
    // Sende das gelöschte Event als JSON-Antwort zurück
    res.json(deletedEvent);
  } catch (err) {
    // Bei einem Fehler: Sende einen HTTP-Statuscode 500 (Serverfehler) und die Fehlermeldung als JSON
    res.status(500).json({ error: err.message });
  }
});

// Exportiere den Router, damit er in anderen Teilen der Anwendung (z. B. in server.js) eingebunden werden kann
module.exports = router;
