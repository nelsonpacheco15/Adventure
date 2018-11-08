-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2018 at 12:06 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sw_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `idActivity` int(11) NOT NULL AUTO_INCREMENT,
  `idAdministrator` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `location` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL,
  PRIMARY KEY (`idActivity`),
  KEY `fk_Activity_Administrator_idx` (`idAdministrator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `idAdministrator` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`idAdministrator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `administrator` (`idAdministrator`,`username`,`password`) VALUES
(1,'admin','12yJ.Of/NQ.Pk');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idActivity` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `fk_Comment_Activity1_idx` (`idActivity`),
  KEY `fk_Comment_User1_idx` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

DROP TABLE IF EXISTS `creditcard`;
CREATE TABLE IF NOT EXISTS `creditcard` (
  `cardNumber` varchar(45) NOT NULL,
  `cardHolderName` varchar(45) NOT NULL,
  `expiryDate` date NOT NULL,
  `securityNumber` int(11) NOT NULL,
  PRIMARY KEY (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idActivity` int(11) NOT NULL,
  `cardNumber` varchar(45) NOT NULL,
  `state` enum('standby','rejected','accepted','delayed') NOT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `fk_Reservation_Activity1_idx` (`idActivity`),
  KEY `fk_Reservation_User1_idx` (`idUser`),
  KEY `fk_Reservation_CreditCard1_idx` (`cardNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_Activity_Administrator` FOREIGN KEY (`idAdministrator`) REFERENCES `administrator` (`idAdministrator`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_Comment_Activity1` FOREIGN KEY (`idActivity`) REFERENCES `activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comment_User1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_Reservation_Activity1` FOREIGN KEY (`idActivity`) REFERENCES `activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservation_CreditCard1` FOREIGN KEY (`cardNumber`) REFERENCES `creditcard` (`cardNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservation_User1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
