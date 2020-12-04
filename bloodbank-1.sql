-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2020 at 02:37 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `AvailableBlood`
--

CREATE TABLE `AvailableBlood` (
  `avb_id` int(10) NOT NULL,
  `hos_id` int(10) NOT NULL,
  `avb_blood_type` varchar(3) NOT NULL,
  `added_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AvailableBlood`
--

INSERT INTO `AvailableBlood` (`avb_id`, `hos_id`, `avb_blood_type`, `added_on`) VALUES
(1, 1, 'A+', '2020-12-04 00:00:00'),
(2, 1, 'AB-', '2020-12-04 00:00:00'),
(3, 3, 'O+', '2020-12-04 00:00:00'),
(4, 3, 'A-', '2020-12-04 00:00:00'),
(5, 2, 'B+', '2020-12-04 00:00:00'),
(6, 2, 'AB+', '2020-12-04 00:00:00'),
(7, 2, 'O+', '2020-12-04 00:00:00'),
(8, 2, 'AB-', '2020-12-04 00:00:00'),
(9, 3, 'A+', '2020-12-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Hospitals`
--

CREATE TABLE `Hospitals` (
  `hos_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Hospitals`
--

INSERT INTO `Hospitals` (`hos_id`, `user_id`, `name`) VALUES
(1, 1, 'Lifeline Hospital'),
(2, 2, 'Columbia Asia Hospital'),
(3, 3, 'Amri Hospital'),
(4, 7, 'Test Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `Logins`
--

CREATE TABLE `Logins` (
  `user_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Logins`
--

INSERT INTO `Logins` (`user_id`, `email`, `password`, `user_type`) VALUES
(1, 'contact@lifeline.com', '$2y$10$jfvb43maFwIrvpBVmgtMn.PAjYDHeXYliTG8XqBosoPi2JHwkbNAq', 'H'),
(2, 'staff@columbiaasia.com', '$2y$10$B3PBf89hYZC3ASMX7c/jWeG/WrYaVFIDSs.2iq6VPBu1W7QtHMyVm', 'H'),
(3, 'bloodbank@amrihospital.com', '$2y$10$HZhFYElQrPxwP1ZTGn2t2OeEV/Z5evC9IEyHCTFkrGKF6SrICbQP.', 'H'),
(4, 'saket_roy@testmail.com', '$2y$10$NnJM6thBsXnXj1eKVJoLG.CLb0VPq55R4kDz1gQ8v/FN33T3LFYbW', 'R'),
(5, 'ramsingh@company.com', '$2y$10$45rmKb2wrXr2XTszoUfQsOIEO2AA6HjDyJyyd/DPs1o9VSiFuUfxG', 'R'),
(6, 'testuser@receiver.com', '$2y$10$4h1bIMtWAa40ZXahbSIhNu3rA9XZNeHOLucc64ygibfEZQwIT3A7a', 'R'),
(7, 'testhos@hospital.com', '$2y$10$iOcBb08NL5cNWoa4k4oynOw/WfKlK6hi59Ra5kX.MRGnke0anYLoG', 'H');

-- --------------------------------------------------------

--
-- Table structure for table `Receivers`
--

CREATE TABLE `Receivers` (
  `rcvr_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `rcvr_blood_type` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Receivers`
--

INSERT INTO `Receivers` (`rcvr_id`, `user_id`, `first_name`, `last_name`, `rcvr_blood_type`) VALUES
(1, 4, 'Saket', 'Roy', 'B+'),
(2, 5, 'Ram', 'Singh', 'AB-'),
(3, 6, 'Test', 'User', 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `req_id` int(10) NOT NULL,
  `rcvr_id` int(10) NOT NULL,
  `hos_id` int(10) NOT NULL,
  `req_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Requests`
--

INSERT INTO `Requests` (`req_id`, `rcvr_id`, `hos_id`, `req_date`) VALUES
(1, 1, 2, '2020-12-04'),
(2, 2, 1, '2020-12-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AvailableBlood`
--
ALTER TABLE `AvailableBlood`
  ADD PRIMARY KEY (`avb_id`),
  ADD KEY `hos_id` (`hos_id`);

--
-- Indexes for table `Hospitals`
--
ALTER TABLE `Hospitals`
  ADD PRIMARY KEY (`hos_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Logins`
--
ALTER TABLE `Logins`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Receivers`
--
ALTER TABLE `Receivers`
  ADD PRIMARY KEY (`rcvr_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Requests`
--
ALTER TABLE `Requests`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `rcvr_id` (`rcvr_id`),
  ADD KEY `hos_id` (`hos_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AvailableBlood`
--
ALTER TABLE `AvailableBlood`
  MODIFY `avb_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `Hospitals`
--
ALTER TABLE `Hospitals`
  MODIFY `hos_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Logins`
--
ALTER TABLE `Logins`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Receivers`
--
ALTER TABLE `Receivers`
  MODIFY `rcvr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Requests`
--
ALTER TABLE `Requests`
  MODIFY `req_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `AvailableBlood`
--
ALTER TABLE `AvailableBlood`
  ADD CONSTRAINT `AvailableBlood_ibfk_1` FOREIGN KEY (`hos_id`) REFERENCES `Hospitals` (`hos_id`);

--
-- Constraints for table `Hospitals`
--
ALTER TABLE `Hospitals`
  ADD CONSTRAINT `Hospitals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Logins` (`user_id`);

--
-- Constraints for table `Receivers`
--
ALTER TABLE `Receivers`
  ADD CONSTRAINT `Receivers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Logins` (`user_id`);

--
-- Constraints for table `Requests`
--
ALTER TABLE `Requests`
  ADD CONSTRAINT `Requests_ibfk_1` FOREIGN KEY (`rcvr_id`) REFERENCES `Receivers` (`rcvr_id`),
  ADD CONSTRAINT `Requests_ibfk_2` FOREIGN KEY (`hos_id`) REFERENCES `Hospitals` (`hos_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
