-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 09:30 PM
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
-- Database: `schools_out`
--

-- --------------------------------------------------------

--
-- Table structure for table `camp_info`
--

CREATE TABLE `camp_info` (
  `camp_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zipcode` varchar(12) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `ages_served` varchar(100) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `hours_duration` tinyint(4) DEFAULT NULL,
  `after_care` tinyint(1) DEFAULT NULL,
  `after_care_time_end` time DEFAULT NULL,
  `price_after_care` decimal(10,2) DEFAULT NULL,
  `food_provided` tinyint(1) DEFAULT NULL,
  `special_needs_accom` tinyint(1) DEFAULT NULL,
  `scholarship_opps` tinyint(1) DEFAULT NULL,
  `description` text NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `camp_start_date` date DEFAULT NULL,
  `camp_end_date` date DEFAULT NULL,
  `camp_fill_date` date DEFAULT NULL,
  `camp_days_of_week` char(7) DEFAULT NULL,
  `camp_visible` tinyint(1) NOT NULL DEFAULT 1,
  `website_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `camp_info`
--

INSERT INTO `camp_info` (`camp_id`, `account_id`, `name`, `street_address`, `city`, `state`, `zipcode`, `activity`, `price`, `ages_served`, `start_time`, `end_time`, `hours_duration`, `after_care`, `after_care_time_end`, `price_after_care`, `food_provided`, `special_needs_accom`, `scholarship_opps`, `description`, `upload_time`, `camp_start_date`, `camp_end_date`, `camp_fill_date`, `camp_days_of_week`, `camp_visible`, `website_link`) VALUES
(4, 1, 'test camp 1', '123 test street', 'test city', 'NJ', '11111', 'camping', 45.45, '8,9,10,11,12', '08:00:00', '15:00:00', NULL, 1, '16:00:00', 10.00, 1, 0, 0, 'test text\r\n\r\nexample website link \"www.google.com\"', '2023-08-01 23:28:26', '2023-03-01', '2023-08-01', '2023-01-19', 'SMTWRFU', 1, 'www.testwebsite.com'),
(5, 2, 'Rover Warriors, Martial Arts', '4617 SE Milwaukie Ave', 'Portland', 'OR', '00000', 'Martial Arts', 435.00, '1,2-3,4-5,6-12', '09:00:00', '14:45:00', NULL, 1, '17:30:00', NULL, 1, NULL, 1, 'Build focus and physical confidence through martial arts and movement. Play fun team games that teach self-defense and offer exciting challenges.', '2023-08-01 23:28:26', NULL, NULL, NULL, NULL, 1, NULL),
(6, 123, 'test2', 'test2', 'test2', 'NJ', '07424', 'test2', 423.00, '5', '09:00:00', '10:00:00', NULL, 0, NULL, 23.00, 0, 0, 0, 'test2test2test2test2test2', '2023-08-01 23:28:26', NULL, NULL, NULL, NULL, 1, NULL),
(7, 14321, 'test3', 'test3', 'test3', 'NY', '143214', 'test3', 0.00, '', '00:00:00', '00:00:00', NULL, 0, NULL, 0.00, 0, 0, 0, '', '2023-08-01 23:28:26', NULL, NULL, NULL, NULL, 1, NULL),
(8, 564, 'special needs accom camp', '4232', 'test city', 'NJ', '22222', 'hiking', 700.00, '10', '11:11:51', '14:45:00', NULL, 0, NULL, NULL, 0, 1, 0, 'special needs accom camp test', '2023-08-02 20:13:31', '2023-08-07', '2023-08-23', '2023-08-01', 'SU', 1, NULL),
(9, 1, '1', '1', '1', '1', '1', '1', 1.00, '', '00:00:00', '00:00:00', NULL, 0, NULL, 0.00, 0, 0, 0, 'camp new upload', '2023-08-03 22:27:19', '2023-08-03', '2023-08-24', '2023-08-01', 'SMWR', 1, NULL),
(10, 0, 'test4', 'test4', 'test4', 'HW', '12345', 'test4', 0.00, '', '00:00:00', '00:00:00', NULL, 0, NULL, 0.00, 0, 0, 0, '', '2023-08-04 21:46:28', '2023-08-01', '2023-08-05', '2023-07-31', 'SMFU', 1, 'www.test4.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `camp_info`
--
ALTER TABLE `camp_info`
  ADD PRIMARY KEY (`camp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camp_info`
--
ALTER TABLE `camp_info`
  MODIFY `camp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
