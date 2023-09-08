<div class="header">
        <div class="logotip">
            <img src="../images/logo.svg" alt="logotip">
        </div>
        <div class="stranica"><a href="my_promocodes.php">Мои промокоды</a></div>

        <?php
            // Проверка роли пользователя
            if ($_SESSION['user_role'] == 'hr') {
                echo '<div class="stranica"><a href="employees.php">Сотрудники</a></div>';
            }
        ?>

        <p class="bones">Мои бонусы: <?php echo $_SESSION['user_balance']; ?></p>
        <div class="menu">                    
            <a href="profile.php"><img src="../images/personhead.svg" width="60px" height="50px" alt="Личный кабинет"></a>
            <a href="favorites.php"><img src="../images/like.svg" width="60px" height="50px" alt="Избранное"></a>
            <a href="basket.php"><img src="../images/basket.svg" width="60px" height="50px" alt="Корзина"></a>
            <a href="components/logout.php"><img src="../images/exit.svg" width="60px" height="50px" alt="Выход"></a>
        </div>
    </div>