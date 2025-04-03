print("Übung 1")


class Vektor:
    def __init__(self, x, y):
        self.x = x
        self.y = y

    def __repr__(self):
        return f"Vector({self.x}, {self.y})"

    def __add__(self, other):
        return Vektor(self.x + other.x, self.y + other.y)

    def __sub__(self, other):
        return Vektor(self.x - other.x, self.y - other.y)

    def __mul__(self, scalar):
        return Vektor(self.x * scalar, self.y * scalar)


v1 = Vektor(2, 4)
v2 = Vektor(5, 9)

print(v1 + v2)
print(v1 - v2)
print(v1 * 4)


print("")
print("Übung 2")


class Buch:
    def __init__(self, author, title, pages):
        self.author = author
        self.title = title
        self.pages = pages

    def __str__(self):
        return f"Author: {self.author}, Titel: {self.title}, Seiten: {self.pages}"

    def __len__(self):
        return self.pages

    def __del__(self):
        print(f'Das Buch "{self.title}" von "{self.author}" wird gelöscht.')
        del self.author
        del self.title
        del self.pages


buch1 = Buch("Lari-Fari", "Chaos-Theorie", 10)
print(buch1)
anzahl_seiten = len(buch1)
print(anzahl_seiten)

del buch1
#print(buch1)


print("")
print("Übung 3")


class Container:
    def __init__(self):
        self.items = []

    def __getitem__(self, index):
        return self.items[index]

    def __setitem__(self, index, value):
        if index >= len(self.items):
            self.items.extend([None] * (index + 1 - len(self.items)))
        self.items[index] = value

    def __delitem__(self, index):
        del self.items[index]

    def __len__(self):
        return len(self.items)

    def __str__(self):
        return str(self.items)


container = Container()
container[0] = "Python"
container[1] = "Java"
container[2] = "Ruby"
container[3] = "C++"
print(container)
print(container[1])
del container[1]
print(len(container))


