print("Übung 1")

fruits1 = ["apfel", "banane", "kirsche", "dattel"]
fruits2 = [fruit.upper() for fruit in fruits1]
print(fruits2)


print("")
print("Übung 2")

mixer = "a1b2c3d4"
numbers = [int(mix) for mix in mixer if mix.isdigit()]
print(numbers)


print("")
print("Übung 3")

num_quad = [num ** 2 for num in range(11)]
print(num_quad)


print("")
print("Übung 4")

fruits_x = ["Apfel", "Banane", "Kirsche", "Dattel"]

char_fruit = [fruit[0] for fruit in fruits_x]
print(char_fruit)


print("")
print("Übung 5")

number_y = [num for num in range(1,101) if (num % 3 == 0 and num % 5 == 0)]

print(number_y)


print("")
print("Übung 6")

cities = ["Berlin", "München", "Hamburg", "Köln"]
cities.reverse()
cities_reverse = [city.upper() for city in cities]
print(cities_reverse)

