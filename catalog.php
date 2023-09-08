<?php require 'components/check_session.php';?>

<?php
    require 'components/config.php';
    // Проверяем, есть ли переданный идентификатор категории
    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];
    } else {
        // Если идентификатор категории не передан, можно выполнить соответствующие действия или вывести сообщение об ошибке.
        echo 'Идентификатор категории не указан.';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
            <div class="informcat">
                <table width=100%>

                    <?php
                        // Подключение к базе данных
                        $conn = new mysqli($host, $user, $pass, $data);
                        if ($conn->connect_error) {
                            die("Ошибка подключения к базе данных: " . $conn->connect_error);
                        }

                        $itemsSql = "SELECT * FROM items WHERE category_id = $categoryId";
                        $itemsResult = $conn->query($itemsSql);

                        if ($itemsResult->num_rows > 0) {
                
                            while ($itemRow = $itemsResult->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>';
                                echo '    <p>' . $itemRow['name'] . '</p>';
                                echo '    <p>' . $itemRow['description'] . '</p>';
                                
                                if ($_SESSION['user_role'] == 'hr') {
                                    echo '    <p class="popular"> Количество покупок: ' . $itemRow['count'] . '</p>';
                                }

                                echo '</td>';
                                echo '<td>';
                                echo '    <p>' . $itemRow['price'] . '</p>';
                                echo '</td>';
                                echo '<td>';
                                echo"<img src='../images/basket.svg' width='60px' height='50px' alt='Добавить в корзину' style='cursor: pointer;' onclick='postAddToBasket({$itemRow['id']}, {$_SESSION['user_id']});'>";
                                echo '</td>';
                                echo '<td>';
                                echo"<img src='../images/like.svg' width='60px' height='50px' alt='Добавить в избранное' style='cursor: pointer;' onclick='postAddToFavorites({$itemRow['id']}, {$_SESSION['user_id']});'>";
                                echo '</td>';
                                if ($_SESSION['user_role'] == 'hr') {
                                echo '<td>';
                                echo "<a href='cat_update.php?id=" . $itemRow['id'] . "&categoryId=" . $categoryId . "'>Редактировать</a>";
                                echo '</td>';}
                                if ($_SESSION['user_role'] == 'hr') {
                                echo '<td>';
                                echo "<a href='lgot/delete.php?id=" . $itemRow['id'] . "'>Удалить</a>";
                                echo '</td>';}
                                echo '</tr>';                  
                            }
                        } else {
                            echo 'Нет товаров в данной категории';
                        }
                
                        $conn->close();
                    ?>
                </table>
            </div>

            <?php
            // Проверка роли пользователя
            if ($_SESSION['user_role'] == 'hr') {
                echo "<button onclick = 'showAddItemForm()'>Добавить товар</button>";
            }
            ?>
            
            <form id="addItemForm" style="display: none;" action = "components/add_item.php" method = "post">
                <label for="addItemNameLabel">Наименование:</label>
                <input type="text" id="addItemName" name="addItemName" required>

                <label for="addItemDescriptionLabel">Описание:</label>
                <input type="text" id="addItemDescription" name="addItemDescription" required>

                <label for="addItemPriceLabel">Цена:</label>
                <input type="text" id="addItemPrice" name="addItemPrice" required>

                <label for="addItemPromoLabel">Промокод:</label>
                <input type="text" id="addItemPromo" name="addItemPromo" required>

                <?php
                echo "<input type='hidden' id='addItemCategoryId' name='addItemCategoryId' value='$categoryId'>"
                ?>

                <button type = "submit">Добавить</button>
                <button type="button" onclick="hideAddItemForm()">Отмена</button>
            </form>


        </div>
    </div>
    <script src="js/categories.js"></script>
    <script src="js/catalog.js"></script>
    <script src="js/basket.js"></script>
    <script src="js/favorites.js"></script>
</body>
</html>

<!-- если успеем сделаем -->
<!-- <td  width=15%><p style="color: #FF0000;font-weight:bold;">Редактировать</p></td> -->
<!-- todo кол-во купленных -->