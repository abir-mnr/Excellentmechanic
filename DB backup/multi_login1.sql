-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2019 at 02:34 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `carnumber` int(32) NOT NULL,
  `carengineno` int(32) NOT NULL,
  `appointmentdate` date NOT NULL,
  `mechanic` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `user_type`, `password`, `address`, `phone`, `carnumber`, `carengineno`, `appointmentdate`, `mechanic`) VALUES
(1, 'abir', 'admin', '9ab209d66a9bf2250d7f56cc4b3b125d', 'mohipur', 1782512587, 2254, 132465, '2019-03-13', 'mechanic1'),
(2, 'nibir', 'user', 'f7a8527f6ce952d6f7ad9f104de65315', 'dhaka', 1547923697, 3625, 321654, '2019-03-14', 'mechanic2'),
(4, 'chamak', 'admin', '8e6f09d78db003c669ef595a022c5f86', 'tongi', 1568478932, 3365, 789456, '2019-03-20', 'mechanic3'),
(5, 'dimdim', 'user', 'e6fa959b9e8f9c638e0d82bf2c7dc5e7', 'uttora', 1756325694, 2565, 78913, '2019-03-28', 'mechanic4'),
(6, 'siam', 'user', 'b3b644a7b06b255d18b9f615f775f8e1', 'mohipur', 1234567892, 1245, 123456, '2019-04-21', 'mechanic4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
