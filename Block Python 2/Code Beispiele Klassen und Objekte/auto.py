class Auto:
    def __init__(self, marke, modell, baujahr):
        self.marke = marke
        self.modell = modell
        self.baujahr = baujahr

mein_auto = Auto("Toyota", "Corolla", 2020)
print(mein_auto.marke)
print(mein_auto.baujahr)  
print(mein_auto.modell)

mein_auto.modell = "RAV4"
print(mein_auto.modell)