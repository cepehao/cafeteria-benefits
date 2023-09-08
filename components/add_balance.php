<?php 
    require 'check_session.php';
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['inputBonusId'];
        $newBalance = $_POST['inputBonus'];

        // Подключение к базе данных
        $conn = new mysqli($host, $user, $pass, $data);
        if ($conn->connect_error) {
            die("Ошибка подключения к базе данных: " . $conn->connect_error);
        }

        // Подготовленный SQL-запрос для вставки нового сотрудника
        $stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
        $stmt->bind_param("ii", $newBalance, $id);

        if ($stmt->execute()) {

            if ($_SESSION['user_id'] === $id) {
                $_SESSION['user_balance'] = $_SESSION['user_balance'] + $newBalance;
            }


            header("Location: /employees.php");
            exit();
        } else {
            echo "Ошибка при добавлении категории: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
?>
