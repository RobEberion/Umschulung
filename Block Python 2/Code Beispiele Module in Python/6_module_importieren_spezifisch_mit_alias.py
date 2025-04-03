from greetings import Greeter as Greet, farewell as bye

# Auch hier können Sie ein Alias für eine importierte Klasse oder Funktion verwenden.
# Verwendung der Greeter-Klasse und der farewell-Funktion mit Aliassen
greeter = Greet("Hallo")
print(greeter.greet("Anna"))
print(bye("Anna"))
