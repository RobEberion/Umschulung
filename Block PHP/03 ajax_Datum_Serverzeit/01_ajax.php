<?php
function serverZeit() {
    // Datum und Uhrzeit im Format "Tag.Monat.Jahr Stunde:Minute:Sekunde"
    return date("l, d. F Y H:i:s (T)");

}

/* function serverZeit() {
    // Datum und Uhrzeit
    $wochentagEnglisch = date("l"); // Wochentag auf Englisch
    $monatEnglisch = date("F");    // Monat auf Englisch
    $datum = date("d");            // Tag
    $jahr = date("Y");             // Jahr
    $uhrzeit = date("H:i:s");      // Uhrzeit
    $zeitzone = date("T");         // Zeitzone (z. B. CET)

    // Übersetzung von Englisch nach Deutsch
    $wochentage = [
        "Monday" => "Montag", "Tuesday" => "Dienstag", "Wednesday" => "Mittwoch",
        "Thursday" => "Donnerstag", "Friday" => "Freitag", "Saturday" => "Samstag", "Sunday" => "Sonntag"
    ];
    $monate = [
        "January" => "Januar", "February" => "Februar", "March" => "März",
        "April" => "April", "May" => "Mai", "June" => "Juni",
        "July" => "Juli", "August" => "August", "September" => "September",
        "October" => "Oktober", "November" => "November", "December" => "Dezember"
    ];

    // Übersetzte Werte
    $wochentag = $wochentage[$wochentagEnglisch] ?? $wochentagEnglisch;
    $monat = $monate[$monatEnglisch] ?? $monatEnglisch;

    // Zusammensetzen der Rückgabe
    return "$wochentag, $datum. $monat $jahr $uhrzeit ($zeitzone)";
} */

require_once "Sajax.php";
sajax_init();
sajax_export("serverZeit");
sajax_handle_client_request();
?>
<html>
<head>
  <title>PHP und JavaScript</title>
  <script type="text/javascript">

        <?php 
            sajax_show_javascript(); 
            ?>

        function zeigeServerZeit() {
             // AJAX-Aufruf an die serverZeit-Funktion
            x_serverZeit(serverZeit_callback);
            setTimeout(zeigeServerZeit, 1000); // Aktualisierung jede Sekunde
        }

        function serverZeit_callback(ergebnis) {
            // Rückgabe in das HTML-Element "zeit" einfügen
            document.getElementById("zeit").innerHTML = ergebnis;
        }

        zeigeServerZeit();
  </script>
</head>
<body>
<p id="zeit"></p>
</body>
</html>
