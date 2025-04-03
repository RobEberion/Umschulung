const fsconst = require('fs');

const data = fsconst.readFileSync('file.txt', 'utf-8')
console.log(data)