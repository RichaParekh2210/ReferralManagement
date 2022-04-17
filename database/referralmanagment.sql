-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2022 at 06:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `referralmanagment`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int(11) NOT NULL,
  `income` decimal(13,2) NOT NULL,
  `credit_debit` decimal(13,2) NOT NULL,
  `code` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `income`, `credit_debit`, `code`) VALUES
(1, '500.00', '500.00', 'c'),
(1, '550.00', '50.00', 'c'),
(2, '450.00', '450.00', 'c'),
(1, '600.00', '50.00', 'c'),
(2, '500.00', '50.00', 'c'),
(3, '450.00', '450.00', 'c'),
(1, '625.00', '25.00', 'c'),
(2, '550.00', '50.00', 'c'),
(4, '450.00', '450.00', 'c'),
(1, '630.00', '5.00', 'c'),
(2, '600.00', '50.00', 'c'),
(5, '450.00', '450.00', 'c'),
(6, '500.00', '500.00', 'c'),
(2, '650.00', '50.00', 'c'),
(7, '450.00', '450.00', 'c'),
(1, '430.00', '200.00', 'd'),
(8, '500.00', '500.00', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `referral_tbl`
--

CREATE TABLE `referral_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `referral_user_id` int(11) NOT NULL,
  `referral_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referral_tbl`
--

INSERT INTO `referral_tbl` (`id`, `user_id`, `referral_user_id`, `referral_code`) VALUES
(1, 2, 1, 'Ref125434189'),
(2, 3, 2, 'Ref1104917667'),
(3, 4, 2, 'Ref1104917667'),
(4, 5, 2, 'Ref1104917667'),
(5, 7, 2, 'Ref1104917667');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_referral_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `user_referral_code`) VALUES
(1, 'user 1', 'user 1', 'user1@gmail.com', '123', 'Ref125434189'),
(2, 'user 2', 'user 2', 'user2@gmail.com', '123', 'Ref1104917667'),
(3, 'user 3', 'user 3', 'user3@gmail.com', '123', 'Ref1369492291'),
(4, 'user 4', 'user 4', 'user4@gmail.com', '123', 'Ref1427423619'),
(5, 'user 5', 'user 5', 'user5@gmail.com', '123', 'Ref997101923'),
(6, 'user 6', 'user 6', 'user6@gmail.com', '123', 'Ref1902578074'),
(7, 'user 7', 'user 7', 'user7@gmail.com', '123', 'Ref1913356130'),
(8, 'admin', 'admin', 'admin@gmail.com', '123', 'Ref438767769');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `referral_tbl`
--
ALTER TABLE `referral_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `referral_tbl`
--
ALTER TABLE `referral_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

