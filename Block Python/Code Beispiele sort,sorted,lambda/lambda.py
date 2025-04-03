# Eine Normale Funktion in Python
def addiere_zwei(x):
    return x + 2

z = addiere_zwei(3)
print(z)


# dieselbe  als lambda-Funktion
y = lambda x: x + 2
print(y(3))  # Ausgabe: 5
print(y(4))
print(y(9))


# x ist der Parameter der Lambda-Funktion.

# x + 2  ist der Ausdruck, der von der Lambda-Funktion ausgewertet und zurückgegeben wird.

# lambda -Dieses Schlüsselwort wird verwendet, um eine Lambda-Funktion in Python zu definieren.
# Es signalisiert Python, dass Sie eine Funktion erstellen, die keinen Namen hat (eine anonyme
# Funktion).

# y - Dies ist der Name der Lambda-Funktion.
# Wenn Sie später y(3) aufrufen, wird die Lambda-Funktion mit 3 als Argument ausgeführt.



"""
Lambda-Funktionen sind kleine, anonyme Funktionen in Python.
Sie werden mit dem Schlüsselwort lambda definiert.
Oft verwendet für schnelle, einmalige Funktionen, die sonst nicht wiederverwendet werden.

https://www.geeksforgeeks.org/python-lambda-anonymous-functions-filter-map-reduce/

Lambda-Funktionen werden häufig mit Funktionen wie map(), filter() und sorted() verwendet.
"""


"""

Einschränkungen von Lambda-Funktionen :
Können nur einen einzigen Ausdruck enthalten.
Nicht ideal für komplexe Funktionen oder wenn Lesbarkeit wichtig ist.
Das Debuggen kann schwierig sein, da kein Funktionsname vorhanden ist.

Best Practices :
Verwenden Sie Lambda-Funktionen für einfache, kurze Aufgaben.
Vermeiden Sie die Verwendung von Lambda für komplexe Operationen.
Bevorzugen Sie reguläre Funktionen für bessere Lesbarkeit und Wartbarkeit.

"""