document.getElementById('uploadFile').addEventListener('click', () => {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0]; 

    if (!file) {
        document.getElementById('uploadOutput').innerText = 'Bitte wähle eine Datei aus.';
        console.error('Keine Datei ausgewählt.');
        return;
    }

    const reader = new FileReader();

    reader.onload = function () {
        document.getElementById('fileContent').innerText = reader.result;
    };

    reader.onerror = function () {
        console.error('Fehler beim Lesen der Datei.');
        document.getElementById('fileContent').innerText = 'Fehler beim Lesen der Datei.';
    };

    reader.readAsText(file);

    const formData = new FormData();
    formData.append('file', file);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'https://httpbin.org/post', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('uploadOutput').innerText = `Erfolgreich hochgeladen:\n${xhr.responseText}`;
        } else {
            console.error(`Fehler beim Hochladen: ${xhr.status}`);
            document.getElementById('uploadOutput').innerText = `Fehler: ${xhr.status}`;
        }
    };

    xhr.onerror = function () {
        console.error('Netzwerkfehler bei der Anfrage.');
        document.getElementById('uploadOutput').innerText = 'Netzwerkfehler. Überprüfung der Verbindung erforderlich.';
    };

    xhr.send(formData);
});
