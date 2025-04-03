
# Funktion zur Verdopplung eines Wertes
def doppeln(x):
    return x * 2


# Liste von Zahlen
numbers = [1, 2, 3, 4, 5]

# Anwenden der map()-Funktion
result = map(doppeln, numbers)

print(result)
# Ergebnis in eine Liste umwandeln und anzeigen
print(list(result))  # Ausgabe: [2, 4, 6, 8, 10]

"""
Die map()-Funktion ist ein eingebautes Funktion in Python.

Sie ermöglicht es, eine Funktion auf jedes Element einer Liste 
(oder eines anderen iterierbaren Objekts) anzuwenden.

Gibt ein map-Objekt zurück, das iteriert werden kann.

map(function, iterable)

function: Die Funktion, die auf jedes Element angewendet werden soll.
iterable: Eine Liste, ein Tuple oder ein anderes iterierbares Objekt.

Die map()-Funktion kann auch mit mehreren iterierbaren Objekten verwendet werden, indem die Funktion entsprechend viele Argumente akzeptiert.
"""


"""
# Lösung ohne map funktion
# Liste von Zahlen
numbers = [1, 2, 3, 4, 5]

# Leere Liste, um die Ergebnisse zu speichern
result = []

# Schleife durch jedes Element in der Liste
for x in numbers:
    # Multipliziere jedes Element mit 2 und speichere es in der Ergebnisliste
    result.append(x * 2)

# Ergebnis anzeigen
print(result)  # Ausgabe: [2, 4, 6, 8, 10]

"""