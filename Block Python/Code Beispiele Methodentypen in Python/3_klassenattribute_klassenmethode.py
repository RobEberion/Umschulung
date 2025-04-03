class MyClass:
    class_variable = 0

    @classmethod
    def class_method(cls):
        cls.class_variable += 1


print(MyClass.class_variable)
MyClass.class_method()
print(MyClass.class_variable)  # Ausgabe: 1




"""
In Python werden Klassenvariablen (oder auch Klassenattribute) verwendet, um Daten zu speichern, 
die für alle Instanzen einer Klasse gemeinsam sind. 

Im Gegensatz zu Instanzvariablen, die für jede Instanz (jedes Objekt) einer Klasse spezifisch sind, 
werden Klassenvariablen von allen Instanzen gemeinsam genutzt.

"""

"""
Wenn eine Methode Zugriff auf Klassenvariablen benötigt, ist es besser, eine Klassenmethode zu
verwenden. Klassenmethoden sind dafür konzipiert, auf Klassenebene zu arbeiten und können über
den cls-Parameter auf Klassenvariablen zugreifen.
"""


"""
MyClass.class_variable += 10
print(MyClass.class_variable)
"""

"""

my_object = MyClass()
my_object.class_method()
print(my_object.class_variable)
my_object.class_method()
print(my_object.class_variable)
print(MyClass.class_variable)
"""


""""
Mehr erkunden :
https://www.data-science-architect.de/methoden-in-python/
https://realpython.com/instance-class-and-static-methods-demystified/
https://www.geeksforgeeks.org/class-method-vs-static-method-python/
https://www.programiz.com/python-programming/methods/built-in/staticmethod
https://www.programiz.com/python-programming/methods/built-in/classmethod
"""