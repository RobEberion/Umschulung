print("Übung 1")


def uppercase_words(var1):
    var2 = var1.upper()
    return var2


tools = ["Regenschirm", "Fahrrad", "Fluxkompensator", "Rucksack", "Switch", "Router"]

tools_up = map(uppercase_words, tools)

print(list(tools_up))

print("")
print("Übung 2")


def filter_even_numbers(var1):
    return var1 % 2 == 0


numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]

result_even = filter(filter_even_numbers, numbers)
print(list(result_even))

result_even = filter(lambda x: x % 2 == 0, numbers)
print(list(result_even))

print("")
print("Übung 3")


def square_numbers(var1):
    return var1 ** 2


result_square = map(square_numbers, numbers)
print(list(result_square))

result_square = map(lambda x: x ** 2, numbers)
print(list(result_square))

print("")
print("Übung 4")


def filter_words(words, char):
    return filter(lambda word: word.lower().startswith(char.lower()), words)


words_list = ["Apfel", "Banane", "Avocado", "Blaubeere", "Aprikose"]

result = filter_words(words_list, "a")
print(list(result))

print("")
print("Übung 5")


from functools import reduce


def find_longest_word(words):
    return reduce(lambda x, y: x if len(x) > len(y) else y, words)


words2 = ["Apfel", "Banane", "Kirsche", "Mango"]
longest_word = find_longest_word(words2)
print(longest_word)
