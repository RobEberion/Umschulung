// Importiere das Express-Framework, das zum Erstellen des Webservers verwendet wird.
const express = require('express');
// Importiere Mongoose, um mit MongoDB zu kommunizieren und Schemas zu definieren.
const mongoose = require('mongoose');
// Importiere das cors-Paket, um Cross-Origin Resource Sharing (CORS) zu ermöglichen.
const cors = require('cors');
// Importiere das path-Modul, um Pfade im Dateisystem zu handhaben.
const path = require('path');

// Importiere den Router für die Event-bezogenen Routen aus dem "routes"-Verzeichnis.
const eventsRouter = require('./routes/events');

// Erstelle eine Instanz der Express-Anwendung.
const app = express();

// Setze Middleware ein:
// Erlaube CORS-Anfragen, um Ressourcen von anderen Domains zugänglich zu machen.
app.use(cors());
// Ermögliche das Parsen von JSON-Daten, die im Request-Body gesendet werden.
app.use(express.json());
// Erlaube das Parsen von URL-kodierten Daten (z.B. aus HTML-Formularen), wobei extended: true auch verschachtelte Objekte unterstützt.
app.use(express.urlencoded({ extended: true }));

// Stelle statische Dateien (z.B. CSS, JavaScript, Bilder) aus dem "public"-Ordner bereit.
// Damit können Dateien direkt über den Browser angefragt werden.
app.use(express.static(path.join(__dirname, 'public')));

// Konfiguriere EJS als Template Engine für das Rendering von dynamischen HTML-Seiten.
app.set('view engine', 'ejs');
// Setze das Verzeichnis, in dem sich die EJS-Templates befinden, auf den "views"-Ordner.
app.set('views', path.join(__dirname, 'views'));

// Stelle eine Verbindung zur MongoDB-Datenbank her.
// Der Datenbankname ist "calendar_app", dieser kann bei Bedarf angepasst werden.
// Hinweis: In neueren Versionen des MongoDB-Treibers sind die Optionen useNewUrlParser und useUnifiedTopology nicht mehr zwingend erforderlich.
mongoose.connect('mongodb://127.0.0.1:27017/calendar_app', {
  // Optionen können hier angegeben werden, sind aber nicht zwingend nötig.
})
.then(() => console.log('MongoDB verbunden')) // Bei erfolgreicher Verbindung wird eine Erfolgsmeldung in der Konsole ausgegeben.
.catch(err => console.error('Fehler beim Verbinden:', err)); // Bei einem Verbindungsfehler wird dieser in der Konsole protokolliert.

// Definiere die API-Routen für Kalender-Ereignisse (CRUD-Operationen) und verknüpfe sie mit dem eventsRouter.
// Alle Anfragen, die mit "/api/events" beginnen, werden an den eventsRouter weitergeleitet.
app.use('/api/events', eventsRouter);

// Definiere die Route für die Startseite ("/").
// Diese Route lädt alle Events aus der Datenbank und rendert die "index.ejs"-Datei.
app.get('/', async (req, res) => {
  // Importiere das Event-Modell, um auf die Event-Daten in der MongoDB zugreifen zu können.
  const Event = require('./models/Event');
  try {
    // Finde alle Events in der Datenbank und sortiere sie nach dem "start"-Feld (aufsteigend).
    const events = await Event.find().sort({ start: 1 });
    // Rendere die "index.ejs"-Datei und übergebe das Array der gefundenen Events an das Template.
    res.render('index', { events });
  } catch (err) {
    // Falls ein Fehler beim Laden der Events auftritt, wird dieser in der Konsole ausgegeben.
    console.error('Fehler beim Laden der Events:', err);
    // Rendere die "index.ejs"-Datei mit einem leeren Events-Array, um einen Fehlerzustand abzufangen.
    res.render('index', { events: [] });
  }
});

// Starte den Server:
// Nutze den Port, der in der Umgebungsvariable PORT definiert ist, oder setze ihn auf 3000, wenn keine Variable vorhanden ist.
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  // Sobald der Server startet, wird eine Meldung in der Konsole ausgegeben, die den verwendeten Port anzeigt.
  console.log(`Server läuft auf Port ${PORT}`);
});
