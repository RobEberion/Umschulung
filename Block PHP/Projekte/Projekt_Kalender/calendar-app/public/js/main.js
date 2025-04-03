// Funktion zur Aktualisierung der Anzeige des aktuellen Datums und der Uhrzeit
function updateDateTime() {
  // Erstelle ein neues Date-Objekt mit dem aktuellen Datum und Uhrzeit
  const now = new Date();
  // Formatiere das Datum und die Uhrzeit als lokal formatierte Zeichenkette
  const dateTimeString = now.toLocaleString();
  // Setze den Textinhalt des Elements mit der ID "current-date-time" auf die formatierte Zeichenkette
  document.getElementById('current-date-time').textContent = dateTimeString;
}
// Rufe die Funktion sofort auf, um die Anzeige initial zu setzen
updateDateTime();
// Aktualisiere die Datum- und Uhrzeitanzeige jede Sekunde
setInterval(updateDateTime, 1000);

// Funktion zum Formatieren eines Datumsstrings, passend für Input-Felder vom Typ "datetime-local"
function formatDateForInput(dateString) {
  if (!dateString) return "";
  const date = new Date(dateString);
  // ISO-String hat das Format "YYYY-MM-DDTHH:MM:SS.sssZ". Hier wird auf "YYYY-MM-DDTHH:MM" gekürzt.
  return date.toISOString().slice(0, 16);
}

// Funktion zur Generierung des Kalenders
// Parameter:
// - events: Array von Event-Objekten
// - year: Optional, das anzuzeigende Jahr (falls nicht angegeben, wird das aktuelle Jahr verwendet)
// - month: Optional, der anzuzeigende Monat (falls nicht angegeben, wird der aktuelle Monat verwendet)
function generateCalendar(events = [], year = null, month = null) {
  const now = new Date();
  const currentYear = year || now.getFullYear();
  // Falls month null ist, wird der aktuelle Monat genutzt (0-basiert)
  const currentMonth = month !== null ? month : now.getMonth();
  const today = new Date();

  // Hole den Kalender-Container und lösche dessen bisherigen Inhalt
  const calendarContainer = document.getElementById('calendar');
  calendarContainer.innerHTML = '';

  // Erstelle den Header des Kalenders mit Navigations-Buttons und Monatsanzeige
  const header = document.createElement('div');
  header.classList.add('calendar-header');

  // Erstelle den Button für den vorherigen Monat
  const prevBtn = document.createElement('button');
  prevBtn.textContent = '<';
  prevBtn.id = 'prev-month';
  prevBtn.classList.add('nav-btn');
  header.appendChild(prevBtn);

  // Erstelle das Element zur Anzeige des aktuellen Monats und Jahres
  const monthDisplay = document.createElement('div');
  monthDisplay.classList.add('month-display');
  const monthNames = [
    "Januar", "Februar", "März", "April", "Mai", "Juni",
    "Juli", "August", "September", "Oktober", "November", "Dezember"
  ];
  monthDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;
  header.appendChild(monthDisplay);

  // Erstelle den Button für den nächsten Monat
  const nextBtn = document.createElement('button');
  nextBtn.textContent = '>';
  nextBtn.id = 'next-month';
  nextBtn.classList.add('nav-btn');
  header.appendChild(nextBtn);

  // Füge den Header dem Kalendercontainer hinzu
  calendarContainer.appendChild(header);

  // 1. Erstelle den Wochentage-Header
  const dayNames = ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"];
  const daysHeader = document.createElement('div');
  daysHeader.classList.add('calendar-day-names');
  // Erstelle für jeden Wochentag ein Element und füge es hinzu
  dayNames.forEach(dayName => {
    const dayElem = document.createElement('div');
    dayElem.classList.add('calendar-day-name');
    dayElem.textContent = dayName;
    daysHeader.appendChild(dayElem);
  });
  // Füge den Wochentage-Header zum Kalendercontainer hinzu
  calendarContainer.appendChild(daysHeader);

  // 2. Bestimme, an welchen Tagen Events vorhanden sind
  const daysWithEvents = {};
  events.forEach(event => {
    const eventDate = new Date(event.start);
    // Prüfe, ob das Event im aktuellen Jahr und Monat liegt
    if (
      eventDate.getFullYear() === currentYear &&
      eventDate.getMonth() === currentMonth
    ) {
      // Markiere den Tag als Event-Tag
      const day = eventDate.getDate();
      daysWithEvents[day] = true;
    }
  });

  // 3. Erstelle das Kalender-Gitter
  const grid = document.createElement('div');
  grid.classList.add('calendar-grid');

  // Bestimme den Wochentag des ersten Tages des Monats
  // JavaScript's getDay() liefert 0 für Sonntag, 1 für Montag etc.
  let firstDay = new Date(currentYear, currentMonth, 1).getDay();
  if (firstDay === 0) firstDay = 7; // Behandle Sonntag als 7, damit Montag als erster Tag erscheint

  // Füge leere Zellen hinzu, um die Tage vor dem 1. des Monats auszugleichen
  for (let i = 1; i < firstDay; i++) {
    const emptyCell = document.createElement('div');
    emptyCell.classList.add('calendar-cell', 'empty');
    grid.appendChild(emptyCell);
  }

  // Füge alle Tage des Monats als Zellen hinzu
  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  for (let day = 1; day <= daysInMonth; day++) {
    const cell = document.createElement('div');
    cell.classList.add('calendar-cell');
    cell.textContent = day;

    // Hebe den heutigen Tag hervor, wenn der Kalender den aktuellen Monat und das aktuelle Jahr anzeigt
    if (
      day === today.getDate() &&
      currentMonth === today.getMonth() &&
      currentYear === today.getFullYear()
    ) {
      cell.classList.add('today');
    }

    // Wenn an diesem Tag ein Event vorhanden ist, füge eine Markierung hinzu
    if (daysWithEvents[day]) {
      cell.classList.add('has-event');
      const marker = document.createElement('div');
      marker.classList.add('event-marker');
      cell.appendChild(marker);
    }

    // Füge die Zelle dem Gitter hinzu
    grid.appendChild(cell);
  }
  // Füge das gesamte Gitter zum Kalendercontainer hinzu
  calendarContainer.appendChild(grid);

  // Füge Event Listener zu den Navigations-Buttons hinzu, um zwischen Monaten zu wechseln

  // Für den vorherigen Monat
  prevBtn.addEventListener('click', () => {
    let newMonth = currentMonth - 1;
    let newYear = currentYear;
    // Falls der Monat kleiner als 0 ist, gehe zum Dezember des Vorjahres
    if (newMonth < 0) {
      newMonth = 11;
      newYear--;
    }
    // Erzeuge den Kalender neu mit den aktualisierten Parametern
    generateCalendar(events, newYear, newMonth);
  });

  // Für den nächsten Monat
  nextBtn.addEventListener('click', () => {
    let newMonth = currentMonth + 1;
    let newYear = currentYear;
    // Falls der Monat größer als 11 ist, gehe zum Januar des nächsten Jahres
    if (newMonth > 11) {
      newMonth = 0;
      newYear++;
    }
    // Erzeuge den Kalender neu mit den aktualisierten Parametern
    generateCalendar(events, newYear, newMonth);
  });
}

// Kalender generieren, Events laden und Event-Handling einrichten, sobald das DOM vollständig geladen ist
document.addEventListener('DOMContentLoaded', () => {
  // Hole die HTML-Elemente für die Event-Liste und den Button zum Erstellen eines neuen Events
  const eventList = document.getElementById('event-list');
  const createBtn = document.getElementById('create-event-btn');

  // Asynchrone Funktion zum Laden der Events von der API
  const loadEvents = async () => {
    try {
      // Hole alle Events von der API
      const res = await fetch('/api/events');
      const events = await res.json();

      // Aktualisiere die Event-Liste: Leere den bisherigen Inhalt
      eventList.innerHTML = '';
      // Iteriere über alle geladenen Events und erstelle Listeneinträge
      events.forEach(event => {
        const li = document.createElement('li');
        // Setze Datenattribute für das Event, um später auf Details zugreifen zu können
        li.dataset.id = event._id;
        li.dataset.titel = event.titel;
        li.dataset.beschreibung = event.beschreibung || '';
        li.dataset.start = event.start;
        li.dataset.ende = event.ende || '';
        li.dataset.ort = event.ort || '';
        // Setze den inneren HTML-Inhalt des Listeneintrags mit Event-Details und Schaltflächen
        li.innerHTML = `
          <h2>${event.titel}</h2>
          <p>${event.beschreibung || ''}</p>
          <p>Start: ${new Date(event.start).toLocaleString()}</p>
          ${ event.ende ? `<p>Ende: ${new Date(event.ende).toLocaleString()}</p>` : '' }
          ${ event.ort ? `<p>Ort: ${event.ort}</p>` : '' }
          <button class="edit-btn">Bearbeiten</button>
          <button class="delete-btn">Löschen</button>
        `;
        // Füge den Listeneintrag der Event-Liste hinzu
        eventList.appendChild(li);
      });

      // Generiere den Kalender neu, wobei die geladenen Events berücksichtigt werden
      generateCalendar(events);
    } catch (err) {
      console.error('Fehler beim Laden der Ereignisse:', err);
    }
  };

  // Beim Klick auf den "Neuen Termin erstellen"-Button wird zur Formularseite navigiert
  createBtn.addEventListener('click', () => {
    location.href = '/eventForm.html';
  });

  // Verwende Event-Delegation, um Klicks auf Edit- und Delete-Buttons in der Event-Liste zu verarbeiten
  eventList.addEventListener('click', async (e) => {
    // Ermittle das nächste übergeordnete <li>-Element, falls auf ein untergeordnetes Element geklickt wurde
    const li = e.target.closest('li');
    if (!li) return;
    const id = li.dataset.id;

    // Falls der "Löschen"-Button geklickt wurde
    if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
      try {
        // Sende eine DELETE-Anfrage an die API, um das Event zu löschen
        await fetch(`/api/events/${id}`, { method: 'DELETE' });
        // Lade die Events neu, um die Aktualisierung in der Anzeige widerzuspiegeln
        loadEvents();
      } catch (err) {
        console.error('Fehler beim Löschen des Ereignisses:', err);
      }
    }
    // Falls der "Bearbeiten"-Button geklickt wurde
    else if (e.target.classList.contains('edit-btn') || e.target.closest('.edit-btn')) {
      // Navigiere zur Formularseite und übergebe die Event-ID als URL-Parameter
      location.href = `/eventForm.html?eventId=${id}`;
    }
  });

  // Lade die Events initial beim Laden der Seite
  loadEvents();
});
