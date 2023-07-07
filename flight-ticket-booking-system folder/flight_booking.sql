-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 11:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `flight_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `flight_number`, `date`, `time`) VALUES
(1, 'john123', 'FL001', '2023-07-05', '10:00:00'),
(2, 'john123', 'FL002', '2023-07-06', '14:30:00'),
(3, 'mary456', 'FL003', '2023-07-07', '09:45:00'),
(4, 'mary456', 'FL004', '2023-07-08', '16:15:00'),
(5, 'sam789', 'FL005', '2023-07-09', '11:30:00'),
(6, 'sam789', 'FL006', '2023-07-10', '18:00:00'),
(7, 'alice321', 'FL007', '2023-07-11', '13:00:00'),
(8, 'alice321', 'FL008', '2023-07-12', '19:45:00'),
(9, 'bob654', 'FL009', '2023-07-13', '08:15:00'),
(10, 'bob654', 'FL010', '2023-07-14', '15:30:00'),
(11, 'abc', 'ABC123', '2023-07-10', '00:00:10'),
(12, 'abc', 'ABC123', '2023-07-10', '00:00:10'),
(13, 'abc', 'DEF456', '2023-07-11', '00:00:15'),
(14, 'abc', 'DEF456', '2023-07-11', '00:00:15'),
(15, 'abc', 'ABC123', '2023-07-10', '00:00:10'),
(16, 'abc', 'ABC123', '2023-07-10', '00:00:10'),
(17, 'user1', 'ABC123', '2023-07-10', '00:00:10'),
(18, 'user1', 'DEF456', '2023-07-11', '15:30:00'),
(19, 'user1', 'DEF456', '2023-07-11', '15:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `seats_available` int(11) NOT NULL,
  `flight_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `date`, `time`, `seats_available`, `flight_name`) VALUES
(1, 'ABC123', '2023-07-10', '10:00:00', 67, 'Flight 1'),
(2, 'DEF456', '2023-07-11', '15:30:00', 80, 'Flight 2'),
(3, 'GHI789', '2023-07-12', '18:45:00', 119, 'Flight 3'),
(4, 'JKL012', '2023-07-13', '09:15:00', 90, 'Flight 4'),
(5, 'MNO345', '2023-07-14', '12:30:00', 110, 'Flight 5'),
(6, 'PQR678', '2023-07-15', '14:45:00', 70, 'Flight 6'),
(7, 'STU901', '2023-07-16', '17:00:00', 150, 'Flight 7'),
(8, 'VWX234', '2023-07-17', '20:30:00', 60, 'Flight 8'),
(9, 'YZA567', '2023-07-18', '11:45:00', 80, 'Flight 9'),
(12, 'GFRT45', '2023-07-31', '02:00:00', 200, 'Flight 12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type`) VALUES
(123, 'user1', '', 'user', 'user'),
(125, 'abc', 'abc2@gmail.com', '123', 'user'),
(126, 'thiru', 'thiru@gmail.com', 'thiru123', 'user'),
(127, 'admin', 'admin@gmail.com', 'admin', 'admin'),
(145, 'user2', '12345@gmail.com', 'user2', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
