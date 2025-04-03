words = ["Apfel", "Kirsche", "Banane", "Bananen", "Dattel"]
words.sort()
print(words)  #normal sortiert

words.sort(key=len)  # Sortiert nach der Länge der Wörter - Default standard aufsteigend
print(words)

print(ord("B"))  #  Reihenfolge Unicode
print(ord("D"))
print(chr(68))

words.sort(key=len, reverse=True)  # Sortiert nach der Länge der Wörter und absteigend
print(words)

# print("hallo".sort())  -Bringt Error. sort geht nur mit Liste
