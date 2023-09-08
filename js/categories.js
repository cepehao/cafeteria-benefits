function showAddCategoryForm() {
    var form = document.getElementById('addCategoryForm');
    form.style.display = 'block';
  }

  function hideAddCategoryForm() {
    var form = document.getElementById('addCategoryForm');
    form.reset();
    form.style.display = 'none';
  }

function hideChangeCategoryForm(){
  var form = document.getElementById('changeCategoryForm');
    form.reset();
    form.style.display = 'none';

    window.location.href = '../lgot_inform.php';
}