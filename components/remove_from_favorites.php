<?php
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Подключение к базе данных
        $conn = new mysqli($host, $user, $pass, $data);
        if ($conn->connect_error) {
            die("Ошибка подключения к базе данных: " . $conn->connect_error);
        }
        
        // Получение данных из POST-запроса
        $itemID = $_POST['itemID'];
        $userID = $_POST['userID'];
        

        // Подготовка и выполнение запроса на удаление данных
        $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND item_id = ?");
        $stmt->bind_param("ii", $userID, $itemID);
        
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Товар успешно удален из избранного"));
            
        } else {
            echo json_encode(array("success" => false, "message" => "Ошибка при удалении товара из избранного"));
        }
        
        $stmt->close();
        $conn->close();
    }
?>
