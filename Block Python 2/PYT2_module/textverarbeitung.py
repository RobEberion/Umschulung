#Übung 4


def anzahl_woerter(text: str) -> int:
    words = text.split()
    return len(words)


def anzahl_buchstaben(text: str) -> int:
    buchstaben = [char for char in text if char.isalpha()]
    return len(buchstaben)


def text_in_grossbuchstaben(text: str) -> str:
    return text.upper()
