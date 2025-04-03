import greetings

"""
In Python ist ein Modul eine Datei, die Python-Code enthält. Module werden verwendet, um Code logisch zu 
organisieren und wiederzuverwenden. Ein Modul kann Funktionen, Klassen, Variablen und ausführbaren Code 
definieren. Durch das Gruppieren verwandter Codes in Modulen kannst du deine Programme einfacher pflegen 
und den Code sauber und organisiert halten.
"""

# Initialisierung :
"""
    Wenn ein Modul importiert wird, werden dessen Inhalte einmalig (Automatisch) ausgeführt.
    
    Funktionen (und Klassen) werden nicht ausgeführt, es sei denn, sie werden im Modul selbst aufgerufen 
    oder vom aufrufenden Modul aufgerufen. 
    
    Aber print-Anweisungen und bedingte Anweisungen (wie if-Bedingungen) werden ausgeführt, falls das Modul 
    solche enthält.
"""


# Verhalten
"""
    Wenn ein Modul importiert wird, stehen seine Funktionen und Klassen dem aufrufenden Modul zur
    Verfügung und können mehrfach verwendet werden.
"""
print(greetings.farewell("Anna"))


