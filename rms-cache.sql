-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2014 at 04:02 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rms-cache`
--

-- --------------------------------------------------------

--
-- Table structure for table `m2_times`
--

CREATE TABLE IF NOT EXISTS `m2_times` (
  `timestamp` datetime NOT NULL,
  `E1` tinyint(4) NOT NULL,
  `E2` tinyint(4) NOT NULL,
  `E3` tinyint(4) NOT NULL,
  `E4` tinyint(4) NOT NULL,
  `E5` tinyint(4) NOT NULL,
  `E6` tinyint(4) NOT NULL,
  `ETOTAL` tinyint(4) NOT NULL,
  `W1` tinyint(4) NOT NULL,
  `W2` tinyint(4) NOT NULL,
  `W3` tinyint(4) NOT NULL,
  `W4` tinyint(4) NOT NULL,
  `W5` tinyint(4) NOT NULL,
  `WTOTAL` tinyint(4) NOT NULL,
  PRIMARY KEY (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores travel times from http://livetraffic.rta.nsw.gov.au/';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
