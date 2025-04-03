my_list = [0, 1, 2, 3, 4, 5, 6, 7]

print(my_list[slice(None, None, -1)])
# Verwende Slice Objekt, um die Liste umzukehren

print(my_list[slice(-3, None)])
# Greife auf die letzten drei Elemente zu
# Erklärung  1

print(my_list[slice(-3)])
# obigen Code ist tatsächlich äquivalent zu print(my_list[slice(None, -3)])
# Erklärung 2


"""
# Erklärung  1
        die Parameter von slice-Objekten funktionieren im Wesentlichen 
        genauso wie bei der Slicing-Syntax [:]. 
        
        Der Unterschied liegt in der Art und Weise, wie die Parameter 
        übergeben werden und wie sie verwendet werden. 
        
        my_list = [1, 2, 3, 4, 5, 6, 7]
        print(my_list[-3:])  # Ausgabe: [5, 6, 7]
        
        Hier bedeutet [-3:], dass das Slicing bei Index -3 beginnt 
        und bis zum Ende der Liste geht.
        
        Bei der Verwendung von slice() müssen Sie die Parameter explizit angeben
        
        Syntax: slice(start, stop, step)
        Wenn Sie None für stop angeben, bedeutet das "bis zum Ende der Liste".
        
        my_list = [1, 2, 3, 4, 5, 6, 7]
        x = slice(-3, None)
        print(my_list[x])  # Ausgabe: [5, 6, 7]

"""

"""
# Erklärung 2
        Der Code print(my_list[slice(-3)]) 
        ist tatsächlich äquivalent zu print(my_list[slice(None, -3)]).
        # [0, 1, 2, 3, 4]
        
        Wenn Sie nur einen einzelnen Wert in slice() angeben, wie in print(my_list[slice(-3)]), 
        interpretiert Python diesen Wert als den stop-Parameter.
        
        Der start-Parameter wird standardmäßig auf None gesetzt, was bedeutet, 
        dass das Slicing bei Beginn der Liste startet.
        
        Der step-Parameter wird ebenfalls auf den Standardwert 1 gesetzt, 
        wenn er nicht angegeben wird.

"""
