<?php require 'components/check_session.php';?>
<?php

// Обновление информации о льготе

require_once 'components/config.php';

// Создаем подключение к базе данных
$connection = new mysqli($host, $user, $pass, $data);
if ($connection->connect_error) {
    die('Ошибка подключения к базе данных: ' . $connection->connect_error);
}

/*
 * Получаем ID льготы из адресной строки - /update.php?id=1
 */

$lgot_id = $_GET['id'];
$categoryId = $_GET['categoryId'];

/*
 * Делаем выборку строки с полученным ID выше
 */

$sql = "SELECT * FROM `items` WHERE `id` = '$lgot_id'";
$result = $connection->query($sql);

/*
 * Проверяем, есть ли результаты выборки
 */

if ($result->num_rows > 0) {
    // Получаем данные о льготе в виде ассоциативного массива
    $product = $result->fetch_assoc();

    // Закрываем результат выборки
    $result->close();

    // Закрываем соединение с базой данных
    $connection->close();
} else {
    // Новость с указанным ID не найдена, перенаправляем пользователя или выводим сообщение об ошибке
    die('Льгота не найдена.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение льготы</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <h3>Изменить льготу</h3>
        <form id = "changeItemForm" action="lgot/update.php" method="post">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <p>Название</p>
            <input type="text" name="name" value="<?= $product['name'] ?>">
            <p>Описание</p>
            <input type="text" name="description" value="<?= $product['description'] ?>">
            <p>Цена</p>
            <input type="text" name="price" value="<?= $product['price'] ?>">
            <p>Промокод</p>
            <input type="text" name="promo" value="<?= $product['promo'] ?>">

            <input type="hidden" name="categoryId" value="<?= $categoryId ?>">

            <button type="submit">Изменить</button>
            <button type="button" onclick="hideChangeItemForm(<?= $categoryId ?>)">Отмена</button>
        </form>
        </div>
    </div>
    <!-- <script src="js/categories.js"></script> -->
    <script src="../js/catalog.js"></script>
</body>
</html>