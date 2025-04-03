class KI:
    def sound(self):
        return "Hasta la vista, baby"


class Tier:
    def sound(self):
        return "Ein Geräusch"


class Robot(KI):
    pass


class Katze(Tier):
    def sound(self):
        return "Miau"


class Mischling(Robot, Katze):
    pass


m = Mischling()
print(m.sound())

# print(m.sound()) ?
# Was wird hier ausgegeben?


# Im Zweifelsfall prüfen Sie die Reihenfolge der Methodenauflösung
# print(Mischling.mro())
