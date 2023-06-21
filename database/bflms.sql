-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 07:59 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bflms`
--

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `resident_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_id` int(11) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`resident_id`, `first_name`, `middle_name`, `last_name`, `street_id`, `contact`) VALUES
(1, 'Don McLin', 'Dela Cruz', 'Diaz', 1, '9317016827');

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `tracking_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `data` float NOT NULL,
  `sign_level` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sensor`
--

INSERT INTO `sensor` (`tracking_id`, `sensor_id`, `data`, `sign_level`, `date_time`) VALUES
(1, 1, 2, 2, '2023-04-28 06:22:50'),
(2, 1, 5.65, 3, '2023-04-28 10:41:37'),
(3, 1, 2, 2, '2023-04-28 10:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `street`
--

CREATE TABLE `street` (
  `street_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `location_x` int(11) NOT NULL,
  `location_y` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `street`
--

INSERT INTO `street` (`street_id`, `sensor_id`, `street_name`, `location_x`, `location_y`) VALUES
(1, 1, 'Main River', 35, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `user_type`) VALUES
(1, 'Admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin', 'Administrator'),
(2, 'donmclin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Don McLin Diaz', 'BRTO');

-- --------------------------------------------------------

--
-- Table structure for table `warning`
--

CREATE TABLE `warning` (
  `warning_id` int(11) NOT NULL,
  `sign_level` int(11) NOT NULL,
  `surge_name` varchar(255) NOT NULL,
  `info` longtext NOT NULL,
  `meter` int(11) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warning`
--

INSERT INTO `warning` (`warning_id`, `sign_level`, `surge_name`, `info`, `meter`, `color`) VALUES
(1, 1, 'No Alert', 'No Action Required', 0, '#adb5bd'),
(2, 2, 'Normal Warning', 'Normal flood level but must be monitored time to time.', 1, '#0d6efd'),
(3, 3, 'Yellow ALERT', 'Storm surge is POSSIBLE.\r\nStay away from the coast or beach. Preparation measures must be carried out.', 2, '#ffc107'),
(4, 4, 'Orange ALARM', 'Storm surge is EXPECTED.\r\n\r\nThe condition must life threatening. All marine activities must be cancelled. Follow evacuation guidelines from local authorities.', 3, '#fd7e14'),
(5, 5, 'Red TAKE ACTION ', 'Storm surge is CATASTROPHICS. \r\n\r\nThere is significant threat to life. Mandatory evacuation is enforced.', 4, '#dc3545');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`resident_id`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`tracking_id`);

--
-- Indexes for table `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`street_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warning`
--
ALTER TABLE `warning`
  ADD PRIMARY KEY (`warning_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `street`
--
ALTER TABLE `street`
  MODIFY `street_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warning`
--
ALTER TABLE `warning`
  MODIFY `warning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
