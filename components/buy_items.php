<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Подключение к базе данных
    $conn = new mysqli($host, $user, $pass, $data);
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Запрос на получение суммы всех price из таблицы items
    $sql = "SELECT SUM(price) FROM items JOIN basket
    ON items.id = basket.item_id WHERE user_id = {$_SESSION['user_id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    $totalPrice = $row[0]; // сумма корзины

    // Проверка баланса пользователя
    if ($_SESSION['user_balance'] < $totalPrice) {
        echo "У вас недостаточно баллов для покупки.";
    } else {
        echo "Покупка возможна. Процедура покупки...";

        // Уменьшение значения balance в таблице users
        $updateSql = "UPDATE users SET balance = balance - {$totalPrice} WHERE id = {$_SESSION['user_id']}";
        if ($conn->query($updateSql) === TRUE) {
            echo "Баланс пользователя обновлен.";
        } else {
            echo "Ошибка при обновлении баланса пользователя: " . $conn->error;
        }

        $_SESSION['user_balance'] -= $totalPrice;

        // Получение массива item_id из таблицы basket
        $items = [];
        $selectSql = "SELECT item_id FROM basket WHERE user_id = {$_SESSION['user_id']}";
        $selectResult = $conn->query($selectSql);
        while ($row = $selectResult->fetch_assoc()) {
            $items[] = $row['item_id'];
        }

        // Вставка значений из массива $items в таблицу my_promocodes
        $insertSql = "INSERT INTO my_promocodes (item_id, user_id) VALUES ";
        $values = [];
        foreach ($items as $item) {
            $values[] = "($item, {$_SESSION['user_id']})";
        }
        $insertSql .= implode(", ", $values);

        if ($conn->query($insertSql) === TRUE) {
            echo "Значения успешно вставлены в таблицу my_promocodes.";
        } else {
            echo "Ошибка при вставке значений в таблицу my_promocodes: " . $conn->error;
        }

        // Увеличение значения count в таблице items
        $updateCountSql = "UPDATE items SET count = count + 1 WHERE id IN (" . implode(",", $items) . ")";
        if ($conn->query($updateCountSql) === TRUE) {
            echo "Значения успешно обновлены в таблице items.";
        } else {
            echo "Ошибка при обновлении значений в таблице items: " . $conn->error;
        }

        // Удаление записей из таблицы basket
        $deleteSql = "DELETE FROM basket WHERE user_id = {$_SESSION['user_id']}";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Все записи из корзины удалены.";
            header("Location: /my_promocodes.php");
            exit();
        } else {
            echo "Ошибка при удалении записей из корзины: " . $conn->error;
        }
    }

    $conn->close();
}
?>
