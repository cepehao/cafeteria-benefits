<?php
  session_start();
  session_destroy(); // Разрушение сессии

  // Перенаправление на страницу авторизации или другую нужную страницу
  header("Location: /login.php");
  exit();
?>