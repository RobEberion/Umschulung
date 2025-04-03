# Definition der Klasse 'Haus', die den Bauplan für alle Häuser darstellt
class Haus:
    # Der Konstruktor __init__ wird aufgerufen, wenn ein neues Objekt der Klasse erstellt wird.
    # Er initialisiert die Attribute 'zimmer', 'stockwerke' und 'farbe' mit den Werten,
    # die beim Erstellen des Objekts übergeben werden.
    def __init__(self, zimmer, stockwerke, farbe):
        self.zimmer = zimmer      # Attribut für die Anzahl der Zimmer im Haus
        self.stockwerke = stockwerke  # Attribut für die Anzahl der Stockwerke im Haus
        self.farbe = farbe        # Attribut für die Farbe des Hauses

    # Methode zur Beschreibung des Hauses
    def beschreibung(self):
        # Diese Methode gibt eine Beschreibung des Hauses aus, basierend auf den Attributen des Objekts.
        print(f"Dieses Haus hat {self.zimmer} Zimmer, {self.stockwerke} Stockwerke und ist {self.farbe} gestrichen.")




# Erstellen eines Objekts 'mein_haus' der Klasse 'Haus'
# Dies ist die konkrete Instanz, die einem spezifischen Haus entspricht.
mein_haus = Haus(5, 2, "blau")  # Das Haus hat 5 Zimmer, 2 Stockwerke und ist blau gestrichen


# Aufruf der Methode 'beschreibung' für das Objekt 'mein_haus'
# Diese Methode gibt die spezifischen Details des Hauses aus.
mein_haus.beschreibung()  # Ausgabe: Dieses Haus hat 5 Zimmer, 2 Stockwerke und ist blau gestrichen.

mein_zweite_haus = Haus(20, 7, "rot")
mein_zweite_haus.beschreibung()
