<?php

// Обновление информации о новости
require '../components/check_session.php';

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
$login = $_POST['login'];
$surname = $_POST['surname'];
$name = $_POST['name'];
$middle_name = $_POST['middle_name'];
$birthday = $_POST['birthday'];
$phone = $_POST['phone'];
$position = $_POST['position'];
$division = $_POST['division'];
$experience = $_POST['experience'];
$balance = $_POST['balance'];

/*
 * Делаем запрос на изменение строки в таблице
 */
$sql = "UPDATE `users` SET `login` = '$login', `surname` = '$surname', `name` = '$name', `middle_name` = '$middle_name', `birthday` = '$birthday', `phone` = '$phone', `position` = '$position', `division` = '$division', `experience` = '$experience', `balance` = $balance WHERE `id` = '$id'";

if ($connection->query($sql) === TRUE) {
    // Запись успешно обновлена
    if ($_SESSION['user_id'] === $id) {
        $_SESSION['user_balance'] = $balance;
    }

    header('Location: ../employees.php');
    exit();
} else {
    // Возникла ошибка при обновлении записи
    echo 'Ошибка при обновлении пользователя: ' . $connection->error;
}

// Закрываем соединение с базой данных
$connection->close();
?>
