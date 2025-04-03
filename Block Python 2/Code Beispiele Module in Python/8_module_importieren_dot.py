"""
->Wir haben einen Ordner namens tier,
->in diesem Ordner eine Datei namens katze,
->in dieser Datei eine Funktion namens meaw().
->Wir möchten auf diese Funktion zugreifen.
"""


"""
# möglichkeit 1
import tier.katze
tier.katze.meaw()
"""

"""
# möglichkeit 2
from tier.katze import meaw
meaw()
"""


"""
#Diese Syntax bringt ModuleNotFoundError:
import tier.katze.meaw
    
    Wenn Sie per Punktnotation importieren, sollte das letzte Element immer ein Modul sein,
    das die Funktionen enthält.
    Hier ist das letzte Element jedoch kein Modul, sondern eine Funktion innerhalb eines Moduls.
"""


