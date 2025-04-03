'use strict';

(() => {
  // === DOM & VARS =======
  const DOM = {};
  DOM.productManager = document.querySelector('.m-product-manager');
  DOM.products = DOM.productManager.querySelector('.products');
  DOM.templateProduct = DOM.productManager.querySelector('.template-product');
  DOM.templateCardProduct = DOM.productManager.querySelector(
    '.template-card-product'
  );

  DOM.buttonProductAdd = DOM.productManager.querySelector(
    '.button-product-add'
  );

  DOM.modalProductAddUpdate = DOM.productManager.querySelector(
    '#modal-product-add-update'
  );

  DOM.formProductAddUpdate = DOM.modalProductAddUpdate.querySelector(
    '.form-product-add-update'
  );
  DOM.inputProductCode =
    DOM.modalProductAddUpdate.querySelector('input[name="code"]');

  DOM.inputProductId =
    DOM.modalProductAddUpdate.querySelector('input[name="id"]');

  DOM.inputProductTagline = DOM.modalProductAddUpdate.querySelector(
    'input[name="tagline"]'
  );
  DOM.textareaProductShortDescription = DOM.modalProductAddUpdate.querySelector(
    'textarea[name="shortDescription"]'
  );
  DOM.inputProductQuantity = DOM.modalProductAddUpdate.querySelector(
    'input[name="quantity"]'
  );
  DOM.inputProductPrice = DOM.modalProductAddUpdate.querySelector(
    'input[name="price"]'
  );

  DOM.buttonProductConfirmAddUpdate = DOM.modalProductAddUpdate.querySelector(
    '.button-product-confirm-add-update'
  );

  const bsModalProductAddUpdate = new bootstrap.Modal(
    DOM.modalProductAddUpdate
  );

  console.log(DOM);
  // === INIT =============
  const init = () => {
    getProducts().then((products) => {
      createProductsEls(products);
    });
    DOM.buttonProductAdd.addEventListener('click', onClickProductAdd);

    DOM.formProductAddUpdate.addEventListener(
      'submit',
      onSubmitProductAddUpdate
    );
  };

  // === EVENTHANDLER =====

  // Richtig
  const onSubmitProductAddUpdate = (e) => {
    e.preventDefault();
  
    // Produktdaten aus dem Formular sammeln
    const product = {
      code: DOM.inputProductCode.value,
      tagline: DOM.inputProductTagline.value,
      shortDescription: DOM.textareaProductShortDescription.value,
      quantity: parseInt(DOM.inputProductQuantity.value, 10),
      price: parseFloat(DOM.inputProductPrice.value),
    };
  
    if (DOM.inputProductId.value) {
      product._id = DOM.inputProductId.value; // Nur setzen, wenn eine ID vorhanden ist (bei Update)
    }
  
    // Aktion überprüfen (add oder update)
    if (DOM.formProductAddUpdate.dataset.action === 'add') {
      console.log('Hinzufügen Aktion ausgelöst');
      addProduct(product).then((data) => {
        if (data) {
          console.log('Produkt erfolgreich hinzugefügt:', data);
          getProducts().then((products) => createProductsEls(products));
          bsModalProductAddUpdate.hide(); // Modal schließen
        } else {
          alert('Produkt konnte nicht hinzugefügt werden.');
        }
      });
    } else if (DOM.formProductAddUpdate.dataset.action === 'update') {
      console.log('Update Aktion ausgelöst');
      console.log('Zu aktualisierendes Produkt:', product);
  
      updateProduct(product).then((data) => {
        if (data) {
          console.log('Produkt erfolgreich aktualisiert:', data);
          getProducts().then((products) => createProductsEls(products));
          bsModalProductAddUpdate.hide(); // Modal schließen
        } else {
          alert('Produkt konnte nicht aktualisiert werden.');
        }
      });
    }
  };
  

  /* const onClickProductAdd = (e) => {
    console.log('click');
    DOM.modalProductAddUpdate.querySelector(
      '.modal-product-title'
    ).textContent = 'Add Product';
    DOM.modalProductAddUpdate.querySelector(
      '.button-product-confirm-add-update'
    ).textContent = 'Add Product';
  };
  */

  // Richtig
  const onClickProductAdd = () => {
    DOM.modalProductAddUpdate.querySelector('.modal-product-title').textContent = 'Add Product';
    DOM.buttonProductConfirmAddUpdate.textContent = 'Add Product';
  
    // Felder leeren
    DOM.inputProductCode.value = '';
    DOM.inputProductTagline.value = '';
    DOM.textareaProductShortDescription.value = '';
    DOM.inputProductQuantity.value = '';
    DOM.inputProductPrice.value = '';
    DOM.inputProductId.value = '';
  
    DOM.formProductAddUpdate.dataset.action = 'add';
  };
  
/*
  const onClickProductEdit = (e) => {
    console.log('edit');
    const productEl = e.target.closest('.product');
    const id = productEl.dataset.id;

    getProductById(id).then((product) => {
      DOM.modalProductAddUpdate.querySelector(
        '.modal-product-title'
      ).textContent = 'Edit Product';
      DOM.modalProductAddUpdate.querySelector(
        '.button-product-confirm-add-update'
      ).textContent = 'Update Product';

      DOM.inputProductCode.value = product.code;
      DOM.inputProductTagline.value = product.tagline;
      DOM.textareaProductShortDescription.value = product.shortDescription;
      DOM.inputProductQuantity.value = product.quantity;
      DOM.inputProductPrice.value = product.price;
      DOM.inputProductId.value = product._id;

      DOM.formProductAddUpdate.dataset.action = 'update';

      bsModalProductAddUpdate.show();
    });
  };
*/

// Richtig:
const onClickProductEdit = (e) => {
  const productEl = e.target.closest('.product');
  const id = productEl.dataset.id;

  getProductById(id).then((product) => {
    if (product) {
      console.log('Produkt zum Bearbeiten:', product); // Debugging-Log
      DOM.modalProductAddUpdate.querySelector('.modal-product-title').textContent = 'Edit Product';
      DOM.buttonProductConfirmAddUpdate.textContent = 'Update Product';

      DOM.inputProductCode.value = product.code;
      DOM.inputProductTagline.value = product.tagline;
      DOM.textareaProductShortDescription.value = product.shortDescription;
      DOM.inputProductQuantity.value = product.quantity;
      DOM.inputProductPrice.value = product.price;
      DOM.inputProductId.value = product._id;

      DOM.formProductAddUpdate.dataset.action = 'update';
      bsModalProductAddUpdate.show();
    } else {
      alert('Produktdaten konnten nicht geladen werden!');
    }
  });
};



  /*const onClickProductDelete = (e) => {
    console.log('delete');
    const productEl = e.target.closest('.product');
    const id = productEl.dataset.id;

    deleteProduct(id).then((data) => {
      console.log(data);
      getProducts().then((products) => {
        createProductsEls(products);
      });
    });
  };
  */
  const onClickProductDelete = (e) => {
    const productEl = e.target.closest('.product');
    const id = productEl.dataset.id;
  
    if (confirm('Willst du dieses Produkt wirklich löschen?')) {
      deleteProduct(id).then((data) => {
        if (data) {
          getProducts().then((products) => createProductsEls(products));
        } else {
          alert('Löschen fehlgeschlagen!');
        }
      });
    }
  };
  

  const onClickProductShow = (e) => {
    console.log('show');
    const productEl = e.target.closest('.product');
    const id = productEl.dataset.id;

    DOM.formProductAddUpdate.dataset.action = 'add';

    getProductById(id).then((product) => {
      createProductEl(product);
    });
  };

  const onClickCardProductClose = (e) => {
    const cardProductEl = e.target.closest('.card-product');
    cardProductEl.remove();
  };

  // === XHR/FETCH ========
  const getProducts = async () => {
    const res = await fetch('/api/products');

    try {
      const data = await res.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  };

  const getProductById = async (id) => {
    try {
      const res = await fetch(`/api/products/${id}`);
      if (!res.ok) {
        console.error('Fehler beim Laden des Produkts:', await res.text());
        return null;
      }
      const data = await res.json();
      console.log('Geladene Produktdaten:', data); // Debugging-Log
      return data;
    } catch (error) {
      console.error('Netzwerkfehler beim Laden des Produkts:', error);
      return null;
    }
  };
  

  const addProduct = async (product) => {
    try {
      const res = await fetch('/api/products', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(product),
      });
  
      if (!res.ok) {
        console.error('Fehler beim Hinzufügen:', await res.text());
        return null;
      }
  
      return await res.json();
    } catch (error) {
      console.error('Netzwerkfehler beim Hinzufügen:', error);
      return null;
    }
  };
  

  const updateProduct = async (product) => {
    try {
      console.log('Sende Produktdaten:', product); // Debug-Log
  
      const res = await fetch('/api/products', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(product),
      });
  
      if (!res.ok) {
        const errorText = await res.text();
        console.error('Fehler beim Aktualisieren des Produkts:', errorText);
        alert('Das Produkt konnte nicht aktualisiert werden. Fehler: ' + errorText);
        return null;
      }
  
      const data = await res.json();
      console.log('Serverantwort:', data); // Debug-Log
      return data;
    } catch (error) {
      console.error('Netzwerkfehler beim Aktualisieren des Produkts:', error);
      alert('Es gab ein Problem bei der Verbindung zum Server.');
      return null;
    }
  };
  
  
  

  /*const deleteProduct = async (id) => {
    const res = await fetch(`/api/products/${id}`, {
      method: 'DELETE',
    });

    if (res.status === 200) {
      try {
        const data = await res.json();
        console.log(data);
        return data;
      } catch (error) {
        console.error(error);
      }
    }
  };
  */
  const deleteProduct = async (id) => {
    try {
      console.log(id)
      const res = await fetch(`/api/products/${id}`, { method: 'DELETE' });
  
      if (res.ok) {
        return await res.json();
      } else {
        console.error('Fehler beim Löschen:', res.statusText);
        return null;
      }
    } catch (error) {
      console.error('Fehler beim Löschen:', error);
      return null;
    }
  };
  

  // === FUNCTIONS ========
  const createProductsEls = (products) => {
    DOM.products.innerHTML = '';
    products.forEach((product) => {
      const productEl = DOM.templateProduct.content
        .cloneNode(true)
        .querySelector('.product');
      const buttonProductEdit = productEl.querySelector('.button-product-edit');
      const buttonProductDelete = productEl.querySelector(
        '.button-product-delete'
      );
      const buttonProductShow = productEl.querySelector('.button-product-show');

      productEl.dataset.id = product._id;
      productEl.querySelector('.code').textContent = product.code;
      productEl.querySelector('.tagline').textContent = product.tagline;
      productEl.querySelector('.short-description').textContent =
        product.shortDescription;

      buttonProductEdit.addEventListener('click', onClickProductEdit);
      buttonProductDelete.addEventListener('click', onClickProductDelete);
      buttonProductShow.addEventListener('click', onClickProductShow);

      DOM.products.appendChild(productEl);
    });
  };

  const createProductEl = (product) => {
    const {
      code,
      tagline,
      shortDescription,
      quantity,
      price,
      stockWarn = false,
      _id,
    } = product;

    const cardProductEl = DOM.templateCardProduct.content
      .cloneNode(true)
      .querySelector('.card-product');
    const codeEl = cardProductEl.querySelector('.card-product-code');
    const taglineEl = cardProductEl.querySelector('.card-product-tagline');
    const priceEl = cardProductEl.querySelector('.card-product-price');
    const quantityEl = cardProductEl.querySelector('.card-product-quantity');
    const shortDescriptionEl = cardProductEl.querySelector(
      '.card-product-short-description'
    );
    const alertstockWarnEl = cardProductEl.querySelector('.alert-stock-warn');
    const idEl = cardProductEl.querySelector('.card-product-id');
    const buttonCloseEl = cardProductEl.querySelector('.button-card-close');

    codeEl.textContent = code;
    taglineEl.textContent = tagline;
    priceEl.textContent = price;
    quantityEl.textContent = quantity;
    shortDescriptionEl.textContent = shortDescription;
    idEl.textContent = _id;

    if (stockWarn) {
      alertstockWarnEl.classList.remove('d-none');
    }

    const currentProductEl = DOM.products.querySelector(
      `.product[data-id="${_id}"]`
    );

    buttonCloseEl.addEventListener('click', onClickCardProductClose);

    insertAfter(currentProductEl, cardProductEl);
  };

  const insertAfter = (referenceNode, newNode) => {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  };

  init();
})();
