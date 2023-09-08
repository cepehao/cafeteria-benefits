<?php
    require_once 'components/config.php';

    session_start();

    // Проверка, существует ли сессия с пользователем
    if (isset($_SESSION['user_id'])) {
        header("Location: profile.php");
        exit();
    }

    $conn = mysqli_connect($host, $user, $pass, $data);

    if (!$conn) {
        die("Ошибка подключения к базе данных: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["uname"];
        $password = $_POST["psw"];

        // Защита от SQL-инъекций
        $login = mysqli_real_escape_string($conn, $login);

        // Выполнение запроса на поиск пользователя
        $query = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Проверка пароля
            if ($password == $row['password']) {
                // Аутентификация успешна

                // Создание сессии
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_role'] = $row['role'];
                $_SESSION['user_surname'] = $row['surname'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_middle_name'] = $row['middle_name'];
                $_SESSION['user_birthday'] = date('d.m.Y', strtotime($row['birthday']));
                $_SESSION['user_phone'] = $row['phone'];
                $_SESSION['user_position'] = $row['position'];
                $_SESSION['user_division'] = $row['division'];
                $_SESSION['user_experience'] = date('d.m.Y', strtotime($row['experience']));
                $_SESSION['user_balance'] = $row['balance'];
                //$_SESSION['user_login'] = $row['login'];
                

                // Перенаправление на другую страницу после успешной авторизации
                header("Location: profile.php");
                exit();
            } else {
                //todo сделать красиво можно
                echo "НЕПРАВИЛЬНЫЙ ЛОГИН ИЛИ ПАРОЛЬ";
            }
        } else {
            //todo сделать красиво можно
            echo "ПОЛЬЗОВАТЕЛЬ НЕ НАЙДЕН";
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="logotip">
            <img src="images/logo.svg" alt="logotip">
        </div>
    </div>


    <div class="loginper">
        <h2>Войти в систему</h2>

        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Войти</button>

        <div id="id01" class="modal">
        
        <form class="modal-content animate" action="login.php" method="post">
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="images/person.svg" alt="Avatar" class="avatar">
            </div>

            <div class="container">
            <label for="uname"><b>Логин</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Пароль</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
                
            <button type="submit">Войти</button>
            <!-- <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
            </div>

            <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Закрыть</button>
            <!-- <span class="psw">Забыл <a href="#">пароль</a></span> -->
            </div>
        </form>
        </div>
    </div>
    

    <script src="js/scrip.js"></script>
</body>
</html>