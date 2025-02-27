-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 11:12 AM
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
-- Database: `student_dss`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `points` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `student_id`, `subject_id`, `grade`, `points`) VALUES
(1, 1, 1, 'A', 0),
(2, 1, 2, 'A', 0),
(3, 1, 3, 'A-', 0),
(4, 1, 4, 'A-', 0),
(5, 1, 5, 'B+', 0),
(6, 1, 6, 'B+', 0),
(7, 1, 7, 'B+', 0),
(8, 1, 8, 'B+', 0),
(9, 1, 9, 'B+', 0),
(10, 1, 10, '', 0),
(11, 1, 11, 'B', 0),
(12, 1, 12, 'A-', 0),
(13, 1, 1, 'A', 0),
(14, 1, 2, 'A', 0),
(15, 1, 3, 'A-', 0),
(16, 1, 4, 'A-', 0),
(17, 1, 5, 'B+', 0),
(18, 1, 6, 'B+', 0),
(19, 1, 7, 'B+', 0),
(20, 1, 8, 'B+', 0),
(21, 1, 9, 'B+', 0),
(22, 1, 10, '', 0),
(23, 1, 11, 'B', 0),
(24, 1, 12, 'A-', 0),
(25, 1, 1, 'C', 0),
(26, 1, 2, 'B-', 0),
(27, 1, 3, 'B', 0),
(28, 1, 4, 'B', 0),
(29, 1, 5, 'B+', 0),
(30, 1, 6, 'B', 0),
(31, 1, 7, 'B+', 0),
(32, 1, 8, 'B-', 0),
(33, 1, 9, 'B', 0),
(34, 1, 10, 'B+', 0),
(35, 1, 11, 'D-', 0),
(36, 1, 12, 'B+', 0),
(37, 1, 1, '12', 0),
(38, 1, 2, '12', 0),
(39, 1, 3, '12', 0),
(40, 1, 4, '12', 0),
(41, 1, 5, '12', 0),
(42, 1, 6, '12', 0),
(43, 1, 7, '12', 0),
(44, 1, 8, '7', 0),
(45, 1, 9, '8', 0),
(46, 1, 10, '9', 0),
(47, 1, 11, '10', 0),
(48, 1, 12, '7', 0),
(49, 1, 1, '12', 0),
(50, 1, 2, '12', 0),
(51, 1, 3, '12', 0),
(52, 1, 4, '12', 0),
(53, 1, 5, '12', 0),
(54, 1, 6, '12', 0),
(55, 1, 7, '12', 0),
(56, 1, 8, '7', 0),
(57, 1, 9, '8', 0),
(58, 1, 10, '9', 0),
(59, 1, 11, '10', 0),
(60, 1, 12, '7', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `student_grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
