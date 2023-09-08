<?php require 'components/check_session.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование льгот</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <table>
        <tr>
            <th>Название</th>
        </tr>
        <?php
        require_once 'components/config.php';
        $connection = new mysqli($host, $user, $pass, $data);
        if ($connection->connect_error) die('Error connection');

        $sql = "SELECT * FROM `categories`";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><a href="lgot_update.php?id=<?php echo $row['id']; ?>">Изменить</a></td>
                    <td><a style="color: red;" href="catalog/delete.php?id=<?php echo $row['id']; ?>">Удалить</a>
                </tr>
                <?php
            }
        } else {
            echo "No data found.";
        }
        $connection->close();
        ?>
    </table>
        </div>
    </div>
    <script src="js/categories.js"></script>
</body>
</html>
