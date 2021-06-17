-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 17, 2021 at 01:25 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autoarts`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

DROP TABLE IF EXISTS `applicants`;
CREATE TABLE IF NOT EXISTS `applicants` (
  `SNo` int(4) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `FileName` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ApplicantName` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ApplicantEmail` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `GithubID` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `SkillsLanguage` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `SkillsApplication` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `SkillsMisc` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `Experience` int(3) DEFAULT NULL,
  `Percentage10` float NOT NULL,
  `Percentage12` float NOT NULL,
  `CGPA` float NOT NULL,
  `Projects` int(3) DEFAULT NULL,
  `Score` float DEFAULT NULL,
  `Star` enum('1','0') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`SNo`),
  KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

DROP TABLE IF EXISTS `requirements`;
CREATE TABLE IF NOT EXISTS `requirements` (
  `Email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Duration` int(3) NOT NULL,
  `Languages` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `Applications` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `Miscellaneous` varchar(5000) COLLATE latin1_general_ci DEFAULT NULL,
  `Percentage10` int(3) NOT NULL,
  `Percentage12` int(3) NOT NULL,
  `CGPA` float NOT NULL,
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Password` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicants`
--
ALTER TABLE `applicants`
  ADD CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `requirements`
--
ALTER TABLE `requirements`
  ADD CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
