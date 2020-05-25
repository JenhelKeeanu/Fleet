-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 07:22 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `quotation_database`
--

CREATE TABLE `quotation_database` (
  `quot_id` int(11) NOT NULL,
  `affiliate_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `quot_description` text NOT NULL,
  `quot_amount` text NOT NULL,
  `quot_cheque` text NOT NULL,
  `quot_status` text NOT NULL,
  `quot_createDate` text NOT NULL,
  `quote_vrr` int(11) DEFAULT NULL,
  `quot_updateDate` text NOT NULL,
  `quot_notif` int(11) NOT NULL
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
(1, 'dispatcher', 'dispatcher', 'dispatcher', 'dispatcher', 'dispatcher', '', '2020-05-25', 'Dispatcher', 'dispatcher@gmail.com', 'dispatcher'),
(2, 'qc', 'qc', 'qc', 'qc', 'qc', '', '2020-05-25', 'Quality Controller', 'qc@gmail.com', 'qc'),
(3, 'secretary', 'secretary', 'secretary', 'secretary', 'secretary', '', '2020-05-25', 'Secretary', 'Secretary@gmail.com', 'Secretary'),
(4, 'manager', 'manager', 'manager', 'manager', 'manager', '', '2020-05-25', 'Manager', 'Manager@gmail.com', 'Manager'),
(5, 'billing', 'billing', 'billing', 'billing', 'billing', '', '2020-05-25', 'Billing', 'billing@gmail.com', 'billing');

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
  `Branch` varchar(150) NOT NULL,
  `notif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `Affiliates_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_database`
--
ALTER TABLE `log_database`
  MODIFY `Log_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_database`
--
ALTER TABLE `quotation_database`
  MODIFY `quot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_database`
--
ALTER TABLE `users_database`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_database`
--
ALTER TABLE `vehicle_database`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vrrnotes_database`
--
ALTER TABLE `vrrnotes_database`
  MODIFY `Note_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vrr_database`
--
ALTER TABLE `vrr_database`
  MODIFY `VRR_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
