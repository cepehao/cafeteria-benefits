<?php require 'components/check_session.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои промокоды</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <div class="informmycat">
            <table width=100%>

                <?php
                    // Подключение к базе данных
                    $conn = new mysqli($host, $user, $pass, $data);
                    if ($conn->connect_error) {
                        die("Ошибка подключения к базе данных: " . $conn->connect_error);
                    }

                    $itemsSql = "SELECT * FROM my_promocodes JOIN items
                    ON my_promocodes.item_id = items.id
                    WHERE my_promocodes.user_id = {$_SESSION['user_id']}";

                    $itemsResult = $conn->query($itemsSql);

                    if ($itemsResult->num_rows > 0) {
            
                        while ($itemRow = $itemsResult->fetch_assoc()) {                             
                            echo "<TR>";
                                echo '<td  width=50%>'.$itemRow['name']. '<br>' .$itemRow['description']. '</td>';
                                echo '<td  width=50%>Цена<br>' .$itemRow['price']. '</td>';
                                echo '<td  width=50%>Промокод<br>' .$itemRow['promo']. '</td>';
                            echo "</TR>";
                        }
                    } else {
                        echo 'Промокодов нет';
                    }
            
                    $conn->close();
                ?>

            </table>
        </div>
        </div>
    </div>
    <script src="js/categories.js"></script>
</body>
</html>