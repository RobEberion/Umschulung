import greetings

"""
Wenn ein Modul importiert wird, werden dessen Inhalte einmalig (Automatisch) ausgeführt.

Funktionen (und Klassen) werden nicht ausgeführt, es sei denn, sie werden im Modul selbst aufgerufen 
oder vom aufrufenden Modul aufgerufen. 

Aber print-Anweisungen und bedingte Anweisungen (wie if-Bedingungen) werden ausgeführt, falls das Modul 
solche enthält.
"""

print("\n\nDokumentation der greetings Module:", greetings.__doc__)

print("\n\nDokumentation der Klasse Greeter aus dem greetings Module:", greetings.Greeter.__doc__)
print("\n\nDokumentation der greet Methode in der Klasse Greeter aus dem greetings Module:", greetings.Greeter.greet.__doc__)
print("\n\nDokumentation der __init__ Methode (Konstruktor) in der Klasse Greeter "
      "aus dem greetings Module:", greetings.Greeter.__init__.__doc__)


print("\n\nDokumentation der Funktion farewell() aus dem greetings Module:", greetings.farewell.__doc__)
