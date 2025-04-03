import greetings as gr

"""
Wenn der Modulname lang ist oder man den Namen abkürzen möchte, kann man ein Alias verwenden.
"""
# Verwendung der Greeter-Klasse und der farewell-Funktion mit einem Alias für das Modul
greeter = gr.Greeter("Moin")
print(greeter.greet("Anna"))
print(gr.farewell("Anna"))
