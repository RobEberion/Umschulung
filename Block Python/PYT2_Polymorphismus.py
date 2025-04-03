print("Übung 1")

class Tier:
    def sprechen(self):
        return "Ich bin ein Tier"

class Hund(Tier):
    def sprechen(self):
        return "Ich bin ein Hund"

class Katze(Tier):
    def sprechen(self):
        return "Ich bin eine Katze"


tier_list = [Tier(), Hund(), Katze()]

for tier in tier_list:
    print(tier.sprechen())

print("")
print("Übung 2")


class Person:
    def run(self):
        return "Die Person geht zu Fuß."


class Roboter:
    def run(self):
        return "Der Roboter bewegt sich vorwärts."


class Tier:
    def run(self):
        return "Das Tier ist am laufen."


def run_test(item):
    return item.run()


objekte = [Person(), Roboter(), Tier()]

for objekt in objekte:
    print(run_test(objekt))
