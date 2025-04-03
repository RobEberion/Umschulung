class CustomDict:
    def __init__(self):
        """
        Initialisiert das CustomDict mit einem leeren Wörterbuch.
        """
        self.data = {}

    def __getitem__(self, key):
        """
        Ermöglicht den Zugriff auf Werte im Wörterbuch mit der Schlüssel-Syntax.
        Beispiel: value = custom_dict[key]
        """
        return self.data[key]

    def __setitem__(self, key, value):
        """
        Setzt einen Wert für einen bestimmten Schlüssel im Wörterbuch.
        Beispiel: custom_dict[key] = value
        """
        self.data[key] = value
        print(f"Setze {key} auf {value}")

    def __delitem__(self, key):
        """
        Löscht einen Schlüssel-Wert-Eintrag im Wörterbuch.
        Beispiel: del custom_dict[key]
        """
        del self.data[key]  # Dieses Element wird nicht gelöscht, wenn dieser Code kommentiert wird.
        print(f"{key} wurde gelöscht")

    def __del__(self):
        """
        Wird aufgerufen, wenn das Objekt gelöscht wird. Hier können Aufräumarbeiten durchgeführt werden.
        Im Gegensatz zu anderen magischen Methoden erlaubt dir __del__ nicht, zu ändern, wie oder wann ein
        Objekt gelöscht wird. Der Prozess der Objektlöschung wird vom Speichermanagement und Garbage
        Collector von Python verwaltet. Die Methode __del__ bietet lediglich die Möglichkeit, in diesen
        Prozess einzugreifen, um einige abschließende Operationen durchzuführen, aber sie kontrolliert
        oder verhindert die Löschung selbst nicht.
        """
        print("CustomDict-Objekt wird gelöscht.")

    def __str__(self):
        print("meaw")
        return str(self.data)


# Beispielverwendung der CustomDict-Klasse
# Eine Instanz der CustomDict-Klasse erstellen
custom_dict = CustomDict()

# Setzen von Werten mit __setitem__
custom_dict['name'] = 'Alice'  # Ausgabe: Setze name auf Alice
custom_dict['age'] = 30  # Ausgabe: Setze age auf 30
custom_dict['land'] = 'Wonderland'

# Zugriff auf Werte mit __getitem__
print(custom_dict['name'])  # Ausgabe: Alice

# Löschen eines Eintrags mit __delitem__
del custom_dict['age']  # Ausgabe: age wurde gelöscht

# Ausgabe des gesamten CustomDict
print(custom_dict)

# Löschen des gesamten Objekts mit __del__
del custom_dict  # Ausgabe: CustomDict-Objekt wird gelöscht.

# print(custom_dict) #NameError name 'custom_dict' is not defined.
