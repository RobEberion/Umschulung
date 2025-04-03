import color from 'chalk';
import express from 'express';

const app = express();

const HOST = '127.0.0.1';
const PORT = 8081;
const BASE_URL = `http://${HOST}:${PORT}`;

app.get('/', (req,res) =>{
    res.send('Hello Express');
});

app.listen(PORT, HOST, ()=>{
    console.log(color.magenta(`Server running at ${BASE_URL}`));
    console.log(color.yellow('Press Ctrl+C to quit.'));
});