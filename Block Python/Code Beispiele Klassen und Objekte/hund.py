class Hund:
    def __init__(self, name, alter):
        self.name = name
        self.alter = alter
    def bellen(self):
        print(f"{self.name} bellt!")

mein_hund = Hund("Bello", 3)
mein_hund.bellen()  # Ausgabe: Bello bellt!