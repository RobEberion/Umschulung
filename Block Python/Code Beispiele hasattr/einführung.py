class MeineKlasse:
    meaw = 10
    def __init__(self):
        self.wert = 10

    def meine_methode(self):
        return "Hallo, Welt!"


# Erstellen einer Instanz der Klasse 'MeineKlasse'
obj = MeineKlasse()

# Überprüfen, ob 'obj' das Attribut 'wert' hat
print(hasattr(obj, 'wert'))  # Ausgabe: True

# Überprüfen, ob 'obj' die Methode 'meine_methode' hat
print(hasattr(obj, 'meine_methode'))  # Ausgabe: True

# Überprüfen, ob 'obj' ein Attribut hat, das nicht existiert
print(hasattr(obj, 'nicht_existierend'))  # Ausgabe: False

# Überprüfen, ob 'obj' das Attribut 'meaw' hat
print(hasattr(obj, 'meaw'))  # Ausgabe: True


"""
Die Funktion hasattr() überprüft, ob ein Objekt, sei es eine Instanz oder eine Klasse, ein bestimmtes 
Attribut oder eine bestimmte Methode besitzt. Sie gibt True zurück, wenn das Attribut oder die Methode 
vorhanden ist, und False, wenn es nicht existiert. 

Diese Funktion ist sowohl auf Klassen als auch auf Instanzen anwendbar, 
wodurch sie flexibel einsetzbar ist, um die Existenz von Attributen oder Methoden dynamisch zu prüfen und so potenzielle Fehler zu vermeiden.


"""