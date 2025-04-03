import greetings

"""
Dies ist die grundlegendste Art des Imports. Hier wird das gesamte greetings-Modul importiert, 
und man greift auf die Klasse Greeter und die Funktion farewell mit dem Modulnamen als Präfix zu.
"""

# Verwendung der Greeter-Klasse und der farewell-Funktion aus dem greetings-Modul
grusseen = greetings.Greeter("Guten Morgen")
print(grusseen.greet("Anna"))
print(greetings.farewell("Anna"))
