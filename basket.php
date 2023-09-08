<?php require 'components/check_session.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <div class="informmybasket">
            <table width=100%>


                <?php
                    // Подключение к базе данных
                    $conn = new mysqli($host, $user, $pass, $data);
                    if ($conn->connect_error) {
                        die("Ошибка подключения к базе данных: " . $conn->connect_error);
                    }

                    $itemsSql = "SELECT * FROM basket JOIN items
                    ON basket.item_id = items.id
                    WHERE  basket.user_id = {$_SESSION['user_id']}";

                    $itemsResult = $conn->query($itemsSql);

                    if ($itemsResult->num_rows > 0) {
            
                        while ($itemRow = $itemsResult->fetch_assoc()) {                             
                            echo "<TR>";
                                echo '<td  width=40%>'.$itemRow['name']. '<br>'.$itemRow['description'].'</td>';
                                echo '<td  width=20%>Цена<br>'.$itemRow['price'].'</td>';
                                echo "<td width='40%'><p style='color: #FF0000; cursor: pointer;' onclick='removeFromBasket({$itemRow['item_id']}, {$_SESSION['user_id']});'>Удалить из корзины</p></td>";
                            echo "</TR>";
                        }
                    } else {
                        echo 'Корзина пуста';
                    }
            
                    $conn->close();
                
                
                    echo "</table>";
                    echo "</div>";
                    if ($itemsResult->num_rows > 0) {

                        echo "<form id='BuyItemsForm' action='components/buy_items.php' method='post'>";
                            echo "<button type='submit'>Купить</button>";
                        echo "</form>";
                    }
                ?>
        </div>
    </div>
    <script src="js/categories.js"></script>
    <script src="js/basket.js"></script>
</body>
</html>