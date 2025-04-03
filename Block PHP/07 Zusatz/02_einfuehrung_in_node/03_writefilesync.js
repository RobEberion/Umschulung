const fs = require('fs');

const data = 'Hallo Juiter und Mars'
fs.writeFileSync('file-3.txt', data, 'utf-8')
console.log('Datei wurde erfolgreich geschrieben!')