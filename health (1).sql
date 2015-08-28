-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2015 at 05:12 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `health`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `clinictypeofclinic`
--

CREATE TABLE IF NOT EXISTS `clinictypeofclinic` (
  `id` int(11) NOT NULL,
  `clinic` int(11) NOT NULL,
  `typeofclinic` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinictypeofclinic`
--

INSERT INTO `clinictypeofclinic` (`id`, `clinic`, `typeofclinic`) VALUES
(4, 3, 1),
(5, 3, 3),
(9, 1, 1),
(10, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctortypeofdoctor`
--

CREATE TABLE IF NOT EXISTS `doctortypeofdoctor` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `typeofdoctor` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctortypeofdoctor`
--

INSERT INTO `doctortypeofdoctor` (`id`, `doctor`, `typeofdoctor`) VALUES
(5, 2, 1),
(6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_clinic`
--

CREATE TABLE IF NOT EXISTS `health_clinic` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `street` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_clinic`
--

INSERT INTO `health_clinic` (`id`, `name`, `description`, `street`, `landmark`, `locality`, `area`, `city`, `pincode`, `state`, `country`, `lat`, `long`, `image`) VALUES
(1, 'Mydentist - Vile Parle East', 'Mydentist is the fastest growing organized chain of 102 dental clinics spread across Mumbai, Pune, Surat and Ahmedabad.', 'Shop No 7', 'Minal Apartment', 'Shradhanand Road', 'Vile Parle East', 'Mumbai', '400002', 'maharashtra', 'india', '19.768786876', '73.765776576', '');

-- --------------------------------------------------------

--
-- Table structure for table `health_clinicimage`
--

CREATE TABLE IF NOT EXISTS `health_clinicimage` (
  `id` int(11) NOT NULL,
  `clinic` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_clinicimage`
--

INSERT INTO `health_clinicimage` (`id`, `clinic`, `image`, `order`) VALUES
(1, 1, 'download_-_Copy_(2).jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `health_clinicservice`
--

CREATE TABLE IF NOT EXISTS `health_clinicservice` (
  `id` int(11) NOT NULL,
  `clinic` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_clinicservice`
--

INSERT INTO `health_clinicservice` (`id`, `clinic`, `service`, `order`) VALUES
(2, 1, 'Root Canal Treatment', 33);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctor`
--

CREATE TABLE IF NOT EXISTS `health_doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `experiance` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctor`
--

INSERT INTO `health_doctor` (`id`, `name`, `experiance`, `description`, `image`, `status`) VALUES
(1, 'Dr. Nirav Chheda', '12 Years Experience', 'Dr. Nirav Chheda is an ENT/ Otolaryngologist, ENT/ Otolaryngologist and Rhinologist in Ghatkopar West, Mumbai and has an experience of 12 years in these fields.', 'coffee1.jpeg', 1),
(2, '@vinash', '1 Year', 'cascasc', 'images_(28).jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctoraward`
--

CREATE TABLE IF NOT EXISTS `health_doctoraward` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `award` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctoraward`
--

INSERT INTO `health_doctoraward` (`id`, `doctor`, `award`, `order`) VALUES
(1, 1, 'ENT Qualification -', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorclinic`
--

CREATE TABLE IF NOT EXISTS `health_doctorclinic` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `clinic` int(11) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctorclinic`
--

INSERT INTO `health_doctorclinic` (`id`, `doctor`, `clinic`, `price`) VALUES
(1, 1, 1, '200'),
(2, 1, 1, '200');

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorclinicweek`
--

CREATE TABLE IF NOT EXISTS `health_doctorclinicweek` (
  `id` int(11) NOT NULL,
  `doctorclinic` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `fromtime` int(11) NOT NULL,
  `totime` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctorclinicweek`
--

INSERT INTO `health_doctorclinicweek` (`id`, `doctorclinic`, `week`, `fromtime`, `totime`) VALUES
(6, 2, 1, 3, 11),
(7, 2, 2, 5, 11),
(8, 2, 3, 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorclinicweektiming`
--

CREATE TABLE IF NOT EXISTS `health_doctorclinicweektiming` (
  `id` int(11) NOT NULL,
  `doctorclinicweek` int(11) NOT NULL,
  `timing` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `health_doctoreducation`
--

CREATE TABLE IF NOT EXISTS `health_doctoreducation` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctoreducation`
--

INSERT INTO `health_doctoreducation` (`id`, `doctor`, `degree`, `university`, `year`, `order`) VALUES
(1, 1, 'MBBS', 'Mumbai Univarsity', '2005', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorexperiance`
--

CREATE TABLE IF NOT EXISTS `health_doctorexperiance` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `experiance` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctorexperiance`
--

INSERT INTO `health_doctorexperiance` (`id`, `doctor`, `experiance`, `order`) VALUES
(1, 1, 'Owner at Ascent advace surgical centre in ENT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctormembership`
--

CREATE TABLE IF NOT EXISTS `health_doctormembership` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `membership` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctormembership`
--

INSERT INTO `health_doctormembership` (`id`, `doctor`, `membership`, `order`) VALUES
(1, 1, 'Indian Association of Oral and Maxillofacial Pathologist', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorregistration`
--

CREATE TABLE IF NOT EXISTS `health_doctorregistration` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `registration` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctorregistration`
--

INSERT INTO `health_doctorregistration` (`id`, `doctor`, `registration`, `order`) VALUES
(1, 0, '2', 1),
(2, 1, '90076 Maharashtra Medical Council, 1999', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorservice`
--

CREATE TABLE IF NOT EXISTS `health_doctorservice` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctorservice`
--

INSERT INTO `health_doctorservice` (`id`, `doctor`, `service`, `order`) VALUES
(1, 1, 'Allergy Testing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `health_doctorspecialization`
--

CREATE TABLE IF NOT EXISTS `health_doctorspecialization` (
  `id` int(11) NOT NULL,
  `doctor` int(11) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_doctorspecialization`
--

INSERT INTO `health_doctorspecialization` (`id`, `doctor`, `specialization`, `order`) VALUES
(1, 1, 'ENT/ Otolaryngologist', 1),
(2, 1, 'Rhinologist', 2);

-- --------------------------------------------------------

--
-- Table structure for table `health_lab`
--

CREATE TABLE IF NOT EXISTS `health_lab` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_lab`
--

INSERT INTO `health_lab` (`id`, `name`, `image`, `street`, `landmark`, `locality`, `area`, `city`, `pincode`, `state`, `country`, `lat`, `long`) VALUES
(1, 'Demo lab', 'demo.png', 'street', 'landmark', 'locality', 'area', 'city', 'pincode', 'state', 'country', 'lat', 'long'),
(2, '2', 'Nature_at_its_Best!!!.png', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `health_labaccrediation`
--

CREATE TABLE IF NOT EXISTS `health_labaccrediation` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `accrediation` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_labaccrediation`
--

INSERT INTO `health_labaccrediation` (`id`, `lab`, `accrediation`, `order`) VALUES
(1, 2, 'asasc', 3);

-- --------------------------------------------------------

--
-- Table structure for table `health_labfacility`
--

CREATE TABLE IF NOT EXISTS `health_labfacility` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `facility` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_labfacility`
--

INSERT INTO `health_labfacility` (`id`, `lab`, `facility`, `order`) VALUES
(1, 2, 'demo111', 2);

-- --------------------------------------------------------

--
-- Table structure for table `health_labtest`
--

CREATE TABLE IF NOT EXISTS `health_labtest` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_labtest`
--

INSERT INTO `health_labtest` (`id`, `lab`, `name`, `price`, `order`) VALUES
(1, 0, 'Diabetes', 2000, 2),
(2, 2, 'asxas', 10000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `health_labweek`
--

CREATE TABLE IF NOT EXISTS `health_labweek` (
  `id` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `fromtime` int(11) NOT NULL,
  `totime` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_labweek`
--

INSERT INTO `health_labweek` (`id`, `lab`, `week`, `fromtime`, `totime`) VALUES
(4, 2, 1, 4, 6),
(5, 2, 2, 14, 17),
(6, 2, 3, 20, 12);

-- --------------------------------------------------------

--
-- Table structure for table `health_labweektiming`
--

CREATE TABLE IF NOT EXISTS `health_labweektiming` (
  `id` int(11) NOT NULL,
  `labweek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `health_timing`
--

CREATE TABLE IF NOT EXISTS `health_timing` (
  `id` int(11) NOT NULL,
  `time1` varchar(255) NOT NULL,
  `time2` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_timing`
--

INSERT INTO `health_timing` (`id`, `time1`, `time2`) VALUES
(1, '00:00', ''),
(2, '00:30', ''),
(3, '01:00', ''),
(4, '01:30', ''),
(5, '02:00', ''),
(6, '02:30', ''),
(7, '03:00', ''),
(8, '03:30', ''),
(9, '04:00', ''),
(10, '04:30', ''),
(11, '05:00', ''),
(12, '05:30', ''),
(13, '06:00', ''),
(14, '06:30', ''),
(15, '07:00', ''),
(16, '07:30', ''),
(17, '08:00', ''),
(18, '08:30', ''),
(19, '09:00', ''),
(20, '09:30', ''),
(21, '10:00', ''),
(22, '10:30', ''),
(23, '11:00', ''),
(24, '11:30', ''),
(25, '12:00', ''),
(26, '12:30', ''),
(27, '13:00', ''),
(28, '13:30', ''),
(29, '14:00', ''),
(30, '14:30', ''),
(31, '15:00', ''),
(32, '15:30', ''),
(33, '16:00', ''),
(34, '16:30', ''),
(35, '17:00', ''),
(36, '17:30', ''),
(37, '18:00', ''),
(38, '18:30', ''),
(39, '19:00', ''),
(40, '19:30', ''),
(41, '20:00', ''),
(42, '20:30', ''),
(43, '21:00', ''),
(44, '21:30', ''),
(45, '22:00', ''),
(46, '12:30', ''),
(47, '23:00', ''),
(48, '23:30', '');

-- --------------------------------------------------------

--
-- Table structure for table `health_typeofclinic`
--

CREATE TABLE IF NOT EXISTS `health_typeofclinic` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_typeofclinic`
--

INSERT INTO `health_typeofclinic` (`id`, `name`) VALUES
(1, 'Dental Clinic'),
(3, 'Dental Clinic 3');

-- --------------------------------------------------------

--
-- Table structure for table `health_typeofdoctor`
--

CREATE TABLE IF NOT EXISTS `health_typeofdoctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_typeofdoctor`
--

INSERT INTO `health_typeofdoctor` (`id`, `name`) VALUES
(1, 'ENT/ Otolaryngologist'),
(2, 'Rhinologist');

-- --------------------------------------------------------

--
-- Table structure for table `health_week`
--

CREATE TABLE IF NOT EXISTS `health_week` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_week`
--

INSERT INTO `health_week` (`id`, `name`) VALUES
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thurstday'),
(6, 'Friday'),
(7, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `linktype` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'Users', '', '', 'site/viewusers', 1, 0, 1, 1, 'icon-user'),
(4, 'Dashboard', '', '', 'site/index', 1, 0, 1, 0, 'icon-dashboard'),
(6, 'Doctors', '', '', 'site/viewdoctor', 1, 0, 1, 2, 'icon-user'),
(7, 'Types Of Doctor', '', '', 'site/viewtypeofdoctor', 1, 0, 1, 3, 'icon-user'),
(8, 'Clinic', '', '', 'site/viewclinic', 1, 0, 1, 4, 'icon-user'),
(9, 'Types Of Clinic', '', '', 'site/viewtypeofclinic', 1, 0, 1, 5, 'icon-user'),
(10, 'Lab', '', '', 'site/viewlab', 1, 0, 1, 6, 'icon-user'),
(11, 'Week', '', '', 'site/viewweek', 1, 0, 1, 7, 'icon-user');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 3),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'inactive'),
(2, 'Active'),
(3, 'Waiting'),
(4, 'Active Waiting'),
(5, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` int(11) NOT NULL,
  `json` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, NULL, '', '', 0, ''),
(4, 'pratik', '0cb2b62754dfd12b6ed0161d4b447df7', 'pratik@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, 'pratik', '1', 1, ''),
(5, 'wohlig123', 'wohlig123', 'wohlig1@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, ''),
(6, 'wohlig1', 'a63526467438df9566c508027d9cb06b', 'wohlig2@wohlig.com', 1, '2014-05-12 06:52:44', 1, NULL, '', '', 0, ''),
(7, 'Avinash', '7b0a80efe0d324e937bbfc7716fb15d3', 'avinash@wohlig.com', 1, '2014-10-17 06:22:29', 1, NULL, '', '', 0, ''),
(9, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@email.com', 2, '2014-12-03 11:06:19', 3, '', '', '123', 1, 'demojson'),
(13, 'aaa', 'a208e5837519309129fa466b0c68396b', 'aaa3@email.com', 3, '2014-12-04 06:55:42', 3, NULL, '', '1', 2, 'userjson'),
(14, 'Avinash Ghare', '4d58a7a64a610c882f16ab99c23c1054', 'avinash6767@gmail.com', 1, '2015-04-20 10:34:11', 2, 'Nature_at_its_Best!!!.png', '', '1', 1, ''),
(15, 'avinash', 'a208e5837519309129fa466b0c68396b', 'a@w.com', 1, '2015-04-23 06:47:34', 1, 'Nature_at_its_Best!!!.png', '', '1', 1, 'demojson');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `clinictypeofclinic`
--
ALTER TABLE `clinictypeofclinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctortypeofdoctor`
--
ALTER TABLE `doctortypeofdoctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_clinic`
--
ALTER TABLE `health_clinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_clinicimage`
--
ALTER TABLE `health_clinicimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_clinicservice`
--
ALTER TABLE `health_clinicservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctor`
--
ALTER TABLE `health_doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctoraward`
--
ALTER TABLE `health_doctoraward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorclinic`
--
ALTER TABLE `health_doctorclinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorclinicweek`
--
ALTER TABLE `health_doctorclinicweek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorclinicweektiming`
--
ALTER TABLE `health_doctorclinicweektiming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctoreducation`
--
ALTER TABLE `health_doctoreducation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorexperiance`
--
ALTER TABLE `health_doctorexperiance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctormembership`
--
ALTER TABLE `health_doctormembership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorregistration`
--
ALTER TABLE `health_doctorregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorservice`
--
ALTER TABLE `health_doctorservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_doctorspecialization`
--
ALTER TABLE `health_doctorspecialization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_lab`
--
ALTER TABLE `health_lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_labaccrediation`
--
ALTER TABLE `health_labaccrediation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_labfacility`
--
ALTER TABLE `health_labfacility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_labtest`
--
ALTER TABLE `health_labtest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_labweek`
--
ALTER TABLE `health_labweek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_labweektiming`
--
ALTER TABLE `health_labweektiming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_timing`
--
ALTER TABLE `health_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_typeofclinic`
--
ALTER TABLE `health_typeofclinic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_typeofdoctor`
--
ALTER TABLE `health_typeofdoctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `health_week`
--
ALTER TABLE `health_week`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clinictypeofclinic`
--
ALTER TABLE `clinictypeofclinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `doctortypeofdoctor`
--
ALTER TABLE `doctortypeofdoctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `health_clinic`
--
ALTER TABLE `health_clinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_clinicimage`
--
ALTER TABLE `health_clinicimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_clinicservice`
--
ALTER TABLE `health_clinicservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_doctor`
--
ALTER TABLE `health_doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_doctoraward`
--
ALTER TABLE `health_doctoraward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_doctorclinic`
--
ALTER TABLE `health_doctorclinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_doctorclinicweek`
--
ALTER TABLE `health_doctorclinicweek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `health_doctorclinicweektiming`
--
ALTER TABLE `health_doctorclinicweektiming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `health_doctoreducation`
--
ALTER TABLE `health_doctoreducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_doctorexperiance`
--
ALTER TABLE `health_doctorexperiance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_doctormembership`
--
ALTER TABLE `health_doctormembership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_doctorregistration`
--
ALTER TABLE `health_doctorregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_doctorservice`
--
ALTER TABLE `health_doctorservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_doctorspecialization`
--
ALTER TABLE `health_doctorspecialization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_lab`
--
ALTER TABLE `health_lab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_labaccrediation`
--
ALTER TABLE `health_labaccrediation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_labfacility`
--
ALTER TABLE `health_labfacility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `health_labtest`
--
ALTER TABLE `health_labtest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_labweek`
--
ALTER TABLE `health_labweek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `health_labweektiming`
--
ALTER TABLE `health_labweektiming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `health_timing`
--
ALTER TABLE `health_timing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `health_typeofclinic`
--
ALTER TABLE `health_typeofclinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `health_typeofdoctor`
--
ALTER TABLE `health_typeofdoctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `health_week`
--
ALTER TABLE `health_week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
