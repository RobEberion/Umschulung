print("Übung 1")

my_list = [1, 2, 3, 4, 5]
new_list = my_list[:]
print(new_list)

print("")
print("Übung 2")

my_list2 = [1, 2, 3, 4, 5, 6, 7]
new_list2 = my_list2[2:5]
print(new_list2)

print("")
print("Übung 3")

my_list3 = [1, 2, 3, 4, 5]
new_list3 = my_list3[::-1]
print(new_list3)

print("")
print("Übung 4")

my_list4 = [1, 2, 3, 4, 5, 6, 7, 8]
new_list4 = my_list4[1::2]
print(new_list4)

print("")
print("Übung 5")

my_list5 = [1, 2, 3, 4, 5]
new_list5 = my_list5[:2] + my_list5[3:]
print(new_list5)

print("")
print("Übung 6")

my_list6 = [1, 2, 3, 4, 5]
my_list6[3:4] = [100]
print(my_list6)

print("")
print("Übung 7")

my_list7 = [1, 2, 3, 4, 5]
my_list7[2:2] = [10,11]
print(my_list7)

print("")
print("Übung 8")

my_list8 = [1, 2, 3, 4, 5, 6, 7]
new_list8 = my_list8[4:]
print(new_list8)

print("")
print("Übung 9")

my_list9 = [1, 2, 3, 4, 5, 6, 7, 8]
my_list9[2:6] = [100, 101]
print(my_list9)

print("")
print("Übung 10")

my_string = "Hallo Welt"
new_string = my_string[6:]
print(new_string)
my_slice = slice(-4, None)
