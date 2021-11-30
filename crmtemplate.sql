-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 09:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crmtemplate`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `AL_ID` int(11) NOT NULL,
  `AL_Userid` int(11) NOT NULL,
  `AL_Type` varchar(10) NOT NULL,
  `AL_Detail` varchar(500) NOT NULL,
  `AL_Current_DateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `AU_ID` int(11) NOT NULL,
  `AU_Username` varchar(100) NOT NULL,
  `AU_Password` varchar(100) NOT NULL,
  `AU_FullName` varchar(100) NOT NULL,
  `AU_Type` varchar(10) NOT NULL,
  `AU_Added_Id` int(11) NOT NULL,
  `AU_Status` tinyint(1) NOT NULL,
  `AU_Added_By` varchar(45) DEFAULT NULL,
  `AU_Added_Date` datetime DEFAULT NULL,
  `AU_Updated_By` int(11) DEFAULT NULL,
  `AU_Updated_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`AU_ID`, `AU_Username`, `AU_Password`, `AU_FullName`, `AU_Type`, `AU_Added_Id`, `AU_Status`, `AU_Added_By`, `AU_Added_Date`, `AU_Updated_By`, `AU_Updated_Date`) VALUES
(10, 'ADMIN', 'admin', 'Bhushan Salunkhe', 'admin', 1, 1, '1', '2021-11-29 11:01:37', NULL, '2021-11-29 11:01:37');

-- --------------------------------------------------------

--
-- Table structure for table `loghistory`
--

CREATE TABLE `loghistory` (
  `LH_ID` int(11) NOT NULL,
  `LH_User_ID` varchar(45) DEFAULT NULL,
  `LH_Type` varchar(45) DEFAULT NULL,
  `LH_Login_Datetime` varchar(45) DEFAULT NULL,
  `LH_Activity` varchar(255) DEFAULT NULL,
  `LH_Session_Time` varchar(255) DEFAULT NULL,
  `LH_Session_ID` varchar(100) DEFAULT NULL,
  `LH_Login_Date` datetime DEFAULT NULL,
  `LH_Login_Time` time DEFAULT NULL,
  `LH_Logout_Date` datetime NOT NULL,
  `LH_Logout_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`AL_ID`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`AU_ID`) USING BTREE;

--
-- Indexes for table `loghistory`
--
ALTER TABLE `loghistory`
  ADD PRIMARY KEY (`LH_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `AL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `AU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `loghistory`
--
ALTER TABLE `loghistory`
  MODIFY `LH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
