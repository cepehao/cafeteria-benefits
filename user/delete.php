<?php

// Удаление новости

require_once '../components/config.php';

// Создаем подключение к базе данных
$connection = new mysqli($host, $user, $pass, $data);
if ($connection->connect_error) {
    die('Ошибка подключения к базе данных: ' . $connection->connect_error);
}

// Получаем ID новости из адресной строки
$id = $_GET['id'];

// Создаем запрос на удаление строки из таблицы news_cafe
$sql = "DELETE FROM `users` WHERE `id` = '$id'";

if ($connection->query($sql) === TRUE) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    // Возникла ошибка при удалении записи
    echo 'Ошибка при удалении пользователя: ' . $connection->error;
}

// Закрываем соединение с базой данных
$connection->close();
?>
