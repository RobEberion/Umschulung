const fs = require('fs');

fs.readFile('file.txt', 'utf-8', (error, data) => {
    if(error){
        console.log('Error:', error)
    } else {
        console.log(data)
    }
})