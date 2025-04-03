print("Übung 1")


class Auto:
    hersteller = "Unbekannt"

    def __init__(self, modell, baujahr):
        self.modell = modell
        self.baujahr = baujahr

    def fahr_info(self):
        return f"Modell: {self.modell}, Baujahr: {self.baujahr}"


def check_auto_attribute(auto_instanz):
    if not hasattr(auto_instanz, 'farbe'):
        auto_instanz.farbe = "Unbekannt"
        print("Das Attribut 'farbe' wurde hinzugefügt mit dem Wert 'Unbekannt'.")

    print("Vorhandene Attribute:")
    for attribut in ['modell', 'baujahr', 'farbe']:
        wert = getattr(auto_instanz, attribut)
        print(f"{attribut}: {wert}")


auto1 = Auto("Larumba", 1600)
check_auto_attribute(auto1)

auto2 = Auto("Banza", 1700)
auto2.farbe = "grün"
check_auto_attribute(auto2)

auto3 = Auto("Larumba",2200)
check_auto_attribute(auto3)
