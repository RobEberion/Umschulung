x = 10  # globale Variable

def meine_funktion():
    global x  # Wir erklären, dass wir die globale Variable x verwenden wollen
    x = 5  # Dies ändert die globale Variable
    print("Innerhalb der Funktion:", x)

meine_funktion()
print("Außerhalb der Funktion:", x)


"""
Das Schlüsselwort global in Python wird verwendet, um anzuzeigen, dass eine Variable innerhalb einer Funktion 
auf eine globale Variable verweist, also auf eine Variable, die außerhalb des Funktionsbereichs existiert. 

Ohne das global-Schlüsselwort wird jede Zuweisung zu einer Variable innerhalb einer Funktion als lokale 
Variable betrachtet und ändert die globale Variable mit demselben Namen nicht.

Hier zeigt das global-Schlüsselwort Python an, dass die Variable x innerhalb der Funktion dieselbe ist 
wie die globale x.

Daher ändert die Modifikation von x in der Funktion den globalen Wert.

Wichtige Punkte:
    Lokale Variablen: Variablen, die innerhalb einer Funktion erstellt werden, sind standardmäßig lokal.
        Lokale Variablen in Python sind diejenigen, die innerhalb einer Funktion definiert werden, und ihr Gültigkeitsbereich (Scope) ist auf diese Funktion beschränkt. Das bedeutet, dass sie nur innerhalb der Funktion verfügbar sind, in der sie erstellt wurden, und außerhalb dieser Funktion nicht zugänglich oder sichtbar sind.
        Wenn die Funktion endet, wird die lokale Variable gelöscht, und sie ist nicht mehr existent.
        
    Globale Variablen: Variablen, die außerhalb aller Funktionen deklariert werden, sind global.
    Verwendung von global: Ermöglicht es einer Funktion, eine globale Variable zu ändern.
    Du kannst mehrere globale Variablen deklarieren, indem du sie durch Kommas trennst.
"""