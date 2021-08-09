-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 09 2021 г., 13:15
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ritg v`
--

-- --------------------------------------------------------

--
-- Структура таблицы `candidates`
--

CREATE TABLE `candidates` (
  `id` int NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `candidates`
--

INSERT INTO `candidates` (`id`, `full_name`, `description`, `date_of_birth`) VALUES
(75, 'Солнышков Олег', 'Изменение', '1985-12-01'),
(82, 'Боб', 'Умен', '2021-01-01'),
(83, 'Кирилл Алексеевич', 'Разбирается во фреймах', '2002-01-01'),
(102, 'James Ironwood', 'американец', '1985-12-01'),
(108, 'Лорен Шмит', 'немец', '1987-01-12'),
(109, 'Иван Иванов', 'Молодец', '2021-08-13'),
(110, 'Варгенов Александр Сытков', 'Старая школа', '1998-03-27'),
(111, 'Ромашков Виталий Николаевич', 'Фронт-енд разработчик', '1987-06-12'),
(112, 'Мышкина Ира Максимова', 'Требуется переобучение', '1996-02-09'),
(113, 'Смирнов Денис Валерьевич', 'Требуется одна профильная ориентация', '2000-02-13'),
(114, 'Котов Петр Андреевич', 'Стабильный кадр', '1987-03-07'),
(115, 'Мухин Платон Вячеславович', 'Фронтенд', '2011-03-04'),
(116, 'Селезнёв Адам Мэлсович', 'Хороший фронтенд-разработчик', '2003-02-14');

-- --------------------------------------------------------

--
-- Структура таблицы `connect`
--

CREATE TABLE `connect` (
  `id` int NOT NULL,
  `id_candidates` int NOT NULL,
  `id_technologies` int NOT NULL,
  `skill` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `connect`
--

INSERT INTO `connect` (`id`, `id_candidates`, `id_technologies`, `skill`) VALUES
(3, 82, 2, 2),
(4, 83, 4, 3),
(5, 75, 4, 1),
(6, 82, 4, 1),
(10, 82, 3, 1),
(11, 75, 2, 1),
(12, 75, 3, 1),
(13, 83, 2, 2),
(15, 108, 2, 1),
(16, 108, 3, 1),
(17, 108, 4, 1),
(18, 108, 5, 1),
(19, 75, 5, 1),
(32, 102, 2, 1),
(33, 102, 3, 1),
(34, 102, 4, 1),
(35, 102, 5, 2),
(36, 109, 2, 0),
(37, 109, 3, 0),
(38, 109, 4, 0),
(39, 109, 5, 1),
(40, 110, 2, 0),
(41, 110, 3, 1),
(42, 110, 4, 1),
(43, 110, 5, 1),
(44, 111, 2, 0),
(45, 111, 3, 0),
(46, 111, 4, 1),
(47, 111, 5, 1),
(48, 112, 2, 1),
(49, 112, 3, 2),
(50, 112, 4, 0),
(51, 112, 5, 0),
(52, 113, 2, 1),
(53, 113, 3, 1),
(54, 113, 4, 1),
(55, 113, 5, 1),
(56, 114, 2, 3),
(57, 114, 3, 3),
(58, 114, 4, 1),
(59, 114, 5, 1),
(60, 115, 2, 1),
(61, 115, 3, 1),
(62, 115, 4, 3),
(63, 115, 5, 1),
(64, 116, 2, 1),
(65, 116, 3, 3),
(66, 116, 4, 1),
(67, 116, 5, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `technologies`
--

CREATE TABLE `technologies` (
  `id` int NOT NULL,
  `technology` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `technologies`
--

INSERT INTO `technologies` (`id`, `technology`) VALUES
(2, 'C++'),
(4, 'Java'),
(3, 'PascalABC'),
(5, 'ReactJs');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(355) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES
(2, 'Роман алексеев', 'Roma22222', 'roman200@reere.ru', '250cf8b51c773f3f8dc8b4be867a9a02'),
(3, 'Дима Никитин', 'Diman', 'velieff@yandex.ru', '698d51a19d8a121ce581499d7b701668'),
(6, 'Дима Никитин', 'Diman', 'velieff@gmail.com', '698d51a19d8a121ce581499d7b701668'),
(8, 'Сагид Физулиевич Велиев', 'Sagid', 'dagfarid73@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 'Петр Петров', 'Peter32423432', 'roma1131231200@reere.ru', '550a141f12de6341fba65b0ad0433500'),
(31, 'asdas', 'Sagid', 'sada@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `connect`
--
ALTER TABLE `connect`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `technology` (`technology`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT для таблицы `connect`
--
ALTER TABLE `connect`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT для таблицы `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
