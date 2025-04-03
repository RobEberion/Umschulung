def einfache_generator():
    print("Start")
    yield 1
    print("Zwischenwert")
    yield 2
    print("Ende")
    yield 3


my_generator = einfache_generator()
print(next(my_generator))
# Der Generator pausiert nach jedem yield und wird beim nächsten Aufruf fortgesetzt.

print(next(my_generator))
print(next(my_generator))



print(next(my_generator)) # StopIteration Error



