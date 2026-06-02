-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 02 2026 г., 09:25
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `status_id` int UNSIGNED NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` timestamp NOT NULL,
  `status` enum('new','timereserv','timechange','provideo') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id`, `user_id`, `status_id`, `content`, `date`, `time`, `reason`, `create_at`, `status`) VALUES
(5, 4, 1, 'монитор перестал показывать изображение, индикаторы не горят, никаких признаков жизни данный монитор не подает', '2026-05-28', '19:09:00', 'сломан монитор', '2026-05-21 06:52:09', 'provideo'),
(20, 10, 1, 'очень сильно срывает сенсор у мышки, так же периодически сама по себе отключается и подключается обратно', '2026-06-30', '11:11:00', 'мышка не работает', '2026-05-27 07:28:09', 'timechange'),
(32, 10, 1, 'клавиатуре 5 лет, перестала недавно работать, предположительно залита', '2026-05-29', '12:33:00', 'клавиатура не функционирует', '2026-05-29 07:53:57', 'timereserv'),
(33, 4, 1, 'компьютер не включался около двух лет, от пыли почищен но не работает', '2026-05-29', '15:34:00', 'не включается компьютер', '2026-05-29 07:55:36', 'new');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int UNSIGNED NOT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `feedback`, `image_file`, `fio`, `phone`, `create_at`, `status_id`) VALUES
(6, 'все сделано быстро и качественно', 'uploads/1780040669_images.jpg', 'Иванов Иван Иванович', '+7(999)-999-99-99', '2026-05-29 10:44:29', 1),
(7, 'починили матрицу за относительно небольшие деньги, буду пользоваться данным сервисом еще', 'uploads/1780040792_images (1).jpg', 'Алексеев Алексей Алексеевич', '+7(999)-999-88-88', '2026-05-29 10:46:32', 1),
(8, 'сломалась мышка, но работники этой компании починили за небольшую стоимость', 'uploads/1780041032_00-00056922-1-515Wx515H.jpg', 'Андреев Андрей Андреевич', '+7(666)-666-88-88', '2026-05-29 10:50:32', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'новый'),
(2, 'одобренный'),
(3, 'отмененный');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `fio`, `login`, `email`, `password`, `phone`, `create_at`, `role`, `token`) VALUES
(4, 'Андреев Андрей Андреевич', 'vrrkzumg', 'smaev@gmail.com', 'rtyurtyurtyurtyu', '+7(999)-999-99-99', '2026-05-14 14:42:00', 'user', ''),
(10, 'палагин сергей сергеевич', 'office-manager', 'palagin@gmail.com', 'manager123', '+7(111)-111-11-11', '2026-05-25 10:10:24', 'admin', '7f1b967e247793731333c3f84a4c6e03bf81f452'),
(11, 'смаев смаев смаев', 'aaaaaa', 'smaevsmaev@gmail.com', 'aaaaaa', '+7(999)-999-99-88', '2026-05-27 11:33:19', 'user', ''),
(12, 'ббббб ббббб ббббб', 'bbbbbb', 'bbbbbb@gmail.com', 'bbbbbb', '+7(999)-999-99-11', '2026-05-27 12:03:31', 'user', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_status_id` (`status_id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status_id` (`status_id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `fk_app_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
