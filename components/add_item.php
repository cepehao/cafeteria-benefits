<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['addItemName'];
    $description = $_POST['addItemDescription'];
    $price = $_POST['addItemPrice'];
    $promo = $_POST['addItemPromo'];
    $categoryId = $_POST['addItemCategoryId'];

    // Подключение к базе данных
    $conn = new mysqli($host, $user, $pass, $data);
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Подготовленный SQL-запрос для вставки нового сотрудника
    $stmt = $conn->prepare("INSERT INTO items (name, description, price, promo, category_id) VALUES (?,?,?,?,?)");
    if (!$stmt) {
        die("Ошибка при подготовке SQL-запроса: " . $conn->error);
    }

    $stmt->bind_param("ssisi", $name, $description, $price, $promo, $categoryId);
    if (!$stmt->execute()) {
        echo "Ошибка при добавлении товара: " . $stmt->error;
    } else {
        header("Location: /catalog.php?id=".$categoryId);
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
