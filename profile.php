<?php require 'components/check_session.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
            <div class="personinf">
                <div><img src="../images/person.svg" width="150px" height="150px" alt="Фото"></div>
                <div>
                    <p><?php echo $_SESSION['user_surname'] . ' ' . $_SESSION['user_name'] . ' ' . $_SESSION['user_middle_name']; ?></p>
                    <br>
                    <p><?php echo 'Дата рождения: ' . $_SESSION['user_birthday']; ?></p>
                    <br>
                    <p><?php echo 'Номер телефона: ' . $_SESSION['user_phone']; ?></p>
                    <br>
                    <p><?php echo $_SESSION['user_position'] . ', ' . $_SESSION['user_division'] . ', работает с ' . $_SESSION['user_experience']; ?></p>
                    <br>
                </div>
            </div>
            <br>
            <div>
                <p>Прикрепить чек</p>
                <form action="/action_page.php">
                    <input type="file" id="myFile" name="filename">
                    <input type="submit">
                </form>
            </div>
            <br>
            <table class="tablebox" width="100%" align="center" >
                <caption><p class="bonesinf">История списания и начисления бонусов:</p></caption>
                <tr>
                    <td width="70%">Наименование1 <br> Дата1</td>
                    <td width="30%">Тип операции1</td>
                </tr>
                <tr>
                    <td width="70%">Наименование2 <br> Дата2</td>
                    <td width="30%">Тип операции2</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="js/categories.js"></script>
</body>
</html>
