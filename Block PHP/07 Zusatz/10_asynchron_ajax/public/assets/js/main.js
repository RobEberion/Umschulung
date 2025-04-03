'use strict';

(() => {
  const DOM = {};
  DOM.stockInfo = document.querySelector('.stock-info');
  DOM.spanPrice = DOM.stockInfo.querySelector('.price');
  DOM.spanVolume = DOM.stockInfo.querySelector('.volume');
  DOM.time = DOM.stockInfo.querySelector('.time');

  const init = () => {
    getStockInfo();
  };

  const getStockInfo = () => {
    fetch('/info')
      .then((res) => res.json())
      .then((data) => updateStockInfo(data))
      .catch((err) => console.error(err));

    setTimeout(getStockInfo, 2000);
  };

  const updateStockInfo = (data) => {
    const { price, volume, time } = data;
    DOM.spanPrice.textContent = price;
    DOM.spanVolume.textContent = volume;
    DOM.time.textContent = time;
  };

  init();
})();
