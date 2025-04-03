print("Übung 1")
def greet(name):
    return f"Hello {name}"

print(greet("Maria"))

print("")
print("Übung 2")
def add(a, b):
    return a + b

print(add(10, 20))

print("")
print("Übung 3")
def greeting(namen, begruessung="Hello"):
    return begruessung + " " + namen

print(greeting("Peter"))
print(greeting("Anna", "Good Day"))

print("")
print("Übung 4")
def multiply(a, b):
    return a * b

print(multiply(b=5, a=4))

print("")
print("Übung 5")
def power(basis, exponent):
    return basis ** exponent

print(power(2,exponent=3))

print("")
print("Übung 6")
def print_message(Nachricht):
    print(Nachricht)

print(print_message("Nichts"))
print(print("Nichts"))


print("")
print("Übung 7")

def calculate(number1, number2):
    summe = number1 + number2
    produkt = number1 * number2
    return summe, produkt

summe, produkt = calculate(2, 3)

print(f"Summe = {summe}")
print(f"Produkt = {produkt}")

print("")
print("Übung 8")
def is_positive_number(number):

    return number > 0

print(is_positive_number(-1))

print("")
print("Übung 9")
def sum_numbers(*numbers):
    return sum(numbers)

print(sum_numbers(1, 2, 3, 4, 5))

