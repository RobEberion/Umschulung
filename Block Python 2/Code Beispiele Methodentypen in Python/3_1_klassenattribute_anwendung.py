class Zaehlklasse:
    zaehler = 0

    def __init__(self):
        Zaehlklasse.zaehler += 1


instanz1 = Zaehlklasse()
instanz2 = Zaehlklasse()

print(Zaehlklasse.zaehler)  # Ausgabe: 2

"""
Klassenvariablen sind nützlich, wenn ein Wert von allen Instanzen einer Klasse geteilt wird, 
z.B. ein Zähler, der die Anzahl der Instanzen verfolgt.
"""


"""
Klassenvariablen sind für alle Instanzen einer Klasse gleich und können durch die Klasse selbst 
oder durch ihre Instanzen verändert werden.

Instanzvariablen sind spezifisch für jede Instanz und werden in der __init__-Methode definiert.
"""