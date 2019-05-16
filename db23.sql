-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2019 at 02:42 PM
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
-- Database: `db23`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

DROP TABLE IF EXISTS `catagory`;
CREATE TABLE IF NOT EXISTS `catagory` (
  `catagoryID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

DROP TABLE IF EXISTS `fooditem`;
CREATE TABLE IF NOT EXISTS `fooditem` (
  `foodID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `picsource` varchar(350) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `UnitPrice` varchar(255) NOT NULL,
  `CatagoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`foodID`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditem`
--

INSERT INTO `fooditem` (`foodID`, `Name`, `picsource`, `Quantity`, `UnitPrice`, `CatagoryID`, `userID`) VALUES
(19, 'Doughnuts', 'uploads/Doughnuts.jpg', '4', '800', 4, 15),
(18, 'Italian Food', 'uploads/quickserve_items.jpg', '5', '1040', 5, 15),
(7, 'Chicken ', 'uploads/recipeThumb-06.jpg', '7', '7', 4, 9),
(17, 'Chicken Biryani', 'uploads/1590373-biryani-1513939158-933-640x480.gif', '2', '300', 3, 15),
(16, 'Desi Food', 'uploads/agarwal-store-light-food-items-chandrapura-bokaro-restaurants-3skw39a.jpg', '2', '290', 4, 15),
(14, 'Burger', 'uploads/3d06c742-15cc-49b2-8845-7ef42d0c9f97.jpg', '1', '350', 3, 15),
(15, 'burger King', 'uploads/5a7dc169d03072af008b4bf2-750-562.jpg', '1', '560', 3, 15),
(21, 'Large Pizza', 'uploads/pictures-of-food-items-147346-4143337.jpg', '6', '900', 5, 13),
(22, 'Chicken Nuggets', 'uploads/fast-food-chicken-nuggets-with-ketchup-cola-PDXXSGU.jpg', '4', '400', 5, 13),
(23, 'Gullab Jamun', 'uploads/feature-image-gulab-jamun.jpg', '4', '150', 5, 13),
(24, 'Desert', 'uploads/raw-dessert.jpg', '5', '489', 2, 13),
(33, 'Pasta', 'uploads/meaaals.jpg', '3', '345', 4, 13),
(26, 'Chocolate Cake', 'uploads/0266676.jpg', '4', '300', 4, 13),
(27, 'Indian Platter', 'uploads/Fullonshaadi-Indian-Wedding-Planning-Indian-wedding-meal-and-caterer-Indian-Meal.jpg', '5', '567', 5, 9),
(28, 'South Indian Platter', 'uploads/south-indian-food-1495910817-2204324.jpeg', '5', '679', 4, 9),
(29, 'Mix Food Deal ', 'uploads/shutterstock_1161597079-760x506.jpg', '2', '349', 4, 9),
(30, 'Burger Fries', 'uploads/food-swamp-food.jpg', '3', '590', 5, 9),
(32, 'Cuisine Rajhistan', 'uploads/rajas.b_11aug.jpg', '4', '590', 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `orderID` int(11) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `UserID` int(100) NOT NULL,
  `foodID` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `Quantity`, `UserID`, `foodID`) VALUES
(14, 2, 9, 2),
(13, 2, 9, 2),
(12, 2, 9, 2),
(11, 2, 9, 2),
(10, 2, 9, 2),
(9, 2, 9, 2),
(15, 2, 9, 2),
(16, 2, 9, 2),
(17, 2, 9, 2),
(18, 2, 9, 2),
(19, 2, 9, 2),
(20, 2, 9, 2),
(21, 2, 9, 2),
(22, 2, 9, 2),
(23, 2, 9, 2),
(24, 2, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
  `FoodID` int(11) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `UnitPrice` varchar(255) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`FoodID`, `Quantity`, `UnitPrice`, `OrderID`, `item_id`) VALUES
(12, '1', '223', 24, 38);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `userID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Comments` text NOT NULL,
  `Rating` int(11) NOT NULL,
  `FoodID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`userID`, `Name`, `Email`, `Comments`, `Rating`, `FoodID`) VALUES
(5, 'Summen', 'Summen@gmail.com', 'yyy', 3, 13),
(5, 'alia', 'alia@gmail.com', 'tggg', 2, 13),
(5, 'alia', 'alia@gmail.com', 'tggg', 2, 13),
(5, 'alia', 'alia@gmail.com', 'tggg', 2, 13),
(5, 'alia', 'alia@gmail.com', 'tggg', 2, 13),
(5, 'alia', 'alia@gmail.com', 'tggg', 2, 13),
(5, 'summen', 'Summen@gmail.com', 'tet', 3, 6),
(5, 'summen', 'Summen@gmail.com', 'tet', 3, 6),
(5, 'summen', 'Summen@gmail.com', 'tet', 3, 6),
(5, 'summen', 'Summen@gmail.com', 'tet', 3, 6),
(5, 'summen', 'Summen@gmail.com', 'tet', 3, 6),
(5, 'summen', 'Summen@gmail.com', 'tet', 3, 6),
(5, 'summen', 'Summen@gmail.com', 'hello', 3, 11),
(9, 'hh', 'Summen@gmail.com', 'yy', 2, 9),
(9, 'hh', 'Summen@gmail.com', 'yy', 2, 9),
(9, 'hh', 'Summen@gmail.com', 'yy', 2, 9),
(16, 'summen', 'Summen@gmail.com', 'your food is good i really like it.', 4, 18),
(16, 'summen', 'Summen@gmail.com', 'your food is good i really like it.', 4, 18),
(16, 'summen', 'Summen@gmail.com', 'your food is good i really like it.', 4, 18),
(16, 'summen', 'Summen@gmail.com', 'your food is good i really like it.', 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `RoleID` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `Email`, `PhoneNo`, `Fname`, `Lname`, `Password`, `RoleID`) VALUES
(1, 'Summen@gmail.com', '333', 'ccc', 'ccc', 'd', 2),
(2, 'aim@gmail.com', '66w7y777', 'zahid', 'tayyab', '123455', 2),
(3, 'aim@gmail.com', '66w7y777', 'zahid', 'tayyab', '123455', 2),
(4, 'Summen@gmail.com', '8222222', 'zahid', 'sumen', '2342', 1),
(5, 'Summen@gmail.com', '8222222', 'zahid', 'Summen', '55', 2),
(6, 'aman@gmail.com', '8222222', 'ccc', 'aiman', '12345', 1),
(7, 'Summen@gmail.com', '88899', 'ccc', 'Summen', '6677', 2),
(8, 'aa@gmail.com', '63673883', 'zahid', 'Summen', '562', 1),
(9, 'new@gmail.com', '88899', 'new', 'new', '12345', 1),
(10, 'hafsa@gmail.com', '12345', 'qayyum', 'hafsa', '12345', 1),
(11, 'Summen@gmail.com', '03218877183', 'Summen ', 'Zahid', '123', 2),
(12, 'Aiman@gmail.com', '03244243090', 'Aiman', 'Zahid', '123', 2),
(13, 'hafsa@gmail.com', '03117896578', 'Hafsa', 'Komal', '123', 1),
(14, 'alia@gmail.com', '03237894356', 'Alia', 'Liaqat', '123', 1),
(15, 'Bisma@gmail.com', '03326783456', 'Bisma', 'Khan', '123', 1),
(16, 'menahal@gmail.com', '03127890333', 'Menahal ', 'Hassan', '123', 2),
(17, 'sana@gmail.com', '03217822987', 'Sana', 'afzal', '123', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
