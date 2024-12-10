-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 01:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edus_managment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_title` varchar(100) NOT NULL,
  `Class_description` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_date` date NOT NULL DEFAULT current_timestamp(),
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_title`, `Class_description`, `teacher_id`, `grade_id`, `semester_id`, `subject_id`, `class_date`, `start_time`, `end_time`) VALUES
(20, 'Math', 'Math is a intersting subject.', 2, 1, 1, 4, '2024-12-10', '00:00:00', '00:00:00'),
(21, 'Science', 'Science is a intersting subject.', 2, 2, 1, 1, '2024-12-10', '00:00:00', '00:00:00'),
(22, 'Arabic', 'Arabic is a intersting subject.', 1, 1, 1, 5, '2024-12-10', '00:00:00', '00:00:00'),
(23, 'Scuence', 'Geologyis a intersting subject.', 3, 2, 1, 1, '2024-12-10', '00:00:00', '00:00:00'),
(34, 'test', 'ddsfsdfdshk', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(35, 'test', 'ddsfsdfdshk', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(36, 'test', 'ddsfsdfdshk', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(37, 'test', 'ddsfsdfdshk', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(39, 'Math', 'MathMathMath', 3, 1, 1, 4, '2024-12-10', '00:00:00', '00:00:00'),
(40, 'Math', 'MathMathMath', 2, 1, 1, 4, '2024-12-11', '11:00:00', '12:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `classes_ibfk_1` (`grade_id`),
  ADD KEY `classes_ibfk_2` (`semester_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_account` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
