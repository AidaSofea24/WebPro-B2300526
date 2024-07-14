-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 04:12 PM
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
-- Database: `assignment2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `student_id` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `student_id`, `gender`, `qualification`, `date`, `time`, `status`) VALUES
(1, '1414', 'female', 'professional', '2024-07-06', '09:00:00', 'yes'),
(2, '1212', 'female', 'professional', '2024-07-05', '09:00:00', ''),
(3, '221', 'female', 'professional', '2024-07-05', '10:00:00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `booking_assignments`
--

CREATE TABLE `booking_assignments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mh_survey`
--

CREATE TABLE `mh_survey` (
  `survey_id` int(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `sad` int(11) NOT NULL,
  `anxious` int(11) NOT NULL,
  `hopeless` int(11) NOT NULL,
  `enjoying` int(11) NOT NULL,
  `irritable` int(11) NOT NULL,
  `sleep` int(11) NOT NULL,
  `tired` int(11) NOT NULL,
  `concentrating` int(11) NOT NULL,
  `symptoms` int(11) NOT NULL,
  `appetite` int(11) NOT NULL,
  `withdrawn` int(11) NOT NULL,
  `conflicts` int(11) NOT NULL,
  `substances` int(11) NOT NULL,
  `overwhelmed` int(11) NOT NULL,
  `confident` int(11) NOT NULL,
  `additional` text NOT NULL,
  `treatment` varchar(20) NOT NULL,
  `treatment_details` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mh_survey`
--

INSERT INTO `mh_survey` (`survey_id`, `student_id`, `age`, `gender`, `email`, `phone`, `sad`, `anxious`, `hopeless`, `enjoying`, `irritable`, `sleep`, `tired`, `concentrating`, `symptoms`, `appetite`, `withdrawn`, `conflicts`, `substances`, `overwhelmed`, `confident`, `additional`, `treatment`, `treatment_details`, `rating`, `submission_time`) VALUES
(3, '223', 23, 'Male', 'barney23@gmail.com', '0126124443', 1, 1, 1, 1, 1, 3, 3, 3, 5, 5, 1, 1, 1, 1, 1, 'no', 'No', '', 1, '2024-07-13 08:20:32'),
(4, '78122', 22, 'Female', 'ali55@gmail.com', '0142223121', 5, 5, 5, 5, 5, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, '-', 'No', '', 5, '2024-07-14 10:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `therapists`
--

CREATE TABLE `therapists` (
  `id` int(11) NOT NULL,
  `therapist_name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_assignments`
--
ALTER TABLE `booking_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `therapist_id` (`therapist_id`);

--
-- Indexes for table `mh_survey`
--
ALTER TABLE `mh_survey`
  ADD PRIMARY KEY (`survey_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `therapists`
--
ALTER TABLE `therapists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_assignments`
--
ALTER TABLE `booking_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mh_survey`
--
ALTER TABLE `mh_survey`
  MODIFY `survey_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `therapists`
--
ALTER TABLE `therapists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_assignments`
--
ALTER TABLE `booking_assignments`
  ADD CONSTRAINT `booking_assignments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `booking_assignments_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `booking_assignments_ibfk_3` FOREIGN KEY (`therapist_id`) REFERENCES `therapists` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
