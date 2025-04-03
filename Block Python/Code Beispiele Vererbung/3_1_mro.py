class Tier:
    def sound(self):
        return "Ein Geräusch"

class Hund(Tier):
    pass

class Katze(Tier):
    def sound(self):
        return "Miau"

class Mischling(Hund, Katze):
    pass


m = Mischling()
print(m.sound())

# Was wird hier ausgegeben?


# Im Zweifelsfall prüfen Sie die Reihenfolge der Methodenauflösung
# print(Mischling.mro())
