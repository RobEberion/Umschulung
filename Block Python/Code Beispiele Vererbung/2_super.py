class Tier:
    def __init__(self, name):
        self.name = name

    def eat(self):
        print("Ich habe hunger")


class Hund(Tier):
    def __init__(self, name, rasse):
        # Parent (Oberklasse)-Konstruktor-Aufruf
        super().__init__(name)
        self.rasse = rasse

    def sprechen(self):
        # Parent (Oberklasse)-Methode-Aufruf
        super().eat()
        # self.eat() -geht auch
        return f"{self.name} sagt Wuff! Ich bin ein {self.rasse}."


hund = Hund("Buddy", "Golden Retriever")
print(hund.sprechen())
# Ausgabe:
# Ich habe hunger
# Buddy sagt Wuff! Ich bin ein Golden Retriever.

