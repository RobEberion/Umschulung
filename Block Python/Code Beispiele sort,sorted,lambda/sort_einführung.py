zahlen = [5, 3, 8, 1, 9]

zahlen.sort(reverse=True)  # Sortiert absteigend
print(zahlen)
# Ausgabe: [9, 8, 5, 3, 1]
# die ursprüngliche Liste wird geändert

zahlen.sort()  # ohne reverse parameter.
print(zahlen)
# die ursprüngliche Liste wird wieder geändert




"""
sort: Eine Methode von Listenobjekten, die die Liste in-place sortiert 
(die Original-Liste wird verändert).

Optionale Parameter:
    key: Eine Funktion, die für jedes Element einen Wert zurückgibt, der als Sortierkriterium dient. Der standartwert ist natürlichen Reihenfolge.
    
    reverse: Wenn auf True gesetzt, sortiert die Liste in absteigender Reihenfolge. 
    Der Standardwert ist False (aufsteigend!).

sort: Kann nur auf Listen angewendet werden und ändert die Liste in-place.
sort verändert die Original-Liste, sorted nicht.
https://www.w3schools.com/python/ref_list_sort.asp

"""

"""
natürlichen Reihenfolge Erkunden:
Die ord()Funktion gibt die Zahl zurück, die den Unicode-Code (Reihenfolge) eines angegebenen Zeichens darstellt.
https://www.ssec.wisc.edu/~tomw/java/unicode.html


print(ord('A'))
print(ord('a'))
print(ord(' '))
print(ord('1'))


print(chr(65))
print(chr(97))
"""
