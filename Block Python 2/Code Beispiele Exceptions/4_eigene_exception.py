class NegativeWertError(Exception):
    """Exception, die ausgelöst wird, wenn ein negativer Wert gefunden wird."""
    def __init__(self, wert, nachricht="Wert darf nicht negativ sein"):
        self.wert = wert
        self.nachricht = nachricht
        super().__init__(f"{nachricht}: {wert}")  # Übergabe der Nachricht an die Exception-Basisklasse

def check_wert(wert):
    if wert < 0:
        raise NegativeWertError(wert)
    return wert  # Wenn kein Fehler auftritt, wird der Wert zurückgegeben.

try:
    wert = check_wert(-7)
except NegativeWertError as e:
    print(f"Fehler: {e}")  # Ausgabe der kombinierten Fehlermeldung
    #print(e.nachricht) #print(e.wert)
else:
    print(f"Der Wert ist: {wert}")  # Dieser Block wird nur ausgeführt, wenn kein Fehler auftritt
finally:
    print("Prüfung abgeschlossen.")  # Dieser Block wird immer ausgeführt, unabhängig von Fehlern


"""
e ist ein Objekt der Klasse NegativeWertError.

Dieses Objekt e enthält die Attribute nachricht und wert, die in der __init__-Methode der Klasse NegativeWertError 
definiert wurden.
Probiere #print(e.nachricht) #print(e.wert)

Wenn eine Exception ausgelöst (also mit raise erzeugt) wird und der except-Block sie abfängt, 
wird das Exception-Objekt der angegebenen Variablen (in diesem Fall e) zugewiesen. 

Dieses Objekt enthält alle Informationen, die die Exception bereitstellt, einschließlich der 
Attribute und der Nachricht, die du in der benutzerdefinierten Exception-Klasse definiert hast.

"""

"""
Wenn du super().__init__(f"{nachricht}: {wert}") verwendest, wird die zusammengesetzte Nachricht an 
die Basisklasse Exception übergeben. Dadurch kannst du die vollständige Fehlermeldung direkt beim Abfangen
 der Exception im except-Block ausgeben. Das ist nützlich, wenn du möchtest, dass die Exception selbst 
 eine beschreibende Nachricht hat.


Wenn du diesen Schritt weglässt, kannst du immer noch auf die Attribute nachricht und wert direkt zugreifen, 
aber die Exception selbst enthält keine beschreibende Nachricht, wenn du sie abfängst. 
Du könntest die Nachricht dann manuell zusammenstellen oder die Attribute getrennt behandeln.

    Wenn super().__init__() kommentiert ist (oder weglässt), wird das wert-Argument nicht explizit an die Exception-Basisklasse weitergeleitet. 
    Aber weil NegativeWertError von Exception erbt, wird der Wert wert implizit als einziges Argument an 
    die Basisklasse übergeben.
    
    Wenn du dann print(e) ausführst, wird intern str(e) aufgerufen, und weil Exception mit wert initialisiert wurde, 
    wird dieser Wert (in diesem Fall -10) als Fehlermeldung ausgegeben.


"""