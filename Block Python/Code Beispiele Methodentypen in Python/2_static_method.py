class MathOperations:
    @staticmethod
    def add(x, y):
        return x + y

    @staticmethod
    def subtract(x, y):
        return x - y


# Statische Methoden direkt auf der Klasse aufrufen
result_add = MathOperations.add(5, 3)
result_subtract = MathOperations.subtract(10, 4)

print("Addition:", result_add)  # Ausgabe: Addition: 8
print("Subtraktion:", result_subtract)  # Ausgabe: Subtraktion: 6




"""
Statische Methoden sind Methoden, die innerhalb einer Klasse definiert sind, aber keine Instanz
spezifischen zugreifen oder ändern. Sie werden mit dem @staticmethod Dekorator definiert.
    • Keine self oder cls Parameter: Statische Methoden nehmen weder self (Instanzreferenz) noch cls
    (Klassenreferenz) als Parameter.
    • Klassen-Level-Aufruf: Sie können auf der Klasse selbst aufgerufen werden, ohne dass eine Instanz der
    Klasse erforderlich ist.
    • Dienstprogrammfunktionalität: Typischerweise verwendet für Dienstprogrammfunktionen, die eine
    Aufgabe unabhängig von Klassen- oder Instanzzustand ausführen.

"""

"""
# auch mit Objekt möglich - aber nicht notwendig
math_obj = MathOperations()
obj_add = math_obj.add(15, 3)
obj_minus = math_obj.subtract(19, 4)
print("Addition:", obj_add)
print("Subtraktion:", obj_minus)
"""


""""
Mehr erkunden :
https://www.data-science-architect.de/methoden-in-python/
https://realpython.com/instance-class-and-static-methods-demystified/
https://www.geeksforgeeks.org/class-method-vs-static-method-python/
https://www.programiz.com/python-programming/methods/built-in/staticmethod
https://www.programiz.com/python-programming/methods/built-in/classmethod
"""