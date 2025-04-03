# benutzerdefinierten Kontextmanager

class ContextManager():
    def __init__(self):
        print('init method called')

    def __enter__(self):
        print('enter method called')
        return self

    def __exit__(self, exc_type, exc_value, exc_traceback):
        print('exit method called')


with ContextManager() as manager:
    print('with statement block')


"""
Dieses Python-Programm demonstriert die Erstellung und Verwendung eines benutzerdefinierten 
Kontextmanagers mithilfe einer Klasse. 

Ein Kontextmanager in Python ist ein Objekt, das den Laufzeitkontext definiert, 
der beim Ausführen einer with-Anweisung eingerichtet wird. 

Der Hauptzweck der Verwendung eines Kontextmanagers besteht darin, 
Ressourcen wie das Öffnen und Schließen von Dateien oder 
das Verwalten von Datenbankverbindungen auf eine saubere und effiziente Weise zu verwalten.

Der Kontextmanager ist nützlich, um Ressourcen zu verwalten und sicherzustellen, dass notwendige Aufräumvorgänge automatisch durchgeführt werden, selbst wenn innerhalb des with-Blocks eine Exception auftritt.
"""



"""

Der 'with' Befehl stellt sicher, dass Ressourcen ordnungsgemäß erworben und freigegeben werden, 
was häufige Fehler wie das Vergessen, eine Datei zu schließen, oder das Offenlassen einer Datenbankverbindung 
verhindert.

Beispiel Dateilesen:
    my_file = open("hello.txt", "r")
    print(my_file.read())
    my_file.close()
    
    
    Im Gegensatz zu open(), wo du die Datei mit der close()-Methode selbst schließen musst, 
    schließt der with-Befehl die Datei für dich, ohne dass du es ihm explizit sagen musst.
    
    with open("hello.txt") as my_file:
     print(my_file.read())

"""
