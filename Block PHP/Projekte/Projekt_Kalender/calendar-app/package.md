{
  // Der Name des Projekts, der im npm-Repository angezeigt wird
  "name": "calendar-app",
  

  // Die Versionsnummer des Projekts nach Semantic Versioning
  "version": "1.0.0",
  

  // Der Einstiegspunkt der Anwendung (kann von den Start-Skripten überschrieben werden)
  "main": "index.js",
  

  // Skripte, die mit npm ausgeführt werden können
  "scripts": {
    // Startet den Server mit Node.js, indem die Datei server.js ausgeführt wird
    "start": "node server.js",
    // Startet den Server im Entwicklungsmodus mit Nodemon, was automatische Neustarts bei Codeänderungen ermöglicht
    "dev": "nodemon server.js"
  },
  

  // Eine Liste von Schlagwörtern, die das Projekt beschreiben (derzeit leer)
  "keywords": [],
  

  // Der Autor des Projekts (hier leer, kann ergänzt werden)
  "author": "",
  

  // Die Lizenz, unter der das Projekt veröffentlicht wird (z.B. ISC, MIT, etc.)
  "license": "ISC",
  

  // Eine kurze Beschreibung des Projekts (derzeit leer)
  "description": "",
  

  // Produktionsabhängigkeiten: Diese Pakete werden benötigt, damit die Anwendung im Betrieb funktioniert
  "dependencies": {
    // "cors": Ermöglicht Cross-Origin Resource Sharing, sodass Anfragen von anderen Domains akzeptiert werden
    "cors": "^2.8.5",
    // "ejs": Template Engine zum dynamischen Erzeugen von HTML-Seiten
    "ejs": "^3.1.10",
    // "express": Webframework für Node.js, das das Erstellen von Servern und APIs vereinfacht
    "express": "^4.21.2",
    // "mongoose": ODM (Object Data Modeling) für MongoDB, das den Umgang mit der Datenbank erleichtert
    "mongoose": "^8.11.0"
  },
  
  
  // Entwicklungsabhängigkeiten: Diese Pakete werden nur während der Entwicklung benötigt
  "devDependencies": {
    // "nodemon": Tool, das den Node.js-Server automatisch neu startet, wenn Codeänderungen erkannt werden
    "nodemon": "^3.1.9"
  }
}
