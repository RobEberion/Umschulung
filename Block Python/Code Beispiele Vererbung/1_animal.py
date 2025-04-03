# Definition der Oberklasse
class Animal:

    def __init__(self, name):
        self.name = name

    def speak(self):
        return f"{self.name} sagt Hallo!"


# Definition einer Unterklasse
class Dog(Animal):
    def speak(self):
        return f"{self.name} sagt Woof!"


# Definition einer weiteren Unterklasse
class Cat(Animal):
    def speak(self):
        return f"{self.name} sagt Meow!"


# Erstellen von Instanzen der Unterklassen
dog = Dog("Buddy")
cat = Cat("Whiskers")

print(dog.speak())
print(cat.speak())

tiger = Animal("Tiger")
print(tiger.speak())







"""
print(dir(Animal))
print(dir(tiger))
print(dir(dog))
print(dir())

`dir()` ist eine eingebaute Funktion in Python, die eine Übersicht über die verfügbaren Namen
 (wie Attribute, Methoden und Klassen) eines Objekts, einer Klasse oder 
 des aktuellen Namensraums liefert.
 
 Ohne Argument listet dir() alle Namen im aktuellen lokalen Namensraum auf.

"""