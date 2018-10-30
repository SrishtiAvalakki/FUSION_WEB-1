-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2018 at 02:41 PM
-- Server version: 5.5.61
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roomies`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--
CREATE DATABASE `roomies`;
USE `roomies`;

grant all privileges on *.* to 'root'@'localhost';


-- DROP TABLE IF EXISTS `groups`;
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
(3, 'PrivateGroup_Apt2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` 	longtext NOT NULL,
  `sentTime` datetime NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `message_fk01` (`groupId`),
  KEY `message_fk02` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  UNIQUE KEY `id` (`id`),
  KEY `UserGroupMapping_fk01` (`userId`),
  KEY `UserGroupMapping_fk02` (`groupId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroupmapping`
--

INSERT INTO `usergroupmapping` (`id`, `userId`, `groupId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 1, 2),
(7, 2, 2),
(8, 3, 2),
(9, 4, 3),
(10, 5, 3),
(11, 3, 3);

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
  `dob` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `displayName` (`displayName`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `displayName`, `password`, `emailId`, `gender`, `dob`) VALUES
(1, 'Tow Mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', 'M', '2011-12-18 13:17:17'),
(2, 'Sally Carrera', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', 'F', '2011-10-18 13:17:17'),
(3, 'Doc Hudson', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', 'M', '2009-10-18 13:17:17'),
(4, 'Finn McMissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', 'M', '2000-10-18 13:17:17'),
(5, 'Lightning McQueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', 'F', '1995-10-18 13:17:17');

--
-- Constraints for dumped tables
--
DROP TABLE IF EXISTS `UserMessageGroupLikes`;
CREATE TABLE IF NOT EXISTS `UserMessageGroupLikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`messageId`),
  KEY `UserMessageGroupLikes_fk02` (`userId`),
  KEY `UserMessageGroupLikes_fk01` (`messageId`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

ALTER TABLE `UserMessageGroupLikes`
  ADD CONSTRAINT `UserMessageGroupLikes_fk02` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `UserMessageGroupLikes_fk01` FOREIGN KEY (`messageId`) REFERENCES `messages` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_fk02` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_fk01` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`);

--
-- Constraints for table `usergroupmapping`
--
ALTER TABLE `usergroupmapping`
  ADD CONSTRAINT `UserGroupMapping_fk02` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `UserGroupMapping_fk01` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `bio` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `pno` int(11) NOT NULL,
  `country` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `about`, `fname`, `lname`, `hobbies`, `bio`, `gender`, `pno`, `country`) VALUES
(1, 'mee', 'fgh', 'fgh', 'fghj', 'dfghj', 'fghj', 45678, 'fghj'),
(6, 'its me srishti', 'srishti', 'avalakki', '2', 'qw', 'male', 123, 'india');

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`) VALUES
(7, 'IMG_0270 (2).jpg'),
(8, 'IMG_0812.jpg');
