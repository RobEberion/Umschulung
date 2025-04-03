""""""

"""
print("Übung 1")

try:
    num1 = int(input("Geben Sie die erste Zahl ein: "))
    num2 = int(input("Geben Sie die zweite Zahl ein: "))
    ergebnis = num1 / num2
    print(f"Das Ergebnis ist: {ergebnis}")
except ZeroDivisionError:
    print("Fehler: Division durch Null ist ungültig")   
finally:
    print("Programm Ende")
"""

"""
print("Übung 2")

try:
    datei = open("PYT2_exceptions/datei.txt", "r")
    #datei = open("datei.txt", "r")
    inhalt = datei.read()
    print(f"Dateiinhalt: {inhalt}")
except FileNotFoundError:
    print("Fehler: Datei nicht gefunden")
finally:
    print("Programm Ende")
"""

"""
print("Übung 3")

while True:

    try:
        number = int(input("Geben Sie eine Ganzzahl ein: "))
        print(f"Deine Zahl ist {number}")
        break
    except ValueError:
        print("Fehler: Geben Sie eine Ganzzahl ein")

print("Programm Ende")
"""

"""
print("Übung 4 und 5")

try:
    number1 = int(input("Geben Sie die erste Zahl ein: "))
    number2 = int(input("Geben Sie die zweite Zahl ein: "))
    ergebnis = number1 / number2
except ZeroDivisionError:
    print("Fehler: Division durch Null")
except ValueError:
    print("Fehler: Geben Sie eine Zahl ein")
else:
    print(f"Das Ergebnis ist: {ergebnis}")
"""

"""
print("Übung 6")

datei = None

try:
    datei = open("PYT2_exceptions/datei.txt", "r")
    inhalt = datei.read()
    print(f"Dateiinhalt: {inhalt}")
except FileNotFoundError:
    print("Fehler: Datei nicht gefunden")
finally:
    if datei:
        datei.close()
        print("Datei wurde geschlossen")
"""

"""
print("Übung 7")


class UngueltigerBereichError(Exception):
    def __init__(self, wert):
        self.wert = wert
        self.message = f"Der Wert {wert} liegt außerhalb des gültigen Bereichs"
        super().__init__(self.message)


def check_bereich(zahl):
    if zahl < 1 or zahl > 10:
        raise UngueltigerBereichError(zahl)
    return zahl


try:
    wert = float(input("Geben Sie eine Zahl ein: "))
    ergebnis = check_bereich(wert)
    print(ergebnis)
except ValueError:
    print("Fehler: Geben Sie eine Zahl ein")
except UngueltigerBereichError as e:
    print(f"Fehler: {e}")
else:
    print(f"Der Wert {wert} ist im gültigen Bereich.")
finally:
    print("Programm Ende")
"""

"""
print("Übung 8")


def berechne_durchschnitt(num):
    return sum(num) / len(num)


datei = None

try:
    datei = open("PYT2_exceptions/zahlen.txt", "r")
    #datei = open("zahlen.txt", "r")
    #datei = open("PYT2_exceptions/datei.txt", "r")
    
    inhalte = datei.read()
    zahlen = [float(zeile.strip()) for zeile in inhalte.split()]
    durchschnitt = berechne_durchschnitt(zahlen)

    print(f"Durchschnitt der Zahlen in der Datei: {durchschnitt}")

except FileNotFoundError:
    print("Fehler: Datei nicht gefunden")
except ValueError:
    print("Fehler: Andere Inhalte als nur Zahlen vorhanden")
except Exception:
    print("allgemeiner Fehler")

finally:
    if datei:
        datei.close()
        print("Datei wurde geschlossen")
print("Programm Ende")
"""



