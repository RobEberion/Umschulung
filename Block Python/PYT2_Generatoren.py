print("Übung 1")


def count_down(n):
    while n > 0:
        yield n
        n -= 1


#counter = count_down(5)
#print(next(counter))
#print(next(counter))
#print(next(counter))
#print(next(counter))
#print(next(counter))

for num in count_down(5):
    print(num)

print("")
print("Übung 2")


def odd_numbers_up_to(number):
    for numb in range(1, number + 1, 2):
        yield numb


for num in odd_numbers_up_to(10):
    print(num)

print("")
print("Übung 3")

quad_gen = (x ** 2 for x in range(1, 11))

for num in quad_gen:
    print(num)

print("")
print("Übung 4")

words = ["Hallo", "an", "Welt", "Tag", "Python", "ist", "toll"]
words_length = (word for word in words if len(word) > 3)

print(*words_length, sep=", ")
