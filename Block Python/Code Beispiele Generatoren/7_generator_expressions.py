quadrate_gen_exp = (x * x for x in range(5))

# print(quadrate_gen_exp)
for wert in quadrate_gen_exp:
    print(wert)  # Ausgabe: 0, 1, 4, 9, 16

# Ähnlich wie List Comprehensions, aber speichereffizienter:
#my_list = [x * x for x in range(5)]
#(my_list)

summe = sum( x * x for x in range(1000000) )
print(summe)  # Berechnet die Summe der Quadrate von 0 bis 999999, ohne eine Liste im Speicher zu halten.



"""
Generator-Ausdruck mit Klammern
    Klammern erforderlich: 
        Wenn du einen Generator-Ausdruck einer Variablen zuweist, musst du den Ausdruck in Klammern setzen. 
        Dies ist notwendig, da der Generator-Ausdruck eine eigenständige Einheit sein muss, die die Werte erzeugt, 
        während du darüber iterierst.
    Verwendung: 
         Die Klammern zeigen explizit an, dass du ein Generator-Objekt erstellst, das anschließend in einer 
         Schleife durchlaufen werden kann, wie im folgenden for-Loop.

Generator-Ausdruck innerhalb eines Funktionsaufrufs (wie sum())
    Klammern optional: 
         Wenn ein Generator-Ausdruck das einzige Argument einer Funktion wie sum() ist, musst du den Ausdruck nicht zusätzlich in Klammern setzen. Das liegt daran, dass der Funktionsaufruf selbst den erforderlichen Kontext bietet, um den Generator-Ausdruck als eine Einheit zu behandeln.
    Implizite Gruppierung: 
        Python erkennt, dass alles innerhalb der Funktion sum() Teil des Generator-Ausdrucks ist, daher sind zusätzliche Klammern überflüssig.

"""
