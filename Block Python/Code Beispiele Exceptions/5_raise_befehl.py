def check_alter(alter):
    if alter < 0:
        raise ValueError("Das Alter darf nicht negativ sein.")
    elif alter < 18:
        print("Du bist minderjährig.")
    else:
        print("Du bist volljährig.")

try:
    check_alter(-1)
except ValueError as e:
    print(f"Fehler: {e}")
except Exception:
    print("Exception")
