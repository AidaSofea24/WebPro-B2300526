-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 10:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bit102db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_registration`
--

CREATE TABLE `users_registration` (
  `ID` int(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_registration`
--

INSERT INTO `users_registration` (`ID`, `first_name`, `last_name`, `student_id`, `email`, `password`, `created_at`, `role`) VALUES
(23, 'Bernyleo', 'Jupiri', 'B1234567', 'bernyleog@gmail.com', '$2y$10$4AkmmZ8..mqChuRj4cZn7eVzEIjFMqeeLY7.1TFOpI8AnNzytwiYu', '2024-07-13 07:50:37.898751', ''),
(24, 'Bernyleo', 'Jupiri', 'B1234568', 'bernyleog@gmail.com', '$2y$10$AMKtoByq5EMWwtPDN4kiIOgKgBKiB1.x8mhbgFvYpg4//toVieHGS', '2024-07-13 07:51:08.155447', ''),
(26, 'Bernyleo', 'Jupiri', 'B2200966', 'bernyleog@gmail.com', '$2y$10$llOie7S5X7cTeKVppc0BGOphvI9BIxaSqCGefLoilv6OxZBQ1FnPu', '2024-07-13 08:10:55.447033', 'user'),
(27, 'HELP', 'Admin', 'ADMIN123', 'admin@gmail.com', '@dmin123', '0000-00-00 00:00:00.000000', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_registration`
--
ALTER TABLE `users_registration`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_registration`
--
ALTER TABLE `users_registration`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
