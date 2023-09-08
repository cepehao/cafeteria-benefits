<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['addCategoryName'];

    // Подключение к базе данных
    $conn = new mysqli($host, $user, $pass, $data);
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Подготовленный SQL-запрос для вставки нового сотрудника
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {

        $sql = "SELECT max(id) AS max_id FROM categories";
        $result = $conn->query($sql);
        $countCategories = $result->fetch_assoc()['max_id'];

        header("Location: /catalog.php?id=".$countCategories);
        exit();
    } else {
        echo "Ошибка при добавлении категории: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
