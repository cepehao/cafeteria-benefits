-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Сен 08 2023 г., 23:56
-- Версия сервера: 8.0.31
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `parma`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `user_id`, `item_id`) VALUES
(120, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Здоровье'),
(4, 'Красота'),
(5, 'Обучение'),
(6, 'Питание'),
(8, 'Спорт'),
(9, 'Супермаркеты'),
(10, 'Транспорт'),
(12, 'Разное'),
(36, 'Отдых');

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `item_id`) VALUES
(86, 15, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `promo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `count` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `promo`, `count`, `category_id`) VALUES
(2, 'Спортзал', '\"Скала\", ул. Ленина, 50', 100, 'AQWAPO12', 5, 8),
(3, 'Спортзал', '\"Скала\", ул. Пушкина, 25', 100, 'AQWERTY6', 5, 8),
(6, 'Салон красоты', 'Мира 45', 120, 'FDSGHDFG', 3, 4),
(8, 'Курсы', 'Яндекс.Практикум', 500, 'FSDFGDEW', 1, 5),
(9, 'Курсы', 'Скиллбокс', 300, 'FDSFGEW', 0, 5),
(10, 'Пятерочка', '5000 бонусов', 300, 'FSDFGSDF', 0, 9),
(12, 'Аптека', 'Купон на 200руб \"Планета здоровья\", ул. Ленина 37', 250, 'ZDOROVO200', 1, 2),
(13, 'Автобусный проездной', 'Безлимит на месяц', 100, 'ASDFFFD11', 0, 10),
(23, 'Сертификат на массаж', '3 посещения, Ортопедический центр, ул. Шоссе Космонавтов, 122', 350, 'FSDGHFDF', 0, 2),
(24, 'Аптека', 'Купон на 500руб \"Планета здоровья\", ул. Ленина 37', 500, 'ZDOROVO500', 0, 2),
(25, 'Салон красоты', 'Ленина 54', 200, 'GDFGSDFD', 1, 4),
(26, 'Перекресток', '5000 бонусов', 350, 'PEREK350', 0, 9),
(28, 'Автобусный тур на ГК \"Такман\"', 'В стоимость входит трансфер, прокат снаряжения на двух человек', 900, 'TAKMANDUO', 0, 36),
(30, 'Кофе в подарок', 'Любой кофе в подарок к заказу в сети кафе ', 150, 'SHOKO', 0, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `my_promocodes`
--

CREATE TABLE `my_promocodes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `my_promocodes`
--

INSERT INTO `my_promocodes` (`id`, `user_id`, `item_id`) VALUES
(25, 2, 25),
(26, 15, 6),
(27, 15, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `division` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `experience` date NOT NULL,
  `balance` int NOT NULL DEFAULT '200',
  `login` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `surname`, `name`, `middle_name`, `birthday`, `phone`, `position`, `division`, `experience`, `balance`, `login`, `password`, `role`) VALUES
(1, 'Иванов', 'Максим', 'Александрович', '1990-05-10', '+79824765437', 'Стажер', 'Подразделение А', '2023-01-01', 350, 'user', 'user', 'user'),
(2, 'Жельвите', 'Мирослава', 'Алексеева', '1995-03-12', '+79996666666', 'HR', 'Подразделение Б', '2022-02-11', 510, 'hr', 'hr', 'hr'),
(11, 'sdf', 'sdfs', 'sdf', '2023-06-08', 'dsfs', 'sdf', 'sdf', '2023-06-22', 460, 'sd123', 'sdfsdf', 'user'),
(15, 'Семенов', 'Сергей', 'Иванович', '2023-09-13', '989283294234', 'Разработчик', 'Отдел разработки', '2023-09-08', 80, 'semenov', 'semenov', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`) USING BTREE;

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`) USING BTREE;

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `my_promocodes`
--
ALTER TABLE `my_promocodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `my_promocodes`
--
ALTER TABLE `my_promocodes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `my_promocodes`
--
ALTER TABLE `my_promocodes`
  ADD CONSTRAINT `my_promocodes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `my_promocodes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
