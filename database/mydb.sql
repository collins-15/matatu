-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 08:57 PM
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
  `seats` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `schedule_id`, `ref_no`, `first_name`, `last_name`, `ID_number`, `phone_number`, `email`, `age`, `location`, `seats`, `status`, `date_updated`) VALUES
(36, 35, '202308201437', 'juma', 'moi', '36826282', '0735262532', 'jumamoi@gmail.com', '20', 'meru', 3, 0, NULL),
(37, 35, '202308201282', 'collins', 'mutuma', '38735398', '0708249439', 'collinsmutuma15@gmail.com', '22', 'nairobi', 3, 1, NULL),
(38, 35, '202308217622', 'job', 'benha', '53722748', '0708249439', 'collinsmutuma15@gmail.com', '19', 'yoruba', 4, 1, NULL),
(39, 35, '20230821514', 'van', 'jeff', '387468294', '0708249439', 'collinsmutuma15@gmail.com', '22', 'nairobi', 4, 1, NULL),
(40, 35, '202308218953', 'collins', 'mutuma', '46729343', '0708249439', 'collinsmutuma15@gmail.com', '32', 'nairobi', 4, 0, NULL),
(41, 36, '202308232343', 'hosea', 'heys', '3752282443', '0708249439', 'collinsmutuma15@gmail.com', '24', 'baringo', 5, 1, NULL),
(42, 36, '202308231462', 'collinsss', 'ssmutuma', '38262723', '0708249439', 'collinsmutuma15@gmail.com', '18', 'baringo', 4, 1, NULL),
(43, 37, '202308231346', 'hassan', 'juma', '37265732', '073562723', 'hassanjuma@gmail.com', '23', 'mombasa', 7, 1, NULL),
(44, 37, '202308233685', 'raheem', 'heart', '38773398', '0708249439', 'raheemhear@gmail.com', '44', 'mombasa', 9, 1, NULL),
(45, 38, '202308238940', 'eden', 'bet', '387226272', '0732293839', 'edenbet@gmail.com', '43', 'mombasa', 12, 1, NULL),
(46, 41, '202308232794', 'maes', 'smele', '327278293', '073562722', 'maessmele@gmail.com', '35', 'mombasa', 13, 1, NULL),
(47, 39, '202308234033', 'ruto', 'wile', '38272634', '0735272834', 'rutowile@gmail.com', '43', 'mombasa', 21, 1, NULL),
(48, 39, '202308236909', 'david', 'raya', '3782732', '07363622', 'davidraya@gmail.com', '37', 'mombasa', 10, 1, NULL),
(49, 40, '202308237902', 'smityh', 'mart', '3827289', '07337722', 'smithymart@gmail.com', '42', 'mombasa', 13, 1, NULL);

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
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `driver_id`, `driver_name`, `driver_number`, `conductor_name`, `conductor_number`, `registration_number`, `bus_number`, `bus_seats`, `status`, `date_updated`) VALUES
(1, 'super metro', 5, 'Moses Kithinji', '07356274672', 'francis njenga', '0745274627', 'KBR 342J', '1436', 34, 1, '2023-07-25 12:05:23'),
(2, 'SuperMetro', 6, 'jimmy graves', '0736726383', 'john champion', '07453678567', 'KBG 454W', '2963', 34, 1, '2023-07-25 13:40:43'),
(3, 'SuperMetro', 7, 'hezus nandi', '0735647824', 'daniel martey', '0733274743', 'KBB 534D', '1755', 34, 1, '2023-07-25 13:40:43');

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
  `price` decimal(10,2) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `bus_id`, `from_location`, `to_location`, `departure_time`, `eta`, `status`, `price`, `date_updated`) VALUES
(35, 1, 2, 1, '2023-08-22 20:00:00', '2023-08-23 21:00:00', 1, 22.00, NULL),
(36, 1, 3, 1, '2023-08-24 15:00:00', '2023-08-25 04:00:00', 1, 2500.00, NULL),
(37, 2, 1, 2, '2023-08-23 22:00:00', '2023-08-24 15:00:00', 1, 800.00, NULL),
(38, 3, 2, 4, '2023-08-23 22:00:00', '2023-08-24 18:00:00', 1, 1000.00, NULL),
(39, 1, 2, 4, '2023-08-28 18:00:00', '2091-09-24 03:00:00', 1, 1000.00, NULL),
(40, 2, 3, 1, '2023-08-29 21:00:00', '2023-08-30 18:00:00', 1, 1000.00, NULL),
(41, 3, 5, 2, '2023-08-25 22:00:00', '2023-08-26 18:00:00', 1, 1900.00, NULL);

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
(1, 40, 1, 35, 22.00, '2023-08-22 09:28:03'),
(2, 38, 1, 35, 88.00, '2023-08-22 10:07:35'),
(3, 41, 1, 36, 12500.00, '2023-08-23 11:24:59'),
(4, 42, 1, 36, 10000.00, '2023-08-23 19:55:15'),
(5, 43, 2, 37, 5600.00, '2023-08-23 21:37:28'),
(6, 44, 2, 37, 7200.00, '2023-08-23 21:41:23'),
(7, 45, 3, 38, 12000.00, '2023-08-23 21:42:48'),
(8, 46, 3, 41, 24700.00, '2023-08-23 21:44:11'),
(9, 47, 1, 39, 21000.00, '2023-08-23 21:45:18'),
(10, 48, 1, 39, 10000.00, '2023-08-23 21:46:23'),
(11, 49, 2, 40, 13000.00, '2023-08-23 21:47:41');

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
  ADD KEY `driver_id` (`driver_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`);

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
