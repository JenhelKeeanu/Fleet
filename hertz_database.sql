-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 08:01 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
  `Branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `affiliates_database`
--

INSERT INTO `affiliates_database` (`Affiliates_ID`, `Affiliates_Name`, `Branch`) VALUES
(1, 'Toyota', 'shaw'),
(2, 'Toyota', 'Magallanes'),
(3, 'Suzuki', 'Magnolia'),
(4, 'Rapidae', 'Pasong Tamo'),
(5, 'honda', 'Mandaluyong'),
(6, 'Douche', 'Timog');

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
(48, 'Dalisay, Bernard Weeds', '2019-11-14', '03:29:30');

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
(1, 'ayel0830', 'sabado0830', 'Ayel', 'Adoc', 'Sabado', '+639212047240', '1993-08-30', 'Manager', 'ayel0830@gmail.com', 'Blk. 49 Lt. 10 Robinsons Homes Antipolo City																'),
(3, 'ana123', 'banana', 'Ana Katrina', 'Flat', 'Ramos', '09550175288', '2019-10-17', 'Quality Controller', 'anakatrina@gmail.com', 'none'),
(4, 'laynes123', 'labomata', 'Daniel', 'Mata', 'Laynes', '09123456789', '2019-10-10', 'Secretary', 'laynes@gmail.com', 'none'),
(8, 'bernard123', 'dalisay123', 'Bernard', 'Weeds', 'Dalisay', '09123456789', '2019-01-01', 'Dispatcher', 'dalisay@gmail.com', 'none								');

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
(1, 'Mitsubishi', 'Mirage', 'XLI 253', 'For Repair', '2019-10-31', '2019-11-08'),
(2, 'Toyota', 'Corolla', 'XEF 3239', 'For Rent', '2019-10-31', '0000-00-00'),
(3, 'ISUZU', 'Trooper', 'YFG 7140', 'For Rent', '2019-10-31', '0000-00-00'),
(4, 'HYUNDAI', 'Santa Fe', 'ZGH 0555', 'For Repair', '2019-10-31', '0000-00-00'),
(5, 'KIA', 'Sportage', 'AHI 3763', 'For Repair', '2019-10-31', '0000-00-00');

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
(27, 1, 'Change User', 'Ticket Forwarding Test', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '08:43:43'),
(28, 1, 'Change Account', 'ticket testing', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '08:52:23'),
(29, 1, 'Change Account', 'testing again', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '08:53:55'),
(30, 1, 'Update Affiliate', 'affil test', 'By: Sabado, Ayel Adoc', 'Toyota(shaw)', '', '2019-11-11', '08:57:02'),
(31, 1, 'Follow-Up', 'note testing', 'By: Sabado, Ayel Adoc', '', '', '2019-11-11', '08:57:58'),
(32, 1, 'Ticket Cancelled', 'void test', 'By: Sabado, Ayel Adoc', '', '', '2019-11-11', '09:00:30'),
(33, 1, 'Ticket Reopen', 'reopen test', 'By: Sabado, Ayel Adoc', '', '', '2019-11-11', '09:00:50'),
(34, 1, 'Repair Checking', 'repair test', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '09:02:03'),
(35, 1, 'Ticket Resolved', 'rent testing', 'By: Sabado, Ayel Adoc', '', '', '2019-11-11', '09:02:29'),
(36, 1, 'Repair Checking', 'checking', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '09:05:14'),
(37, 1, 'Repair Checking', 'checking', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '09:05:58'),
(38, 1, 'Repair Checking', 'nn', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '09:06:41'),
(39, 1, 'Repair Checking', 'test', 'By: Sabado, Ayel Adoc', '', 'Quality Controller', '2019-11-11', '09:08:30'),
(41, 1, 'Ticket Cancelled', 'test', 'By: Sabado, Ayel Adoc', '', '', '2019-11-13', '10:50:33'),
(43, 1, 'Follow-Up', 'need feedback', 'By: Dalisay, Bernard Weeds', '', '', '2019-11-14', '03:26:59'),
(44, 1, 'Follow-Up', 'follow up on this concern.', 'By: Dalisay, Bernard Weeds', '', '', '2019-11-14', '03:35:57'),
(45, 1, 'Reminder', 'no feedback for 10 days', 'By: Dalisay, Bernard Weeds', '', '', '2019-11-14', '03:41:16'),
(46, 1, 'Update', 'car for pullout', 'By: Dalisay, Bernard Weeds', '', '', '2019-11-14', '03:41:35');

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
(1, 'Minor', '2019-10-16', 'WDE 4327', 'Mitsubishi', 'Mirage', '130', 'Mirror damaged', 'Dispatcher', 'Ticket Reopened', 'Toyota', 'shaw'),
(5, '', '2019-11-14', 'XLI 253', 'KIA', 'Sportage', '150', '', '', 'Pending', '', '');

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
  MODIFY `Affiliates_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_database`
--
ALTER TABLE `log_database`
  MODIFY `Log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users_database`
--
ALTER TABLE `users_database`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_database`
--
ALTER TABLE `vehicle_database`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vrrnotes_database`
--
ALTER TABLE `vrrnotes_database`
  MODIFY `Note_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `vrr_database`
--
ALTER TABLE `vrr_database`
  MODIFY `VRR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
