-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 08:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sasattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_user_name` varchar(100) NOT NULL,
  `admin_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_user_name`, `admin_password`) VALUES
(1, 'admin', '0cc175b9c0f1b6a831c399e269772661');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `attendance_date` date NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `student_id`, `grade_id`, `attendance_status`, `attendance_date`, `teacher_id`) VALUES
(1, 1, 1, 'Absent', '2023-03-15', 1),
(2, 2, 1, 'Absent', '2023-03-15', 1),
(3, 3, 1, 'Absent', '2023-03-15', 1),
(4, 4, 1, 'Present', '2023-03-15', 1),
(5, 5, 3, 'Present', '2023-03-15', 1),
(6, 6, 3, 'Present', '2023-03-15', 1),
(7, 7, 3, 'Present', '2023-03-15', 1),
(8, 5, 3, 'Absent', '2023-03-16', 1),
(9, 6, 3, 'Absent', '2023-03-16', 1),
(10, 7, 3, 'Absent', '2023-03-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `grade_id` int(11) NOT NULL,
  `grade_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade`
--

INSERT INTO `tbl_grade` (`grade_id`, `grade_name`) VALUES
(1, '02BCA-A'),
(2, '04BCA-D'),
(3, '02BCA-B');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(150) NOT NULL,
  `student_roll_number` int(11) NOT NULL,
  `student_dob` date NOT NULL,
  `student_grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_roll_number`, `student_dob`, `student_grade_id`) VALUES
(1, 'raj', 1, '2004-01-29', 1),
(2, 'kush', 2, '2006-06-07', 1),
(3, 'meet', 3, '2005-06-15', 1),
(4, 'jeet', 4, '2005-04-15', 1),
(5, 'raj01', 1, '2005-06-15', 3),
(6, 'kush01', 2, '2004-02-16', 3),
(7, 'meet01', 3, '2008-05-19', 3),
(8, 'jeet02', 1, '2004-09-14', 2),
(9, 'meet02', 2, '2003-02-15', 2),
(10, 'kush02', 3, '2005-02-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(150) NOT NULL,
  `teacher_address` text NOT NULL,
  `teacher_emailid` varchar(100) NOT NULL,
  `teacher_password` varchar(100) NOT NULL,
  `teacher_qualification` varchar(100) NOT NULL,
  `teacher_doj` date NOT NULL,
  `teacher_image` varchar(100) NOT NULL,
  `teacher_language` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_emailid`, `teacher_password`, `teacher_qualification`, `teacher_doj`, `teacher_image`, `teacher_language`) VALUES
(1, 'shivangi', 'rajkot', 'shivangi@gmail.com', 'b5eb72dd2000d6bb8c1704e93a1ede22', 'phdma,javas', '2023-03-15', '6411a0f5ab06563ba639fafdd9.png', 'java'),
(3, 'Ramu', 'rajkot2', 'ramu@gmail.com', 'ramu@gmail.com', 'Phd,php,python', '2023-03-15', '6411a174723122149355264-PGOi3BOSC-transformed-removebg-preview.png', 'python');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachet_class`
--

CREATE TABLE `tbl_teachet_class` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teachet_class`
--

INSERT INTO `tbl_teachet_class` (`id`, `teacher_id`, `grade_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 3, 3),
(4, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `tbl_teachet_class`
--
ALTER TABLE `tbl_teachet_class`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_teachet_class`
--
ALTER TABLE `tbl_teachet_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
