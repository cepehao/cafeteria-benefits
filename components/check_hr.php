<?php
    // если не hr - ошибка
    if ($_SESSION['user_role'] === "user") {
        header("Location: profile.php");
        exit();
    }
?>