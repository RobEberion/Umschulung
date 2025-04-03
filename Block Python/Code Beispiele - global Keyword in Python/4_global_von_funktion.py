def func(x):
    global y
    y = x * x
    return y


func(2)
print(y)


"""
Globale Variablen können auch innerhalb einer Funktion deklariert werden.

Das bedeutet, dass du in Python eine globale Variable auch innerhalb einer Funktion erstellen kannst, 
indem du das global-Schlüsselwort verwendest. Wenn du eine Variable innerhalb einer Funktion mit dem 
global-Schlüsselwort deklarierst, wird sie außerhalb der Funktion ebenfalls als globale Variable erkannt
 und kann im gesamten Programm verwendet werden.
"""