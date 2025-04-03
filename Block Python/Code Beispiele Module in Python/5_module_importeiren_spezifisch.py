from greetings import Greeter, farewell

"""
Hier wird nur die benötigte Klasse oder Funktion importiert. Dies ist effizient, da Sie nur das importieren,
was Sie benötigen, und auf die Klassen und Funktionen direkt zugreifen können, ohne den Modulnamen als 
Präfix zu verwenden.
"""

# Direktes Verwenden der Greeter-Klasse und der farewell-Funktion ohne Modulpräfix
greeter = Greeter("Guten Abend")
print(greeter.greet("Anna"))
print(farewell("Anna"))
