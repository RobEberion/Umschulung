const fs = require('fs');

fs.unlink('file-3.txt', (error) => {
    if(error){
        console.log('Geht nicht! Error:', error)
    } else{
        console.log('Datei wurde gelöscht')
    }
})