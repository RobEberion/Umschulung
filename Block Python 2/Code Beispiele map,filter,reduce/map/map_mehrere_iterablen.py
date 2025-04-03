# Zwei Listen von Zahlen
numbers1 = [1, 2, 3]
numbers2 = [4, 5, 6]


# Funktion zur Addition von zwei Werten
def add(x, y):
    return x + y


# Anwenden der map()-Funktion mit zwei Listen
# result = map(add, numbers1, numbers2)
result = map(lambda x, y: x + y, numbers1, numbers2)


print(result)
# Ergebnis in eine Liste umwandeln und anzeigen
print(list(result))  # Ausgabe: [5, 7, 9]
