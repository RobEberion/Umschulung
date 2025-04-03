document.getElementById('loadJsonHtml').addEventListener('click', () => {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'data/example.json', true);

    xhr.onload = function () {
        if (this.status === 200) {
            try {
                const data = JSON.parse(this.responseText);
                const { name, alter, hobbys, stadt } = data;

                const htmlContent = `
                    <p><strong>Name:</strong> ${name}</p>
                    <p><strong>Alter:</strong> ${alter}</p>
                    <p><strong>Stadt:</strong> ${stadt}</p>
                    <p><strong>Hobbys:</strong></p>
                    <ul>
                        ${hobbys.map(hobby => `<li>${hobby}</li>`).join('')}
                    </ul>
                `;

                document.getElementById('jsonOutput-2').innerHTML = htmlContent;
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
