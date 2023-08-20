-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 07:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matatu`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `ref_no` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seats` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `schedule_id`, `ref_no`, `name`, `seats`, `status`, `date_updated`) VALUES
(1, 1, '202307256406', 'nrea', 3, 1, NULL),
(2, 2, '20230725875', 'faser', 5, 0, NULL),
(3, 1, '202307252358', 'cda', 5, 0, NULL),
(4, 2, '202307252647', 'csghaj', 9, 0, NULL),
(5, 1, '202307255972', 'frenc', 4, 0, NULL),
(6, 1, '202307253157', 'ind', 2, 0, NULL),
(7, 1, '202307254122', 'dsd', 1, 0, NULL),
(8, 1, '202307256429', 'cdaq', 3, 0, NULL),
(9, 4, '202307253190', 'his', 2, 0, NULL),
(10, 15, '202307256893', 'brian', 6, 0, NULL),
(11, 19, '202307257285', 'fresa', 34, 0, NULL),
(12, 1, '20230725247', 'brian', 4, 0, NULL),
(13, 1, '202307253831', 'angela', 4, 0, NULL),
(14, 1, '202307257626', 'angela', 4, 0, NULL),
(15, 15, '202307258725', 'angela', 4, 0, NULL),
(16, 15, '202307252223', 'brian', 4, 0, NULL),
(17, 15, '202307256069', 'cables', 2, 0, NULL),
(18, 15, '202307252375', 'nicco movers', 4, 0, NULL),
(19, 15, '202307255544', 'nicco movers', 14, 0, NULL),
(20, 27, '202307262090', 'angela', 4, 0, NULL),
(21, 1, '202307265853', 'angela', 5, 0, NULL),
(22, 2, '202307262897', 'angela', 20, 0, NULL),
(23, 4, '202307262216', 'brian', 16, 0, NULL),
(24, 14, '202307267908', 'angela', 34, 0, NULL),
(25, 27, '202307276145', ' Joan Muteti', 4, 0, NULL),
(26, 27, '202307277797', 'Sam Waweru', 6, 0, NULL),
(27, 27, '202307273851', 'yyyy', 3, 0, NULL),
(28, 25, '2023072837', 'angela', 2, 1, NULL),
(29, 17, '202307303830', 'cables', 10, 1, NULL),
(30, 26, '202307319139', 'cables', 22, 0, NULL),
(31, 26, '202307312942', 'angela', 2, 0, NULL),
(32, 26, '202307312412', 'MOSES MUTUNGA', 4, 0, NULL),
(33, 16, '202308022552', 'collins mutuma', 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bus_number` varchar(50) NOT NULL,
  `bus_seats` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `bus_number`, `bus_seats`, `status`, `date_updated`) VALUES
(1, 'super metro', '1436', 34, 1, '2023-07-25 12:05:23'),
(2, 'SuperMetro', '2963', 34, 1, '2023-07-25 13:40:43'),
(3, 'SuperMetro', '1755', 34, 1, '2023-07-25 13:40:43'),
(4, 'SuperMetro', '7886', 34, 1, '2023-07-25 13:40:43'),
(5, 'SuperMetro', '6164', 34, 1, '2023-07-25 13:40:43'),
(6, 'SuperMetro', '6164', 34, 1, '2023-07-25 13:40:43'),
(7, 'SuperMetro', '2328', 34, 1, '2023-07-25 13:40:43'),
(8, 'SuperMetro', '1148', 34, 1, '2023-07-25 13:40:43'),
(9, 'SuperMetro', '6756', 34, 1, '2023-07-25 13:40:43'),
(10, 'SuperMetro', '2338', 34, 1, '2023-07-25 13:40:43'),
(11, 'SuperMetro', '8424', 34, 1, '2023-07-25 13:40:43'),
(12, 'SuperMetro', '7105', 34, 1, '2023-07-25 13:40:43'),
(13, 'SuperMetro', '9253', 34, 1, '2023-07-25 13:40:43'),
(14, 'SuperMetro', '5953', 34, 1, '2023-07-25 13:40:43'),
(15, 'SuperMetro', '1003', 34, 1, '2023-07-25 13:40:43'),
(16, 'SuperMetro', '4160', 34, 1, '2023-07-25 13:40:43'),
(17, 'SuperMetro', '7788', 34, 1, '2023-07-25 13:40:43'),
(18, 'SuperMetro', '7463', 34, 1, '2023-07-25 13:40:43'),
(19, 'SuperMetro', '3953', 34, 1, '2023-07-25 13:40:43'),
(20, 'SuperMetro', '5373', 34, 1, '2023-07-25 13:40:43'),
(21, 'SuperMetro', '5009', 34, 1, '2023-07-25 13:40:43'),
(22, 'brian', '78', 89, 1, NULL),
(23, 'City Shuttle', '1009', 65, 0, NULL),
(24, 'Super Metro', '4321', 34, 0, NULL),
(25, 'angela', '321221321', 321, 0, NULL),
(26, 'brian', '654321', 321, 1, NULL),
(27, 'cables', '232', 23, 1, NULL);

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
(8, 'Embu', 1, '2023-07-25 13:38:15'),
(9, 'Garissa', 1, '2023-07-25 13:38:15'),
(10, 'Homa Bay', 1, '2023-07-25 13:38:15'),
(11, 'Isiolo', 1, '2023-07-25 13:38:15'),
(12, 'Kajiado', 1, '2023-07-25 13:38:15'),
(13, 'Kakamega', 1, '2023-07-25 13:38:15'),
(14, 'Kericho', 1, '2023-07-25 13:38:15'),
(15, 'Kiambu', 1, '2023-07-25 13:38:15'),
(16, 'Kilifi', 1, '2023-07-25 13:38:15'),
(17, 'Kirinyaga', 1, '2023-07-25 13:38:15'),
(18, 'Kisii', 1, '2023-07-25 13:38:15'),
(19, 'Kisumu', 1, '2023-07-25 13:38:15'),
(20, 'Kitui', 1, '2023-07-25 13:38:15'),
(21, 'Kwale', 1, '2023-07-25 13:38:15'),
(22, 'Laikipia', 1, '2023-07-25 13:38:15'),
(23, 'Lamu', 1, '2023-07-25 13:38:15'),
(24, 'Machakos', 1, '2023-07-25 13:38:15'),
(25, 'Makueni', 1, '2023-07-25 13:38:15'),
(26, 'Mandera', 1, '2023-07-25 13:38:15'),
(27, 'Marsabit', 1, '2023-07-25 13:38:15'),
(28, 'Meru', 1, '2023-07-25 13:38:15'),
(29, 'Migori', 1, '2023-07-25 13:38:15'),
(30, 'Muranga', 1, '2023-07-25 13:38:15'),
(31, 'Nakuru', 1, '2023-07-25 13:38:15'),
(32, 'Nandi', 1, '2023-07-25 13:38:15'),
(33, 'Narok', 1, '2023-07-25 13:38:15'),
(34, 'Nyamira', 1, '2023-07-25 13:38:15'),
(35, 'Nyandarua', 1, '2023-07-25 13:38:15'),
(36, 'Nyeri', 1, '2023-07-25 13:38:15'),
(37, 'Samburu', 1, '2023-07-25 13:38:15'),
(38, 'Siaya', 1, '2023-07-25 13:38:15'),
(39, 'Taita-Taveta', 1, '2023-07-25 13:38:15'),
(40, 'Tana River', 1, '2023-07-25 13:38:15'),
(41, 'Tharaka-Nithi', 1, '2023-07-25 13:38:15'),
(42, 'Trans Nzoia', 1, '2023-07-25 13:38:15'),
(43, 'Turkana', 1, '2023-07-25 13:38:15'),
(44, 'Uasin Gishu', 1, '2023-07-25 13:38:15'),
(45, 'Vihiga', 1, '2023-07-25 13:38:15'),
(46, 'Wajir', 1, '2023-07-25 13:38:15'),
(47, 'West Pokot', 1, '2023-07-25 13:38:15'),
(48, 'sax', 1, '2023-07-31 09:55:39'),
(49, 'saxy', 1, '2023-07-31 10:01:31'),
(50, 'busia', 0, '2023-07-31 10:07:02'),
(51, 'busia', 1, '2023-07-31 10:31:48');

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
  `space_left` int(11) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `bus_id`, `from_location`, `to_location`, `departure_time`, `eta`, `status`, `price`, `space_left`, `date_updated`) VALUES
(1, 1, 1, 2, '2023-07-27 12:14:00', '2023-07-27 16:00:00', 0, '1278.00', 2, NULL),
(2, 1, 2, 1, '2023-07-28 14:00:00', '2023-07-28 19:00:00', 1, '1278.00', 9, NULL),
(3, 12, 17, 20, '2023-08-06 13:51:00', '2023-08-06 17:51:00', 1, '1519.00', 34, NULL),
(4, 18, 13, 4, '2023-07-27 13:51:31', '2023-07-25 18:51:31', 1, '1435.00', 0, NULL),
(5, 1, 20, 23, '2023-07-27 13:51:31', '2023-07-25 17:51:31', 1, '1753.00', 30, NULL),
(6, 20, 12, 11, '2023-08-03 13:51:00', '2023-08-03 17:51:00', 1, '1285.00', 34, NULL),
(7, 13, 3, 21, '2023-08-03 13:51:00', '2023-08-03 22:51:00', 1, '1546.00', 34, NULL),
(8, 1, 11, 25, '2023-08-03 13:51:00', '2023-08-03 19:51:00', 1, '1900.00', 34, NULL),
(9, 15, 18, 11, '2023-08-07 13:51:00', '2023-08-07 20:00:00', 1, '1754.00', 34, NULL),
(10, 5, 21, 12, '2023-08-05 13:51:00', '2023-08-05 20:51:00', 1, '1875.00', 34, NULL),
(11, 9, 10, 19, '2023-07-31 13:51:31', '2023-07-25 15:51:31', 1, '1122.00', 0, NULL),
(12, 7, 7, 8, '2023-08-04 13:51:00', '2023-08-04 21:51:00', 1, '1044.00', 34, NULL),
(13, 14, 2, 8, '2023-07-30 13:51:31', '2023-07-25 16:51:31', 1, '1738.00', 34, NULL),
(14, 2, 5, 16, '2023-08-01 13:51:31', '2023-07-25 20:51:31', 1, '1092.00', 22, NULL),
(15, 7, 6, 5, '2023-07-25 13:52:00', '2023-07-25 18:00:00', 1, '1860.00', 18, NULL),
(16, 18, 14, 7, '2023-08-02 13:51:00', '2023-08-02 17:51:00', 1, '1745.00', 34, NULL),
(17, 17, 16, 22, '2023-07-30 13:51:31', '2023-07-25 17:51:31', 1, '1605.00', 32, NULL),
(18, 21, 1, 5, '2023-08-06 13:51:00', '2023-08-06 21:51:00', 1, '1378.00', 34, NULL),
(19, 11, 9, 7, '2023-07-29 13:51:31', '2023-07-25 20:51:31', 1, '1728.00', 34, NULL),
(20, 10, 1, 20, '2023-08-06 13:51:00', '2023-08-06 18:00:00', 1, '1961.00', 34, NULL),
(21, 9, 4, 11, '2023-08-03 13:51:00', '2023-08-03 18:00:00', 1, '1022.00', 34, NULL),
(22, 10, 1, 18, '2023-08-05 13:51:00', '2023-08-05 16:51:00', 1, '1189.00', 34, NULL),
(23, 11, 24, 7, '2023-07-31 13:51:00', '2023-07-25 20:51:00', 0, '1739.00', 0, NULL),
(24, 17, 16, 20, '2023-08-07 13:51:00', '2023-08-07 21:00:00', 1, '1174.00', 34, NULL),
(25, 21, 12, 9, '2023-07-29 13:51:31', '2023-07-25 20:51:31', 1, '1156.00', 30, NULL),
(26, 19, 24, 2, '2023-08-01 13:51:31', '2023-07-25 19:51:31', 1, '1118.00', 16, NULL),
(27, 20, 6, 10, '2023-07-27 13:51:31', '2023-07-25 20:51:31', 1, '1942.00', 34, NULL),
(28, 5, 5, 6, '2023-07-31 15:00:00', '2023-08-01 14:00:00', 0, '6550.00', 0, NULL),
(29, 6, 1, 3, '2023-07-31 09:32:00', '2023-07-31 15:00:00', 0, '3450.00', 0, NULL),
(30, 2, 8, 2, '2023-07-31 15:00:00', '2023-07-31 16:00:00', 0, '1212.00', 0, NULL),
(31, 3, 1, 11, '2023-08-03 14:00:00', '2023-08-03 22:00:00', 0, '2400.00', 0, NULL),
(32, 5, 2, 11, '2023-08-02 09:00:00', '2023-08-02 12:00:00', 1, '1200.00', 0, NULL),
(33, 4, 2, 8, '2023-08-02 12:00:00', '2023-08-02 17:00:00', 1, '1200.00', 0, NULL),
(34, 7, 3, 4, '2023-08-02 10:00:00', '2023-08-02 12:00:00', 1, '1200.00', 34, NULL);

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
(1, 'admin', '1', 'admin', '$2y$10$zceUMUap6ATKxhW27Y.CgOZTkQS2WsoNbGcF4gWsVP2hbuVaZCh4C', 1, NULL),
(2, 'brian', '', 'beia', 'admin123', 0, NULL),
(3, 'brian', '', 'adminbr', 'admin123', 1, NULL),
(4, 'john', '', 'john', '$2y$10$tZWJ0fGhWeSsMB93CqM.hOxJ9.Q/w.kbmrnnlzYZOhefXF03Gts3e', 1, NULL);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule_list` (`id`);

--
-- Constraints for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD CONSTRAINT `schedule_list_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`id`),
  ADD CONSTRAINT `schedule_list_ibfk_2` FOREIGN KEY (`from_location`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `schedule_list_ibfk_3` FOREIGN KEY (`to_location`) REFERENCES `location` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
