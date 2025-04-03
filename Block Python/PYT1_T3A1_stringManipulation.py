#Aufgabe 1: String-Manipulation
"""Erstellen Sie eine Funktion string_info, die einen String als Eingabe nimmt und folgende Informationen
zurückgibt:
. Die Länge des Strings
. Den String in Großbuchstaben
. Den String in Kleinbuchstaben
. Die Anzahl der Vokale im String
Nutzen Sie dafür die eingebauten Methoden von String-Objekten
"""

text = input("Gib dein Wort ein: ")

vokale = "aeiouäöüAEIOUÄÖÜ"
vokale_zähler = sum(1 for char in text if char in vokale)
"""
a = text.count("a" and "A")
e = text.count("e" and "E")
i = text.count("i" and "I")
o = text.count("o" and "O")
u = text.count("u" and "U")
ä = text.count("ä" and "Ä")
ö = text.count("ö" and "Ö")
ü = text.count("ü" and "Ü")

vokale_zähler = a + e + i + o + u + ä + ö + ü
"""

print(f"Anzahl Zeichen: {len(text)}")
print(f"Großbuchstaben: {text.upper()}")
print(f"Kleinbuchstaben: {text.lower()}")
print(f"Anzahl Vokale: {vokale_zähler}")
