words = ["apple", "banana", "cherry", "grape", "date", "fig",]


sorted_normal = sorted(words)
print(sorted_normal)

# Sortiere nach dem letzten Zeichen in jedem Wort
sorted_by_last_char = sorted(words, key=lambda x: x[-1])
print(sorted_by_last_char)
