-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2016 at 03:54 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `waaranet_waara`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`waaranet`@`localhost` PROCEDURE `get_calendar_duties`()
    NO SQL
BEGIN
SELECT assign_id As id, user.first_name, user.last_name , duty.name As duty_name, jk.name As jk_name, `start_date`,`end_date` FROM  assign_duty, user, duty, jk WHERE  user.user_id = assign_duty.user_id AND duty.duty_id = assign_duty.duty_id AND jk.id = assign_duty.jk_id;

END$$

CREATE DEFINER=`waaranet`@`localhost` PROCEDURE `get_request`()
    NO SQL
BEGIN
SELECT 
user.first_name As first_name, user.last_name As last_name, request.user_id, request.title, request.request, request.id
from request , user
WHERE user.user_id = request.user_id;

END$$

CREATE DEFINER=`waaranet`@`localhost` PROCEDURE `get_user_waara_calendar`(IN `user_id` INT(10))
    NO SQL
BEGIN
SELECT assign_id As id, user.first_name, user.last_name , duty.name As duty_name, jk.name As jk_name, `start_date`,`end_date` FROM  assign_duty, user, duty, jk WHERE  user_id = assign_duty.user_id AND duty.duty_id = assign_duty.duty_id AND jk.id = assign_duty.jk_id
And  user_id = user.user_id;

END$$

CREATE DEFINER=`waaranet`@`localhost` PROCEDURE `get_waara`(IN `id` INT(10))
    NO SQL
BEGIN
SELECT 
user.first_name, user.last_name, duty.name As duty_name, jk.name As jk_name, start_date,duty.description As duty_description, assign_duty.shift
from assign_duty, user, duty, jk where
user.user_id = assign_duty.user_id And
duty.duty_id = assign_duty.duty_id And 
jk.id = assign_duty.jk_id And
assign_id = id;
END$$

CREATE DEFINER=`waaranet`@`localhost` PROCEDURE `get_waara_info`(IN `date` TEXT)
    NO SQL
BEGIN
SELECT 
user.first_name, user.last_name, user.email, duty.name As duty_name, jk.name As jk_name, start_date,duty.description As duty_description, assign_duty.shift
from assign_duty, user, duty, jk where
user.user_id = assign_duty.user_id And
duty.duty_id = assign_duty.duty_id And 
jk.id = assign_duty.jk_id And
assign_duty.start_date = date;
END$$

CREATE DEFINER=`waaranet`@`localhost` PROCEDURE `Hello`()
    NO SQL
BEGIN
SELECT user.first_name, user.last_name , duty.name As duty_name, jk.name As jk_name, `start_date`,`end_date` FROM  assign_duty, user, duty, jk WHERE  user.user_id = assign_duty.user_id AND duty.duty_id = assign_duty.duty_id AND jk.id = assign_duty.jk_id;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assign_duty`
--

CREATE TABLE IF NOT EXISTS `assign_duty` (
  `assign_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `duty_id` int(11) NOT NULL,
  `jk_id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `shift` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_duty`
--

INSERT INTO `assign_duty` (`assign_id`, `user_id`, `duty_id`, `jk_id`, `start_date`, `end_date`, `shift`, `reason`) VALUES
(38, 11, 26, 14, '2016-05-09', '2016-05-09', '1', ''),
(39, 0, 35, 16, '2016-05-09', '2016-05-09', '1', ''),
(40, 0, 35, 16, '2016-05-09', '2016-05-09', '1', ''),
(41, 13, 35, 16, '2016-05-12', '2016-05-12', '1', ''),
(42, 11, 34, 16, '2016-05-15', '2016-05-15', '1', ''),
(43, 13, 35, 16, '2016-05-02', '2016-05-02', '1', ''),
(44, 11, 34, 16, '2016-05-07', '2016-05-07', '', ''),
(45, 0, 34, 16, '2016-05-19', '2016-05-19', '1', ''),
(46, 0, 34, 16, '2016-05-16', '2016-05-16', '1', ''),
(47, 12, 34, 16, '2016-05-16', '2016-05-16', '1', ''),
(48, 12, 34, 16, '2016-05-18', '2016-05-18', '1', ''),
(49, 14, 30, 16, '2016-05-16', '2016-05-16', '1', ''),
(50, 0, 30, 16, '2016-05-17', '2016-05-17', '1', ''),
(51, 14, 35, 16, '2016-05-16', '2016-05-16', '1', ''),
(52, 24, 30, 16, '2016-05-18', '2016-05-18', '1', ''),
(53, 25, 35, 16, '2016-05-18', '2016-05-18', '1', ''),
(54, 27, 35, 16, '2016-05-18', '2016-05-18', '1', ''),
(55, 0, 38, 16, '2016-05-18', '2016-05-18', '1', ''),
(56, 28, 32, 16, '2016-05-18', '2016-05-18', '1', ''),
(57, 30, 35, 16, '2016-05-25', '2016-05-25', '1', ''),
(58, 24, 34, 16, '2016-05-22', '2016-05-22', '1', ''),
(59, 30, 30, 16, '2016-05-22', '2016-05-22', '1', 'sick'),
(60, 0, 35, 16, '2016-05-22', '2016-05-22', '1', ''),
(61, 24, 31, 16, '2016-05-22', '2016-05-22', '1', ''),
(62, 28, 35, 16, '2016-05-22', '2016-05-22', '1', ''),
(63, 24, 34, 16, '2016-05-24', '2016-05-24', '1', 'sick'),
(64, 11, 34, 16, '2016-05-30', '2016-05-30', '1', ''),
(65, 30, 34, 16, '2016-06-10', '2016-06-10', '1', 'sick'),
(66, 30, 34, 16, '2016-07-15', '2016-07-15', '', ''),
(70, 31, 34, 16, '2016-07-26', '2016-07-26', '1', ''),
(71, 36, 35, 16, '2016-07-26', '2016-07-26', '1', ''),
(72, 31, 34, 16, '2016-09-29', '2016-09-29', '1', ''),
(73, 31, 38, 16, '2016-09-29', '2016-09-29', '1', 'TESTING ');

-- --------------------------------------------------------

--
-- Table structure for table `customfields`
--

CREATE TABLE IF NOT EXISTS `customfields` (
  `customField_id` int(50) NOT NULL,
  `input_type` text NOT NULL,
  `field_name` text NOT NULL,
  `field_lable` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duty`
--

CREATE TABLE IF NOT EXISTS `duty` (
  `duty_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(50000) NOT NULL,
  `priority` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duty`
--

INSERT INTO `duty` (`duty_id`, `name`, `description`, `priority`) VALUES
(26, 'Dua', 'Edit', 13),
(27, 'tasbih', '  \r\n                                        C\r\nc0ming Soon                                                     ', 2),
(30, 'Ginan', '  \r\n                                        ', 8),
(31, 'Firman', '  \r\n                                        ', 11),
(32, '2nd Dua', '  \r\n                                        ', 12),
(33, 'Announcement', '  \r\n                                        ', 14),
(34, 'Ginan', '  \r\n                                        ', 5),
(35, 'Dua', '  2 edit\r\n\r\n                                          \r\n                                                                                ', 9),
(36, 'Nandi - Gents', 'Nandi - Gents\r\n                                        ', 16),
(37, 'Nandi - Ladies', 'Nandi - Ladies  \r\n                                        ', 17),
(38, 'GINAN', '  GINAN\r\n                                        ', 10),
(39, 'Special Announcement', 'Special Announcement\r\n                                        ', 15);

-- --------------------------------------------------------

--
-- Table structure for table `duty_jk`
--

CREATE TABLE IF NOT EXISTS `duty_jk` (
  `id` int(11) NOT NULL,
  `duty_id` int(11) NOT NULL,
  `jk_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duty_jk`
--

INSERT INTO `duty_jk` (`id`, `duty_id`, `jk_id`) VALUES
(30, 26, 14),
(31, 27, 14),
(32, 28, 14),
(33, 29, 14),
(34, 30, 16),
(35, 31, 16),
(36, 32, 16),
(37, 33, 16),
(38, 34, 16),
(39, 35, 16),
(40, 36, 16),
(41, 37, 16),
(42, 38, 16);

-- --------------------------------------------------------

--
-- Table structure for table `jk`
--

CREATE TABLE IF NOT EXISTS `jk` (
  `id` int(5) NOT NULL,
  `name` text NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jk`
--

INSERT INTO `jk` (`id`, `name`, `location`) VALUES
(16, 'Franklin', 'NE Calgary'),
(17, 'South', 'South Calgary'),
(18, 'HQ', 'NE Calgary'),
(19, 'WestWinds', 'NE Calgary'),
(20, 'NorthWest', 'NW Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL,
  `title` text NOT NULL,
  `details` text NOT NULL,
  `created_date` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `details`, `created_date`) VALUES
(24, 'VOLUNTEERS', '<p>Volunteer for Partnership Walk</p>\r\n<p>Please contact Rahim at 519.555.555</p>', '09-05-2016'),
(25, 'Kids day', '<p>Please sign up for Duty with JK Captains</p>', '09-05-2016');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` text NOT NULL,
  `request` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `user_id`, `title`, `request`) VALUES
(0, 24, 'Next Friday', 'I would like to say Dua next Friday');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(50) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `token` text NOT NULL,
  `status` text NOT NULL,
  `verified` text NOT NULL,
  `type` text NOT NULL,
  `jk_id` int(11) NOT NULL,
  `shift` int(10) NOT NULL,
  `pref_duty` text NOT NULL,
  `pref_jk` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `token`, `status`, `verified`, `type`, `jk_id`, `shift`, `pref_duty`, `pref_jk`) VALUES
(11, 'Asim', 'Bilal', 'asimbilal@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '12344', 'XiR0t7dcWUMJOLO', 'true', 'true', 'Super Admin', 0, 0, '', ''),
(12, 'Moiz', 'Kassam', 'moiz@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'IfIQArp07J4w9ld', 'true', 'true', 'Super Admin', 16, 1, '', ''),
(13, 'TEST', 'User', 'test@mail.com', 'd93591bdf7860e1e4ee2fca799911215', '123456789', '', 'true', 'true', 'Super Admin', 0, 1, '', ''),
(15, 'Nadir', 'Kassam', 'nadir@testmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '4038885555', 'JI0JEdaaUqocJF9', 'true', 'false', 'User', 0, 0, '', ''),
(24, 'Shaheen', 'Jamal', 'nshivji@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 'DkfVyUZjBXVL87e', 'true', 'true', 'User', 0, 0, '', ''),
(26, 'Admin', 'Admin', 'naheed@shaw.ca', '81dc9bdb52d04dc20036dbd8313ed055', '4035555555', 'yguFZm4uD1mp8Ju', 'true', 'true', 'Super Admin', 16, 1, '', ''),
(27, 'Shaffin', 'Jamal', 'shaffin@testemail.com', '81dc9bdb52d04dc20036dbd8313ed055', '4038888888', 'AYhAiK8E8eBHgYo', 'true', 'false', 'Super Admin', 16, 1, '', ''),
(28, 'Salim', 'Jaffer', 'salim@test.com', '81dc9bdb52d04dc20036dbd8313ed055', '4035555555', 'oxMNrftmr7qYRVJ', 'true', 'false', 'User', 0, 0, '', ''),
(29, 'Asim', 'Bilal', 'asimbila2l@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '3333908980', 'csJx9Gkl8zTP7Gt', 'true', 'false', 'User', 0, 0, '', ''),
(30, 'Ayaan', 'Shivji', 'ayaan@testemail.com', '912e79cd13c64069d91da65d62fbb78c', '4038888888', 'Ms9xCJwNKh6aW3h', 'true', 'true', 'User', 0, 0, '', ''),
(31, 'Karim', 'Punja', 'kpunja@testingemail.com', '81dc9bdb52d04dc20036dbd8313ed055', '4038883333', 'KvIsuB3u7gqi0g5', 'true', 'true', 'User', 0, 0, '', ''),
(32, 'Narissa', 'Jessa', 'njessa@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '4039185321', 'o3Fmy5JosqshZJp', 'true', 'true', 'JK Admin', 16, 1, '', ''),
(33, 'Ytest', 'Ytest', 'y@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456789', 'Wl3hIjW9KzRLQKN', 'true', 'true', 'User', 0, 0, '31', '16'),
(34, 'Test', 'captcha', 'captcha@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', '33333333333', 'YBHLnGoKzRmUbm8', 'true', 'true', 'User', 0, 0, '30', '16'),
(35, 'Saleem', 'Budhwani', 'saleem@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '4035558888', 'KuVXwPErXHvTYcy', 'true', 'true', 'User', 0, 0, '30', '16'),
(36, 'Salim', 'Shivji', 'salimshivji@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', '4038099999', '2V2xLNSPti2oilh', 'true', 'true', 'User', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_custom_data`
--

CREATE TABLE IF NOT EXISTS `user_custom_data` (
  `user_custom_data_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customField_id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_custom_data`
--

INSERT INTO `user_custom_data` (`user_custom_data_id`, `user_id`, `customField_id`, `key`, `value`) VALUES
(15, 29, 1, 'Test', '2'),
(16, 30, 1, 'Test', 'Only after khane'),
(17, 31, 1, 'Test', 'Prefer Evening Waara'),
(18, 31, 2, 'Jamat_Khana', 'South'),
(19, 32, 1, 'Test', 'South'),
(20, 32, 2, 'Jamat_Khana', 'South'),
(21, 33, 1, 'Test', '12'),
(22, 33, 2, 'Jamat_Khana', '1222'),
(23, 34, 1, 'Test', '3'),
(24, 34, 2, 'Jamat_Khana', '3'),
(25, 35, 1, 'Test', 'test'),
(26, 35, 2, 'Jamat_Khana', 'Franklin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_duty`
--
ALTER TABLE `assign_duty`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `customfields`
--
ALTER TABLE `customfields`
  ADD PRIMARY KEY (`customField_id`);

--
-- Indexes for table `duty`
--
ALTER TABLE `duty`
  ADD PRIMARY KEY (`duty_id`);

--
-- Indexes for table `duty_jk`
--
ALTER TABLE `duty_jk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jk`
--
ALTER TABLE `jk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_custom_data`
--
ALTER TABLE `user_custom_data`
  ADD PRIMARY KEY (`user_custom_data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_duty`
--
ALTER TABLE `assign_duty`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `customfields`
--
ALTER TABLE `customfields`
  MODIFY `customField_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `duty`
--
ALTER TABLE `duty`
  MODIFY `duty_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `duty_jk`
--
ALTER TABLE `duty_jk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `jk`
--
ALTER TABLE `jk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user_custom_data`
--
ALTER TABLE `user_custom_data`
  MODIFY `user_custom_data_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
