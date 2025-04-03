// Importiere Mongoose, um mit MongoDB zu kommunizieren und Schemas zu erstellen
const mongoose = require('mongoose');

// Erstelle ein neues Schema für Events, das die Struktur eines Kalender-Ereignisses definiert
const eventSchema = new mongoose.Schema({
  // Definiere das "titel"-Feld (Titel des Events)
  titel: { 
    type: String,      // Der Datentyp ist String
    required: true     // Dieses Feld ist erforderlich und muss bei der Erstellung eines Events angegeben werden
  },
  // Definiere das "beschreibung"-Feld (Beschreibung des Events)
  beschreibung: { 
    type: String       // Der Datentyp ist String (optional)
  },
  // Definiere das "start"-Feld (Startzeitpunkt des Events)
  start: { 
    type: Date,        // Der Datentyp ist Date
    required: true     // Dieses Feld ist erforderlich, um den Beginn des Events festzulegen
  },
  // Definiere das "ende"-Feld (Endzeitpunkt des Events)
  ende: { 
    type: Date         // Der Datentyp ist Date (optional)
  },
  // Definiere das "ort"-Feld (Ort des Events)
  ort: { 
    type: String       // Der Datentyp ist String (optional)
  }
});

// Exportiere das Mongoose Model "Event" basierend auf dem eventSchema.
// Dadurch kann in anderen Teilen der Anwendung auf die Event-Daten zugegriffen werden.
module.exports = mongoose.model('Event', eventSchema);
