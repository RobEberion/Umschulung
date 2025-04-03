try:
    zahl = int(input("Geben Sie eine Zahl ein: "))
    ergebnis = 10 / zahl
except ZeroDivisionError:
    print("Fehler: Division durch Null ist nicht erlaubt.")
except ValueError:
    print("Fehler: Ungültige Eingabe. Bitte geben Sie eine Zahl ein.")
else:
    print(f"Das Ergebnis ist: {ergebnis}")
finally:
    print("Programm beendet.")
