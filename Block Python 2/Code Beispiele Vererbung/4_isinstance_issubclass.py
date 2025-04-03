# Definition der Oberklasse
class Fahrzeug:
    def __init__(self, marke):
        self.marke = marke


# Definition einer Unterklasse
class Auto(Fahrzeug):
    def __init__(self, marke, modell):
        super().__init__(marke)
        self.modell = modell


# Definition einer weiteren Unterklasse
class Fahrrad(Fahrzeug):
    def __init__(self, marke, typ):
        super().__init__(marke)
        self.typ = typ


# Erstellen von Instanzen der Unterklassen
auto = Auto("BMW", "X5")
fahrrad = Fahrrad("Cannondale", "Mountainbike")




# schätzen und überprüfen Sie eine nach der anderen
"""
    
# Beispiel für isinstance()
# print(isinstance(auto, Auto))
# print(isinstance(auto, Fahrzeug))
# print(isinstance(auto, Fahrrad))
        
#print(isinstance(fahrrad, Fahrrad))
#print(isinstance(fahrrad, Fahrzeug))
#print(isinstance(fahrrad, Auto))
"""


"""
# Beispiel für issubclass()
#print(issubclass(Auto, Fahrzeug))
#print(issubclass(Fahrrad, Fahrzeug))
#print(issubclass(Fahrzeug, Auto))
# print(issubclass(Fahrzeug, Fahrzeug))
"""

