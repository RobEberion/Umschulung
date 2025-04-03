try:
    datei = open('meaw_datei.txt', 'r')
    inhalt = datei.read()
except FileNotFoundError:
    print("Die Datei wurde nicht gefunden.")
else:
    print("Dateiinhalt:", inhalt)
finally:
    print("In Finally Block - Datei Schließen")



"""
data = open('meaw_datei.txt', 'r')
content = data.read()
"""

# TODO change filename & try again : meine_datei.txt

"""
# Ohne Exception Behandlung
data = open('meaw_datei.txt', 'r')
content = data.read()
"""


"""
Der finally-Block ist besonders nützlich, wenn Sie sicherstellen möchten, dass bestimmte 
Bereinigungsaktionen immer durchgeführt werden, egal ob eine Exception aufgetreten ist oder nicht.
 
 Typische Anwendungsfälle sind das Schließen von Dateien oder das Freigeben von Ressourcen, 
 wie Datenbankverbindungen.

"""