-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2018 at 07:07 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE `roomies`;
USE `roomies`;

grant all privileges on *.* to 'root'@'localhost';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roomies`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageId` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `sentTime` datetime NOT NULL,
  `likes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comments_fk01` (`messageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `isPrivate` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `isPrivate`) VALUES
(1, 'Global', 0),
(2, 'PrivateGroup_Apt1', 1),
(3, 'PrivateGroup_Apt2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `sentTime` datetime NOT NULL,
  `likes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `message_fk01` (`groupId`),
  KEY `message_fk02` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `groupId`, `userId`, `text`, `sentTime`, `likes`) VALUES
(1, 1, 1, 'hi', '2018-10-29 19:44:36', 0),
(2, 1, 2, 'hello', '2018-10-29 09:44:36', 0),
(3, 2, 1, 'hello', '2018-10-29 19:34:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usergroupmapping`
--

DROP TABLE IF EXISTS `usergroupmapping`;
CREATE TABLE IF NOT EXISTS `usergroupmapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`userId`,`groupId`),
  KEY `UserGroupMapping_fk01` (`userId`),
  KEY `UserGroupMapping_fk02` (`groupId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroupmapping`
--

INSERT INTO `usergroupmapping` (`id`, `userId`, `groupId`) VALUES
(12, 0, 1),
(13, 0, 2),
(14, 0, 3),
(1, 1, 1),
(6, 1, 2),
(2, 2, 1),
(7, 2, 2),
(3, 3, 1),
(8, 3, 2),
(11, 3, 3),
(4, 4, 1),
(9, 4, 3),
(5, 5, 1),
(10, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `usermessagegrouplikes`
--

DROP TABLE IF EXISTS `usermessagegrouplikes`;
CREATE TABLE IF NOT EXISTS `usermessagegrouplikes` (
  `userId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`messageId`),
  KEY `usermessagegrouplikes_fk01` (`userId`),
  KEY `usermessagegrouplikes_fk02` (`messageId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `displayName` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `dob` date NOT NULL,
  `about` varchar(100) NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `bio` varchar(100) NOT NULL,
  `pno` int(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `displayName` (`displayName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `displayName`, `password`, `emailId`, `gender`, `dob`, `about`, `hobbies`, `bio`, `pno`, `country`, `image`) VALUES
(0, 'admin', 'admin', 'admin', 'admin@odu.edu', 'F', '2018-11-12', 'NULL', 'NULL', 'NULL', 123456789, 'NULL', 'null'),
(1, 'Tow Mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', 'M', '2011-12-18', '', '', '', 0, '', 'EBVH1298.JPG'),
(2, 'Sally Carrera', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', 'F', '2011-10-18', '', '', '', 0, '', 'tom_and_jerry_PNG53.png'),
(3, 'Doc Hudson', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', 'M', '2009-10-18', '', '', '', 0, '', '35.jpg'),
(4, 'Finn McMissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', 'M', '2000-10-18', '', '', '', 0, '', '35.jpg'),
(5, 'Lightning McQueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', 'F', '1995-10-18', '', '', '', 0, '', 'Hannible.jpg'),
(6, 'hello', 'Pagal', 'Srishti@96', 'srishtilakki@gmail.com', 'm', '1996-01-19', 'i am a dancer ', 'watching movies', 'no bio yet ', 762025433, 'bangladesh', 'nibbles_tomandjerry_965.JPG');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_fk01` FOREIGN KEY (`messageId`) REFERENCES `messages` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_fk01` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `message_fk02` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `usergroupmapping`
--
ALTER TABLE `usergroupmapping`
  ADD CONSTRAINT `UserGroupMapping_fk01` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `UserGroupMapping_fk02` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`);

--
-- Constraints for table `usermessagegrouplikes`
--
ALTER TABLE `usermessagegrouplikes`
  ADD CONSTRAINT `usermessagegrouplikes_fk01` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usermessagegrouplikes_fk02` FOREIGN KEY (`messageId`) REFERENCES `messages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
