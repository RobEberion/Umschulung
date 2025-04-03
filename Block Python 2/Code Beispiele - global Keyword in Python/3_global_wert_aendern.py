x = 11

def meaw():
  # global x
  x+=1
  print(f"value of x from meaw function {x}")


meaw()
print(f"value of outside meaw function {x}")




"""
Globale Variablen sind in Python im gesamten Programm und innerhalb jeder Funktion zugänglich.
 Allerdings können globale Variablen innerhalb einer Funktion nicht geändert werden, es sei denn, 
 wir verwenden das Schlüsselwort global innerhalb dieser Funktion. (ähnlich wie import !)

Ohne das global-Schlüsselwort betrachtet Python jede Zuweisung einer Variable innerhalb einer
Funktion als Zuweisung an eine lokale Variable. Das bedeutet, dass die globale Variable nicht beeinflusst wird,
es sei denn, wir sagen Python explizit durch das global-Schlüsselwort, dass wir auf die globale Variable 
zugreifen und sie ändern möchten.
"""