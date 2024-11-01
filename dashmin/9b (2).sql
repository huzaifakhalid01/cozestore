-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 07:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `9b`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `datainsert` (`pname` VARCHAR(20), `pqty` INT, `pprice` INT, `ps` VARCHAR(20), `cid` INT)   BEGIN 
INSERT INTO product(name,price,quantity,pstatus,catID) VALUES(pname,pprice,pqty,ps,cid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAll` ()   BEGIN 
SELECT * from product;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proByCat` (IN `catName` VARCHAR(20))   BEGIN
SELECT product.id ,product.name , product.price,product.quantity , category.Product_Name FROM product INNER JOIN category on 
product.catID = category.id WHERE category.Product_Name = catName;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `catbackup`
--

CREATE TABLE `catbackup` (
  `id` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catbackup`
--

INSERT INTO `catbackup` (`id`, `description`) VALUES
(1, 'new category added into category table at 2024-08-');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catId` int(11) NOT NULL,
  `catName` varchar(20) NOT NULL,
  `catImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catName`, `catImage`) VALUES
(1, 'kids fashion', 'mickeyT-shirt.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `Product_Name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `Product_Name`) VALUES
(1, 'Mobile'),
(2, 'Fashion'),
(3, 'Clothes'),
(4, 'Food'),
(5, 'Electronics'),
(6, 'Accessories'),
(7, 'men fashion');

--
-- Triggers `category`
--
DELIMITER $$
CREATE TRIGGER `catInfo` AFTER INSERT ON `category` FOR EACH ROW BEGIN
INSERT INTO catBackup (description) VALUES(concat("new category added into category table at ", now()));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pbackup`
--

CREATE TABLE `pbackup` (
  `id` int(11) NOT NULL,
  `pname` varchar(25) NOT NULL,
  `pqty` int(11) NOT NULL,
  `pprice` int(11) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pbackup`
--

INSERT INTO `pbackup` (`id`, `pname`, `pqty`, `pprice`, `date`) VALUES
(1, 'i phone 12', 100, 150000, '19-08-24 11:30:22:AM'),
(2, 'redme', 55, 19000, '19-08-24 11:30:39:AM');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `pstatus` varchar(20) DEFAULT NULL,
  `catID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `pstatus`, `catID`) VALUES
(1, 'infinix', 25000, 5, 'best selling', 1),
(2, 'techno', 35000, 10, ' selling', 1),
(3, 'i phone 7', 50000, 3, 'best selling', 1),
(4, 'vivo', 25000, 7, 'best selling', 1),
(5, 'honor', 25000, 35, 'best selling', 1),
(6, 'realme', 20000, 3, ' selling', 1),
(8, 'infinix hot 10', 20000, 10, ' selling', 1),
(9, 'oppo', 45000, 65, 'best selling', 1),
(10, 'qmoble', 15000, 5, ' selling', 1),
(11, 'iphonr x', 65000, 10, ' selling', 1),
(13, 'note 8', 45000, 17, ' selling', 1),
(14, 'techno spark 5 pro ', 37000, 35, 'best selling', 1),
(15, 'techono ', 20000, 42, ' selling', 1),
(16, 'redme 55', 49000, 55, 'best selling', 1),
(17, 'infinix hot 11', 28000, 13, ' selling', 1),
(18, 'oppo f11', 45000, 95, 'best selling', 1),
(19, 'qmoble 11', 25000, 5, ' selling', 1),
(21, 'Wheat', 2500, 2, 'best-selling', 5),
(25, 'Wheat', 2500, 2, 'best-selling', 4),
(26, 'infinix hot 12', 45000, 6, 'bestselling', 1);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `probackup` AFTER DELETE ON `product` FOR EACH ROW BEGIN
DECLARE pn varchar(20);
DECLARE pp int;
DECLARE pq int;
SET pn = old.name;
SET pp = old.price;
SET pq = old.quantity;
INSERT INTO pbackup (pname,pprice,pqty,date) VALUES(pn,pp,pq,date_format(now(),"%d-%m-%y %h:%i:%s:%p"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `course` varchar(15) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `class_status` enum('ONLIN','PHYSIACL') DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `faculty__id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `course`, `city`, `class_status`, `fee`, `faculty__id`) VALUES
(1, 'raees', 'raees@gmial.com', 'cpism', 'karachi', '', 6500, 15515),
(2, 'soud', 'soud@gmial.com', 'hdse', 'lahore', '', 6500, 15515),
(3, 'ali', 'ali@gmial.com', 'accp', 'hajira', '', 6500, 15515),
(4, 'hamid', 'hamid@gmial.com', 'cpism', 'rawalpindi', '', 6500, 15515),
(5, 'danish', 'danish@gmial.co', 'ms word', 'multan', '', 6500, 15515),
(6, 'babar', 'babar@gmial.com', 'c++', 'gilgit', '', 6500, 15515),
(7, 'arbab', 'arbab@gmial.com', 'exel', 'quetta', '', 6500, 15515),
(8, 'dawood', 'dawood@gmial.co', 'cpism', 'multan', '', 6500, 15515),
(9, 'hamaza', 'hamaza@gmial.co', 'dism', 'abbaspur', '', 6500, 15515),
(28, 'raees', 'rais@gmial.com', 'cpism', 'karachi', '', 6500, 15515),
(29, 'soud', 'sod@gmial.com', 'hdse', 'lahore', '', 6500, 15515),
(30, 'ali', 'al@gmial.com', 'accp', 'hajira', '', 6500, 15515),
(31, 'hamid', 'hamd@gmial.com', 'cpism', 'rawalpindi', '', 6500, 15515),
(32, 'danish', 'dnish@gmial.com', 'ms word', 'multan', '', 6500, 15515),
(33, 'babar', 'babr@gmial.com', 'c++', 'gilgit', '', 6500, 15515),
(34, 'arbab', 'arba@gmial.com', 'exel', 'quetta', '', 6500, 15515),
(35, 'dawood', 'dawod@gmial.com', 'cpism', 'multan', '', 6500, 15515),
(36, 'hamaza', 'hamaa@gmial.com', 'dism', 'abbaspur', '', 6500, 15515);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `name`, `email`, `password`, `gender`) VALUES
(1, 'aliyan', 'aliyan@gmail.com', '123', ''),
(4, 'sana', 's@gmail.com', '123', ''),
(6, 'hamza', 'hamza@gmail.com', '123', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catbackup`
--
ALTER TABLE `catbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbackup`
--
ALTER TABLE `pbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catbackup`
--
ALTER TABLE `catbackup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pbackup`
--
ALTER TABLE `pbackup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
