-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2023 at 09:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_adverts`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clicks`
--

CREATE TABLE `tbl_clicks` (
  `job_title` varchar(50) NOT NULL COMMENT 'Job ad reference ',
  `Clicks` int(10) NOT NULL COMMENT 'the number of clicks an ad has received'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='data on ads';

--
-- Dumping data for table `tbl_clicks`
--

INSERT INTO `tbl_clicks` (`job_title`, `Clicks`) VALUES
('CloudTESTED', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_ad_relation`
--

CREATE TABLE `tbl_company_ad_relation` (
  `Company_name` varchar(32) NOT NULL COMMENT 'company the add belongs to',
  `job_title` varchar(50) NOT NULL COMMENT 'job title on the ad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Contains the relations between ads and company';

--
-- Dumping data for table `tbl_company_ad_relation`
--

INSERT INTO `tbl_company_ad_relation` (`Company_name`, `job_title`) VALUES
('parallel', 'CloudTESTED');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daily_clicks`
--

CREATE TABLE `tbl_daily_clicks` (
  `job_title` varchar(50) NOT NULL COMMENT 'Job tile for referance',
  `daily_clicks` int(10) NOT NULL COMMENT 'Clicks that happened on the day',
  `date` date NOT NULL COMMENT 'date the clicks happened on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Contains daily clicks on the ads ';

--
-- Dumping data for table `tbl_daily_clicks`
--

INSERT INTO `tbl_daily_clicks` (`job_title`, `daily_clicks`, `date`) VALUES
('CloudTESTED', 15, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_regions`
--

CREATE TABLE `tbl_regions` (
  `Region_id` int(10) NOT NULL COMMENT 'id to region very basic just a number',
  `Region_name` varchar(32) NOT NULL COMMENT 'Name of the region'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Region list to make filtering safer';

--
-- Dumping data for table `tbl_regions`
--

INSERT INTO `tbl_regions` (`Region_id`, `Region_name`) VALUES
(1, 'Gauteng'),
(2, 'Western Cape'),
(3, 'Eastern Cape'),
(4, 'Northern Cape'),
(5, 'KwaZulu Natal'),
(6, 'Free State'),
(7, 'North West'),
(8, 'Mpumalanga'),
(9, 'Limpopo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `username` varchar(32) NOT NULL COMMENT 'Holds Username for id',
  `companyName` varchar(50) NOT NULL COMMENT 'Holds company name of the user',
  `password` varchar(32) NOT NULL COMMENT 'Holds the password for the user to access the program'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Holds User information';

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`username`, `companyName`, `password`) VALUES
('parallel', 'parallel', 'parallel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_regions`
--
ALTER TABLE `tbl_regions`
  ADD PRIMARY KEY (`Region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_regions`
--
ALTER TABLE `tbl_regions`
  MODIFY `Region_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id to region very basic just a number', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
