print("Übung 1")

fruits = ["apple", "banana", "cherry"]
print(fruits)

fruits.append("orange")
fruits.insert(0, "grape")
print(fruits)


print("")
print("Übung 2")

numbers = [1, 2, 3, 4, 5]
print(numbers)
numbers.remove(2)
print(numbers)
numbers.pop()
print(numbers)


print("")
print("Übung 3")

coordinates = (10, 20, 30)
print(coordinates[0], coordinates[-1])


print("")
print("Übung 4")

person = ("Alice", 25, "Engineer")

name, age, profession = person

print(name, age, profession)


print("")
print("Übung 5")

tuple1 = (1, 2, 3)
print(tuple1)
tuple2 = (4, 5, 6)
print(tuple2)
merged_tuple = tuple1 + tuple2
print(merged_tuple)


print("")
print("Übung 6")

car = {"brand": "Toyota",
       "model": "Corolla",
       "year": 2019}
print(car)
car.update({"color": "blue",
            "year": 2022})
print(car)

for key, value in car.items():
    print(key,value)







