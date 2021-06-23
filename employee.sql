-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 23, 2021 at 01:29 PM
-- Server version: 8.0.18
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(300) NOT NULL,
  `employee_name` varchar(500) NOT NULL,
  `department` varchar(500) NOT NULL,
  `age` int(15) NOT NULL,
  `experience` int(20) NOT NULL,
  `dob` date NOT NULL,
  `doj` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_code`, `employee_name`, `department`, `age`, `experience`, `dob`, `doj`) VALUES
(1, 'EMP001', 'Arun', 'it', 25, 2, '2019-05-29', '2012-05-11'),
(2, 'EMP002', 'Ann', 'it', 23, 2, '2019-05-29', '2012-05-11'),
(3, 'EMP003', 'Midhun', 'software', 24, 2, '2019-05-29', '2012-05-11'),
(4, 'EMP004', 'Kiran', 'testing', 28, 5, '2019-05-29', '2012-05-11'),
(5, 'EMP005', 'Alex', 'analyst', 30, 9, '2019-05-29', '2012-05-11'),
(6, 'EMP006', 'Alan', 'developer', 24, 3, '2019-05-29', '2012-05-11'),
(7, 'EMP007', 'Milan', 'developer', 23, 2, '0000-00-00', '0000-00-00'),
(8, 'EMP008', 'Aleen', 'it', 30, 8, '0000-00-00', '0000-00-00'),
(9, 'EMP009', 'Kripa', 'software', 26, 4, '2021-05-30', '2021-06-09'),
(10, 'EMP010', 'Amal', 'development', 38, 15, '2021-05-30', '2021-06-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
