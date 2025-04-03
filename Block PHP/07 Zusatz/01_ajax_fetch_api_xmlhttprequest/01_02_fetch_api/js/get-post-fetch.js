document.getElementById('getData').addEventListener('click',() =>{
    fetch('data/example.json')
        .then(response => {
            if(!response.ok) {
                throw new Error (`Fehler: ${response.status}`)
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('getOutput').innerText = JSON.stringify(data, null, 2);
        })
        .catch(error => {
            console.error('Fehler bei der GET-Anfrage:', error)
        });
});

document.getElementById('postData').addEventListener('click',() =>{
    const postData = {
        name: 'Max Mustermann',
        alter: 30,
        stadt: 'Berlin'
    };

    fetch('https://httpbin.org/post', {
        method: 'POST',
        header: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(postData)
    })
    .then(response => {
        if(!response.ok) {
            throw new Error (`Fehler: ${response.status}`)
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('postOutput').innerText = JSON.stringify(data, null, 2);
    })
    .catch(error => {
        console.error('Fehler bei der POST-Anfrage:', error)
    });
});