# Calendar App – Schritt-für-Schritt Anleitung (Ohne detaillierten Code)

Diese Anleitung bietet einen Überblick über die notwendigen Schritte zur Einrichtung einer einfachen Kalender-App mit Node.js, Express, MongoDB und EJS – ohne in die Detailimplementierung des Codes zu gehen.

---

## 1. Projektinitialisierung

### a) Projektordner erstellen und initialisieren
- Erstelle einen neuen Ordner, z. B. `calendar-app`.
- Öffne diesen Ordner im Terminal/Command Prompt.
- Initialisiere ein neues Node‑Projekt (z. B. mit `npm init -y`).

### b) Benötigte Abhängigkeiten installieren
- Installiere die Module: **express**, **mongoose**, **cors** und **ejs**.
- Optional: Installiere **nodemon** als Dev‑Abhängigkeit für automatischen Neustart.
- Passe den `scripts`‑Abschnitt in der `package.json` an, um den Server zu starten.

---

## 2. Projektstruktur anlegen

Lege die folgende Struktur an:

- **server.js**  
  Hauptdatei für den Express‑Server.

- **models/Event.js**  
  Enthält das Mongoose‑Modell für Kalender‑Ereignisse.

- **routes/events.js**  
  Express‑Router zur Implementierung der CRUD‑Operationen (Erstellen, Abrufen, Aktualisieren, Löschen von Events).

- **views/index.ejs**  
  EJS‑Template, das die Startseite rendert.

- **public/**  
  Enthält statische Dateien:
  - **css/style.css**: Stylesheet für die App.
  - **js/main.js**: Optional, für clientseitiges JavaScript.

- **package.json**  
  Enthält Projektdetails und Skripte.

---

## 3. Backend-Implementierung

### a) Express‑Setup & MongoDB-Verbindung in `server.js`
- Konfiguriere den Express‑Server mit den notwendigen Middlewares (z. B. CORS, JSON‑Parsing).
- Setze EJS als Template‑Engine und richte statische Dateien ein.
- Stelle die Verbindung zu einer lokalen MongoDB-Datenbank her.
- Binde den Router für die Event‑Operationen ein.
- Definiere eine Route für die Startseite, die das EJS‑Template rendert.

### b) Mongoose‑Modell in `models/Event.js`
- Definiere ein Schema für Events mit Feldern wie **title**, **date** und **description**.
- Exportiere das Modell zur Verwendung in anderen Modulen.

### c) Express‑Router in `routes/events.js`
- Implementiere CRUD‑Operationen:
  - Abrufen aller Events.
  - Erstellen eines neuen Events.
  - Abrufen, Aktualisieren und Löschen eines bestimmten Events.
- Nutze Middleware, um einzelne Events anhand ihrer ID zu laden.

---

## 4. Frontend-Implementierung

### a) EJS‑Template in `views/index.ejs`
- Erstelle ein einfaches Template, das die Startseite der App darstellt.
- Binde das Stylesheet und optional das clientseitige JavaScript ein.

### b) Clientseitiges JavaScript in `public/js/main.js` (optional)
- Implementiere Logik, um über die API vorhandene Events abzurufen und anzuzeigen.

### c) CSS in `public/css/style.css`
- Definiere grundlegende Styles für die App, um ein ansprechendes Layout zu erreichen.

---

## 5. Anwendung starten und testen

### a) MongoDB starten
- Stelle sicher, dass der MongoDB-Dienst (z. B. über `mongod`) läuft.

### b) Server starten
- Starte den Server mit dem entsprechenden npm‑Befehl (z. B. `npm run dev` für nodemon oder `npm start`).

### c) Aufruf im Browser
- Öffne deinen Browser und rufe `http://localhost:3000/` auf, um die Anwendung zu testen.  
  - Bei der EJS‑basierten Lösung wird die Startseite gerendert und vorhandene Events (sofern in der Datenbank) angezeigt.
  - Für eine React‑basierte Lösung müssten das Setup und die Integration in `index.html` sowie der React‑Code entsprechend angepasst werden.

---

Diese Übersicht fasst die notwendigen Schritte zusammen, um eine einfache Kalender-App zu erstellen – ohne in die Details der Codeimplementierung zu gehen.
