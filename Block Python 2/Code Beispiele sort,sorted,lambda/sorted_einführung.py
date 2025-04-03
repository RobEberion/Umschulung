text = "Python"
sortierter_text = sorted(text)  # Sortiert die Buchstaben alphabetisch - nach Unicode-Code (Reihenfolge)
print(sortierter_text)
print(text)  # wird nicht geändert


sortierter_text_reverse = sorted(text, reverse=True)  # Sortiert absteigend
print(sortierter_text_reverse)




"""
sorted ist eine eingebaute Python-Funktion, die nicht nur Listen,
sondern auch andere iterierbare Datentypen wie Tupel, Sets oder sogar Zeichenketten sortieren kann.

sorted gibt eine neue sortierte Liste zurück, ohne das Original-Objekt zu verändern.

Parameter
key: Eine Funktion, die für jedes Element einen Wert zurückgibt, der als Sortierkriterium dient. Der standartwert ist natürlichen Reihenfolge.
reverse: Wenn auf True gesetzt, wird die Liste in absteigender Reihenfolge sortiert. Der Standardwert ist False (aufsteigend).

sort: Kann nur auf Listen angewendet werden und ändert die Liste in-place.
sort verändert die Original-Liste, sorted nicht.

https://www.w3schools.com/python/ref_func_sorted.asp


"""


"""
natürlichen Reihenfolge Erkunden :
Die ord()Funktion gibt die Zahl zurück, die den Unicode-Code (Reihenfolge) eines angegebenen Zeichens darstellt.
https://www.ssec.wisc.edu/~tomw/java/unicode.html


print(ord('A'))
print(ord('a'))
print(ord(' '))
print(ord('1'))


print(chr(65))
print(chr(97))
"""
