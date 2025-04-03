class MyClass:
    my_status = 100 # Klassenattribute

    def __init__(self, value):
        self.value = value  # Instanzattribut

    def instance_method(self):
        # Beispiel für eine Instanzmethode.
        self.meaw()
        print(f"Klassenattribute 'my_status' wert : {self.my_status}")
        return self.value

    @staticmethod
    def meaw():
        print("Hallo Meaw...!!!")


# Erstellen einer Instanz der Klasse
obj = MyClass(10)

# Aufrufen der Instanzmethode
print(obj.instance_method())  # Ausgabe: 10

# print(f"Klassenattribute 'my_status' wert : {MyClass.my_status}")





"""
Instanzmethoden sind Funktionen, die innerhalb einer Klasse definiert sind und auf Instanzen
(Objekten) dieser Klasse operieren. Sie haben Zugriff auf die Attribute der Instanz (und auch die
Klassenattribute) und können deren Zustand ändern.

• Erster Parameter self:
    • Instanzmethoden nehmen immer mindestens einen Parameter, typischerweise self, der sich
    auf die spezifische Instanz der Klasse bezieht, die die Methode aufruft.
    • Dadurch kann die Methode auf Instanzattribute und andere Methoden zugreifen.
    
• Zugriff auf Instanzattribute:
    • Instanzmethoden können Instanzattribute lesen und ändern, was dynamisches Verhalten
    basierend auf dem Zustand der Instanz ermöglicht.
"""


""""
Mehr erkunden :
https://www.data-science-architect.de/methoden-in-python/
https://realpython.com/instance-class-and-static-methods-demystified/
https://www.geeksforgeeks.org/class-method-vs-static-method-python/
https://www.programiz.com/python-programming/methods/built-in/staticmethod
https://www.programiz.com/python-programming/methods/built-in/classmethod
"""

# print(f"Klassenattribute 'my_status' wert : {MyClass.my_status}") geht auch

