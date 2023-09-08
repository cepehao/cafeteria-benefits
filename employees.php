<?php require 'components/check_session.php';?>
<?php require 'components/check_hr.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сотрудники</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php require 'components/header.php';?>

    <div class="main">
        
        <?php require 'components/categories.php';?>

        <div class="inform">
        <div class="informwork">
            <!-- <div><a href="notify.php">Уведомления</a></div> -->

            <!-- Вывод логинов сотрудников -->
            <div class="employeeList">
            <table width=100% style="text-align: left;" class="tablebox">
                <tr>
                    <th>Login</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Баланс</th>
                </tr>
                <?php
                require_once 'components/config.php';
                $connection = new mysqli($host, $user, $pass, $data);
                if ($connection->connect_error) die('Error connection');

                $sql = "SELECT * FROM `users`";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['login']; ?></td>
                            <td><?php echo $row['surname']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['middle_name']; ?></td>
                            <td><?php echo $row['balance']; ?></td>
                            <td><a href="us_update.php?id=<?php echo $row['id']; ?>">Изменить</a></td>
                            <td>
                                <?php echo "<p style='cursor: pointer;' onclick='showAddBonusForm({$row['id']})'>Добавить бонусы</p>";?>
                                <?php echo "<form id='addBonusForm{$row['id']}' style ='max-width: 150px; display: none;' class='popup-form' action='components/add_balance.php' method='post'>";?>
                                    <input type="text" id="inputBonus" name="inputBonus" required>
                                    <input type="hidden" id="inputBonusId" name="inputBonusId" value = <?php echo "{$row['id']}"?>>

                                    <button type="submit">Добавить</button>
                                    <?php echo "<button type='button' id='closeFormButton' onclick='hideAddBonusForm({$row['id']})'>Закрыть</button>";?>
                                </form>
                            </td>
                            <td><a style="color: red;" href="user/delete.php?id=<?php echo $row['id']; ?>">Удалить</a>
                        </tr>
                        <?php
                    }
                } else {
                    echo "Сотрудники не найдены";
                }
                $connection->close();
                ?>
            </table>

            </div>

        </div>


        <br><br>
        <!-- Добавление нового сотрудника -->
        <div id="addEmployeeContainer">

        
        <button id="addEmployeeButton" style="width:auto;" onclick="showEmployeeForm()">Добавить сотрудника</button>
       

          <div id="employeeFormPopup" >
            <form id="employeeForm" class="popup-form" action="components/add_employee.php" method="post">
              <h2>Добавление нового сотрудника</h2>
              <label for="surname">Фамилия:</label>
              <input type="text" id="surname" name="surname" required>

              <label for="name">Имя:</label>
              <input type="text" id="name" name="name" required>

              <label for="middleName">Отчество:</label>
              <input type="text" id="middleName" name="middleName" required>

              <label for="birthday">Дата рождения:</label>
              <input type="date" id="birthday" name="birthday" required>

              <label for="phone">Номер телефона:</label>
              <input type="text" id="phone" name="phone" required>

              <label for="position">Должность:</label>
              <input type="text" id="position" name="position" required>

              <label for="division">Подразделение:</label>
              <input type="text" id="division" name="division" required>

              <label for="login">Логин:</label>
              <input type="text" id="login" name="login" required>

              <label for="password">Пароль:</label>
              <input type="text" id="password" name="password" required>

              <button type="submit">Добавить</button>
              <button type="button" id="closeFormButton" onclick="closeEmployeeForm()">Закрыть</button>
            </form>
          </div>
        </div>
       
  </div>
</div>
<script src="./js/scrip.js"></script>
<script src="js/employee.js"></script>   
<script src="js/categories.js"></script>  
</body>
</html>