#Aufgabe 1: Wettervorhersage-Simulator

"""
Erstellen Sie ein Programm, das eine Wettervorhersage für die nächsten 7 Tage simuliert und bei
Gewitterwarnung abbricht.
Anforderungen:
Verwenden Sie eine for-Schleife mit range(), um durch die Wochentage zu iterieren.
Nutzen Sie random.choice(), um für jeden Tag eine Wetterbedingung auszuwählen.
Verwenden Sie if-elif-else Strukturen für verschiedene Wetterempfehlungen.
Brechen Sie die Schleife mit break ab, wenn "Gewitter" vorhergesagt wird.
"""

import random

wetterbedingungen = ["Sonnig", "Bewölkt", "Regnerisch", "Gewitter"]

for tag in range(1, 8):
  wetter = random.choice(wetterbedingungen)
  print(f"Tag {tag}: {wetter}")

  if wetter == wetterbedingungen[3]:
    print("Wetterwarnung!!! Gewitter!")
    break
