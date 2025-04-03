def count_up_to(maximum):
    for count in range(1, maximum + 1):
        yield count


counter = count_up_to(3)
#print(counter)
#print(next(counter))  # Ausgabe: 1
#print(next(counter))  # Ausgabe: 2
#print(next(counter))  # Ausgabe: 3
#print(next(counter))  # StopIteration Error

# Nützlich für das Erzeugen von sequentiellen Werten, ohne vorher die gesamte Sequenz zu berechnen.



# Umwandlung des Generators in eine Liste
neue_counter = count_up_to(4)
counter_list = list(neue_counter)
print(counter_list)
print(next(neue_counter)) # StopIteration Error

"""
Generator-Verbrauch: 
    Ein Generator kann nur einmal durchlaufen werden. 
    Sobald ein Generator alle seine Werte "geyieldet" hat, ist er erschöpft und kann keine weiteren Werte 
    mehr liefern.
    
Umwandlung in Liste: 
    Wenn du list(neue_counter) aufrufst, wird der Generator vollständig durchlaufen, um die Liste zu erstellen. 
    Danach sind keine weiteren Werte im Generator vorhanden.

Fehler: 
    Der Versuch, nach der Umwandlung next(neue_counter) aufzurufen, 
    führt zu einem StopIteration-Fehler, weil der Generator keine weiteren Werte mehr hat.
"""