-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 05 2017 г., 19:48
-- Версия сервера: 5.5.48
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(6, 'Alex', '202cb962ac59075b964b07152d234b70'),
(7, 'Marina', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) unsigned NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `request_id`, `name`, `email`) VALUES
(13, 72, 'admin', NULL),
(15, 74, 'admin', NULL),
(16, 75, 'admin', NULL),
(17, 76, 'admin', NULL),
(18, 77, 'incognito', NULL),
(19, 78, 'admin', NULL),
(20, 79, 'admin', NULL),
(21, 80, 'admin', NULL),
(22, 81, 'admin', NULL),
(23, 82, 'admin', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `title`) VALUES
(26, 'Получение денег'),
(27, 'Процесс идентификации'),
(28, 'Защита прав потребителей'),
(29, 'Отправление денег онлайн');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) unsigned NOT NULL,
  `text` text NOT NULL,
  `cat_id` int(11) NOT NULL,
  `is_published` enum('0','1') NOT NULL DEFAULT '0',
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `text`, `cat_id`, `is_published`, `dated`) VALUES
(72, 'Нужно ли мне пройти идентификацию?', 27, '1', '2017-05-05 12:11:10'),
(74, 'Каким образом мне нужно предoставить документ, удостоверяющий личность?', 27, '0', '2017-05-05 11:45:20'),
(75, ' 	Как я могу отменить свою регистрацию в системе?', 27, '0', '2017-05-05 11:45:51'),
(76, 'На что мне дополнительно следует обращать внимание?', 28, '1', '2017-05-05 12:13:12'),
(77, 'Что мне нужно делать, если я заподозрю мошенничество или стану жертвой мошенничества?', 28, '1', '2017-05-05 15:07:48'),
(78, 'Как мне узнать, подтвержден ли мой перевод онлайн?', 29, '1', '2017-05-05 12:14:43'),
(79, 'Как я могу произвести оплату?', 29, '0', '2017-05-05 11:48:34'),
(80, 'Как я могу получить свои деньги?', 26, '1', '2017-05-05 12:08:33'),
(81, 'Как я могу узнать, можно ли получить денежный перевод?', 26, '1', '2017-05-05 12:09:45'),
(82, 'Сколько стоит получение денег?', 26, '0', '2017-05-05 12:06:33');

-- --------------------------------------------------------

--
-- Структура таблицы `response`
--

CREATE TABLE IF NOT EXISTS `response` (
  `id` int(11) unsigned NOT NULL,
  `request_id` int(11) NOT NULL,
  `text` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `response`
--

INSERT INTO `response` (`id`, `request_id`, `text`, `date`) VALUES
(39, 80, 'Для получения перевода обратитесь в ближайшее отделение банка с документом, удостоверяющим личность, и контрольным номером денежного перевода (MTCN), который вам сообщит отправитель.', '2017-05-05 12:08:33'),
(40, 81, 'Просто следуйте по ссылке «Статус перевода» на домашней странице нашего сайта. Затем введите контрольный номер денежного перевода (MTCN). Мы предоставим Вам последнюю информацию о статусе Вашего денежного перевода.', '2017-05-05 12:09:45'),
(41, 72, 'Для того чтобы отправить деньги онлайн, Вам необходимо создать профиль. Вас попросят указать свои имя и фамилию, адрес, электронную почту, номер мобильного телефона, номер паспорта и ИНН. Мы сверим предоставленные Вами данные с национальной базой данных и сообщим Вам, как только Ваша личность будет подтверждена.', '2017-05-05 12:11:10'),
(42, 76, 'За безопасность отвечает каждый. Следите за информацией. Будьте в курсе новых тенденций мошенничества. Запомните: если что-то звучит неправдоподобно заманчиво, скорее всего, это неправда.', '2017-05-05 12:13:12'),
(43, 78, 'После отправления денежного перевода, выполните следующие простые действия:', '2017-05-05 12:14:43'),
(44, 77, 'После отправления денежного перевода, выполните следующие простые действия', '2017-05-05 15:07:50');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT для таблицы `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
