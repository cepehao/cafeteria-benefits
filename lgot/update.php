<?php

// Обновление информации о льготе

require_once '../components/config.php';

// Создаем подключение к базе данных
$connection = new mysqli($host, $user, $pass, $data);
if ($connection->connect_error) {
    die('Ошибка подключения к базе данных: ' . $connection->connect_error);
}

/*
 * Создаем переменные со значениями, которые были получены с $_POST
 */

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$promo = $_POST['promo'];

$categoryId = $_POST['categoryId'];

/*
 * Делаем запрос на изменение строки в таблице
 */
$sql = "UPDATE `items` SET `name` = '$name', `description` = '$description', `promo` = '$promo', `price` = '$price' WHERE `id` = '$id'";

if ($connection->query($sql) === TRUE) {
    // Запись успешно обновлена
    header("Location: ../catalog.php?id=" . $categoryId);
    exit();

} else {
    // Возникла ошибка при обновлении записи
    echo 'Ошибка при обновлении продукта: ' . $connection->error;
}

// Закрываем соединение с базой данных
$connection->close();
?>
