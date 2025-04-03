const fs = require('fs');

const stats = fs.statSync('file.txt')
console.log('Dateigröße:', stats.size, 'Bytes')