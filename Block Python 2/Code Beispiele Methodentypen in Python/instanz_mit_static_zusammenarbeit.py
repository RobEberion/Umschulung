class Temperature:
    def __init__(self, temperature):
        self.celsius = temperature

    def to_fahrenheit(self):
        return (self.celsius * 9 / 5) + 32

    @staticmethod
    def to_celsius(fhrn):
        return (fhrn - 32) * 5 / 9


# Verwendung
temp = Temperature(25)
temp_als_fahrenheit = temp.to_fahrenheit()
print(temp_als_fahrenheit)  # Ausgabe: 77.0

fahrenheit_zu_celsius = Temperature.to_celsius(temp_als_fahrenheit)
print(round(fahrenheit_zu_celsius,2))  # Ausgabe: 25.0
