words = ("Banane", "Apfel", "Kirsche")

# Sortieren nach der Länge der Wörter (kürzestes Wort zuerst)
sorted_words_per_length = sorted(words, key=len)
print(sorted_words_per_length)  # Ausgabe: ['Apfel', 'Banane', 'Kirsche']


# Sortieren nach der Länge der Wörter in umgekehrter Reihenfolge (längstes Wort zuerst)
sorted_words_reverse = sorted(words, key=len, reverse=True)
print(sorted_words_reverse)  # Ausgabe: ['Kirsche', 'Banane', 'Apfel']