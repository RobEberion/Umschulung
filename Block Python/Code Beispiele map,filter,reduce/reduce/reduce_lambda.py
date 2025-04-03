from functools import reduce

# Liste von Zahlen
numbers = [1, 2, 3, 4, 5]

# Verwenden von reduce, um das Produkt der Zahlen in der Liste zu berechnen
result = reduce(lambda x, y: x * y, numbers)

# Ergebnis anzeigen
print(result)  # Ausgabe: 120
