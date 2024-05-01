-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 12:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poultry`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `createuser` varchar(255) DEFAULT NULL,
  `deleteuser` varchar(255) DEFAULT NULL,
  `createbid` varchar(255) DEFAULT NULL,
  `updatebid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `createuser`, `deleteuser`, `createbid`, `updatebid`) VALUES
(1, 'Superuser', '1', '1', '1', '1'),
(2, 'Admin', '1', NULL, '1', '1'),
(3, 'User', NULL, NULL, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_out`
--

CREATE TABLE `store_out` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `itemsoutvalue` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `store_out`
--

INSERT INTO `store_out` (`id`, `date`, `item`, `quantity`, `itemsoutvalue`) VALUES
(64, '2021-07-10', 'Poultry feeds', '2', 2000),
(65, '2021-07-10', 'paint jellycans', '19', 9500000);

-- --------------------------------------------------------

--
-- Table structure for table `store_stock`
--

CREATE TABLE `store_stock` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `item` varchar(500) NOT NULL,
  `quantity` varchar(500) NOT NULL,
  `rate` varchar(500) NOT NULL,
  `total` varchar(500) NOT NULL,
  `quantity_remaining` varchar(500) NOT NULL,
  `itemvalue` int(15) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `store_stock`
--

INSERT INTO `store_stock` (`id`, `date`, `item`, `quantity`, `rate`, `total`, `quantity_remaining`, `itemvalue`, `status`) VALUES
(12, '2021-05-11', 'brooms', '', '10000', '380000', '10', 100000, '1'),
(16, '2021-07-05', 'liquid soap jellycans', '', '20000', '200000', '7', 140000, '1'),
(19, '2021-07-10', 'Poultry feeds', '', '1000', '102000', '100', 100000, '1'),
(20, '2021-07-10', 'Poultry medicine', '', '1000', '30000', '30', 30000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `Staffid` int(10) DEFAULT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `Staffid`, `AdminName`, `UserName`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Status`, `Photo`, `Password`, `AdminRegdate`) VALUES
(2, 1002, 'Admin', 'admin', 'Kennedy', 'N.', 794298696, 'admin@gmail.com', 1, 'ceo.jpg', '81dc9bdb52d04dc20036dbd8313ed055', '2021-06-21 10:18:39'),
(9, 1003, 'Admin', 'Kelvin', 'Kelvin', 'M.', 757537271, 'kevo@gmail.com', 1, 'pic_3.jpg', '25d55ad283aa400af464c76d713c07ad', '2020-08-21 07:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `CategoryCode` varchar(50) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `CategoryCode`, `PostingDate`) VALUES
(8, 'Eggs', 'GH02', '2021-06-04 20:57:39'),
(9, 'Meat', 'BM001', '2021-07-10 14:05:18'),
(10, 'Birds', 'BH002', '2021-07-10 14:06:44'),
(11, 'Chick', 'CH003', '2021-07-10 14:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `id` int(11) NOT NULL,
  `regno` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyemail` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `companyphone` int(10) NOT NULL,
  `companyaddress` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `companylogo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'avatar15.jpg',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `developer` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`id`, `regno`, `companyname`, `companyemail`, `country`, `companyphone`, `companyaddress`, `companylogo`, `status`, `developer`, `creationdate`) VALUES
(4, 'V9041', 'Poultry farm', 'poultryfarm@gmail.com', 'Kenya', 700000000, 'Juja', 'myfarm.jpg', '1', 'kennedy', '2024-04-09 12:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblitems`
--

CREATE TABLE `tblitems` (
  `id` int(11) NOT NULL,
  `item` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblitems`
--

INSERT INTO `tblitems` (`id`, `item`, `description`, `Creationdate`) VALUES
(1, 'brooms', 'sweeping brooms', '2021-04-30 01:15:55'),
(2, 'soap', 'washing soap', '2021-04-30 01:23:21'),
(3, 'Poultry feeds', 'Food for birds', '2021-07-10 13:56:09'),
(4, 'Poultry medicine', 'used to treat birds', '2021-07-10 14:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `id` int(11) NOT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `InvoiceNumber` int(11) DEFAULT NULL,
  `CustomerName` varchar(150) DEFAULT NULL,
  `CustomerContactNo` bigint(12) DEFAULT NULL,
  `PaymentMode` varchar(100) DEFAULT NULL,
  `InvoiceGenDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`id`, `ProductId`, `Quantity`, `InvoiceNumber`, `CustomerName`, `CustomerContactNo`, `PaymentMode`, `InvoiceGenDate`) VALUES
(22, 9, 2, 631582747, 'John Smith', 770546590, 'cash', '2021-07-10'),
(23, 10, 4, 631582747, 'John Smith', 770546590, 'cash', '2021-07-10'),
(24, 9, 1, 315727203, 'Morgan', 770546444, 'card', '2021-07-21'),
(25, 10, 5, 315727203, 'Morgan', 770546444, 'card', '2021-07-21'),
(26, 12, 2, 288538918, 'Andrea', 770546590, 'cash', '2021-07-21'),
(27, 13, 3, 288538918, 'Andrea', 770546590, 'cash', '2021-07-21'),
(28, 14, 1, 288538918, 'Andrea', 770546590, 'cash', '2021-07-21'),
(29, 16, 20, 537493720, 'Kennedy', 794298696, 'card', '2024-04-24'),
(30, 16, 6, 843796460, 'Ken', 794298696, 'cash', '2024-04-29'),
(31, 16, 10, 262972087, 'Kennedy', 794298696, 'cash', '2024-04-29'),
(32, 16, 5, 852912302, 'Kennedy', 794298696, 'card', '2024-04-29'),
(33, 16, 5, 264238340, 'Kennedy', 794298696, 'cash', '2024-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `tblpoultry`
--

CREATE TABLE `tblpoultry` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `PoultryName` varchar(150) DEFAULT NULL,
  `ArrivalDate` date NOT NULL,
  `RecentVaccination` date NOT NULL,
  `VaccinationFrequency` int(255) NOT NULL,
  `MaxVaccinations` int(255) NOT NULL,
  `NextVaccination` date NOT NULL,
  `Units` int(255) NOT NULL,
  `PoultryImage` varchar(255) DEFAULT NULL,
  `notification` int(255) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpoultry`
--

INSERT INTO `tblpoultry` (`id`, `CategoryName`, `PoultryName`, `ArrivalDate`, `RecentVaccination`, `VaccinationFrequency`, `MaxVaccinations`, `NextVaccination`, `Units`, `PoultryImage`, `notification`, `PostingDate`, `UpdationDate`) VALUES
(1, 'Layers', 'Chicks', '2024-04-17', '2024-04-17', 7, 2, '0000-00-00', 200, 'layers.jpg\r\n', 0, '2024-04-17 19:29:44', NULL),
(2, 'Goose', 'Gooselings', '2024-03-17', '2024-04-17', 7, 3, '0000-00-00', 50, 'goose.jpg', 0, '2024-04-17 19:27:30', NULL),
(3, 'Goose', 'Gooselings', '2024-04-15', '2024-04-25', 5, 2, '0000-00-00', 500, 'goose.jpg', 0, '2024-04-22 16:55:03', NULL),
(4, 'Goose', 'Chicks', '2024-04-22', '2024-04-26', 7, 2, '2024-04-26', 30, 'layers.jpg', 0, '2024-04-22 17:05:14', NULL),
(5, 'Goose', 'Gooselings', '2024-04-22', '0000-00-00', 7, 2, '2024-04-30', 40, 'goose.jpg', 0, '2024-04-30 11:25:54', '2024-04-30 11:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblpoultry_category`
--

CREATE TABLE `tblpoultry_category` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `CategoryCode` varchar(50) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpoultry_category`
--

INSERT INTO `tblpoultry_category` (`id`, `CategoryName`, `CategoryCode`, `PostingDate`) VALUES
(1, 'Layers', 'L012', '2024-04-17 18:14:31'),
(2, 'Goose', 'G01K', '2024-04-17 19:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `ProductName` varchar(150) DEFAULT NULL,
  `Units` int(11) NOT NULL,
  `ProductImage` varchar(255) DEFAULT NULL,
  `ProductPrice` decimal(10,0) DEFAULT current_timestamp(),
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `CategoryName`, `ProductName`, `Units`, `ProductImage`, `ProductPrice`, `PostingDate`, `UpdationDate`) VALUES
(9, 'Meat', '1kg fresh meat', 0, 'po0.jpg', 1000, '2021-07-20 23:10:08', '2021-07-20 23:10:08'),
(10, 'Eggs', ' local eggs', 0, 'po5.jpg', 5000, '2021-07-10 14:18:15', '2021-07-10 14:18:15'),
(11, 'Meat', 'fried chicken', 0, 'p2.jpg', 1000, '2024-05-01 10:45:57', '2024-05-01 10:45:57'),
(13, 'Birds', 'layers', 0, 'bi.jpg', 6000, '2021-07-10 14:23:14', NULL),
(16, 'Chick', 'Chicks', 20, 'goose.jpg', 150, '2024-04-29 11:56:47', '2024-04-29 11:56:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_out`
--
ALTER TABLE `store_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_stock`
--
ALTER TABLE `store_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblitems`
--
ALTER TABLE `tblitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpoultry`
--
ALTER TABLE `tblpoultry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpoultry_category`
--
ALTER TABLE `tblpoultry_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_out`
--
ALTER TABLE `store_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `store_stock`
--
ALTER TABLE `store_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblitems`
--
ALTER TABLE `tblitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tblpoultry`
--
ALTER TABLE `tblpoultry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpoultry_category`
--
ALTER TABLE `tblpoultry_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
