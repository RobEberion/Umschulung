#Aufgabe 2: Blitz-Entfernungsrechner
"""
Entwickeln Sie einen interaktiven Blitz-Entfernungsrechner mit einer while-Schleife.
Anforderungen:
Implementieren Sie eine Funktion zur Berechnung der Blitzentfernung (Schallgeschwindigkeit: ca.
343 m/s).
Nutzen Sie eine while-Schleife für wiederholte Benutzereingaben.
Verwenden Sie if-elif-else für verschiedene Entfernungskategorien.
Ermöglichen Sie dem Benutzer, das Programm zu beenden.
"""


def berechne_entfernung(sekunden):
    return sekunden * 343  # Entfernung in Metern


def entfernungsbereich(entfernung):
    if entfernung < 10:
        return "du lebst noch?!"
    elif 10 <= entfernung < 100:
        return "bitte geh in Deckung! Extrem nah!"
    elif 100 <= entfernung < 1000:
        return "ist Gefährlich nah!"
    elif 1000 <= entfernung < 5000:
        return "ist in der Nähe."
    elif 5000 <= entfernung < 10000:
        return "ist in sicherer Entfernung."
    elif 10000 <= entfernung < 20000:
        return "ist in sehr sicherer Entfernung."
    elif 20000 <= entfernung < 100000:
        return "ist weit entfernt."
    else:
        return "es war einmal vor langer Zeit in einer weit, weit entfernten Galaxis ein Blitz, der hat sich verlaufen..."


while True:

    eingabe = input("Sekunden zwischen Blitz und Donner (oder 'q' zum Beenden): ")

    if eingabe.lower() == 'q':
        break

    elif (eingabe.isdigit()):  #https://docs.python.org/3/library/stdtypes.html#str.isdigit
        sekunden = float(eingabe)
        entfernung = berechne_entfernung(sekunden)
        bereich = entfernungsbereich(entfernung)
        print(f"Der Blitz ist etwa {entfernung:.2f} Meter entfernt und {bereich:}")

    else:
        print("Bitte gib nur eine Zahl ein oder 'q' zum Beenden")
