-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2018 at 07:40 PM
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
-- Table structure for table `comments`
--
CREATE DATABASE `roomies`;
USE `roomies`;

grant all privileges on *.* to 'root'@'localhost';

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageId` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `sentTime` datetime NOT NULL,
  `likes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `comments_fk01` (`messageId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `messageId`, `text`, `sentTime`, `likes`) VALUES
(1, 4, 'this is srishti', '2018-11-22 15:08:15', 0),
(2, 4, 'wassup!!!', '2018-11-22 15:08:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `isPrivate` tinyint(1) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `isPrivate`, `isArchived`) VALUES
(1, 'Global', 0, 1),
(2, 'PrivateGroup_Apt1', 1, 1),
(3, 'PrivateGroup_Apt2', 1, 1),
(4, 'roomies', 1, 0),
(7, 'srishti', 0, 0),
(10, 'hello', 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `groupId`, `userId`, `text`, `sentTime`, `likes`) VALUES
(1, 1, 1, 'hi', '2018-10-29 19:44:36', 0),
(2, 1, 2, 'hello', '2018-10-29 09:44:36', 0),
(3, 2, 1, 'hello', '2018-10-29 19:34:36', 0),
(4, 1, 1, 'hello', '2018-11-22 13:16:50', 0),
(5, 1, 1, 'shreya', '2018-11-24 15:58:01', 0),
(6, 1, 1, 'hello', '2018-11-24 22:53:55', 0),
(7, 1, 1, 'images/messageImage15bfa305a39e1c7.25207441.png', '2018-11-25 00:17:14', 0),
(8, 1, 1, 'images/messageImage15bfa30c616e2d0.29712173.png', '2018-11-25 00:19:02', 0),
(9, 1, 1, 'images/messageImage15bfa32894d4cd0.88698935.png', '2018-11-25 00:26:33', 0),
(10, 1, 1, '', '2018-11-25 00:28:03', 0),
(11, 1, 1, 'images/messageImage15bfa34c90106c4.88304583.jpg', '2018-11-25 00:36:09', 0),
(12, 1, 1, 'images/messageImage15bfa355cb4e907.85995865.jpg', '2018-11-25 00:38:36', 0),
(13, 1, 1, 'images/messageImage15bfa3a39ea02c0.32769710.png', '2018-11-25 00:59:21', 0),
(14, 1, 1, 'images/messageImage15bfa3a51c72f72.61913150.jpg', '2018-11-25 00:59:45', 0),
(15, 1, 1, 'images/messageImage15bfa3c844f7d77.65276360.jpg', '2018-11-25 01:09:08', 0),
(16, 1, 1, 'images/messageImage15bfa3c9eb2d630.22566347.jpg', '2018-11-25 01:09:34', 0),
(17, 1, 1, 'images/messageImage15bfa3e25a02388.78349299.jpg', '2018-11-25 01:16:05', 0),
(18, 1, 1, 'images/messageImage15bfa3ea87e8012.57871491.jpg', '2018-11-25 01:18:16', 0),
(19, 1, 1, 'images/messageImage15bfa3ec4642100.67820803.jpg', '2018-11-25 01:18:44', 0),
(20, 1, 1, 'images/messageImage15bfa3fdcda2172.18346377.jpg', '2018-11-25 01:23:24', 0),
(21, 1, 1, 'images/messageImage15bfa406472a438.49855110.jpg', '2018-11-25 01:25:40', 0),
(22, 1, 1, 'images/messageImage15bfa40af73be73.12978638.png', '2018-11-25 01:26:55', 0),
(23, 1, 1, 'images/messageImage15bfa4118ecd486.70888037.jpg', '2018-11-25 01:28:40', 0),
(24, 1, 1, 'images/messageImage15bfa41a66c4986.81903750.jpg', '2018-11-25 01:31:02', 0),
(25, 1, 1, 'images/messageImage15bfa426bb2d193.03901150.png', '2018-11-25 01:34:19', 0),
(26, 1, 1, 'images/messageImage15bfa43263c5900.28531248.jpg', '2018-11-25 01:37:26', 0),
(27, 1, 1, 'images/messageImage15bfa4389e6b6d0.26810890.png', '2018-11-25 01:39:05', 0),
(28, 1, 1, 'images/messageImage15bfa4399cfbd60.66438867.jpg', '2018-11-25 01:39:21', 0),
(29, 1, 1, 'images/messageImage15bfa43cda8ca15.55192809.jpg', '2018-11-25 01:40:13', 0),
(30, 1, 1, 'hiiii', '2018-11-25 01:40:54', 0),
(31, 1, 1, 'images/messageImage15bfa44eab09ae5.34778880.png', '2018-11-25 01:44:58', 0),
(32, 1, 1, 'images/messageImage15bfa45842ee468.65208508.jpg', '2018-11-25 01:47:32', 0),
(45, 1, 1, 'images/messageFile15bfa511b41e073.56243264.pdf', '2018-11-25 02:36:59', 0),
(46, 1, 1, '', '2018-11-25 02:37:09', 0),
(47, 1, 1, 'images/messageFile15bfa562e103d76.55233404.docx', '2018-11-25 02:58:38', 0),
(48, 1, 1, '', '2018-11-25 02:58:49', 0),
(49, 1, 1, 'images/messageImage15bfae32e1bf476.56304737.jpg', '2018-11-25 13:00:14', 0),
(50, 1, 1, 'images/messageFile15bfae33fa9d3d4.20901992.pdf', '2018-11-25 13:00:31', 0),
(51, 1, 1, 'images/messageImage15bfaedaccc4a85.18864982.jpg', '2018-11-25 13:45:00', 0),
(52, 1, 1, '', '2018-11-25 13:45:19', 0),
(53, 1, 1, 'images/messageFile15bfaedccccc598.58941387.pdf', '2018-11-25 13:45:32', 0),
(54, 1, 1, 'images/messageImage15bfaf40b385260.99742563.jpg', '2018-11-25 14:12:11', 0),
(55, 1, 1, 'images/messageImage15bfaf41ecd5468.58006284.jpg', '2018-11-25 14:12:30', 0),
(56, 1, 1, 'images/messageFile15bfaf42948e303.51409170.docx', '2018-11-25 14:12:41', 0),
(57, 1, 1, 'hello i am srishti', '2018-12-09 18:10:58', 0),
(58, 1, 1, 'images/messageImage15c0da18ebd3cf7.15127163.jpg', '2018-12-09 18:13:18', 0),
(59, 1, 1, 'images/messageImage15c0da269829b86.84262120.jpg', '2018-12-09 18:16:57', 0),
(60, 1, 1, '', '2018-12-09 18:17:46', 0),
(61, 1, 1, 'images/messageFile15c0da449b97ca7.45107916.docx', '2018-12-09 18:24:57', 0),
(62, 1, 1, 'images/messageImage15c0da479bc61f3.75588083.jpg', '2018-12-09 18:25:45', 0),
(63, 1, 1, 'images/messageFile15c0da48e2b7950.11563360.pdf', '2018-12-09 18:26:06', 0),
(64, 1, 1, 'hello', '2018-12-09 18:27:32', 0),
(65, 4, 1, 'hello', '2018-12-09 18:42:56', 0),
(66, 1, 1, 'hey', '2018-12-09 19:24:20', 0),
(67, 1, 1, 'heyy', '2018-12-09 19:26:28', 0),
(68, 7, 1, 'hiii', '2018-12-09 19:53:17', 0),
(69, 2, 0, 'hiiii', '2018-12-10 15:29:44', 0),
(70, 3, 0, 'hello', '2018-12-10 15:29:52', 0),
(71, 3, 0, 'hello', '2018-12-10 15:29:53', 0),
(72, 4, 0, 'aaasssssuupppp', '2018-12-10 15:30:14', 0),
(73, 1, 0, 'hi', '2018-12-10 15:38:20', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroupmapping`
--

INSERT INTO `usergroupmapping` (`id`, `userId`, `groupId`) VALUES
(1, 0, 1),
(15, 0, 2),
(16, 0, 3),
(18, 0, 4),
(30, 0, 7),
(80, 0, 10),
(2, 1, 1),
(8, 1, 2),
(17, 1, 4),
(29, 1, 7),
(79, 1, 10),
(3, 2, 1),
(9, 2, 2),
(23, 2, 4),
(4, 3, 1),
(14, 3, 2),
(10, 3, 3),
(19, 3, 4),
(31, 3, 7),
(5, 4, 1),
(11, 4, 2),
(27, 4, 4),
(35, 4, 7),
(81, 4, 10),
(6, 5, 1),
(12, 5, 3),
(85, 5, 10),
(78, 6, 1),
(60, 6, 2),
(48, 6, 3);

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
  `groups` int(11) DEFAULT NULL,
  `Posts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `displayName` (`displayName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `displayName`, `password`, `emailId`, `gender`, `dob`, `about`, `hobbies`, `bio`, `pno`, `country`, `image`, `groups`, `Posts`) VALUES
(0, 'admin', 'admin', '@fusionweb', 'admin@odu.edu', 'F', '2018-11-12', 'admin', 'admin', 'admin', 123456789, 'admin', 'images/profile05c0dbc0dc21a14.60491464.jpg', NULL, NULL),
(1, 'Tow Mater', 'hello', '@mater', 'mater@rsprings.gov', 'M', '2011-12-18', 'hello', 'hello', 'hello', 34567890, 'australia', 'images/tom_and_jerry_PNG53.png', 80, 40),
(2, 'Sally Carrera', 'Sally Carrera', '@sally', 'porsche@rsprings.gov', 'F', '2011-10-18', '', '', '', 0, '', 'images/tom_and_jerry_PNG53.png', 5, 70),
(3, 'Doc Hudson', 'Doc Hudson', '@doc', 'hornet@rsprings.gov', 'M', '2009-10-18', '', '', '', 0, '', 'images/35.jpg', 1, 60),
(4, 'Finn McMissile', 'Finn McMissile', '@mcmissile', 'topsecret@agent.org', 'M', '2000-10-18', '', '', '', 0, '', 'images/35.jpg', 3, 40),
(5, 'Lightning McQueen', 'Lightning McQueen', '@mcqueen', 'kachow@rusteze.com', 'F', '1995-10-18', '', '', '', 0, '', 'images/Hannible.jpg', 2, 20),
(6, 'Shreya Varadaraj', 'Shreya', '@shreya', 'svara001@odu.edu', 'F', '1996-01-19', 'i am a dancer ', 'watching movies', 'no bio yet ', 762025433, 'bangladesh', 'images/nibbles_tomandjerry_965.JPG', 3, 10);

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
