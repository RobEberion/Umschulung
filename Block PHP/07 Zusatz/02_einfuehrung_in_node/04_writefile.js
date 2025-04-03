const fs = require('fs');

const data = 'Hallo Erde'

fs.writeFile('file-3.txt', data, 'utf-8', (error) => {
    if(error){
        console.log('Error:', error)
    } else {
        console.log('Datei wurde erfolgreich geschrieben!')
    }
})