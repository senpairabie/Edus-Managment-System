-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 03:56 PM
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
-- Table structure for table `assigned_exams`
--

CREATE TABLE `assigned_exams` (
  `assigned_exams_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `due` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `clss_id` int(11) NOT NULL,
  `attendance` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_title_en`, `class_title_ar`, `Class_description_en`, `Class_description_ar`, `teacher_id`, `grade_id`, `semester_id`, `subject_id`, `class_date`, `start_time`, `end_time`) VALUES
(20, 'Math', 'رياضيات', 'Math is a intersting subject.', '0', 2, 1, 1, 4, '2024-12-10', '00:00:00', '00:00:00'),
(21, 'Science', 'علوم', 'Science is a intersting subject.', '0', 2, 2, 1, 1, '2024-12-10', '00:00:00', '00:00:00'),
(22, 'Arabic', 'عربي', 'Arabic is a intersting subject.', '0', 1, 1, 1, 5, '2024-12-10', '00:00:00', '00:00:00'),
(23, 'Scuence', 'علوم', 'Geologyis a intersting subject.', '0', 3, 2, 1, 1, '2024-12-10', '00:00:00', '00:00:00'),
(34, 'test', '0', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(35, 'test', '0', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(36, 'test', '0', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(37, 'test', '0', 'ddsfsdfdshk', '0', 2, 1, 2, 4, '2024-12-10', '00:00:00', '00:00:00'),
(39, 'Math', 'رياضيات', 'MathMathMath', '0', 3, 1, 1, 4, '2024-12-10', '00:00:00', '00:00:00'),
(40, 'Math', 'رياضيات', 'MathMathMath', '0', 2, 1, 1, 4, '2024-12-11', '11:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `class_st_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam` varchar(100) NOT NULL,
  `score` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `grade_description` text NOT NULL,
  `groups_no` int(11) NOT NULL,
  `students_no` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade_level`, `grade_description`, `groups_no`, `students_no`, `status`) VALUES
(1, 'first grade', 'dsdsfdsgdsafwqkdhglsqn', 0, 0, ''),
(2, 'second grade', 'dsdsxsafdsgdsafwqkdhglsqn', 0, 0, ''),
(3, 'second grade', 'dsdsxsafdsgdsafwqkdhglsqn', 0, 0, ''),
(5, 'Third grade', 'العب العب العب العب', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `groupe_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `groupe_title`) VALUES
(1, 'Group A'),
(2, 'Group B'),
(3, 'Group C'),
(4, 'Group D');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `homework_id` int(11) NOT NULL,
  `assignment_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `submitted` varchar(20) NOT NULL,
  `late_submission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`homework_id`, `assignment_title`, `teacher_id`, `class_id`, `student_id`, `due_date`, `submitted`, `late_submission`) VALUES
(1, 'second', 2, 21, 0, '2024-11-18 22:00:00', '', ''),
(5, 'third', 2, 20, 0, '2024-11-18 22:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `parent_infromation`
--

CREATE TABLE `parent_infromation` (
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_infromation`
--

INSERT INTO `parent_infromation` (`parent_id`, `student_id`, `parent_name`, `relation`, `contact_number`, `address`) VALUES
(1, 1, 'Sabra', 'father', '010907555659', 'tanta gharbia'),
(2, 2, 'shora', 'father', '010907555659', 'tanta gharbia'),
(3, 2, 'shoraaaa', 'mother', '010907555659', 'tanta gharbia'),
(10, 1, 'shora', 'mother', '010907555657', 'tanta gharbia');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `is_used`) VALUES
(6, 'aabosabra3@gmail.com', 'bb833f06fc87cb94a8b3a0cbb8358c0c5dc3affb40d5756de8b50e856bb904bb', 0),
(8, 'aabosabra3@gmail.com', 'ac7d800b223a395a10e3501b63a6013817d93f71bcfd6f05a3d466ce69f16218', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `payment_status_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semester_name`) VALUES
(1, 'First semester'),
(2, 'Second semester');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `date_of_birth` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `parent_name`, `email`, `password`, `grade_id`, `class_id`, `gender`, `phone_number`, `date_of_birth`, `address`) VALUES
(1, 'sabra', 'sabra', '', '', 1, 20, 'male', '01090755659', '2024-11-14 00:34:16', 'tanta'),
(2, 'shora', 'shora', '', '', 1, 20, 'male', '01090755659', '2024-11-18 00:48:08', 'tanta'),
(3, 'eslam', 'eslam', '', '', 1, 20, 'male', '01090755659', '2024-11-18 00:48:08', 'tanta'),
(4, 'rabie', 'rabie', '', '', 2, 23, '', '', '2024-11-18 02:20:29', 'tanta'),
(5, 'ahmed', 'ahmed', '', '', 2, 23, '', '', '2024-11-18 02:25:45', 'tanta'),
(6, 'sabra', '', '', '', 1, 0, 'male', '01090755659', '0000-00-00 00:00:00', ''),
(7, 'sabra', '', '', '', 1, 0, 'male', '01090755659', '0000-00-00 00:00:00', ''),
(8, 'sabra', '', '', 'sabra123', 1, 0, 'male', '01090755659', '0000-00-00 00:00:00', ''),
(9, 'sabra', '', '', 'sabra123', 1, 0, 'male', '01090755659', '0000-00-00 00:00:00', ''),
(23, 'eslam', '', 'eslam@gmail.com', '$2y$10$tCD.3asRPQ.CeNRAoJk0dOeW6YWzyBTYfW8IZPteV.WW.dJEncUlu', 0, 0, '1', '01009075565', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `subject_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `teacher_id`, `subject_title`, `subject_description`) VALUES
(1, 2, 'science', 'science is an amazing subject.'),
(4, 2, 'math', 'math is an amazing subject.'),
(5, 2, 'Arabic', 'Arabic is the most powerfull language.'),
(6, 2, 'Geology', 'Geology is an intersting subject.'),
(12, 2, 'Geology', 'Geology is an intersting subject.'),
(13, 2, 'sabra', 'sabra is good hhh');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_account`
--

CREATE TABLE `teacher_account` (
  `teacher_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_account`
--

INSERT INTO `teacher_account` (`teacher_id`, `full_name`, `email`, `phone_number`, `location`, `password`, `token`) VALUES
(1, 'rabie', 'rabie@gmail.com', '01094245990', 'Kafr el-Sheikh Governorate', '$2y$10$Bo6P6SVmdvd8/dcmqFqqDuHt7jMSVCYF7nhA4MCrpE.XC9HzP08tC', 'aTe0{%>>d0m{OO.V(WqkB_].PYi7a^5^u?V6i+cr45fs}o)t.G[])~cl~OUXgDD>Sy.PVlt>V)GT>$Tl2A?MmMJ}n\nZTD$a<tVSd'),
(2, 'sabra', 'aabosabra3@gmail.com', '01090755659', 'tanta', '$2y$10$dbsnTDQrN/vVR/lBc.1NX.LBq8byg9JUcguRI6Ru1dNHn8lPwAXHi', 'c @f=_Y} g~ Nwv6Xug&,<UXrrB16Qvv1>u=wx50E]2eq/onLmQYb?TAPC,sRu>YY,~@]_GI-n2{M<u4j1X]X}t6bI9J+>B<&,B{'),
(3, 'shora', 'shora@gmail.com', '01090755658', 'tanta', '$2y$10$7RTtulFbdMra4SNPnblJlugDxVN.hTjqR7I/7DnqWQeuhUYnJNo4e', '$XIa<hPOiG~D@jic8 9pbD(LiUI@VyS>QpC>1<D] E@@)~9_6zv8n<,D0tz\r[_9we\nuX<QVY@V}t0ess{76mnB+(<0=B27.Gwch]'),
(4, 'eslam elshora', 'shoraa@gmail.com', '01010201010', 'tanta', '$2y$10$6o5QxD6XRTUUSEII5T8k3OYTDLEE9Bo6JlwRCKt9HSy.KAdaAD8da', 'P*pdZ})>0KK2*]B%{PEnVO) ^<zIX&\n(HvtscK}ij=(BC b.CE]Zv\r=A9h\n~M}3-nJU&P~]^apyw0)(P7@xp6z>7$J2p 2Hlq3g~'),
(5, 'ana', 'ana@gmail.com', '01010201011', 'tanta', '$2y$10$jr5bFxm1mUBBTYl59ZaDY.oXFglECaFLHv76.1D.azoco7r3nVtVy', '*D7D<Tg,G a%vb0k$8Pv#]DR@dS-x 97l2<HOk<ku>Fx4)}tC&c+~\neR#XGGM .jlwrlY73hI\n$n>wKE+{{JT86}vM~.f*T]+00N'),
(7, '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_exams`
--
ALTER TABLE `assigned_exams`
  ADD PRIMARY KEY (`assigned_exams_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

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
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`class_st_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homework_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `parent_infromation`
--
ALTER TABLE `parent_infromation`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`payment_status_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher_account`
--
ALTER TABLE `teacher_account`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_exams`
--
ALTER TABLE `assigned_exams`
  MODIFY `assigned_exams_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `class_st_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `homework_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parent_infromation`
--
ALTER TABLE `parent_infromation`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `payment_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teacher_account`
--
ALTER TABLE `teacher_account`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- Constraints for table `class_students`
--
ALTER TABLE `class_students`
  ADD CONSTRAINT `class_students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `homework_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_account` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent_infromation`
--
ALTER TABLE `parent_infromation`
  ADD CONSTRAINT `parent_infromation_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
