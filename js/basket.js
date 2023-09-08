function postAddToBasket(itemRowID, userID) {
    const formData = new FormData();
    formData.append('itemID', itemRowID);
    formData.append('userID', userID);
  
    fetch('/components/add_to_basket.php', {
      method: 'POST',
      body: formData
    })
      .then(response => {
        if (response.ok) {
          // Если ответ успешный (статус код 200-299)
          return response.json();
        } else {
          throw new Error('Ошибка при выполнении запроса');
        }
      })
      .then(data => {
        // Обработка данных, полученных от сервера
        console.log('Ответ сервера:', data);
        // Дополнительные действия с полученными данными
      })
      .catch(error => {
        // Обработка ошибок
        console.error('Ошибка:', error);
      });
  }
  
  function removeFromBasket(itemRowID, userID) {
    const formData = new FormData();
    formData.append('itemID', itemRowID);
    formData.append('userID', userID);
  
    fetch('/components/remove_from_basket.php', {
      method: 'POST',
      body: formData
    })
      .then(response => {
        if (response.ok) {
          // Если ответ успешный (статус код 200-299)
          window.location.reload();
          return response.json();
        } else {
          throw new Error('Ошибка при выполнении запроса');
        }
      })
      .then(data => {
        // Обработка данных, полученных от сервера
        console.log('Ответ сервера:', data);
        // Дополнительные действия с полученными данными
      })
      .catch(error => {
        // Обработка ошибок
        console.error('Ошибка:', error);
      });
  }