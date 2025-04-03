-- ============================================================== 
-- 1) Basic Settings
-- ============================================================== 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- ============================================================== 
-- 2) Create Database and switch to it
-- ============================================================== 
CREATE DATABASE IF NOT EXISTS imbissverwaltung
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_general_ci;

USE imbissverwaltung;

-- ============================================================== 
-- Zusatz: Tabelle für Login-Funktionalität
-- ============================================================== 
CREATE TABLE IF NOT EXISTS user (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Passwort-Hash
    role ENUM('admin','user') DEFAULT 'user'
) ENGINE=InnoDB;

-- Beispiel: Admin-Benutzer einfügen (das Passwort muss mit password_hash() erzeugt werden)
-- Hier ein Beispiel-Passworthash (ersetze den Beispiel-Hash durch einen echten Hash, z. B. via password_hash("adminpass", PASSWORD_DEFAULT))
INSERT INTO user (username, email, password, role)
VALUES ('admin', 'admin@example.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFx/XYjPco6uT6G4v6J9LInN21hBr0ei', 'admin');

-- ============================================================== 
-- 3) Table: koch
-- ============================================================== 
CREATE TABLE IF NOT EXISTS koch (
    kochId INT AUTO_INCREMENT PRIMARY KEY,
    nachname VARCHAR(50) NOT NULL,
    vorname VARCHAR(50) NOT NULL,
    sterne ENUM('1', '2', '3') DEFAULT '1',
    age INT,
    geschlecht ENUM('männlich', 'weiblich', 'geschlechtsneutral') DEFAULT 'geschlechtsneutral',
    spezialgebiet VARCHAR(255)
);

-- 3a) Insert Daten in koch
INSERT INTO koch (nachname, vorname, sterne, age, geschlecht, spezialgebiet)
VALUES
    ('Meier', 'Klaus', '3', 45, 'männlich', 'Hauptspeisen'),
    ('Schmidt', 'Julia', '1', 38, 'weiblich', 'Desserts'),
    ('Weber', 'Anna', '2', 25, 'geschlechtsneutral', 'Suppen'),
    ('Möller', 'Timo', '3', 39, 'männlich', 'Grill'),
    ('Kaiser', 'Sarah', '2', 29, 'weiblich', 'Backen'),
    ('Braun', 'Lea', '1', 19, 'weiblich', 'Vegan'),
    ('Fischer', 'Fabian', '3', 42, 'männlich', 'Fleisch'),
    ('Wolf', 'Marion', '3', 54, 'weiblich', 'Rohkost'),
    ('Beck', 'Jonas', '2', 22, 'männlich', 'Snacks'),
    ('Krause', 'Maria', '3', 31, 'weiblich', 'Salate');

-- ============================================================== 
-- 4) Table: kunde
-- ============================================================== 
CREATE TABLE IF NOT EXISTS kunde (
    kundeId INT AUTO_INCREMENT PRIMARY KEY,
    nachname VARCHAR(50) NOT NULL,
    vorname VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    lieblingsgericht VARCHAR(255),
    plz VARCHAR(10),
    ort VARCHAR(50),
    strasse VARCHAR(50),
    strassennr VARCHAR(10),
    telefonnr VARCHAR(20)
);

-- 4a) Insert Daten in kunde
INSERT INTO kunde (nachname, vorname, email, lieblingsgericht, plz, ort, strasse, strassennr, telefonnr)
VALUES
    ('Maier',   'Tina',     'tina.maier@example.com',    'Sushi',        '98765', 'Neustadt',     'Ringstr',  '12', '012341234'),
    ('Schulz',  'Peter',    'peter.schulz@example.com',  'Pizza',        '11111', 'Altstadt',     'Allee',    '7',  '098765432'),
    ('Becker',  'Johanna',  'johanna.becker@example.com','Spaghetti',    '22222', 'Feldstadt',    'Mitte',    '4',  '012349876'),
    ('Krüger',  'Michael',  'michael.krueger@example.com','Burger',       '33333', 'Sonnenburg',   'Bahnhof',  '18','015159753'),
    ('König',   'Daniela',  'daniela.koenig@example.com','Tiramisu',      '44444', 'Waldheim',     'Bergweg',  '22','017212345'),
    ('Vogel',   'Stefan',   'stefan.vogel@example.com',  'Steak',         '55555', 'Kleinau',      'Dorfstr',  '9', '013579246'),
    ('Braun',   'Jana',     'jana.braun@example.com',    'Salat',         '66666', 'Großrode',     'Hauptweg', '11','016132165'),
    ('Richter', 'Martin',   'martin.richter@example.com','Lasagne',       '77777', 'Blumenau',     'Rosenweg', '2', '017987654'),
    ('Seifert', 'Nina',     'nina.seifert@example.com',  'Gulasch',       '88888', 'Wiesenort',    'Feldweg',  '15','014458866'),
    ('Lehmann', 'Sven',     'sven.lehmann@example.com',  'Chili con Carne','99999','Heidedorf',     'Heideweg', '30','015234779'),
    ('Werner',  'Katharina','katharina.werner@example.com','Ramen',       '10000', 'Nordhausen',   'Uferstr',   '3','012390011'),
    ('Huber',   'Leon',     'leon.huber@example.com',      'Pancakes',    '10101', 'Westheim',      'Weststr',   '7','012399121'),
    ('Koch',    'Laura',    'laura.koch@example.com',      'Suppe',       '10202', 'Seeburg',       'Seestr',    '6','017211233'),
    ('Jäger',   'Tim',      'tim.jaeger@example.com',      'Curry',       '10303', 'Flussstadt',    'Auenweg',   '9','015512555'),
    ('Wolf',    'Theresa',  'theresa.wolf@example.com',    'Quiche',      '10404', 'Steintal',      'Steinweg',  '1','017711144'),
    ('Krause',  'Jonas',    'jonas.krause@example.com',    'Wraps',       '10505', 'Hügelstadt',    'Höhenstr',  '12','013356466'),
    ('Walter',  'Emma',     'emma.walter@example.com',     'Fisch',       '10606', 'Torfingen',     'Moordamm',  '5','015559911'),
    ('Lang',    'Sebastian','sebastian.lang@example.com',  'Fondue',      '10707', 'Mühlheim',      'Mühle',     '3','018822555'),
    ('Kuhn',    'Marie',    'marie.kuhn@example.com',      'Kaiserschmarrn','10808','Eichenau',     'Eichstr',   '7','016778899'),
    ('Schmitt', 'Philipp',  'philipp.schmitt@example.com', 'Döner',       '10909', 'Breitenfeld',   'Bergstr',   '9','016888888'),
    ('Brandt',  'Leonie',   'leonie.brandt@example.com',   'Schnitzel',   '11011', 'Hafenstadt',    'Leuchtturm','5','014459866'),
    ('Sauer',   'Paul',     'paul.sauer@example.com',       'Hotdog',      '11112', 'Regenburg',     'Nassweg',   '6','017300123'),
    ('Pohl',    'Lisa',     'lisa.pohl@example.com',        'Burrito',     '11223', 'Weitendorf',    'Weitstr',   '20','012387452'),
    ('Ziegler', 'Erik',     'erik.ziegler@example.com',     'Eis',         '11334', 'Schneeburg',    'Frostgasse','1','017211200'),
    ('Engel',   'Sophie',   'sophie.engel@example.com',     'Sandwich',    '11445', 'Talhausen',     'Talstr',    '18','017123321'),
    ('Horn',    'Tobias',   'tobias.horn@example.com',      'Donuts',      '11556', 'Gipfelstadt',   'Berggasse', '2','016712368'),
    ('Busch',   'Sabrina',  'sabrina.busch@example.com',    'Grünkohl',    '11667', 'Kohlhausen',    'Kohlgasse', '22','014454321'),
    ('Bergmann','Oliver',   'oliver.bergmann@example.com',  'Enchiladas',  '11778', 'Felsenau',      'Felspfad',  '19','015512987'),
    ('Albrecht','Sabrina',  'sabrina.albrecht@example.com', 'Risotto',     '11889', 'Wasserburg',    'Seestr',    '3','017445566'),
    ('Roth',    'Florian',  'florian.roth@example.com',     'Falafel',     '11990', 'Holzhausen',    'Waldweg',   '8','016632144');

-- ============================================================== 
-- 5) Table: rezept
-- ============================================================== 
CREATE TABLE IF NOT EXISTS rezept (
    rezeptId INT AUTO_INCREMENT PRIMARY KEY,
    rezeptname VARCHAR(100) NOT NULL,
    dauer INT,
    speiseart VARCHAR(50),
    rezeptbeschreibung TEXT
);

-- 5a) Insert Daten in rezept
INSERT INTO rezept (rezeptname, dauer, speiseart, rezeptbeschreibung)
VALUES
    ('Spaghetti Bolognese', 30, 'Pasta', 'Spaghetti mit Hackfleischsoße und Tomaten.'),
    ('Pfannkuchen', 20, 'Dessert', 'Fluffige Pfannkuchen, serviert mit Ahornsirup.'),
    ('Tomatensuppe', 25, 'Suppe', 'Cremige Tomatensuppe mit frischem Basilikum.'),
    ('Pizza Margherita', 15, 'Pizza', 'Klassische Pizza mit Tomaten, Mozzarella und Basilikum.'),
    ('Sushi', 45, 'Asiatisch', 'Ausgewählte Sushi-Rollen mit frischem Fisch und Reis.'),
    ('Currywurst', 10, 'Snack', 'Gegrillte Wurst mit würziger Curryketchup-Soße.'),
    ('Salat Nicoise', 20, 'Salat', 'Frischer Salat mit Thunfisch, Eiern und Oliven.'),
    ('Chicken Curry', 35, 'Asiatisch', 'Hähnchencurry mit Kokosmilch und aromatischen Gewürzen.'),
    ('Beef Stroganoff', 40, 'Fleisch', 'Rindfleischstreifen in cremiger Pilzsoße.'),
    ('Lasagne', 50, 'Pasta', 'Schichtweise aufgebaute Lasagne mit Fleischsoße und Béchamelsauce.'),
    ('Ratatouille', 30, 'Gemüse', 'Französischer Gemüseeintopf mit Aubergine, Zucchini und Tomaten.'),
    ('Hamburger', 20, 'Fast Food', 'Saftiger Burger mit Rindfleisch, Salat, Tomate und Käse.'),
    ('Griechischer Salat', 15, 'Salat', 'Salat mit Feta, Oliven, Gurken und Tomaten.'),
    ('Paella', 60, 'Reisgericht', 'Spanisches Reisgericht mit Meeresfrüchten, Hähnchen und Gemüse.'),
    ('Tacos', 25, 'Mexikanisch', 'Weiche Tortillas gefüllt mit gewürztem Rindfleisch, Salat und Salsa.'),
    ('Fajitas', 30, 'Mexikanisch', 'Gegrilltes Fleisch mit Paprika und Zwiebeln in Tortillas.'),
    ('Minestrone', 35, 'Suppe', 'Italienische Gemüsesuppe mit Pasta und Bohnen.'),
    ('Chili con Carne', 45, 'Eintopf', 'Würziger Rindfleisch-Eintopf mit Bohnen und Tomaten.'),
    ('Quiche Lorraine', 40, 'Herzhaft', 'Herzhafte Quiche mit Speck, Eiern und Käse.'),
    ('Crêpes', 20, 'Dessert', 'Feine französische Crêpes, serviert mit süßen oder herzhaften Füllungen.');

-- ============================================================== 
-- 6) Table: gericht
-- ============================================================== 
CREATE TABLE IF NOT EXISTS gericht (
    gerichtId INT AUTO_INCREMENT PRIMARY KEY,
    kochId INT NOT NULL,
    rezeptId INT NOT NULL,
    
    FOREIGN KEY (kochId) REFERENCES koch(kochId)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    FOREIGN KEY (rezeptId) REFERENCES rezept(rezeptId)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- 6a) Insert Daten in gericht
INSERT INTO gericht (kochId, rezeptId)
VALUES
    (1, 1),
    (2, 4),
    (3, 3),
    (4, 8),
    (5, 2),
    (6, 7),
    (7, 9),
    (8, 6),
    (9, 10),
    (10, 5);

-- ============================================================== 
-- 7) Table: bestellung
-- ============================================================== 
CREATE TABLE IF NOT EXISTS bestellung (
    bestellungId INT AUTO_INCREMENT PRIMARY KEY,
    kundeId INT NOT NULL,
    gerichtId INT NOT NULL,
    zeitpunkt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    anzahl INT NOT NULL,
    preis DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    zahlungsart VARCHAR(20) DEFAULT 'bargeld',

    FOREIGN KEY (kundeId) REFERENCES kunde(kundeId)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    
    FOREIGN KEY (gerichtId) REFERENCES gericht(gerichtId)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- 7a) Insert Daten in bestellung
INSERT INTO bestellung (kundeId, gerichtId, anzahl, preis, zahlungsart)
VALUES
    (1, 1, 2, 9.50, 'bargeld'),
    (2, 2, 1, 7.99, 'karte'),
    (3, 3, 3, 12.50, 'bargeld'),
    (4, 4, 1, 15.00, 'karte'),
    (5, 5, 2, 10.00, 'paypal'),
    (6, 6, 1, 8.99, 'bargeld'),
    (7, 7, 2, 11.50, 'karte'),
    (8, 8, 1, 13.25, 'bargeld'),
    (9, 9, 3, 9.99, 'paypal'),
    (10, 10, 2, 14.75, 'karte');
