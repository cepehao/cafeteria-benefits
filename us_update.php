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

$user_id = $_GET['id'];

/*
 * Делаем выборку строки с полученным ID выше
 */

$sql = "SELECT * FROM `users` WHERE `id` = '$user_id'";
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
    die('Пользователь не найден.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <h3>Обновить информацию о пользователе</h3>
        <form action="user/update.php" method="post">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <p>Логин</p>
            <input type="text" name="login" value="<?= $product['login'] ?>" required>
            <p>Фамилия</p>
            <input type="text" name="surname" value="<?= $product['surname'] ?>" required>
            <p>Имя</p>
            <input type="text" name="name" value="<?= $product['name'] ?>" required>
            <p>Отчество</p>
            <input type="text" name="middle_name" value="<?= $product['middle_name'] ?>" required>
            <p>День рождения</p>
            <input type="text" name="birthday" value="<?= $product['birthday'] ?>" required>
            <p>Телефон</p>
            <input type="text" name="phone" value="<?= $product['phone'] ?>" required>
            <p>Должность</p>
            <input type="text" name="position" value="<?= $product['position'] ?>" required>
            <p>Подразделение</p>
            <input type="text" name="division" value="<?= $product['division'] ?>" required>
            <p>Начало работы</p>
            <input type="text" name="experience" value="<?= $product['experience'] ?>" required>
            <p>Баланс</p>
            <input type="text" name="balance" value="<?= $product['balance'] ?>" required>
            <br> <br>
            <button type="submit">Обновить</button>
        </form>
        </div>
    </div>
    <script src="js/categories.js"></script>
</body>
</html>