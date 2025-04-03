from datetime import date


# random Person
class Person:
    def __init__(self, name, age):
        self.name = name
        self.age = age

    @classmethod
    def from_birth_year(cls, name, geburtsjahr):
        return cls(name, date.today().year - geburtsjahr)

    def display(self):
        print(self.name + "'s Alter ist: " + str(self.age))


person = Person('Adam', 19)
person.display()

person1 = Person.from_birth_year('John', 1985)
person1.display()


"""
Factory-Methoden sind die Methoden, die ein Klassenobjekt (wie ein Konstruktor) für verschiedene Anwendungsfälle zurückgeben.

Die Methode from_birth_year nimmt die Klasse Person (nicht das Objekt Person) 
als ersten Parameter cls und gibt den Konstruktor durch Aufruf von cls(name, date.today().year - geburtsjahr) zurück.

Es ist dasselbe wie das Erstellen eines Objekts wie folgt: Person(name, date.today().year - geburtsjahr)
"""