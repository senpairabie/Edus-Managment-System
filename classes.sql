-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 12:54 PM
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
  `class_title_en` varchar(100) NOT NULL,
  `class_title_ar` varchar(50) DEFAULT NULL,
  `Class_description_en` text NOT NULL,
  `Class_description_ar` varchar(255) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_date` date NOT NULL DEFAULT current_timestamp(),
  `class_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_title_en`, `class_title_ar`, `Class_description_en`, `Class_description_ar`, `teacher_id`, `grade_id`, `semester_id`, `subject_id`, `class_date`, `class_time`) VALUES
(20, 'Math', 'رياضيات', 'Math is a intersting subject.', '0', 2, 1, 1, 4, '2024-12-10', '4:00 - 5:00 pm'),
(21, 'Science', 'علوم', 'Science is a intersting subject.', '0', 2, 2, 1, 1, '2024-12-10', ''),
(22, 'Arabic', 'عربي', 'Arabic is a intersting subject.', '0', 1, 1, 1, 5, '2024-12-10', ''),
(23, 'Scuence', 'علوم', 'Geologyis a intersting subject.', '0', 3, 2, 1, 1, '2024-12-10', ''),
(34, 'test', 'تيست', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', ''),
(35, 'test', 'تيست', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', ''),
(36, 'test', 'تيست', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', ''),
(37, 'test', 'تيست', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', ''),
(39, 'Math', 'رياضيات', 'MathMathMath', '0', 3, 1, 1, 4, '2024-12-10', ''),
(40, 'Math', 'رياضيات', 'MathMathMath', '0', 2, 1, 1, 4, '2024-12-11', '');

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
