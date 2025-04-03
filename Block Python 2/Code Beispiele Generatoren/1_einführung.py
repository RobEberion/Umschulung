# Liste mit Quadraten von Zahlen
#quadrate = [x * x for x in range(5)] # wie Heißt diese Operation?
#print(quadrate)  # Ausgabe: [0, 1, 4, 9, 16]

"""
Pro: Einfach zu verwenden.
Contra: Speichert alle Werte im Speicher.
"""





# Generator für Quadrate von Zahlen

"""
Generatoren sind spezielle Funktionen, die Werte über 'yield' erzeugen.
Sie ermöglichen das Iterieren über große Datenmengen, ohne den gesamten Speicher zu verbrauchen.
Generatoren liefern bei jedem Aufruf der next()-Funktion den nächsten Wert zurück.
"""


def quadrat_generator():
    for x in range(5):
        yield x * x


quadrate_gen = quadrat_generator()
print(quadrate_gen)
print(next(quadrate_gen))
print(next(quadrate_gen))
print(next(quadrate_gen))
print(next(quadrate_gen))
print(next(quadrate_gen))
#print(next(quadrate_gen))


"""
Pro: Speichert nur den aktuellen Wert im Speicher.
Contra: Kann nur einmal durchlaufen werden.
"""

"""
quadrate_gen variable hält keine Werte !!!: 
    Beim Erstellen von quadrate_gen durch die Zuweisung quadrate_gen = quadrat_generator()
    hält counter noch keine Werte.

Werte werden bei Bedarf erzeugt: 
    Die Werte werden erst dann erzeugt, wenn du über den Generator iterierst 
    oder explizit next() aufrufst.
"""

"""
Vorteile von Generatoren:
    Speichereffizienz
    Einfaches Erzeugen von Sequenzen
    Gut geeignet für große Datenmengen und Streaming-Daten.

Wann sollte man Generatoren verwenden?
    Wenn der Speicherverbrauch ein Problem darstellt.
    Wenn nur einmal über die Daten iteriert werden muss.
"""