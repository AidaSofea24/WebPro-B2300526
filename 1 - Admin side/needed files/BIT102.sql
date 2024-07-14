-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 14, 2024 at 04:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BIT102`
--

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `firstName`, `lastName`, `topic`, `description`, `option1`, `option2`, `option3`, `created_at`) VALUES
(9, 'Jane', 'Smith', 'Preferred Study Method', 'How do you prefer to study for exams?', 'Group Study', 'Solo Study', 'Online Resources', '2024-07-13 17:58:40'),
(10, 'Alice', 'Johnson', 'Campus Event Interest', 'Which type of campus event interests you the most?', 'Sports Events', 'Cultural Festivals', 'Academic Seminars', '2024-07-13 17:58:40'),
(17, 'Friidric', 'Yeow', 'More book needed for our library', 'Lot of book is outdated and no one want to read it', 'YESSSS', 'IDK', 'NOOO....', '2024-07-14 19:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `suggestionBox`
--

CREATE TABLE `suggestionBox` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suggestionBox`
--

INSERT INTO `suggestionBox` (`id`, `name`, `email`, `message`) VALUES
(1, 'Sarah', 'sarah@example.com', 'The library should have more copies of popular textbooks and extend its hours during exam periods to better support students\' study needs.'),
(3, 'Friidric', 'friidric@gmail.com', 'new campus needed'),
(13, 'Michael Brown', 'michael.brown@example.com', 'Introduce more healthy and affordable food options in the campus cafeterias, including vegan and gluten-free choices.');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `itemDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `title`, `file_name`, `file_path`, `upload_time`, `itemDescription`) VALUES
(8, 'Lost Pen', '~lost1.jpeg', 'uploads/~lost1.jpeg', '2024-07-14 11:26:24', 'Found in classroom HLT2.7, a shiny silver fountain pen lay nestled in an old textbook. Its sleek metal body gleamed under the classroom lights, seemingly left behind after a lecture.'),
(9, 'Forgotten Journal', '~lost2.jpeg', 'uploads/~lost2.jpeg', '2024-07-14 11:26:58', 'Discovered in the library, a worn leather journal with intricate designs held pages. It seemed like someone forgot it while studying among stacks of books.');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_registration`
--

INSERT INTO `users_registration` (`ID`, `first_name`, `last_name`, `student_id`, `email`, `password`, `created_at`, `role`) VALUES
(23, 'Bernyleo', 'Jupiri', 'B1234567', 'bernyleog@gmail.com', '$2y$10$4AkmmZ8..mqChuRj4cZn7eVzEIjFMqeeLY7.1TFOpI8AnNzytwiYu', '2024-07-13 07:50:37.898751', ''),
(24, 'Elain', 'liow', 'B2301162', 'elainliow@gmail.com', '.WUd5erhzC3h2', '2024-07-13 07:51:08.155447', 'user'),
(26, 'Bernyleo', 'Jupiri', 'B2200966', 'bernyleog@gmail.com', '$2y$10$llOie7S5X7cTeKVppc0BGOphvI9BIxaSqCGefLoilv6OxZBQ1FnPu', '2024-07-13 08:10:55.447033', 'user'),
(27, 'HELP', 'Admin', 'ADMIN123', 'admin@gmail.com', '1UuUHVdGzu3y.', '0000-00-00 00:00:00.000000', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `voteResult`
--

CREATE TABLE `voteResult` (
  `id` int(11) NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `pollID` int(11) NOT NULL,
  `voteOption` varchar(255) NOT NULL,
  `voteTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voteResult`
--

INSERT INTO `voteResult` (`id`, `studentID`, `pollID`, `voteOption`, `voteTime`) VALUES
(40, 'B2200966', 9, 'option3', '2024-07-14 19:37:44'),
(41, 'B2200966', 10, 'option1', '2024-07-14 19:38:06'),
(42, 'B2200966', 17, 'option2', '2024-07-14 19:38:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggestionBox`
--
ALTER TABLE `suggestionBox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_registration`
--
ALTER TABLE `users_registration`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_student_id` (`student_id`);

--
-- Indexes for table `voteResult`
--
ALTER TABLE `voteResult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pollID` (`pollID`),
  ADD KEY `voteresult_ibfk_1` (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `suggestionBox`
--
ALTER TABLE `suggestionBox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_registration`
--
ALTER TABLE `users_registration`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `voteResult`
--
ALTER TABLE `voteResult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voteResult`
--
ALTER TABLE `voteResult`
  ADD CONSTRAINT `voteresult_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users_registration` (`student_id`),
  ADD CONSTRAINT `voteresult_ibfk_2` FOREIGN KEY (`pollID`) REFERENCES `poll` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
