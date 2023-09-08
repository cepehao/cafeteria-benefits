<?php
require_once 'components/config.php';

// Устанавливаем соединение с базой данных
$conn = new mysqli($host, $user, $pass, $data);

// Проверяем соединение на наличие ошибок
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// SQL-запрос для выборки всех категорий
$sql = "SELECT * FROM categories";

// Выполняем запрос и получаем результат
$result = $conn->query($sql);

echo "<div class='categories'>";
    // Проверяем, есть ли категории
    if ($result->num_rows > 0) {
        // Выводим каждую категорию
        while ($row = $result->fetch_assoc()) {
            $categoryName = $row['name'];
            echo '<div class="stranica"><a href="catalog.php?id=' . $row['id'] . '">' . $categoryName . '</a></div>';
        }
    } else {
        echo 'Нет категорий.';
    }
    
    if ($_SESSION['user_role'] == 'hr') {
        //todo наверно надо покрасивее сделать
        echo "<br>";
        echo "<a href='lgot_inform.php'>Управление</a>";
        echo '<button onclick="showAddCategoryForm()">Добавить новую категорию</button>';
    }
// echo "</div>";

// Закрываем соединение с базой данных
$conn->close();

?>

<form id="addCategoryForm" style="display: none;" action = "components/add_category.php" method = "post">
  <label for="addCategoryLabel">Название категории:</label>
  <input type="text" id="addCategoryName" name="addCategoryName" required>
  <button type = "submit">Добавить</button>
  <button type="button" onclick="hideAddCategoryForm()">Отмена</button>
</form>
</div>

