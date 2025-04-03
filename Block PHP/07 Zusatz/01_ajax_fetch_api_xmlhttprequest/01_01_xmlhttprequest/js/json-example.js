document.getElementById('loadJson').addEventListener('click', () => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'data/example.json', true);

    xhr.onload = function () {
        if (this.status === 200) {
            try {
                const data = JSON.parse(this.responseText);
                document.getElementById('jsonOutput').innerText = JSON.stringify(data, null, 2);
            } catch (error) {
                console.error('Fehler beim Parsen des JSON:', error);
            }
        } else {
            console.error('Fehler beim Laden der JSON-Datei:', this.status);
        }
    };

    xhr.onerror = function () {
        console.error('Anfrage fehlgeschlagen.');
    };

    xhr.send();
});
