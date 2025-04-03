document.getElementById('loadTxt').addEventListener('click', () => {
    const xhr = new XMLHttpRequest();
    console.log(xhr)

    xhr.open('GET','data/example.txt', true);
    xhr.onload = function () {
        if(this.status === 200) {
            document.getElementById('txtOutput').innerText = this.responseText;
        }else{
            console.error('Fehler beim Laden der TXT-Datei:', this.status)
        }
    };

    xhr.error = function(){
        console.error('Anfrage fehlgeschlagen')
    };

    xhr.send();
    })