/*
Erstelle ein Domainmodell und ein physisches Datenmodell auf Basis der 
bestehenden SQL-Tabellen, um die Datenstruktur und deren Beziehungen darzustellen. 
Entwickle darauf aufbauend ein UX- und UI-Konzept für eine Verwaltungsoberfläche 
(händisch ohne Tool / Zeichnung reicht). Diese soll die Funktionen zum Anlegen, 
Bearbeiten, Löschen und Anzeigen von Datensätzen enthalten und eine intuitive 
sowie effiziente Nutzung ermöglichen.
 
*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: 'kursverwaltung'
CREATE DATABASE IF NOT EXISTS kursverwaltung;
USE kursverwaltung;

--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle 'buchung'
--

CREATE TABLE IF NOT EXISTS buchung (
  bnummer int(11) NOT NULL AUTO_INCREMENT,
  termnr int(10) unsigned NOT NULL,
  tnummer int(10) unsigned NOT NULL,
  PRIMARY KEY (bnummer),
  KEY termnr (termnr,tnummer)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle 'buchung'
--

INSERT INTO buchung (bnummer, termnr, tnummer) VALUES
(8, 1, 1),
(1, 1, 3),
(3, 2, 4),
(7, 2, 5),
(6, 2, 22),
(4, 2, 25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle 'dozenten'
--

CREATE TABLE IF NOT EXISTS dozenten (
  doznr int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  vname varchar(40) DEFAULT NULL,
  plz varchar(5) DEFAULT NULL,
  ort varchar(40) DEFAULT NULL,
  strasse varchar(40) DEFAULT NULL,
  hausnr varchar(5) DEFAULT NULL,
  telefon1 varchar(15) DEFAULT NULL,
  telefon2 varchar(15) DEFAULT NULL,
  email varchar(40) DEFAULT NULL,
  PRIMARY KEY (doznr)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Daten für Tabelle 'dozenten'
--

INSERT INTO dozenten (doznr, name, vname, plz, ort, strasse, hausnr, telefon1, telefon2, email) VALUES
(1, 'Bertram', 'Frank', '72072', 'Tübingen', 'Schillerstraße', '16', '01629587565', '070025465464', 'info@frank-bertram.de'),
(22, 'Bruns', 'Claudia', '20144', 'Hamburg', 'Lange Gasse', '2', '231485566', NULL, 'bruns@gnx.de'),
(23, 'Weber', 'Hubertus', '50124', 'Köln', 'Schillerstraße', '14', '1795544661', '02593556688', 'hweber@tonline.com'),
(24, 'Kalender', 'Sabine', '28355', 'Bremen', 'Gotheweg', '3', '1659955881', '01735656897', 'info@kalender.eu'),
(25, 'Rückert', 'Jörg', '70501', 'Stuttgart', 'Gustav-Mahler-Straße', '152', '71124578', NULL, 'jrueckert@wub.de'),
(26, 'Machowski', 'Michaela', '50667', 'Köln', 'Neumarkt', '10', '1732254789', NULL, 'michaela@machowski.de'),
(27, 'Schmidt', 'Christian', '44141', 'Dortmund', 'Wambeler Hellweg', '99', '231123456', '01735656897', 'kontakt@chr-schmidt.de'),
(28, 'Achenbach', 'Johannes', '20144', 'Hamburg', 'Lange Straße', '23', '40987554', NULL, 'j.achenbach@online.com'),
(29, 'Fischer', 'Bernd', '70501', 'Stuttgart', 'Bahnhofstraße', '67', '1721144556', NULL, 'bernd@fischer-learn.de'),
(30, 'Schuster', 'Elke', '20253', 'Hamburg', 'Grüner Weg', '19', '40118866', NULL, 'elkeschuster@gmy.com'),
(31, 'Schneider', 'Thomas', '50667', 'Köln', 'Rheingasse', '141', '221649731', NULL, 'tomschneider@gnx.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle 'kurs'
--

CREATE TABLE IF NOT EXISTS kurs (
  kursnr int(11) NOT NULL AUTO_INCREMENT,
  ressort varchar(20) DEFAULT NULL,
  titel varchar(40) NOT NULL,
  beschreibung varchar(255) DEFAULT NULL,
  preis decimal(6,2) unsigned DEFAULT NULL,
  PRIMARY KEY (kursnr)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle 'kurs'
--

INSERT INTO kurs (kursnr, ressort, titel, beschreibung, preis) VALUES
(1, 'EDV', 'Einführung Datenbanken', NULL, '399.50'),
(2, 'EDV', 'Einführung in Visual Basic', 'Einführung in die Programmierung mit Visual Basic (Visual Studio 2013)', '459.50'),
(3, 'KAUFM', 'Bilanzbuchhaltung ', 'Grundlagen Teil 1', '599.00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle 'teilnehmer'
--

CREATE TABLE IF NOT EXISTS teilnehmer (
  tnummer int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  vname varchar(40) DEFAULT NULL,
  plz varchar(5) DEFAULT NULL,
  ort varchar(40) DEFAULT NULL,
  strasse varchar(40) DEFAULT NULL,
  hausnr varchar(5) DEFAULT NULL,
  telefon1 varchar(15) DEFAULT NULL,
  telefon2 varchar(15) DEFAULT NULL,
  email varchar(40) DEFAULT NULL,
  PRIMARY KEY (tnummer)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Daten für Tabelle 'teilnehmer'
--

INSERT INTO teilnehmer (tnummer, name, vname, plz, ort, strasse, hausnr, telefon1, telefon2, email) VALUES
(1, 'Müller', 'Fritz', '55667', 'Münster', 'Lange Straße', '24a', '', '', 'fritz@mueller.de'),
(2, 'Maier', 'Josef', '44141', 'Dortmund', 'Hansemannstraße ', '47', '0231445566', '', 'meier@abc.de'),
(3, 'Rüschmann', 'Reiner', '50124', 'Köln', 'Am Dom', '14', '01625544661', NULL, NULL),
(4, 'Bender', 'Claudia', '28355', 'Bremen', 'Weserstraße', '3', '01759955881', NULL, 'c.bender@tonline.com'),
(5, 'Seidel', 'Martina', '70501', 'Stuttgart', 'Gustav-Mahler-Straße', '153', '070124578', '01625696963', 'info@seidel.de'),
(6, 'Müller', 'Frank', '50667', 'Köln', 'Heumarkt', '10', '01732254789', NULL, 'fmueller@gmy.de'),
(7, 'Schmidt', 'Olaf', '20537', 'Hamburg', 'Abendrothsweg', '99', '040123456', NULL, 'derolaf@wub.de'),
(8, 'Köster', 'Christine', '20144', 'Hamburg', 'Lange Straße', '23', '040987654', NULL, NULL),
(9, 'Borowski', 'Thomas', '28456', 'Bremen', 'Kurze Straße', '1', '01651144556', '+491725544668', 'tombo@hitmail.com'),
(10, 'Schulze', 'Klaus', '44357', 'Dortmund', 'Mengeder Straße', '648', '0231998866', '007', 'k.schulze@tonline.com'),
(11, 'Schneider', 'Stefanie', '50667', 'Köln', 'Rheingasse', '2', '0221649731', NULL, 'steffi72@wub.de'),
(21, 'Schulze', 'Fritz', '39108', 'Magdeburg', 'Hagebuttenplatz', '5', '039201214', '', 'fschulze@wub.de'),
(22, 'Teuber', 'Anke', '44556', 'Essen', 'Kettwicher Straße', '66', '020123568', '01732545878', 'anke@teuber.tv'),
(25, 'Wiklinski', 'Hans-Peter', '14556', 'Berlin', 'Schöne Straße', '56', '02012121555', '0124578566', 'wiki@leikuss.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle 'termine'
--

CREATE TABLE IF NOT EXISTS termine (
  termnr int(11) NOT NULL AUTO_INCREMENT,
  kursnr int(11) DEFAULT NULL,
  doznr int(11) DEFAULT NULL,
  beginn date DEFAULT NULL,
  ende date DEFAULT NULL,
  dauer varchar(20) DEFAULT NULL,
  minanzahl int(11) DEFAULT NULL,
  maxanzahl int(11) DEFAULT NULL,
  vort varchar(40) DEFAULT NULL,
  PRIMARY KEY (termnr)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle 'termine'
--

INSERT INTO termine (termnr, kursnr, doznr, beginn, ende, dauer, minanzahl, maxanzahl, vort) VALUES
(1, 1, 22, '2014-08-26', '2014-08-27', '16', 5, 12, 'SEMEDV 1'),
(2, 1, 22, '2014-09-15', '2014-09-17', '24', 5, 12, 'SEMEDV 1'),
(6, 3, 27, '2014-11-26', '2014-11-28', '24', 4, 15, 'SEMKFM1'),
(7, 1, 23, '2014-11-16', '2014-11-17', '16', 5, 12, 'SEMEDV2'),
(8, 2, 26, '0000-00-00', '0000-00-00', '', 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
