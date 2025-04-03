from greetings import *

"""
Sie können auch alle Klassen und Funktionen eines Moduls importieren. 
!!!Diese Methode kann jedoch zu Namenskonflikten führen, wenn mehrere Module ähnliche Namen für Klassen 
oder Funktionen haben.

"""
# Direkter Zugriff auf alle importierten Funktionen und Klassen
greeter = Greeter("Bonjour")
print(greeter.greet("Anna"))
print(farewell("Anna"))
