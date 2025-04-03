import sys


# Funktion, die eine große Liste erzeugt
def große_liste():
    return [x for x in range(1000000)]


# Funktion, die einen großen Generator erzeugt
def großer_generator():
    for x in range(1000000):
        yield x


# Speicherverbrauch der Liste
liste = große_liste()
print(f"Speicherverbrauch der Liste: {sys.getsizeof(liste)} Bytes")

# Speicherverbrauch des Generators
generator = großer_generator()
print(f"Speicherverbrauch des Generators: {sys.getsizeof(generator)} Bytes")
