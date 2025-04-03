#!/usr/bin/env python3

print("hallo")

"""

Eine Shebang-Zeile ist ein spezieller Kommentar am Anfang der Datei, der den Interpreter angibt, 
der zur Ausführung des Skripts verwendet werden soll. Sie wird auch Hashbang genannt.


Die Shebang-Zeile beginnt mit den Zeichen #!, gefolgt vom Pfad zum Interpreter.


Um das Python-Skript auszuführen, müssen wir der Shell drei Dinge mitteilen:

1.Dass die Datei ein Skript ist.
2.Welchen Interpreter wir zur Ausführung des Skripts verwenden möchten.
3.Den Pfad zu diesem Interpreter.

    Der Shebang #! erfüllt den ersten Punkt. Der Shebang beginnt mit einem #, weil das #-Zeichen in vielen
    Skriptsprachen ein Kommentarzeichen ist. Der Inhalt der Shebang-Zeile wird daher automatisch vom Interpreter
     ignoriert.

    Der env-Befehl erledigt die Punkte zwei und drei.

Der Shebang (#!) wird in Unix-ähnlichen Betriebssystemen benötigt (Linux Mac). Windows Braucht es nicht:

"""