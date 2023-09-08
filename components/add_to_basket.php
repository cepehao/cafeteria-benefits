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
        
        // Проверка наличия товара в базе данных
        $checkStmt = $conn->prepare("SELECT * FROM basket WHERE item_id = ? AND user_id = ?");
        $checkStmt->bind_param("ii", $itemID, $userID);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if ($result->num_rows > 0) {
            echo json_encode(array("success" => false, "message" => "Товар уже в корзине"));
        } else {
            // Подготовка и выполнение запроса на добавление данных
            $insertStmt = $conn->prepare("INSERT INTO basket (item_id, user_id) VALUES (?, ?)");
            $insertStmt->bind_param("ii", $itemID, $userID);
            
            if ($insertStmt->execute()) {
                echo json_encode(array("success" => true, "message" => "Данные успешно добавлены в корзину"));
            } else {
                echo json_encode(array("success" => false, "message" => "Ошибка при добавлении данных в корзину"));
            }
            
            $insertStmt->close();
        }
        
        $checkStmt->close();
        $conn->close();
    }
?>
