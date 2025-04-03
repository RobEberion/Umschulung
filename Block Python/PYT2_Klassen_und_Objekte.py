print("Übung 1")


class Person:
  def __init__(self):
    self.namen = str
    self.alter = int

  def vorstellen(self):
    print(f"Ich bin {self.namen} und bin {self.alter} alt.")


person1 = Person()

person1.namen = "Charlie"
person1.alter = 30

person1.vorstellen()



print("")
print("Übung 2")


class Student:
  def __init__(self):
    self.name = None
    self.matrikelnummer = None
    self.noten = None

  def durchschnittsnote(self):
    noten_d_schnitt = sum(self.noten)/len(self.noten)
    print(f"{self.name} hat einen Notendurchschnitt von {round(noten_d_schnitt, 1)}!")


student1 = Student()

student1.name = "Marilyn"
student1.matrikelnummer = "78"
student1.noten = [1, 2, 1, 1, 2, 1, 2, 1, 2]

student1.durchschnittsnote()

