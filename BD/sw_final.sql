-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2018 at 11:54 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sw_final`
--
  CREATE DATABASE `sw_final`;

  USE `sw_final`;
-- --------------------------------------------------------

--
-- Table structure for table `Activity`
--

CREATE TABLE `Activity` (
  `idActivity` int(11) NOT NULL,
  `idAdministrator` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `location` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE `Administrator` (
  `idAdministrator` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Administrator` (`idAdministrator`,`name`,`username`,`password`) VALUES
(1,'Miguel','AdminMiguel','12yJ.Of/NQ.Pk'),
(2,'Vasco','AdminVasco','12yJ.Of/NQ.Pk'),
(3,'Nelson','AdminNelson','12yJ.Of/NQ.Pk');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `idComment` int(11) NOT NULL,
  `idActivity` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `CreditCard`
--

CREATE TABLE `CreditCard` (
  `cardNumber` varchar(200) NOT NULL,
  `cardHolderName` varchar(45) NOT NULL,
  `expiryDate` varchar(200) NOT NULL,
  `securityNumber` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE `Reservation` (
  `idReservation` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idActivity` int(11) NOT NULL,
  `cardNumber` varchar(200) NOT NULL,
  `state` enum('standby','rejected','accepted','delayed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Activity`
--
ALTER TABLE `Activity`
  ADD PRIMARY KEY (`idActivity`),
  ADD KEY `fk_Activity_Administrator_idx` (`idAdministrator`);

--
-- Indexes for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`idAdministrator`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `fk_Comment_Activity1_idx` (`idActivity`),
  ADD KEY `fk_Comment_User1_idx` (`idUser`);

--
-- Indexes for table `CreditCard`
--
ALTER TABLE `CreditCard`
  ADD PRIMARY KEY (`cardNumber`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `fk_Reservation_Activity1_idx` (`idActivity`),
  ADD KEY `fk_Reservation_User1_idx` (`idUser`),
  ADD KEY `fk_Reservation_CreditCard1_idx` (`cardNumber`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Activity`
--
ALTER TABLE `Activity`
  MODIFY `idActivity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Administrator`
--
ALTER TABLE `Administrator`
  MODIFY `idAdministrator` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Activity`
--
ALTER TABLE `Activity`
  ADD CONSTRAINT `fk_Activity_Administrator` FOREIGN KEY (`idAdministrator`) REFERENCES `Administrator` (`idAdministrator`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `fk_Comment_Activity1` FOREIGN KEY (`idActivity`) REFERENCES `Activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comment_User1` FOREIGN KEY (`idUser`) REFERENCES `User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `fk_Reservation_Activity1` FOREIGN KEY (`idActivity`) REFERENCES `Activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservation_CreditCard1` FOREIGN KEY (`cardNumber`) REFERENCES `CreditCard` (`cardNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservation_User1` FOREIGN KEY (`idUser`) REFERENCES `User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
