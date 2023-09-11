-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 10:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mat`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `ref_no` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `ID_number` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `booked_seat` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `schedule_id`, `ref_no`, `first_name`, `last_name`, `ID_number`, `phone_number`, `email`, `age`, `location`, `booked_seat`, `status`, `date_updated`) VALUES
(80, 45, '202309114718', 'collinsrr', 'mutuma', '', '', 'collinsmutuma15@gmail.com', '', 'nairobi', 11, 0, NULL),
(81, 45, '20230911942', 'john', 'mutuma', '', '0708249439', 'collinsmutuma15@gmail.com', '', '', 12, 0, NULL),
(82, 45, '202309119533', 'collins', 'mutuma', '', '', 'collinsmutuma15@gmail.com', '', 'baringo', 31, 0, NULL),
(83, 45, '202309112626', 'tony', 'mutuma', '21313', '0708249439', 'collinsmutuma15@gmail.com', '21', 'nairobi', 3, 1, NULL),
(84, 46, '202309113843', 'juma', 'boss', '37262722', '0708249439', 'jumaboss@gmail.com', '21', 'mombasa', 25, 0, NULL),
(85, 45, '202309114176', 'peter', 'mutuma', '387332621', '0708249439', 'collinsmutuma15@gmail.com', '21', 'baringo', 28, 1, NULL),
(87, 45, '202309119749', 'collins', 'mutuma', '382728334', '0708249439', 'collinsmutuma15@gmail.com', '22', 'nairobi', 37, 1, NULL),
(88, 46, '202309119912', 'ryan', 'mutuma', '38292343', '0708249439', 'collinsmutuma15@gmail.com', '21', 'nairobi', 17, 1, NULL),
(89, 47, '202309117718', 'collins', 'frank', '84775383', '0708249439', 'collinsmutuma15@gmail.com', '32', 'nairobi', 30, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_number` varchar(255) DEFAULT NULL,
  `conductor_name` varchar(255) DEFAULT NULL,
  `conductor_number` varchar(255) DEFAULT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `bus_number` varchar(50) NOT NULL,
  `bus_seats` int(11) NOT NULL,
  `bus_seats_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `driver_id`, `driver_name`, `driver_number`, `conductor_name`, `conductor_number`, `registration_number`, `bus_number`, `bus_seats`, `bus_seats_id`, `status`, `date_updated`) VALUES
(1, 'super metro', 5, 'Moses Kithinji', '07356274672', 'francis njenga', '0745274627', 'KBR 342J', '1436', 37, NULL, 1, '2023-07-25 12:05:23'),
(2, 'SuperMetro', 6, 'jimmy graves', '0736726383', 'john champion', '07453678567', 'KBG 454W', '2963', 37, NULL, 1, '2023-07-25 13:40:43'),
(3, 'SuperMetro', 7, 'hezus nandi', '0735647824', 'daniel martey', '0733274743', 'KBB 534D', '1755', 37, NULL, 1, '2023-07-25 13:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `city`, `status`, `date_updated`) VALUES
(1, 'mombasa', 1, '2023-07-25 12:12:48'),
(2, 'nairobi', 1, '2023-07-25 12:12:48'),
(3, 'Baringo', 1, '2023-07-25 13:38:15'),
(4, 'Bomet', 1, '2023-07-25 13:38:15'),
(5, 'Bungoma', 1, '2023-07-25 13:38:15'),
(6, 'Busia', 0, '2023-07-25 13:38:15'),
(7, 'Elgeyo-Marakwet', 1, '2023-07-25 13:38:15'),
(8, 'Embu', 1, '2023-07-25 13:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `from_location` int(11) DEFAULT NULL,
  `to_location` int(11) DEFAULT NULL,
  `departure_time` datetime NOT NULL,
  `eta` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `seat_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `bus_id`, `from_location`, `to_location`, `departure_time`, `eta`, `status`, `seat_info`, `price`, `date_updated`) VALUES
(45, 1, 2, 3, '2023-09-12 16:00:00', '2023-09-13 01:00:00', 1, '', 2000.00, NULL),
(46, 2, 1, 5, '2023-09-12 18:00:00', '2023-09-12 22:00:00', 1, '', 1500.00, NULL),
(47, 3, 4, 3, '2023-09-12 19:00:00', '2023-09-12 23:00:00', 1, '', 1000.00, NULL),
(48, 2, 5, 1, '2023-09-14 18:00:00', '2023-09-14 23:00:00', 1, '', 1500.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `booked_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `booked_id`, `bus_id`, `schedule_id`, `payment_amount`, `payment_date`) VALUES
(16, 83, 1, 45, 2000.00, '2023-09-11 16:47:04'),
(17, 83, 1, 45, 2000.00, '2023-09-11 16:49:20'),
(18, 85, 1, 45, 2000.00, '2023-09-11 17:49:39'),
(19, 87, 1, 45, 2000.00, '2023-09-11 18:36:45'),
(20, 88, 2, 46, 1500.00, '2023-09-11 22:35:37'),
(21, 89, 3, 47, 1000.00, '2023-09-11 22:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `username`, `password`, `status`, `date_updated`) VALUES
(1, 'admin', 'Admin', 'admin', '$2y$10$zceUMUap6ATKxhW27Y.CgOZTkQS2WsoNbGcF4gWsVP2hbuVaZCh4C', 1, NULL),
(2, 'brian', '', 'beia', 'admin123', 0, NULL),
(3, 'brian', '', 'adminbr', 'admin123', 1, NULL),
(4, 'john', '', 'john', '$2y$10$tZWJ0fGhWeSsMB93CqM.hOxJ9.Q/w.kbmrnnlzYZOhefXF03Gts3e', 1, NULL),
(5, 'moses', 'Driver', 'moses-driver', '$2y$10$Act9UuNK1la7Vty5Ila77uG0vwc.Fc/YZvrtWJUYTvnjrlR8HrlCm', 1, NULL),
(6, 'jimmy', 'Driver', 'jimmy-driver', '$2y$10$pXx1adIjseNSfpEKzWus/.cUmGcz8U4BlLObuLpYD3I/ICJfnviVG', 1, '2023-08-21 21:07:54'),
(7, 'hezus', 'Driver', 'hezus-driver', '$2y$10$RU4X6wKIny9FyfqZDomXAeZto.fq1kYo8nxKrWtHlv5g4Ynt5onJq', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `bus_seats_id` (`bus_seats_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `from_location` (`from_location`),
  ADD KEY `to_location` (`to_location`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booked_id` (`booked_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule_list` (`id`);

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bus_ibfk_2` FOREIGN KEY (`bus_seats_id`) REFERENCES `bus_seats` (`id`);

--
-- Constraints for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD CONSTRAINT `schedule_list_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`),
  ADD CONSTRAINT `schedule_list_ibfk_2` FOREIGN KEY (`from_location`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `schedule_list_ibfk_3` FOREIGN KEY (`to_location`) REFERENCES `location` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`booked_id`) REFERENCES `booked` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`schedule_id`) REFERENCES `schedule_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
