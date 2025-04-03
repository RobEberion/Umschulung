from functools import reduce

# Liste von Zahlen
numbers = [1, 2, 3, 4, 5]


# Funktion, die zwei Zahlen addiert
def add(x, y):
    return x + y


# Verwenden von reduce, um die Summe der Zahlen in der Liste zu berechnen
result = reduce(add, numbers)

# Ergebnis anzeigen
print(result)  # Ausgabe: 15

"""
Die reduce()-Funktion ist Teil des Moduls functools in Python und wird verwendet, 
um eine Operation auf alle Elemente eines iterierbaren Objekts (wie einer Liste) anzuwenden, 
um sie zu einem einzigen Wert zu reduzieren. 

Dabei wird eine angegebene Funktion sukzessive
 auf die Elemente des iterierbaren Objekts angewendet, sodass jedes Mal zwei Elemente zu einem
neuen Ergebnis zusammengefasst werden. 

Dieser Prozess wird wiederholt, bis nur noch ein einziger Wert übrig bleibt.

from functools import reduce

reduce(function, iterable[, initializer])
    function: Eine Funktion, die zwei Argumente akzeptiert. Diese Funktion wird wiederholt auf die Elemente des iterierbaren Objekts angewendet.
    iterable: Ein iterierbares Objekt (z. B. eine Liste), dessen Elemente reduziert werden sollen.
    initializer (optional): Ein optionaler Startwert, der als erstes Argument an die Funktion übergeben wird.
"""
