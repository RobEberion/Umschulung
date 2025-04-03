import { Router } from 'express';
import Product from '../models/Product.js';
import mongoose from 'mongoose';

const router = Router();

const STOCK_WARN_AMOUNT = 5;

router.post('/', async (req, res) => {
    try {
      req.body.stockWarn = Number(req.body.quantity) < STOCK_WARN_AMOUNT;
  
      const newProduct = new Product(req.body);
      const savedProduct = await newProduct.save();
  
      res.status(201).json({ msg: 'Product added', data: savedProduct });
    } catch (error) {
      console.error(error);
      res.status(500).json({ msg: 'Error adding product', error });
    }
  });

  router.get('/', async (req, res) => {
    try {
      const products = await Product.find({});
      res.status(200).json(products);
    } catch (error) {
      console.error(error);
      res.status(500).json({ msg: 'Products not found', error });
    }
  });

  router.get('/:id', async (req, res) => {
    const id = req.params.id;
    try {
      const product = await Product.findById(id);
      if (!product) {
        return res.status(404).json({ msg: 'Product not found' });
      }
      res.status(200).json(product);
    } catch (error) {
      console.error(error);
      res.status(500).json({ msg: 'Product not found', error });
    }
  });

  router.put('/', async (req, res) => {
    const id = req.body._id;
  
    // Überprüfen, ob die übergebene ID gültig ist
    if (!mongoose.isValidObjectId(id)) {
      return res.status(400).json({ msg: 'Ungültige Produkt-ID' });
    }
  
    try {
      // Aktualisiere die Stock-Warnung basierend auf der Menge
      req.body.stockWarn = Number(req.body.quantity) < 5;
  
      // Produkt aktualisieren
      const updatedProduct = await Product.findByIdAndUpdate(id, req.body, {
        new: true, // Gibt das aktualisierte Dokument zurück
      });
  
      if (!updatedProduct) {
        return res.status(404).json({ msg: 'Produkt nicht gefunden' });
      }
  
      res.status(200).json({ msg: 'Produkt erfolgreich aktualisiert', data: updatedProduct });
    } catch (error) {
      console.error('Fehler beim Aktualisieren des Produkts:', error);
      res.status(500).json({ msg: 'Fehler beim Aktualisieren des Produkts', error });
    }
  });

  router.delete('/:id', async (req, res) => {
    const id = req.params.id;
  
    if (!mongoose.isValidObjectId(id)) {
      return res.status(400).json({ msg: 'Invalid product ID' });
    }
  
    try {
      const deletedProduct = await Product.findByIdAndDelete(id);
      if (!deletedProduct) {
        return res.status(404).json({ msg: 'Product not found' });
      }
  
      res.status(200).json({ msg: 'Product deleted', data: deletedProduct });
    } catch (error) {
      console.error(error);
      res.status(500).json({ msg: 'Error deleting product', error });
    }
  });

  export default router;