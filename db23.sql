-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2019 at 12:05 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db23`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

DROP TABLE IF EXISTS `fooditem`;
CREATE TABLE IF NOT EXISTS `fooditem` (
  `FoodID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `UnitPrice` varchar(255) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`FoodID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `PickupDate` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
  `OrderID` int(11) NOT NULL,
  `FoodID` int(11) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `UnitPrice` varchar(255) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `FoodID` (`FoodID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentID` int(11) NOT NULL,
  `UserIID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `Amount` varchar(255) NOT NULL,
  `PaymentType` int(11) NOT NULL,
  PRIMARY KEY (`PaymentID`),
  KEY `UserIID` (`UserIID`),
  KEY `OrderID` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Comments` text NOT NULL,
  `Rating` int(11) NOT NULL,
  `FoodID` int(11) NOT NULL,
  KEY `FoodID` (`FoodID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `RoleId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`RoleId`),
  UNIQUE KEY `RoleId` (`RoleId`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `PhoneNo` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `FoodID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `OrderID` (`OrderID`),
  KEY `FoodID` (`FoodID`),
  KEY `PaymentID` (`PaymentID`),
  KEY `RoleId` (`RoleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fooditem`
--
ALTER TABLE `fooditem`
  ADD CONSTRAINT `fooditem_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`FoodID`) REFERENCES `fooditem` (`FoodID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`UserIID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`FoodID`) REFERENCES `fooditem` (`FoodID`);

--
-- Constraints for table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`FoodID`) REFERENCES `fooditem` (`FoodID`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`RoleId`) REFERENCES `role` (`RoleId`),
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
