class Auto:
    """
    Eine einfache Klasse, die ein Auto repräsentiert. Sie speichert Informationen über das Modell,
    die Marke und das Herstellungsjahr des Autos.
    """
    tuv_dauer = 2

    def __init__(self, marke, modell, jahr):
        self.marke = marke
        self.modell = modell
        self.jahr = jahr

    def tuv(self):
        print(f"Hauptuntersuchung in {self.jahr + self.tuv_dauer}")


class Hybrid(Auto):
    pass


class FliegendeHybrid(Hybrid):
    pass


# Eine Instanz von Auto erstellen
mein_auto = Auto("Toyota", "Corolla", 2021)

# Verwendung von magischen Attributen
print("Klassenname :", mein_auto.__class__.__name__)
print("Klass :", mein_auto.__class__)

print("Wörterbuch der Auto-Instanz:", mein_auto.__dict__)
print("Wörterbuch der Auto-Klasse:", Auto.__dict__)

print("Class Auto Elternklassen:", Auto.__bases__)
print("Class Hybrid Elternklassen:", Hybrid.__bases__)
# Verwende das __bases__  Attribut, um nur die direkten Oberklassen (Elternklassen) zu erhalten.


print("Class Auto Kinderklassen:", Auto.__subclasses__())
# Verwende die eingebaute Methode __subclasses__(), um nur die direkten Unterklassen (Kindklassen) zu erhalten.
# __subclasses__() ist keine Magisches Attibute


print("Class Module:", Auto.__module__)
"""
    Wenn du den Code, der __module__ enthält, aus derselben Datei ausführst, in der die Klasse oder 
    Funktion definiert ist, wird der __module__-Attribut den String '__main__' zurückgeben, anstatt 
    den Namen des Moduls. 
    Das passiert, weil die spezielle Variable __name__ auf '__main__' gesetzt wird, 
    wenn ein Python-Skript direkt ausgeführt wird.
"""

print("Dokumentation der Auto-Klasse:", Auto.__doc__)
# TODO. An diesem Punkt besprechen wir über Module im Ordner module_in_python
