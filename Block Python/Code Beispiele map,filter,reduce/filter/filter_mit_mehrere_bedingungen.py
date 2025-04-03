# Liste von Zahlen
numbers = [10, 15, 20, 25, 30, 35, 40]

# Anwenden der filter()-Funktion, um Zahlen zu filtern, die sowohl gerade als auch größer als 20 sind
result = filter(lambda x: x % 2 == 0 and x > 20, numbers)

# Ergebnis in eine Liste umwandeln und anzeigen
print(list(result))  # Ausgabe: [30, 40]




# Mit List Comprehension
result_listcomp = [x for x in numbers if x % 2 == 0 and x > 20]
print(result_listcomp)

# List Comprehensions bieten eine alternative Methode zum Filtern von Listen,
# sind aber oft weniger speichereffizient als filter().
