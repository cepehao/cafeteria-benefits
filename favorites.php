<?php require 'components/check_session.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Избранное</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <div class="informmylike">
        <table width=100%>


            <?php
                // Подключение к базе данных
                $conn = new mysqli($host, $user, $pass, $data);
                if ($conn->connect_error) {
                    die("Ошибка подключения к базе данных: " . $conn->connect_error);
                }

                $itemsSql = "SELECT * FROM favorites JOIN items
                ON favorites.item_id = items.id
                WHERE  favorites.user_id = {$_SESSION['user_id']}";

                $itemsResult = $conn->query($itemsSql);

                if ($itemsResult->num_rows > 0) {

                    while ($itemRow = $itemsResult->fetch_assoc()) {                             
                        echo "<TR>";
                            echo '<td  width=40%>'.$itemRow['name']. '<br>'.$itemRow['description'].'</td>';
                            echo '<td  width=20%>Цена<br>'.$itemRow['price'].'</td>';
                            echo "<td width='40%'><p style='color: #FF0000; cursor: pointer;' onclick='postAddToBasket({$itemRow['item_id']}, {$_SESSION['user_id']});'>Добавить в корзину</p></td>";
                            echo "<td width='40%'><p style='color: #FF0000; cursor: pointer;' onclick='removeFromFavorites({$itemRow['item_id']}, {$_SESSION['user_id']});'>Удалить из избранного</p></td>";
                        echo "</TR>";  
                    }
                } else {
                    echo 'Нет избранных товаров';
                }

                $conn->close();
            ?>


            </table>
        </div>
        </div>
    </div>
    <script src="js/categories.js"></script>
    <script src="js/favorites.js"></script>
    <script src="js/basket.js"></script>
</body>
</html>