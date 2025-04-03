#Aufgabe 1: Temperatur-Konverter
"""
Erstellen Sie ein Programm, das Temperaturen zwischen Celsius und Fahrenheit umrechnet.
Anforderungen:
Fragen Sie den Benutzer nach einer Temperatur und der Einheit (C oder F).
Konvertieren Sie die Temperatur in die jeweils andere Einheit.
Geben Sie das Ergebnis aus.
Verwenden Sie bedingte Anweisungen zur Überprüfung der Eingabe.
"""


def celsius_to_fahrenheit(celsius):
  return (celsius * 9 / 5) + 32


def fahrenheit_to_celsius(fahrenheit):
  return (fahrenheit - 32) * 5 / 9


while True:

  print("Hinweis: Beenden mit 'q'!")

  option = input("In welcher Einheit soll umgerechnet werden? (C/F): ")
  optionLow = option.lower()

  if optionLow == "q":

    print("Sie haben das Programm beendet.")
    break

  elif optionLow == "c":

    temperature_value = float(input("Gib die Temperatur in Grad Celsius ein: "))
    fahrenheit_value = celsius_to_fahrenheit(temperature_value)
    print(f"{temperature_value} Grad Celsius sind {fahrenheit_value} Grad Fahrenheit")

  elif optionLow == "f":

    temperature_value = float(input("Gib die Temperatur in Grad Fahrenheit ein: "))
    celsius_value = fahrenheit_to_celsius(temperature_value)
    print(f"{temperature_value} Grad Fahrenheit sind {celsius_value} Grad Celsius")

  else:
    print("Bitte nur C oder F eingeben!")
