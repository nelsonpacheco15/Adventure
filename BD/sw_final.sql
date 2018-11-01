-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 28-Out-2018 às 18:39
-- Versão do servidor: 5.7.24-0ubuntu0.18.04.1
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
DROP DATABASE IF EXISTS `sw_final`;
CREATE DATABASE
IF NOT EXISTS `sw_final`;
USE `sw_final`;
-- --------------------------------------------------------

--
-- Estrutura da tabela `activity`
--

CREATE TABLE `activity` (
  `idActivity` int(11) NOT NULL,
  `idAdministrator` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `desc` varchar(45) DEFAULT NULL,
  `location` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrator`
--

CREATE TABLE `administrator` (
  `idAdministrator` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrator`
--

INSERT INTO `administrator` (`idAdministrator`, `username`, `password`) VALUES
(1, 'admin', '123'),
(2, 'admin', '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comment`
--

CREATE TABLE `comment` (
  `idComment` int(11) NOT NULL,
  `idActivity` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `creditcard`
--

CREATE TABLE `creditcard` (
  `idCreditCard` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `cardNumber` int(11) NOT NULL,
  `cardHolderName` varchar(45) NOT NULL,
  `expiryDate` date NOT NULL,
  `securityNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `state` enum('standby','rejected','accepted','delayed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=sjis;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`idActivity`),
  ADD KEY `fk_Activity_Administrator_idx` (`idAdministrator`);

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`idAdministrator`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `fk_Comment_Activity1_idx` (`idActivity`),
  ADD KEY `fk_Comment_User1_idx` (`idUser`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`idCreditCard`),
  ADD KEY `fk_CreditCard_User1_idx` (`idUser`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `fk_Reservation_User1_idx` (`idUser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `idActivity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `idAdministrator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_Activity_Administrator` FOREIGN KEY (`idAdministrator`) REFERENCES `administrator` (`idAdministrator`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_Comment_Activity1` FOREIGN KEY (`idActivity`) REFERENCES `activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comment_User1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `fk_CreditCard_User1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_Reservation_User1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
