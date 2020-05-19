-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 06:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hertz_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliates_database`
--

CREATE TABLE `affiliates_database` (
  `Affiliates_ID` int(11) NOT NULL,
  `Affiliates_Name` varchar(200) NOT NULL,
  `Branch` varchar(100) NOT NULL,
  `affiliate_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliates_database`
--

INSERT INTO `affiliates_database` (`Affiliates_ID`, `Affiliates_Name`, `Branch`, `affiliate_user`) VALUES
(1, 'Toyota', 'shaw', 0),
(2, 'Toyota', 'Magallanes', 0),
(3, 'Suzuki', 'Magnolia', 0),
(4, 'Rapidae', 'Pasong Tamo', 0),
(5, 'honda', 'Mandaluyong', 0),
(6, 'Douche', 'Timog', 0),
(7, 'a', 'b', 0),
(8, 'b', 'b', 0),
(9, 'c', 'c', 0),
(10, 'd', 'd', 10),
(11, 'e', 'e', 11),
(12, 'f', 'f', 12),
(13, 'aaaa', 'bbbb', 13),
(14, 'test_Af', 'af', 14);

-- --------------------------------------------------------

--
-- Table structure for table `log_database`
--

CREATE TABLE `log_database` (
  `Log_ID` int(11) NOT NULL,
  `Log_User` varchar(200) NOT NULL,
  `Log_Date` date NOT NULL,
  `Log_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_database`
--

INSERT INTO `log_database` (`Log_ID`, `Log_User`, `Log_Date`, `Log_Time`) VALUES
(1, 'Sabado, Ayel Adoc', '2019-11-08', '06:04:04'),
(2, 'Sabado, Ayel Adoc', '2019-11-08', '08:40:40'),
(3, 'Sabado, Ayel Adoc', '2019-11-08', '10:57:55'),
(4, 'Sabado, Ayel Adoc', '2019-11-08', '11:05:26'),
(5, 'Sabado, Ayel Adoc', '2019-11-08', '11:06:03'),
(6, 'Sabado, Ayel Adoc', '2019-11-08', '11:13:17'),
(7, 'Sabado, Ayel Adoc', '2019-11-08', '11:30:50'),
(8, 'Sabado, Ayel Adoc', '2019-11-08', '11:33:11'),
(9, 'Sabado, Ayel Adoc', '2019-11-08', '11:34:17'),
(10, 'Sabado, Ayel Adoc', '2019-11-10', '01:00:18'),
(11, 'Sabado, Ayel Adoc', '2019-11-10', '01:13:19'),
(12, 'Sabado, Ayel Adoc', '2019-11-11', '08:29:17'),
(13, 'Sabado, Ayel Adoc', '2019-11-11', '08:30:21'),
(14, 'Sabado, Ayel Adoc', '2019-11-11', '09:41:32'),
(15, 'Dalisay, Bernard Weeds', '2019-11-11', '09:43:20'),
(16, 'Sabado, Ayel Adoc', '2019-11-11', '09:45:01'),
(17, 'Dalisay, Bernard Weeds', '2019-11-11', '09:45:13'),
(18, 'Dalisay, Bernard Weeds', '2019-11-11', '10:40:07'),
(19, 'Dalisay, Bernard Weeds', '2019-11-11', '10:42:13'),
(20, 'Sabado, Ayel Adoc', '2019-11-11', '10:42:45'),
(21, 'Dalisay, Bernard Weeds', '2019-11-11', '10:42:58'),
(22, 'Dalisay, Bernard Weeds', '2019-11-11', '11:28:53'),
(23, 'Sabado, Ayel Adoc', '2019-11-11', '11:38:51'),
(24, 'Dalisay, Bernard Weeds', '2019-11-11', '11:44:28'),
(25, 'Sabado, Ayel Adoc', '2019-11-11', '11:49:59'),
(26, 'Sabado, Ayel Adoc', '2019-11-12', '12:15:55'),
(27, 'Sabado, Ayel Adoc', '2019-11-12', '12:18:10'),
(28, 'Dalisay, Bernard Weeds', '2019-11-12', '12:25:40'),
(29, 'Sabado, Ayel Adoc', '2019-11-12', '12:35:16'),
(30, 'Dalisay, Bernard Weeds', '2019-11-12', '12:35:55'),
(31, 'Sabado, Ayel Adoc', '2019-11-12', '12:49:21'),
(32, 'Dalisay, Bernard Weeds', '2019-11-12', '12:49:44'),
(33, 'Sabado, Ayel Adoc', '2019-11-13', '08:53:02'),
(34, 'Sabado, Ayel Adoc', '2019-11-13', '08:54:05'),
(35, 'Dalisay, Bernard Weeds', '2019-11-13', '08:54:23'),
(36, 'Sabado, Ayel Adoc', '2019-11-13', '08:54:41'),
(37, 'Sabado, Ayel Adoc', '2019-11-13', '09:02:01'),
(38, 'Sabado, Ayel Adoc', '2019-11-13', '09:03:56'),
(39, 'Sabado, Ayel Adoc', '2019-11-13', '09:18:03'),
(40, 'Dalisay, Bernard Weeds', '2019-11-13', '09:18:35'),
(41, 'Sabado, Ayel Adoc', '2019-11-13', '10:47:30'),
(42, 'Dalisay, Bernard Weeds', '2019-11-13', '10:52:34'),
(43, 'Dalisay, Bernard Weeds', '2019-11-14', '03:00:16'),
(44, 'Sabado, Ayel Adoc', '2019-11-14', '03:04:01'),
(45, 'Dalisay, Bernard Weeds', '2019-11-14', '03:04:55'),
(46, 'Sabado, Ayel Adoc', '2019-11-14', '03:10:16'),
(47, 'Dalisay, Bernard Weeds', '2019-11-14', '03:10:42'),
(48, 'Dalisay, Bernard Weeds', '2019-11-14', '03:29:30'),
(49, 'Ramos, Ana Katrina Flat', '2020-05-08', '06:42:59'),
(50, 'Dalisay, Bernard Weeds', '2020-05-09', '04:08:14'),
(51, 'Dalisay, Bernard Weeds', '2020-05-09', '04:27:19'),
(52, 'Ramos, Ana Katrina Flat', '2020-05-09', '06:17:49'),
(53, 'Dalisay, Bernard Weeds', '2020-05-09', '06:18:55'),
(54, 'Ramos, Ana Katrina Flat', '2020-05-09', '06:22:53'),
(55, 'Laynes, Daniel Mata', '2020-05-09', '06:50:41'),
(56, 'Laynes, Daniel Mata', '2020-05-09', '06:50:55'),
(57, 'Sabado, Ayel Adoc', '2020-05-09', '07:28:05'),
(58, 'Dalisay, Bernard Weeds', '2020-05-10', '01:45:52'),
(59, 'Sabado, Ayel Adoc', '2020-05-10', '01:48:09'),
(60, 'Ramos, Ana Katrina Flat', '2020-05-10', '02:25:24'),
(61, 'Dalisay, Bernard Weeds', '2020-05-10', '05:10:27'),
(62, 'Sabado, Ayel Adoc', '2020-05-10', '05:16:09'),
(63, 'Ramos, Ana Katrina Flat', '2020-05-10', '05:20:53'),
(64, 'Dalisay, Bernard Weeds', '2020-05-10', '05:21:10'),
(65, 'Laynes, Daniel Mata', '2020-05-10', '05:21:22'),
(66, 'Laynes, Daniel Mata', '2020-05-10', '05:22:04'),
(67, 'Sabado, Ayel Adoc', '2020-05-10', '05:26:02'),
(68, 'Dalisay, Bernard Weeds', '2020-05-10', '06:10:53'),
(69, 'Sabado, Ayel Adoc', '2020-05-10', '06:11:08'),
(70, 'Ramos, Ana Katrina Flat', '2020-05-10', '06:15:50'),
(71, 'Dalisay, Bernard Weeds', '2020-05-10', '06:20:49'),
(72, 'Ramos, Ana Katrina Flat', '2020-05-10', '06:26:57'),
(73, 'Sabado, Ayel Adoc', '2020-05-10', '06:27:08'),
(74, 'Sabado, Ayel Adoc', '2020-05-10', '06:57:48'),
(75, 'Sabado, Ayel Adoc', '2020-05-10', '07:02:00'),
(76, 'Sabado, Ayel Adoc', '2020-05-19', '12:42:17'),
(77, 'Ramos, Katrina ', '2020-05-19', '12:46:16'),
(78, 'Sabado, Ayel Adoc', '2020-05-19', '01:40:46'),
(79, 'Ramos, Katrina ', '2020-05-19', '01:50:23'),
(80, 'Sabado, Ayel Adoc', '2020-05-19', '01:57:23'),
(81, ' ,    ', '2020-05-19', '03:24:46'),
(82, 'Dalisay, Bernard Weeds', '2020-05-19', '03:46:10'),
(83, 'Ramos, Katrina ', '2020-05-19', '03:46:31'),
(84, 'Ramos, Katrina ', '2020-05-19', '05:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_database`
--

CREATE TABLE `quotation_database` (
  `quot_id` int(11) NOT NULL,
  `affiliate_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `quot_description` text NOT NULL,
  `qout_amount` text NOT NULL,
  `quot_cheque` text NOT NULL,
  `quot_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_database`
--

CREATE TABLE `users_database` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Middle_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `Contact_No` varchar(13) NOT NULL,
  `Birthday` date NOT NULL,
  `Account_Type` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_database`
--

INSERT INTO `users_database` (`User_ID`, `Username`, `Password`, `First_Name`, `Middle_Name`, `Last_Name`, `Contact_No`, `Birthday`, `Account_Type`, `Email`, `Address`) VALUES
(1, 'manager', 'manager', 'Ayel', 'Adoc', 'Sabado', '+639212047240', '1993-08-30', 'Manager', 'ayel0830@gmail.com', 'Blk. 49 Lt. 10 Robinsons Homes Antipolo City																				'),
(3, 'qc', 'qc', 'Ana Katrina', 'Flat', 'Ramos', '09550175288', '2019-10-17', 'Quality Controller', 'anakatrina@gmail.com', 'none				'),
(4, 'secretary', 'secretary', 'Daniel', 'Mata', 'Laynes', '09123456789', '2019-10-10', 'Secretary', 'laynes@gmail.com', 'none'),
(8, 'dispatcher', 'dispatcher', 'Bernard', 'Weeds', 'Dalisay', '09123456789', '2019-01-01', 'Dispatcher', 'dalisay@gmail.com', 'none												'),
(9, 'affiliate', 'affiliate', 'Katrina', '', 'Ramos', '0999 999 9999', '1998-05-12', 'Affiliate', 'affiliate@gmail.com', 'affiliate address Q.C'),
(10, 'd', 'd', ' ', ' ', ' ', 'd', '2020-05-19', 'Affiliate', 'd', 'd'),
(11, '', 'e', ' ', ' ', ' ', 'e', '2020-05-19', 'Affiliate', 'e', 'e'),
(12, '', 'f', ' ', ' ', ' ', 'f', '2020-05-19', 'Affiliate', 'f', 'f'),
(13, 'aaaa_bbbb', 'aaaa_bbbb', ' ', ' ', ' ', '09194842539', '2020-05-19', 'Affiliate', 'ab@gmail.com', 'testFil'),
(14, 'test_Af_af', 'test_Af_af', ' ', ' ', ' ', '0999999999', '2020-05-19', 'Affiliate', 'af@gmail.com', 'kjhasd a;kjhsh asdfgaq asf ');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_database`
--

CREATE TABLE `vehicle_database` (
  `Vehicle_ID` int(11) NOT NULL,
  `Vehicle_Brand` varchar(50) NOT NULL,
  `Vehicle_Model` varchar(50) NOT NULL,
  `Vehicle_Plate` varchar(10) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `PMS_Start` date NOT NULL,
  `PMS_End` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_database`
--

INSERT INTO `vehicle_database` (`Vehicle_ID`, `Vehicle_Brand`, `Vehicle_Model`, `Vehicle_Plate`, `Status`, `PMS_Start`, `PMS_End`) VALUES
(1, 'TOYOTA', 'KUNG ANO MAN', 'xml 2412', 'For Repair', '2020-05-10', '2020-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `vrrnotes_database`
--

CREATE TABLE `vrrnotes_database` (
  `Note_ID` int(11) NOT NULL,
  `VRR_ID` int(200) NOT NULL,
  `Note_Type` varchar(150) NOT NULL,
  `Notes` varchar(500) NOT NULL,
  `User_Note` varchar(200) NOT NULL,
  `Assigned_Affil` varchar(200) NOT NULL,
  `Change_User` varchar(200) NOT NULL,
  `Note_Date` date NOT NULL,
  `Note_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vrrnotes_database`
--

INSERT INTO `vrrnotes_database` (`Note_ID`, `VRR_ID`, `Note_Type`, `Notes`, `User_Note`, `Assigned_Affil`, `Change_User`, `Note_Date`, `Note_Time`) VALUES
(1, 1, 'Ticket Created', '', 'By: Dalisay, Bernard Weeds', '', '', '2020-05-19', '03:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `vrr_database`
--

CREATE TABLE `vrr_database` (
  `VRR_ID` int(11) NOT NULL,
  `VRR_Type` varchar(50) NOT NULL,
  `VRR_Date` date NOT NULL,
  `Plate_No` varchar(100) NOT NULL,
  `Car_Brand` varchar(150) NOT NULL,
  `Car_Type` varchar(150) NOT NULL,
  `ODO` varchar(100) NOT NULL,
  `VRR_Concern` varchar(500) NOT NULL,
  `User_Account` varchar(150) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Affiliates` varchar(150) NOT NULL,
  `Branch` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vrr_database`
--

INSERT INTO `vrr_database` (`VRR_ID`, `VRR_Type`, `VRR_Date`, `Plate_No`, `Car_Brand`, `Car_Type`, `ODO`, `VRR_Concern`, `User_Account`, `Status`, `Affiliates`, `Branch`) VALUES
(1, '', '2020-05-19', 'xml 2412', 'TOYOTA', 'KUNG ANO MAN', '1234', '', 'Quality Controller', 'Pending', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliates_database`
--
ALTER TABLE `affiliates_database`
  ADD PRIMARY KEY (`Affiliates_ID`);

--
-- Indexes for table `log_database`
--
ALTER TABLE `log_database`
  ADD PRIMARY KEY (`Log_ID`);

--
-- Indexes for table `quotation_database`
--
ALTER TABLE `quotation_database`
  ADD PRIMARY KEY (`quot_id`);

--
-- Indexes for table `users_database`
--
ALTER TABLE `users_database`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `vehicle_database`
--
ALTER TABLE `vehicle_database`
  ADD PRIMARY KEY (`Vehicle_ID`);

--
-- Indexes for table `vrrnotes_database`
--
ALTER TABLE `vrrnotes_database`
  ADD PRIMARY KEY (`Note_ID`);

--
-- Indexes for table `vrr_database`
--
ALTER TABLE `vrr_database`
  ADD PRIMARY KEY (`VRR_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliates_database`
--
ALTER TABLE `affiliates_database`
  MODIFY `Affiliates_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `log_database`
--
ALTER TABLE `log_database`
  MODIFY `Log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `quotation_database`
--
ALTER TABLE `quotation_database`
  MODIFY `quot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_database`
--
ALTER TABLE `users_database`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vehicle_database`
--
ALTER TABLE `vehicle_database`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vrrnotes_database`
--
ALTER TABLE `vrrnotes_database`
  MODIFY `Note_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vrr_database`
--
ALTER TABLE `vrr_database`
  MODIFY `VRR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
