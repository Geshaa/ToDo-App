-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 
-- Версия на сървъра: 5.6.12-log
-- Версия на PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Структура на таблица `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text,
  `ownerID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userID` (`ownerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Схема на данните от таблица `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `ownerID`, `status`) VALUES
(2, 'New List', NULL, 15, 0),
(73, 'HashCat', '', 29, 0),
(76, 'NewMouse', 'MouseHit', 35, 0),
(79, '1va', 'opisanie1', 1, 0),
(83, '2ra', '', 1, 0);

-- --------------------------------------------------------

--
-- Структура на таблица `collaboration`
--

CREATE TABLE IF NOT EXISTS `collaboration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taskID` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `participantID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTask` text NOT NULL,
  `dateCreation` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dateCreation` date NOT NULL,
  `endDate` date NOT NULL,
  `daysBeforeEnd` int(11) DEFAULT NULL,
  `ownerID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=318 ;

--
-- Схема на данните от таблица `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `comment`, `dateCreation`, `endDate`, `daysBeforeEnd`, `ownerID`, `categoryID`, `status`) VALUES
(311, 'mailProba', 'segaaaa aaaaaaaaaa aaaaaaaaaa segaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaasegaaaa aaaaaaaaaa aaaaaaaaaa segaaaa aaaaaaaaaa aaaaaaaaaa segaaaa aaaaaaaaaa aaaaaaaaaa', '', '2014-03-05', '2014-03-06', 1, 1, 79, 0),
(315, 'proba', 'proba', 'asdasdasd', '2014-03-14', '2014-03-25', 0, 1, 79, 0),
(317, 'IEProba', 'koo', 'Additional comment', '2014-03-14', '2014-03-12', 0, 1, 79, 0);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstName`, `lastName`, `mobile`, `status`) VALUES
(1, 'gesh', '123', 'Geshaaa91@gmail.com', 'Georgi', 'Ivanov', '0879434807', 0),
(37, 'example', '1234', 'example@abv.bg', 'example', 'example', '213', 0),
(38, 'ivaaaan', '1234', 'ivan@abv.gg', 'Georgi', 'Ivanov', '359879434807', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
