import fs from 'node:fs';
import color from 'chalk';
import express from 'express';

const app = express();

// Terminal:
// npm run dev

const HOST = '127.0.0.1'; //or 'localhost'
const PORT = 8081;
const BASE_URL = `http://${HOST}:${PORT}`;
const STOCK_WARN_AMOUNT = 5;

app.set('view engine', 'ejs');

app.use(express.static('public'));

fs.readFile('data/products.csv', 'UTF8', (error,data) =>{
    if (error) {
        console.error("Fehler beim Lesen der Datei:", error);
        return;
    }

    const products = data.split('\n');
    products.shift()

    const entries = products.filter((row) => row !== '').map(recordToObject);

    app.get('/', (req, res) =>{
        res.render('index', {products: entries})
    });

    app.get('/product/:id', (req, res) => {
        const idx = req.params.id - 1;
        res.render('product', { product: entries[idx] });
      });
});

const recordToObject = (record) => {
    const fields = record.split(/\s*,\s*/); 
    return {
      code: fields[0],
      shortDescription: fields[1],
      tagline: fields[2],
      quantity: Number(fields[3]),
      price: Number(fields[4]),
      stockWarn: fields[3] <= STOCK_WARN_AMOUNT ? true : false,
    };
  };

  app.listen(PORT, HOST, () => {
    console.log(color.magenta(`Server running at ${BASE_URL}`));
    console.log(color.yellow('Press Ctrl+C to quit.'));
  });