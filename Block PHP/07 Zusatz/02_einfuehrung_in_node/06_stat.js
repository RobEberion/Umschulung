const fs = require('fs');

fs.stat('file.txt', (error, stats) => {
    if(error){
        console.log('Error:', error)
    } else{
        console.log('Dateigröße:', stats.size, 'Bytes')
    }
})