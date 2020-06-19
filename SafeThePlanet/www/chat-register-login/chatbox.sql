-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 15 2019 г., 19:39
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `chatbox`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `user` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `peoples` int(11) NOT NULL,
  `bool` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `name`, `description`, `theme`, `user`, `quantity`, `peoples`, `bool`) VALUES
(1, 'вавав', 'd', 'энергетическая', '123', 10, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `userid`, `postid`) VALUES
(1, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `chatid` int(11) NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`id`, `username`, `chatid`, `msg`) VALUES
(1, '123', 1, 'ÑÑÑÑÑÑ‡Ñ');

-- --------------------------------------------------------

--
-- Структура таблицы `petitions`
--

CREATE TABLE IF NOT EXISTS `petitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `theme` varchar(100) NOT NULL,
  `name_people` varchar(30) NOT NULL,
  `surname_people` varchar(30) NOT NULL,
  `peoples_ quantity` int(7) NOT NULL,
  `date` varchar(20) NOT NULL,
  `k_description` text NOT NULL,
  `people` varchar(30) NOT NULL,
  `pet_pos` int(255) NOT NULL,
  `bool` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `petitions`
--

INSERT INTO `petitions` (`id`, `name`, `description`, `theme`, `name_people`, `surname_people`, `peoples_ quantity`, `date`, `k_description`, `people`, `pet_pos`, `bool`) VALUES
(1, 'вавав', 'вааваав', 'экологическая', 'аавваав', 'аавваав', 12, '', 'ваавва', '123', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `petition_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `petition_count`) VALUES
(4, '123', '123', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_chat`
--

CREATE TABLE IF NOT EXISTS `user_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `chatid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
