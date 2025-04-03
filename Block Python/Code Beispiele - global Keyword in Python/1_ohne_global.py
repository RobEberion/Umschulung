x = 10  # globale Variable

def meine_funktion():
    x = 5  # Dies erstellt eine neue lokale Variable und ändert nicht die globale
    print("Innerhalb der Funktion:", x)
    y = 11

meine_funktion()
print("Außerhalb der Funktion:", x)
#print(y)
