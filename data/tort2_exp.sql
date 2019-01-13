-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2019 at 07:44 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assessment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tort2_exp`
--

CREATE TABLE `tort2_exp` (
  `exp_id` int(11) NOT NULL,
  `aca_id` tinyint(2) NOT NULL,
  `tort2_subtit` smallint(6) NOT NULL,
  `exp_score` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tort2_exp`
--

INSERT INTO `tort2_exp` (`exp_id`, `aca_id`, `tort2_subtit`, `exp_score`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 3),
(3, 1, 3, 3),
(4, 1, 4, 3),
(5, 1, 5, 3),
(6, 1, 6, 3),
(7, 1, 7, 3),
(8, 1, 8, 3),
(9, 1, 9, 3),
(10, 1, 10, 3),
(11, 1, 11, 0),
(12, 1, 12, 0),
(13, 1, 13, 0),
(14, 1, 14, 0),
(15, 1, 15, 0),
(16, 2, 1, 4),
(17, 2, 2, 4),
(18, 2, 3, 4),
(19, 2, 4, 4),
(20, 2, 5, 4),
(21, 2, 6, 4),
(22, 2, 7, 4),
(23, 2, 8, 4),
(24, 2, 9, 4),
(25, 2, 10, 4),
(26, 2, 11, 0),
(27, 2, 12, 0),
(28, 2, 13, 0),
(29, 2, 14, 0),
(30, 2, 15, 0),
(32, 3, 1, 4),
(33, 3, 2, 4),
(34, 3, 3, 4),
(35, 3, 4, 4),
(36, 3, 5, 4),
(37, 3, 6, 4),
(38, 3, 7, 4),
(39, 3, 8, 4),
(40, 3, 9, 4),
(41, 3, 10, 4),
(42, 3, 11, 0),
(43, 3, 12, 0),
(44, 3, 13, 0),
(45, 3, 14, 0),
(46, 3, 15, 0),
(47, 4, 1, 3),
(48, 4, 2, 3),
(49, 4, 3, 3),
(50, 4, 4, 3),
(51, 4, 5, 3),
(52, 4, 6, 3),
(53, 4, 7, 3),
(54, 4, 8, 3),
(55, 4, 9, 3),
(56, 4, 10, 3),
(57, 4, 11, 0),
(58, 4, 12, 0),
(59, 4, 13, 0),
(60, 4, 14, 0),
(61, 4, 15, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tort2_exp`
--
ALTER TABLE `tort2_exp`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `aca_id` (`aca_id`),
  ADD KEY `tort2_subtit` (`tort2_subtit`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tort2_exp`
--
ALTER TABLE `tort2_exp`
  ADD CONSTRAINT `tort2_exp_ibfk_1` FOREIGN KEY (`aca_id`) REFERENCES `academic` (`aca_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tort2_exp_ibfk_2` FOREIGN KEY (`tort2_subtit`) REFERENCES `tort2_subtit` (`tort2_sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
