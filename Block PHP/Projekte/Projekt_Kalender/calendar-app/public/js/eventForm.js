// Warte, bis das gesamte DOM geladen ist, bevor der Code ausgeführt wird
document.addEventListener('DOMContentLoaded', async () => {
  // Hole das Formular-Element anhand seiner ID
  const form = document.getElementById('event-form');
  // Lese URL-Parameter aus der aktuellen URL, um zu prüfen, ob eine eventId vorhanden ist (Bearbeitungsmodus)
  const params = new URLSearchParams(window.location.search);
  const eventId = params.get('eventId');

  // Hole Referenzen zu den relevanten Formularfeldern
  const allDayCheckbox = document.getElementById('allDay');
  const startInput = document.getElementById('startInput');
  const endInput = document.getElementById('endInput');

  // Listener: Wenn das "Ganztägig"-Kontrollkästchen geändert wird
  allDayCheckbox.addEventListener('change', () => {
    if (allDayCheckbox.checked) {
      // Wenn "Ganztägig" aktiviert ist:
      // Speichere die aktuellen Werte von Start- und Enddatum, bevor der Input-Typ geändert wird
      const currentStart = startInput.value;
      const currentEnd = endInput.value;
      // Ändere den Input-Typ von "datetime-local" zu "date", um nur das Datum zu erfassen
      startInput.type = 'date';
      endInput.type = 'date';
      // Falls bereits ein Wert vorhanden ist, extrahiere nur den Datumsanteil (YYYY-MM-DD)
      if (currentStart) {
        startInput.value = currentStart.slice(0, 10);
      }
      if (currentEnd) {
        endInput.value = currentEnd.slice(0, 10);
      }
      // Füge CSS-Klasse hinzu, um das deaktivierte Aussehen zu signalisieren
      startInput.classList.add('disabled-input');
      endInput.classList.add('disabled-input');
    } else {
      // Wenn "Ganztägig" deaktiviert ist:
      // Speichere die aktuellen Datumwerte
      const currentStart = startInput.value;
      const currentEnd = endInput.value;
      // Ändere den Input-Typ zurück zu "datetime-local", um Datum und Uhrzeit zu erfassen
      startInput.type = 'datetime-local';
      endInput.type = 'datetime-local';
      // Falls nur das Datum vorhanden ist (Länge 10), ergänze "T00:00" als Standardzeit
      if (currentStart && currentStart.length === 10) {
        startInput.value = currentStart + "T00:00";
      }
      if (currentEnd && currentEnd.length === 10) {
        endInput.value = currentEnd + "T00:00";
      }
      // Entferne die CSS-Klasse für deaktivierte Eingabefelder
      startInput.classList.remove('disabled-input');
      endInput.classList.remove('disabled-input');
    }
  });

  // Wenn eine eventId vorhanden ist, befinden wir uns im Bearbeitungsmodus
  if (eventId) {
    // Ändere den Formular-Titel, um anzuzeigen, dass ein Termin bearbeitet wird
    document.getElementById('form-title').textContent = 'Termin bearbeiten';
    try {
      // Hole die Event-Daten von der API anhand der eventId
      const res = await fetch(`/api/events/${eventId}`);
      if (!res.ok) throw new Error('Event konnte nicht geladen werden');
      const event = await res.json();

      // Befülle das Formular mit den geladenen Daten
      form.eventId.value = event._id;
      form.titel.value = event.titel;
      form.beschreibung.value = event.beschreibung || '';
      form.ort.value = event.ort || '';

      // Konvertiere event.start und event.ende in ISO-Strings, falls nötig
      let eventStartStr = "";
      let eventEndStr = "";
      if (event.start) {
        eventStartStr = typeof event.start === "string" ? event.start : new Date(event.start).toISOString();
      }
      if (event.ende) {
        eventEndStr = typeof event.ende === "string" ? event.ende : new Date(event.ende).toISOString();
      }

      // Prüfe, ob der Termin ganztägig ist: Wenn der Zeitanteil "00:00" ist, wird er als ganztägig interpretiert
      const isAllDay = eventStartStr.slice(11,16) === "00:00";
      if (isAllDay) {
        // Falls ganztägig, setze das Kontrollkästchen und passe die Input-Typen sowie die Werte an
        allDayCheckbox.checked = true;
        startInput.type = 'date';
        endInput.type = 'date';
        startInput.classList.add('disabled-input');
        endInput.classList.add('disabled-input');
        // Setze nur den Datumsanteil (YYYY-MM-DD) in die Inputs
        startInput.value = eventStartStr.slice(0, 10);
        if (eventEndStr) {
          endInput.value = eventEndStr.slice(0, 10);
        }
      } else {
        // Falls nicht ganztägig, nutze den "datetime-local"-Typ und setze Datum und Uhrzeit (bis Minuten) ein
        startInput.type = 'datetime-local';
        endInput.type = 'datetime-local';
        startInput.value = eventStartStr.slice(0, 16);
        if (eventEndStr) {
          endInput.value = eventEndStr.slice(0, 16);
        }
      }
    } catch (err) {
      console.error('Fehler beim Laden des Termins:', err);
      alert('Fehler beim Laden des Termins. Bitte versuche es erneut.');
    }
  }

  // Beim Absenden des Formulars
  form.addEventListener('submit', async (e) => {
    // Verhindere das Standardverhalten (Seitenreload)
    e.preventDefault();
    // Erstelle ein FormData-Objekt aus dem Formular
    const formData = new FormData(form);
    let startValue = formData.get('start');
    let endValue = formData.get('ende');
    // Wenn "Ganztägig" aktiviert ist, setze den Start auf 00:00 und das Ende auf 23:59
    if (allDayCheckbox.checked) {
      startValue = startValue ? startValue + "T00:00" : "";
      endValue = endValue ? endValue + "T23:59" : "";
    }
    // Erstelle ein Objekt mit den zu speichernden Event-Daten
    const eventData = {
      titel: formData.get('titel'),
      beschreibung: formData.get('beschreibung'),
      start: startValue,
      ende: endValue,
      ort: formData.get('ort')
    };

    try {
      // Wenn eine eventId vorhanden ist, führe ein Update (PUT) aus
      if (formData.get('eventId')) {
        await fetch(`/api/events/${formData.get('eventId')}`, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(eventData)
        });
      } else {
        // Andernfalls, erstelle einen neuen Termin (POST)
        await fetch('/api/events', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(eventData)
        });
      }
      // Nach erfolgreichem Speichern: Zurück zur Hauptseite navigieren
      location.href = '/';
    } catch (err) {
      console.error('Fehler beim Speichern des Termins:', err);
      alert('Fehler beim Speichern des Termins. Bitte versuche es erneut.');
    }
  });

  // Listener für den "Abbrechen"-Button: Navigiere zurück zur Hauptseite
  document.getElementById('cancel-btn').addEventListener('click', () => {
    location.href = '/';
  });
});
