print("Übung 1")

quad = lambda x: x ** 2
print(quad(7))


print("")
print("Übung 2")

list_x = [("Anna", 25), ("Bernd", 32), ("Clara", 28), ("David", 21)]
list_x_sorted = sorted(list_x, key=lambda x: x[-1])
print(list_x_sorted)


print("")
print("Übung 3")

names = ["Sophie", "Anna", "Maximilian", "Ben", "Charlotte"]
names_sort = sorted(names, key=len)
print(names_sort)

print("")
print("Übung 4")

numbers = [42, 17, 23, 56, 34]
numbers.sort()
print(numbers)
numbers.sort(reverse=True)
print(numbers)
