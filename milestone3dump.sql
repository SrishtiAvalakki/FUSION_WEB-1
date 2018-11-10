-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 30, 2018 at 03:36 PM
-- Server version: 5.7.23
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`) VALUES
(1, 'TomCatHeader.png'),
(2, 'tom_and_jerry_PNG53.png'),
(3, '35.jpg'),
(4, '35.jpg'),
(5, 'Hannible.jpg'),
(6, 'nibbles_tomandjerry_965.JPG');

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
  `likes` int(11) unsigned NOT NULL  DEFAULT '0' ,
  PRIMARY KEY (`id`),
  KEY `message_fk01` (`groupId`),
  KEY `message_fk02` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `groupId`, `userId`, `text`, `sentTime`, `likes`) VALUES
(1, 1, 1, 'hi', '2018-10-29 19:44:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `messageId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `sentTime` datetime NOT NULL,
  `likes` int(11) unsigned NOT NULL  DEFAULT '0' ,
  PRIMARY KEY (`messageId`),
  KEY `posts_fk01` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

INSERT INTO `posts`(`userId`, `text`, `sentTime`) VALUES ('1','hello','2018-10-29 19:45:36');
INSERT INTO `posts`(`userId`, `text`, `sentTime`) VALUES ('2','wassup','2018-10-29 19:46:36');
INSERT INTO `posts`(`userId`, `text`, `sentTime`) VALUES ('3','how are you','2018-10-29 19:47:36');
INSERT INTO `posts`(`userId`, `text`, `sentTime`) VALUES ('4','How you doing','2018-10-29 19:50:36');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `about`, `fname`, `lname`, `hobbies`, `bio`, `gender`, `pno`, `country`) VALUES
(6, 'its me srishti', 'srishti', 'avalakki', '2', 'qw', 'male', 123, 'india'),
(7, 'nothing about me', 'shreya', 'bhardharaj', 'singing', 'nio bio yet', 'female', 12333333, 'india'),
(8, 'i amd a dubmb person', 'dumpala', 'rahul', 'chutiya bananana', 'follow', 'female', 12345678, 'india'),
(9, 'erterg', 'vjhv', 'jhv', 'dsav', 'jhvhjmv', 'male', 231425, 'australia'),
(10, 'ia', 'was', 'weswe', 'asdv', 'wegsdverfdvs', 'wqeagsdvaervd', 2123414, 'asgdvea'),
(11, 'sadv', '3qwfscv', 'asvasavasd', 'sadvadsv', 'sdavds ', 'male', 23456789, 'Brazil'),
(12, 'sadv', '3qwfscv', 'asvasavasd', 'sadvadsv', 'sdavds ', 'male', 23456789, 'Brazil'),
(13, '', '', '', '', 'sadf', 'female', 435342, 'afghanistan'),
(14, 'erg', 'erwg', 'ergg', '234', '324', 'female', 324, 'australia'),
(15, 'erg', 'erwg', 'ergg', '234', '324', 'female', 324, 'australia'),
(16, 'erg', 'erwg', 'ergg', '234', '324', 'female', 324, 'australia'),
(17, '54', 'dfawdf', 'sdfa', 'fasdf', 'fsadf', 'female', 13545, 'australia'),
(18, '5234', '532', '5324', '52353', '532', 'female', 345, 'australia');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `usermessagegrouplikes` (
  `userId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`messageId`),
  KEY `usermessagegrouplikes_fk01` (`userId`),
  KEY `usermessagegrouplikes_fk02` (`messageId`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;



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
  `dob` date NOT NULL,
  `about` varchar(100) NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `bio` varchar(100) NOT NULL,
  `pno` int(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `displayName` (`displayName`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `displayName`, `password`, `emailId`, `gender`, `dob`, `about`, `hobbies`, `bio`, `pno`, `country`) VALUES
(1, 'Tow Mater', 'Tow Mater', '@mater', 'mater@rsprings.gov', 'M', '2011-12-18', '', '', '', 0, ''),
(2, 'Sally Carrera', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', 'F', '2011-10-18', '', '', '', 0, ''),
(3, 'Doc Hudson', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', 'M', '2009-10-18', '', '', '', 0, ''),
(4, 'Finn McMissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', 'M', '2000-10-18', '', '', '', 0, ''),
(5, 'Lightning McQueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', 'F', '1995-10-18', '', '', '', 0, ''),
(6, 'hello', 'Pagal', 'Srishti@96', 'srishtilakki@gmail.com', 'm', '1996-01-19', 'i am a dancer ', 'watching movies', 'no bio yet ', 762025433, 'bangladesh');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_fk01` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `message_fk02` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

ALTER TABLE `posts`
  ADD CONSTRAINT `posts_fk01` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
--
-- Constraints for table `usergroupmapping`
--
ALTER TABLE `usergroupmapping`
  ADD CONSTRAINT `UserGroupMapping_fk01` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `UserGroupMapping_fk02` FOREIGN KEY (`groupId`) REFERENCES `groups` (`id`);
 
 ALTER TABLE `usermessagegrouplikes`
  ADD CONSTRAINT `usermessagegrouplikes_fk01` FOREIGN KEY (`userId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `usermessagegrouplikes_fk02` FOREIGN KEY (`messageId`) REFERENCES `messages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
