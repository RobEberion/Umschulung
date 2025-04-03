def unendliche_sequenz(start=0):
    while True:
        yield start
        start += 1


gen = unendliche_sequenz()
print(next(gen))  # Ausgabe: 0
print(next(gen))  # Ausgabe: 1
print(next(gen))
print(next(gen))
print(next(gen))
print(next(gen))

"""
Unendliche Sequenzen sind besonders nützlich in Situationen, in denen man einen kontinuierlichen 
Stream von Werten benötigt und im Voraus nicht genau weiß, wie viele Werte man letztendlich braucht

Beim Arbeiten mit Echtzeit-Datenströmen, wie Sensordaten, Finanzmarktdaten oder der Überwachung von Logdateien,
müssen Daten oft verarbeitet werden, sobald sie eintreffen, ohne dass im Voraus bekannt ist,
wie viele Daten generiert werden. Ein unendlicher Generator kann Datenpunkte erzeugen, sobald sie verfügbar
sind, und ermöglicht es Ihrem Programm, diese nacheinander zu verarbeiten.

z.B.

def sensor_data():
    while True:
        yield read_sensor()  # read_sensor() liest die aktuellen Sensordaten


"""