def zeilenweise_lesen(dateipfad):
    with open(dateipfad, 'r') as datei:
        for zeile in datei:
            yield zeile.strip()


# Erstellen des Generator-Objekts und Zuweisung an die Variable 'zeilen_generator'
zeilen_generator = zeilenweise_lesen('textdatei.txt')



# Iterieren über das Generator-Objekt 'zeilen_generator'
for zeile in zeilen_generator:
    print(zeile)




"""
Initialisierung des Iterators: Wenn du eine for-Schleife über ein iterierbares Objekt (wie eine Liste, ein Generator oder eine Datei) startest, wird im Hintergrund ein Iterator-Objekt erzeugt, falls es nicht bereits ein solches ist.

Automatische next()-Aufrufe: Die for-Schleife ruft intern wiederholt die next()-Methode des Iterators auf, um das nächste Element zu erhalten. Dies geschieht so lange, bis die StopIteration-Ausnahme ausgelöst wird, die das Ende des Iterators signalisiert. An diesem Punkt beendet die for-Schleife die Iteration.

Kein explizites next(): Da die for-Schleife diese Arbeit automatisch übernimmt, musst du next() nicht selbst aufrufen. Das macht den Code einfacher und weniger fehleranfällig.
"""


"""
#Was passiert im Hintergrund:
#Die for-Schleife könnte theoretisch so umgesetzt sein:
# Hier rufen wir next() explizit auf, aber die for-Schleife versteckt diese Details, um den Code sauberer und einfacher lesbar zu machen.
# Dies macht den Code kürzer, einfacher zu lesen und reduziert die Wahrscheinlichkeit von Fehlern, wie z. B. das manuelle Beenden der Schleife bei StopIteration.

zeilen_generator = zeilenweise_lesen('textdatei.txt')
while True:
    try:
        zeile = next(zeilen_generator)
        print(zeile)
    except StopIteration:
        break  # Beendet die Schleife, wenn keine Werte mehr übrig sind

"""