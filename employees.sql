-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 23, 2021 at 03:49 PM
-- Server version: 5.7.28
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_code`, `employee_name`, `department`, `age`, `experience`, `dob`, `doj`) VALUES
(1, 'EMP001', 'Arun', 'Developer', 25, 2, '1995-11-12', '2019-06-10'),
(2, 'EMP002', 'Bryan', 'Testing', 23, 2, '1997-12-01', '2021-06-15'),
(3, 'EMP003', 'Kevin', 'Development', 26, 4, '1995-01-12', '2015-05-23'),
(4, 'EMP004', 'agnes', 'HR', 23, 2, '1997-06-07', '2019-06-09'),
(5, 'EMP005', 'Bently', 'developer', 22, 1, '1998-06-10', '2020-07-08'),
(6, 'EMP006', 'Deepak', 'HR', 28, 5, '1992-07-02', '2016-06-23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
