-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 01:55 PM
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
  `calss_title` varchar(100) NOT NULL,
  `Class_description` text NOT NULL,
  `grade_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `calss_title`, `Class_description`, `grade_id`, `semester_id`, `subject_id`, `group_id`) VALUES
(1, 'science', 'scienc is a intersting subject.', 1, 1, 1, 1),
(2, 'science', 'scienc is a intersting subject.', 1, 1, 1, 1),
(3, 'science', 'scienc is a intersting subject.', 1, 1, 1, 1),
(4, 'science', 'scienc is a intersting subject.', 1, 1, 1, 1),
(5, 'science', 'scienc is a intersting subject.', 1, 1, 1, 1),
(15, 'science', 'scienc is a intersting subject.', 1, 1, 1, 1);

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
(2, 'second grade', 'dsdsxsafdsgdsafwqkdhglsqn', 0, 0, '');

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
  `student_id` int(11) NOT NULL,
  `assignment` varchar(255) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `submitted` varchar(20) NOT NULL,
  `late_submission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `is_used`) VALUES
(3, 'mtti2002@gmail.com', '0e995200cf2db9ab75dddb5c47dfb711d90cba72b4ef2f1447f8f3d0023044e3', 0),
(4, 'mtti2002@gmail.com', 'ba686265e146b6017838b4d2c4d4c4f00cf3eca71ac87706377cb48ba26bf2db', 0),
(5, 'mtti2002@gmail.com', '7f0a1ed09aac05ba8c309c71c45dd56d92701f0c22519714b565e0760270fb43', 0),
(6, 'mtti2002@gmail.com', '06b0309092add058cf4dccd9f7f84b72150b7093fa5fb7f401a03c8c8cf0d311', 0),
(7, 'mtti2002@gmail.com', 'db31a36a45c27c81631a184f27540f533161f5d737c52b6df8348bb1fb747e75', 1),
(8, 'mtti2002@gmail.com', 'e8475d4c9e69f3df9e4f9f18ce78b6659aadbec8e7df052b59c785cba1de5883', 1),
(9, 'mtti2002@gmail.com', '531d89f72282a2e424c8a9f37b8c7ecc8306365ecf9fb69b45bb0689e9e960b8', 0),
(10, 'mtti2002@gmail.com', '53cba2608693a1351cbc01a13656b579fc17c44cee1483e4c959491ba69e003e', 0);

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
  `grade_id` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `parent_name`, `grade_id`, `gender`, `contact_number`, `email`, `password`, `token`, `address`) VALUES
(2, 'shora', 'shora', 1, 'male', '01090755659', '', '', '', ''),
(3, 'eslam', 'eslam', 1, 'male', '01090755659', '', '', '', ''),
(4, 'rabie', 'rabie', 2, '', '', '', '', '', ''),
(5, 'ahmed', 'ahmed', 2, '', '', '', '', '', ''),
(6, 'mohamed samy', 'rabie', 1, 'male', '01094245990', '', '', '', 'tanta'),
(7, 'mohamed samy', 'rabie', 1, 'male', '01094245990', '', '', '', 'tanta'),
(8, 'mohamed samy', 'rabie', 1, 'male', '01094245990', '', '', '', 'tanta'),
(9, 'mohamed samy', 'rabie', 1, 'male', '01094245990', '', '', '', 'tanta'),
(10, 'mohamed samy', 'rabie', 1, 'male', '01094245990', '', '', '', 'tanta'),
(18, 'mohamed samy', 'rabie', 1, 'male', '01094245990', '', '', '', 'tanta'),
(21, 'mohamed rabie', '', 0, '', '01094245999', 'mohamed@gamil.com', '$2y$10$cuxrLpIHrNz2amWUc1WErOE1q03.C2UFlUzywjqN0kLNqUvV4RtT.', '<&._SF=p*XJmr?1drDmRPVJ <LK^0tbrr[Out{GRpbNS]z&IkF>>DW\r\rlQ?mW{#+viw$P?<A{j(r&?QsND$T=D*DeVmyUZ%h\n pu', ''),
(22, 'mo rabie', '', 0, '', '', 'mm@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_title_en` varchar(255) NOT NULL,
  `subject_title_ar` varchar(255) NOT NULL,
  `subject_description_en` text NOT NULL,
  `subject_description_ar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `teacher_id`, `subject_title_en`, `subject_title_ar`, `subject_description_en`, `subject_description_ar`, `created_at`) VALUES
(1, 9, 'science', '', 'science is an amazing subject.', '', '2024-12-10 12:44:50'),
(4, 9, 'math', '', 'math is an amazing subject.', '', '2024-12-10 12:44:50'),
(5, 0, 'Arabic', '', 'Arabic is the most powerfull language.', '', '2024-12-10 12:44:50'),
(6, 0, 'Geology', '', 'Geology is an intersting subject.', '', '2024-12-10 12:44:50'),
(12, 0, 'math', '', 'math 1th 1111', '', '2024-12-10 12:44:50'),
(13, 9, 'math', '', 'math 1th 1111', '', '2024-12-10 12:44:50'),
(14, 9, 'math', '', 'math 1th 1111', '', '2024-12-10 12:44:50'),
(15, 9, 'math', '', 'math 1th 1111', '', '2024-12-10 12:44:50'),
(16, 9, 'Arabic', '', 'Arabic is the most powerfull language.', '', '2024-12-10 12:44:50'),
(17, 9, 'Arabic', '', 'Arabic is the most powerfull language.', '', '2024-12-10 12:44:50');

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
(1, 'Mohamed Rabie', 'rabie@gmail.com', '01094245990', 'Kafr el-Sheikh Governorate', '$2y$10$Bo6P6SVmdvd8/dcmqFqqDuHt7jMSVCYF7nhA4MCrpE.XC9HzP08tC', 'aTe0{%>>d0m{OO.V(WqkB_].PYi7a^5^u?V6i+cr45fs}o)t.G[])~cl~OUXgDD>Sy.PVlt>V)GT>$Tl2A?MmMJ}n\nZTD$a<tVSd'),
(2, 'sabra', 'sabra@gmail.com', '01090755659', 'tanta', '$2y$10$dbsnTDQrN/vVR/lBc.1NX.LBq8byg9JUcguRI6Ru1dNHn8lPwAXHi', 'c @f=_Y} g~ Nwv6Xug&,<UXrrB16Qvv1>u=wx50E]2eq/onLmQYb?TAPC,sRu>YY,~@]_GI-n2{M<u4j1X]X}t6bI9J+>B<&,B{'),
(3, 'shora', 'shora@gmail.com', '01090755658', 'tanta', '$2y$10$7RTtulFbdMra4SNPnblJlugDxVN.hTjqR7I/7DnqWQeuhUYnJNo4e', '$XIa<hPOiG~D@jic8 9pbD(LiUI@VyS>QpC>1<D] E@@)~9_6zv8n<,D0tz\r[_9we\nuX<QVY@V}t0ess{76mnB+(<0=B27.Gwch]'),
(4, 'eslam elshora', 'shoraa@gmail.com', '01010201010', 'tanta', '$2y$10$6o5QxD6XRTUUSEII5T8k3OYTDLEE9Bo6JlwRCKt9HSy.KAdaAD8da', 'P*pdZ})>0KK2*]B%{PEnVO) ^<zIX&\n(HvtscK}ij=(BC b.CE]Zv\r=A9h\n~M}3-nJU&P~]^apyw0)(P7@xp6z>7$J2p 2Hlq3g~'),
(5, 'Mohamed Rabie Kamal', 'mtti2002@gmail.com', '01094245990', 'Kafr el-Sheikh Governorate', '$2y$10$NmCyWOIngJZZhlArJ3MU/.tGiMjrfdOxEUlkCtzAGku7wsT73cMcu', '$1ZQk3/(pdby1*HR+l9%S<#z9i8dNDNutN>_~P\nR#EsRe@,.},BUlbK]nv0\nQP/}Py\nPD}j}uA9eXjKU9ifoEF&(+hKh[ f}j&E2'),
(6, 'Mohamed Rabie Kamal', 'ali2002@gmail.com', '01094245999', 'Kafr el-Sheikh Governorate', '$2y$10$KHhXuCynNzaUADVyixsD3uzLID8yb9sP5LLIR1aZ/Fe0Atn9uqsT.', 'hU $o3kw{ml&@Clhy3Gt.q49<DD~O]4)Qg*dD%KO=> f9t abr6wf^ 5[,}YwX .L^o}e%rQobaPt>/KCphfRW9^ Y>VS^Pa^~L['),
(7, 'Rabie', 'rabi33@gmail.com', '01094245555', 'Kafr el-Sheikh Governorate', '$2y$10$NbGGUSX61mh.HqfTWtX/heWmyVNd9f.T2uKS7JI103mqWoNJrRFZO', 'iK .vPrl)IX ny<OySqfNtpehz72~ x/ETV1 0#y)q V1@^BM] sJS7T^}cVG~ udO>)YD1[T_sIh@x?n<ogF_Z68p\rnw\rKFE[>4'),
(8, 'mo rabie', 'mm@gmail.com', '', '', '', ''),
(9, 'eslam', 'eslam@gmail.com', '01094245555', 'Kafr el-Sheikh Governorate', '$2y$10$D5NLlXEMKmyjXU8YU6659OE1HeY2RCAbhJ0xBGzffdsQTm88G585S', 'EO7s**p @8,/@hi]AJ,K@R*YjQ4Q6KAoI+<o2[3O}s.oJ}dpr93rJ6d >j8z7N$+N$zk4 .@p g%.G5hs[qsA@T~gmc^<-*lqo3,'),
(10, 'eslam', 'eslam1@gmail.com', '01094245551', 'Kafr el-Sheikh Governorate', '$2y$10$C4522oKffaLsviICtqErIuIdHcoz095AxCNLeX4bpyZh8lmdMwIX6', 'Y+(V^Qb W<&J4k F6SehkOx3_IbKVfO=L? a }hiVojNn(ZZ^-gZ&rh]%~Mw<8L/\r@4le&Ch^6A7c6[s}1%Y[X]&LPywP(rKFiiN'),
(11, 'mohamed rabie', 'mohamed@gamil.com', '01094245999', 'ff', '$2y$10$PxYDYsISmNf.y2Hz08Jvou7ex72RKs001jlU0B6Tpo0/RLHl2MJGC', '{?sY<FgX<h$y@F%LmN8SPAjL?*M}RaL6%1,\r<uxddX B\n&U9g4k}d9gC0^^^m]_3vO>&ReDx0V+t6Ak@1po\rSFcG7}89OMyw6T}&');

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
  ADD KEY `grade_id` (`grade_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `subject_id` (`subject_id`);

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
  ADD PRIMARY KEY (`homework_id`);

--
-- Indexes for table `parent_infromation`
--
ALTER TABLE `parent_infromation`
  ADD PRIMARY KEY (`parent_id`);

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
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `homework_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_infromation`
--
ALTER TABLE `parent_infromation`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher_account`
--
ALTER TABLE `teacher_account`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
