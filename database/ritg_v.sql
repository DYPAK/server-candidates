-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2021 г., 07:12
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
  `full_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `candidates`
--

INSERT INTO `candidates` (`id`, `full_name`, `description`, `date_of_birth`) VALUES
(75, 'KEK', 'LOL', '6666-01-01'),
(82, 'Боб', 'Умен', '2021-01-01'),
(83, 'KEK', 'LOL', '6666-01-01'),
(102, 'Ironwood', 'asdas', '1985-12-01'),
(108, 'Лytt', 'iiiiii', '2021-01-01');

-- --------------------------------------------------------

--
-- Структура таблицы `connect`
--

CREATE TABLE `connect` (
  `id` int NOT NULL,
  `id_candidates` int NOT NULL,
  `id_technologies` int NOT NULL,
  `skill` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `connect`
--

INSERT INTO `connect` (`id`, `id_candidates`, `id_technologies`, `skill`) VALUES
(3, 82, 2, 2),
(4, 83, 4, 3),
(5, 75, 4, 3),
(6, 82, 4, 1),
(7, 102, 2, 1),
(8, 102, 4, 1),
(9, 102, 3, 1),
(10, 82, 3, 1),
(11, 75, 2, 3),
(12, 75, 3, 0),
(13, 83, 2, 2),
(15, 108, 2, 1),
(16, 108, 3, 1),
(17, 108, 4, 1),
(18, 108, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `technologies`
--

CREATE TABLE `technologies` (
  `id` int NOT NULL,
  `technology` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `technologies`
--

INSERT INTO `technologies` (`id`, `technology`) VALUES
(2, 'C++'),
(3, 'PascalABC'),
(4, 'Java'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) VALUES
(2, 'Роман алексеев', 'Roma22222', 'roman200@reere.ru', '250cf8b51c773f3f8dc8b4be867a9a02'),
(3, 'Дима Никитин', 'Diman', 'velieff@yandex.ru', '698d51a19d8a121ce581499d7b701668'),
(4, 'test', 'tsews', 'roman200@reere.ru', '550a141f12de6341fba65b0ad0433500'),
(5, 'sdada', 'Oleg2001', 'Oleg2112@gmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'Дима Никитин', 'Diman', 'velieff@gmail.com', '698d51a19d8a121ce581499d7b701668'),
(8, 'Сагид Физулиевич Велиев', 'Sagid', 'dagfarid73@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(10, 'Cергей Иванов', 'Roman4432', 'roman200@reere.ru', 'bcbe3365e6ac95ea2c0343a2395834dd'),
(11, 'Роман Андреев', 'Roman443', 'roman200@reere.ru', 'bcbe3365e6ac95ea2c0343a2395834dd'),
(13, 'Петр Петров', 'Peter', 'roman200@reere.ru', '289dff07669d7a23de0ef88d2f7129e7'),
(15, 'Виктор Шурчалов', 'viktor', 'velieff@yandex.ru', '202cb962ac59075b964b07152d234b70'),
(16, 'Виталий Антонов', 'VityaAk', 'roman200@reere.ru', '827ccb0eea8a706c4c34a16891f84e7b'),
(18, 'george', 'george', 'www@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(19, 'Виктор Шурчалов', 'viktor', 'velieff@yandex.ru', '202cb962ac59075b964b07152d234b70'),
(20, 'никита ', 'Nikita', 'NIKITA@gmail.com', 'fae0b27c451c728867a567e8c1bb4e53'),
(21, 'Дима Никитин', 'Dima88448848', 'velieff@yandex.ru', '550a141f12de6341fba65b0ad0433500'),
(22, 'Петр Петров', 'Peter32423432', 'roma1131231200@reere.ru', '550a141f12de6341fba65b0ad0433500'),
(23, 'ddda', 'aaaa', 'aaa@dog.com', '698d51a19d8a121ce581499d7b701668'),
(24, 'Дима Никитин', 'Diman', 'velieff@yandex.ru', 'cf79ae6addba60ad018347359bd144d2'),
(25, 'Петр Петров', 'Peter Е', 'roman200@reere.ru', '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'TT', 'TT', 'd@mail.com', '202cb962ac59075b964b07152d234b70'),
(27, 'Алексей', 'RRS', 'TR@gmail.com', 'd93591bdf7860e1e4ee2fca799911215'),
(28, 'TES', 'TES', 'gh@gmail.com', '76d80224611fc919a5d54f0ff9fba446'),
(29, 'Петя', 'TTR', 'gsh@gmail.com', '202cb962ac59075b964b07152d234b70'),
(30, 'Петя', 'TTRE', 'gsh@gmail.com', '202cb962ac59075b964b07152d234b70'),
(31, 'asdas', 'Sagid', 'sada@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(46, 'KTO_TO', 'Leark', 'kue@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

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
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT для таблицы `connect`
--
ALTER TABLE `connect`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
