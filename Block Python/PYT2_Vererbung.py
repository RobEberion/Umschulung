print("Übung 1")


class Person:
    def __init__(self, name, age):
        self.name = name
        self.age = age


class Student(Person):
    def __init__(self, name, age, student_id):
        super().__init__(name, age)
        self.student_id = student_id


person1 = Person("Tim", 32)
print(person1.name)
print(person1.age)


student1 = Student("Harald", 19, "AB1234")
print(student1.name)
print(student1.age)


print("")
print("Übung 2")


class Mitarbeiter:
    def __init__(self, name):
        self.name = name

    def get_role(self):
        print(f"{self.name} hat eine allgemeine Mitarbeiterrolle.")


class Manager(Mitarbeiter):
    def get_role(self):
        print(f"{self.name} ist ein Manager, der die Teamarbeit überwacht.")


class Entwickler(Mitarbeiter):
    def get_role(self):
        print(f"{self.name} ist ein Entwickler, der Code schreibt und wartet.")


mitarbeiter = Mitarbeiter("Harald")
mitarbeiter.get_role()

manager1 = Manager("Alfonse")
manager1.get_role()

entwickler1 = Entwickler("Jane")
entwickler1.get_role()


print("")
print("Übung 3")


class Buch:
    def __init__(self, titel, autor):
        self.titel = titel
        self.autor = autor

    def get_info(self):
        print(f"Buch: {self.titel} von {self.autor}.")


class Ebook(Buch):
    def __init__(self, titel, autor, data_value):
        super().__init__(titel, autor)
        self.data_value = data_value

    def get_info(self):
        print(f"Ebook: {self.titel} von {self.autor}, Dateigröße: {self.data_value}.")


buch1 = Buch("Atome", "Harald")
buch1.get_info()

ebook1 = Ebook("Atome", "Harald", "2 MB")
ebook1.get_info()
