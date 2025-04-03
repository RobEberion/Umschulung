# Liste von Zahlen
numbers = [1, 2, 3, 4, 5]

# Anwenden der map()-Funktion mit einer Lambda-Funktion
result = map(lambda x: x * 2, numbers)

# Ergebnis in eine Liste umwandeln und anzeigen
print(list(result))

# Mit List Comprehension
result_listcomp = [x * 2 for x in numbers]
print(result_listcomp)

# List Comprehensions sind eine Alternative zur map()-Funktion,
# aber map() kann bei großen Datenmengen speichereffizienter sein.
