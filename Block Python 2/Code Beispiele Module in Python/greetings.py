"""
Dieses Modul demonstriert, wie man ein Modul aus einer anderen Datei aufruft, ein Modul verwendet und Docstrings anzeigt.

Klassen:
    Greeter:
        Eine Klasse, die eine Begrüßungsnachricht generiert. Der Begrüßungstext kann beim Erstellen der Klasse angegeben werden.

Funktionen:
    farewell(name):
        Nimmt einen Namen als Eingabe entgegen und gibt eine Abschiedsnachricht zurück.

Dieses Modul zeigt außerdem, wie man das `__module__`- und `__name__`-Attribut verwendet, um Informationen über das
aktuelle Modul und seine Komponenten zu erhalten."""


class Greeter:
    """
    Eine Klasse zur Erzeugung von Begrüßungsnachrichten.

    Konstruktor:
        __init__(greeting):
            Initialisiert die Klasse mit einem Begrüßungstext.

    Methoden:
        greet(name):
            Nimmt einen Namen als Eingabe entgegen und gibt eine Begrüßungsnachricht zurück.
    """

    def __init__(self, greeting):
        """
         Initialisiert die Greeter-Klasse mit einem spezifischen Begrüßungstext.

         Parameter:
            greeting (str): Der Begrüßungstext, der verwendet werden soll.
        """
        self.greeting = greeting

    def greet(self, name):
        """
        Nimmt einen Namen als Eingabe entgegen und gibt eine Begrüßungsnachricht zurück.

        Parameter:
            name (str): Der Name der Person, die gegrüßt werden soll.

        Rückgabe:
            str:  str: Eine Begrüßungsnachricht, die den festgelegten Begrüßungstext und den gegebenen Namen enthält.
        """
        return f"{self.greeting}, {name}!"


# In der Praxis würden wir die Funktion farewell() selbstverständlich in die Klasse Greetings integrieren.
# Dies hier dient jedoch nur zu Lernzwecken.
def farewell(name):
    """
       Nimmt einen Namen als Eingabe entgegen und gibt eine Abschiedsnachricht zurück.

       Parameter:
           name (str): Der Name der Person, von der Abschied genommen wird.

       Rückgabe:
           str: Eine Abschiedsnachricht für den gegebenen Namen.
       """
    return f"Goodbye, {name}!"


# Überprüfen des __module__ und __name__  -Attributs
if __name__ == "__main__":
    greeter = Greeter("Hallo")
    print(f"Die Objekt greeter ist in diesem Modul definiert : {greeter.__module__}")
    print(f"Die Klasse Greeter ist in diesem Modul definiert : {Greeter.__module__}")
    print(f"Die Funktion farewell() ist in diesem Modul definiert.: {farewell.__module__} ")
else:
    print(f"Der Name des Moduls, das Sie gerade importiert haben, ist: {__name__}")
    print(f"Die Klasse Greeter ist in diesem Modul definiert : {Greeter.__module__}")
    print(f"Die Funktion farewell() ist in diesem Modul definiert.: {farewell.__module__} \n\n")

