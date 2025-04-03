# Funktion, die prüft, ob eine Zahl gerade (even) ist
def is_even(x):
    return x % 2 == 0

# Liste von Zahlen
numbers = [1, 2, 3, 4, 5, 6]

# Anwenden der filter()-Funktion
result = filter(is_even, numbers)

# Ergebnis in eine Liste umwandeln und anzeigen
print(list(result))  # Ausgabe: [2, 4, 6]

print(is_even(2))


"""
Die filter()-Funktion ist eine eingebaute Funktion in Python.

Sie ermöglicht es, Elemente aus einer Liste oder einem anderen iterierbaren 
Objekt herauszufiltern, die eine bestimmte Bedingung erfüllen.

Gibt ein filter-Objekt zurück, das iteriert werden kann.

filter(function, iterable)
function: Eine Funktion, die auf jedes Element angewendet wird und True oder False zurückgibt.
iterable: Eine Liste, ein Tuple oder ein anderes iterierbares Objekt, das gefiltert werden soll.

filter() ist besonders nützlich, wenn große Datenmengen effizient gefiltert werden müssen.

"""
