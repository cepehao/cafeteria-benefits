<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middleName = $_POST['middleName'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $division = $_POST['division'];
    $experience = date("Y-m-d");
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = ''; 

    $birthdayParts = explode('.', $birthday);
    $birthday = implode('-', array_reverse($birthdayParts));

    if (strtoupper($position) == "HR") {
        $role = "hr";
    }else {
        $role = "user";
    }

    // Подключение к базе данных
    $conn = new mysqli($host, $user, $pass, $data);
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Подготовленный SQL-запрос для вставки нового сотрудника
    $stmt = $conn->prepare("INSERT INTO users (surname, name, middle_name, birthday, phone, position, division, experience, login, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $surname, $name, $middleName, $birthday, $phone, $position, $division, $experience, $login, $password, $role);

    if ($stmt->execute()) {
        header("Location: /employees.php");
        exit();
    } else {
        // Произошла ошибка при добавлении сотрудника в базу данных
        echo "Ошибка при добавлении сотрудника: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
