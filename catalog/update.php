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

/*
 * Делаем запрос на изменение строки в таблице
 */
$sql = "UPDATE `categories` SET `name` = '$name' WHERE `id` = '$id'";

if ($connection->query($sql) === TRUE) {
    // Запись успешно обновлена
    header("Location: ../lgot_inform.php");
    exit();

} else {
    // Возникла ошибка при обновлении записи
    echo 'Ошибка при обновлении продукта: ' . $connection->error;
}

// Закрываем соединение с базой данных
$connection->close();
?>
