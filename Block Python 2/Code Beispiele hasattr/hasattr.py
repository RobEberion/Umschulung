# Definition einer Klasse mit Konstruktor, Klassenattributen und Methoden
class MeineKlasse:
    # Klassenattribut
    klassen_attribut = "Ich bin ein Klassenattribut"

    # Konstruktor mit Instanzvariablen
    def __init__(self, wert):
        self.instanz_attribut = wert

    # Klassenmethode
    @classmethod
    def klassen_methode(cls):
        return "Ich bin eine Klassenmethode"

    # Instanzmethode
    def instanz_methode(self):
        return f"Instanzwert: {self.instanz_attribut}"

# Überprüfen, ob die Klasse 'MeineKlasse' das Attribut 'klassen_attribut' hat
print(hasattr(MeineKlasse, 'klassen_attribut'))  # Ausgabe: True

# Überprüfen, ob die Klasse 'MeineKlasse' die Methode 'klassen_methode' hat
print(hasattr(MeineKlasse, 'klassen_methode'))  # Ausgabe: True

# Überprüfen, ob die Klasse 'MeineKlasse' ein nicht vorhandenes Attribut hat
print(hasattr(MeineKlasse, 'nicht_vorhanden'))  # Ausgabe: False

# Erstellen einer Instanz von 'MeineKlasse' mit einem bestimmten Wert
objekt = MeineKlasse(wert="Ich bin ein Instanzwert")

# Überprüfen, ob die Instanz das Attribut 'instanz_attribut' hat
print(hasattr(objekt, 'instanz_attribut'))  # Ausgabe: True

# Überprüfen, ob die Instanz die Methode 'instanz_methode' hat
print(hasattr(objekt, 'instanz_methode'))  # Ausgabe: True

# Überprüfen, ob die Instanz das Klassenattribut 'klassen_attribut' hat
print(hasattr(objekt, 'klassen_attribut'))  # Ausgabe: True

# Überprüfen, ob die Instanz ein nicht vorhandenes Attribut hat
print(hasattr(objekt, 'nicht_vorhanden'))  # Ausgabe: False


"""
Die Funktion hasattr() überprüft, ob ein Objekt, sei es eine Instanz oder eine Klasse, ein bestimmtes 
Attribut oder eine bestimmte Methode besitzt. Sie gibt True zurück, wenn das Attribut oder die Methode 
vorhanden ist, und False, wenn es nicht existiert. 

Diese Funktion ist sowohl auf Klassen als auch auf Instanzen anwendbar, wodurch sie flexibel einsetzbar ist, um die Existenz von Attributen oder Methoden dynamisch zu prüfen und so potenzielle Fehler zu vermeiden.


"""