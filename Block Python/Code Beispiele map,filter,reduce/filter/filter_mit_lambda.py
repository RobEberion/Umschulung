# Liste von Zahlen
numbers = [1, 2, 3, 4, 5, 6]

# Anwenden der filter()-Funktion mit einer Lambda-Funktion, um ungerade (odd number) Zahlen zu filtern
result = filter(lambda x: x % 2 != 0, numbers)

# Ergebnis in eine Liste umwandeln und anzeigen
print(list(result))  # Ausgabe: [1, 3, 5]
