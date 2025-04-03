print("Übung 1")


class Person:
    def __init__(self, name, age):
        self.name = name
        self.age = age

    def birthday(self):
        self.age += 1


person1 = Person("Lari", 18)
print(f"{person1.name} ist jetzt {person1.age} Jahre alt!")
person1.birthday()
print(f"{person1.name} ist jetzt {person1.age} Jahre alt!")


print("")
print("Übung 2")


class MathOperations:
    @staticmethod
    def is_even(x):
        num = x % 2 == 0
        if num is True:
            value = "gerade"
        else:
            value = "ungerade"
        return value


n = 5
result = MathOperations.is_even(n)
print(f"Die Zahl {n} ist eine {result} Zahl.")


print("")
print("Übung 3")


class Car:
    total_cars = 0

    def __init__(self):
        Car.total_cars += 1

    @classmethod
    def increment_total_cars(cls):
        cls.total_cars += 1

    def display(self):
        print(Car.total_cars)


car1 = Car()
car1.display()
car2 = Car()
car2.display()
car3 = Car()
car3.display()

print("")
print("Übung 4")


class TemperatureConverter:
    @staticmethod
    def celsius_to_fahrenheit(temperature):
        return (temperature * 9/5) + 32

    @staticmethod
    def fahrenheit_to_celsius(temperature):
        return (temperature - 32) * 5/9


result_in_f = TemperatureConverter.celsius_to_fahrenheit(5)
print(result_in_f)
result_in_c = TemperatureConverter.fahrenheit_to_celsius(5)
print(result_in_c)

print("")
print("Übung 5")


class Student:
    school_name = "Schule "

    @classmethod
    def change_school_name(cls, new_name):
        cls.school_name = new_name


    def display_school_name(self):
        print(f"Name der Schule: {Student.school_name}")


student1 = Student()
student2 = Student()

student1.display_school_name()

Student.change_school_name("Geschwister-Scholl_Schule")


student1.display_school_name()
student2.display_school_name()


print("")
print("Übung 6")

class Employee:
    employee_count = 0

    def __init__(self, name, stelle):
        self.name = name
        self.stelle = stelle

        Employee.employee_count += 1

    def display_employee_info(self):
        print(f"Name: {self.name} mit der Stelle: {self.stelle}")

    @classmethod
    def get_employee_count(cls):
        return f"Anzahl der Angestellten: {cls.employee_count}"


employee1 = Employee("Juan", "Designer")
employee2 = Employee("Jim", "Pilot")
employee3 = Employee("Jana", "Anwältin")

employee1.display_employee_info()
employee2.display_employee_info()

print(employee1.get_employee_count())


print("")
print("Übung 7")


class PasswordValidator:
    @staticmethod
    def validate_password(password):
        if len(password) < 8:
            return False

        digit = False
        letter = False

        for char in password:
            if char.isdigit():
                digit = True
            elif char.isalpha():
                letter = True

            if letter and digit:
                return True

        return False


password1 = "larifari1234"
password2 = "12345789"
password3 = "abcdefghijkl"
password4 = "pass4"

print(PasswordValidator.validate_password(password1))
print(PasswordValidator.validate_password(password2))
print(PasswordValidator.validate_password(password3))
print(PasswordValidator.validate_password(password4))
