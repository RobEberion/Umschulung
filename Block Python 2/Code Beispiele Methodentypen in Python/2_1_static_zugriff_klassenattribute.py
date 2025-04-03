class MyClass:
    class_variable = 0

    @staticmethod
    def static_method():
        MyClass.class_variable += 1  # Expliziter Zugriff auf die Klassenvariable


MyClass.static_method()
print(MyClass.class_variable)


"""
Obwohl statische Methoden keinen direkten Zugriff auf Klassenvariablen haben, können sie
dennoch explizit auf sie zugreifen, indem sie die Klasse namentlich referenzieren. 

Dies wird jedoch als unkonventionell angesehen und untergräbt den Zweck von statischen Methoden.

Statische Methoden sind entworfen, um unabhängig vom Zustand der Klasse oder ihrer Instanzen zu
arbeiten. 

Ihr Zweck ist es, Aufgaben auszuführen, die keinen Zugriff auf oder Änderungen an den
Daten der Klasse oder ihrer Instanzen erfordern.
"""