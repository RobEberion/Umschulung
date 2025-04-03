<!DOCTYPE html>
<html lang="de">
<head>
    <!-- Zeichensatz festlegen, um Sonderzeichen korrekt darzustellen -->
    <meta charset="UTF-8">
    <!-- Seitentitel, der im Browser-Tab angezeigt wird -->
    <title>Imbissverwaltung - Startseite</title>
    <!-- Einbinden der externen CSS-Datei, die das Layout und Design der Seite definiert -->
    <link rel="stylesheet" type="text/css" href="../_css/styles.css">
</head>
<body>
    <!-- Einbinden der Navigationsleiste aus einem externen PHP-Fragment.
         Dadurch wird eine zentrale Navigation genutzt, die in mehreren Seiten wiederverwendet werden kann. -->
    <?php require_once __DIR__ . '/../_include/navigation.inc.php';?>

    <!-- Hauptcontainer für alle Inhalte der Seite -->
    <div class="container">
        <br>
        <!-- Überschriftencontainer, der den Seitentitel und einen Einführungstext enthält -->
        <div class="ueberschrift-container">
            <!-- Überschrift mit einem hervorgehobenen Teil (class "highlight") -->
            <h1>Willkommen in der <span class="highlight">Imbissverwaltung!</span></h1>
            <!-- Einleitungstext, der dem Benutzer erklärt, wie er die Seite nutzen kann -->
            <p>Dies ist die zentrale Übersicht. Wähle einen Bereich aus oder nutze das Navigationsmenü oben:</p>
        </div>
        <br>
        <!-- Liste der Links zu den verschiedenen Verwaltungsbereichen -->
        <ul class="link-list">
            <!-- Jeder Listeneintrag enthält einen Link, der als Button (durch die CSS-Klasse "button") gestaltet ist.
                 Diese Links führen zu den jeweiligen Verwaltungsseiten für Köche, Kunden, Rezepte, Gerichte und Bestellungen. -->
            <li><a href="../koch/index.php" class="button">Köche verwalten</a></li>
            <li><a href="../kunde/index.php" class="button">Kunden verwalten</a></li>
            <li><a href="../rezept/index.php" class="button">Rezepte verwalten</a></li>
            <li><a href="../gericht/index.php" class="button">Gerichte verwalten</a></li>
            <li><a href="../bestellung/index.php" class="button">Bestellungen verwalten</a></li>
        </ul>
    </div>
</body>
</html>
