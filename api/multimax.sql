-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 17 2022 г., 21:03
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `multimax`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `ID` int NOT NULL,
  `IDUser` int NOT NULL,
  `Message` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `ID` int NOT NULL,
  `IDUser` int NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Edited` timestamp NULL DEFAULT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orderproduct`
--

CREATE TABLE `orderproduct` (
  `ID` int NOT NULL,
  `IDOrder` int NOT NULL,
  `IDProduct` int NOT NULL,
  `Count` int NOT NULL DEFAULT '1',
  `Price` int NOT NULL,
  `IDStatus` int NOT NULL DEFAULT '1',
  `DownloadLink` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `ID` int NOT NULL,
  `IDType` int NOT NULL DEFAULT '1',
  `PreviewImage` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `Discount` decimal(10,2) DEFAULT '0.00',
  `GuideLink` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Edited` timestamp NULL DEFAULT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`ID`, `IDType`, `PreviewImage`, `Title`, `Description`, `Price`, `Active`, `Discount`, `GuideLink`, `Created`, `Edited`, `ISDeleted`) VALUES
(1, 1, NULL, 'CLICKER1', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '180.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(2, 1, NULL, 'CLICKER2', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '250.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(3, 1, NULL, 'CLICKER3', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '350.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(4, 1, NULL, 'CLICKER4', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '280.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(5, 1, NULL, 'CLICKER5', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '150.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(6, 1, NULL, 'CLICKER6', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '450.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(7, 1, NULL, 'BOT', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '280.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(8, 1, NULL, 'BOT2', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '150.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0),
(9, 1, NULL, 'BOT3', 'This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts', '450.00', 1, '0.00', NULL, '2022-06-17 14:28:59', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `referal`
--

CREATE TABLE `referal` (
  `ID` int NOT NULL,
  `IDUser` int NOT NULL,
  `Url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `ID` int NOT NULL,
  `Title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`ID`, `Title`, `ISDeleted`) VALUES
(1, 'offline', 0),
(2, 'online', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE `type` (
  `ID` int NOT NULL,
  `Title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`ID`, `Title`, `ISDeleted`) VALUES
(1, 'bot', 0),
(2, 'server', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `Email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Access` int NOT NULL DEFAULT '0',
  `IDReferal` int DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Edited` timestamp NULL DEFAULT NULL,
  `ISDeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID`, `Email`, `Token`, `Access`, `IDReferal`, `Created`, `Edited`, `ISDeleted`) VALUES
(1, 'admin@email.com', 'abf5142836a4bef816a18766423773c5', 4, NULL, '2022-06-17 15:03:40', '2022-06-17 15:39:54', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Индексы таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDOrder` (`IDOrder`),
  ADD KEY `IDProduct` (`IDProduct`),
  ADD KEY `IDStatus` (`IDStatus`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDType` (`IDType`);

--
-- Индексы таблицы `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDUser` (`IDUser`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDReferal` (`IDReferal`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `referal`
--
ALTER TABLE `referal`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `type`
--
ALTER TABLE `type`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`ID`);

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`ID`);

--
-- Ограничения внешнего ключа таблицы `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`IDOrder`) REFERENCES `order` (`ID`),
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`IDProduct`) REFERENCES `product` (`ID`),
  ADD CONSTRAINT `orderproduct_ibfk_3` FOREIGN KEY (`IDStatus`) REFERENCES `status` (`ID`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`IDType`) REFERENCES `type` (`ID`);

--
-- Ограничения внешнего ключа таблицы `referal`
--
ALTER TABLE `referal`
  ADD CONSTRAINT `referal_ibfk_1` FOREIGN KEY (`IDUser`) REFERENCES `user` (`ID`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`IDReferal`) REFERENCES `referal` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
