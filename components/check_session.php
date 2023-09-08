<?php
    session_start();

    // Проверка, существует ли сессия с статусом
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
?>