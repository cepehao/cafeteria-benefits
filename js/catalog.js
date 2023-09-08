function showAddItemForm() {
    var form = document.getElementById('addItemForm');
    form.style.display = 'block';
  }

  function hideAddItemForm() {
    var form = document.getElementById('addItemForm');
    form.reset();
    form.style.display = 'none';
  }

  function hideChangeItemForm(id) {
    var form = document.getElementById('changeItemForm');
    form.reset();
    form.style.display = 'none';

    window.location.href = '../catalog.php?id=' + id;
  }