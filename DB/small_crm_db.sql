-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 02:48 PM
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
-- Database: `small_crm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_association`
--

CREATE TABLE `tbl_association` (
  `id` int(11) NOT NULL,
  `section_name` varchar(150) NOT NULL,
  `section_icon` varchar(150) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0 = Disable,\r\n1 = Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(150) NOT NULL,
  `department_status` char(1) NOT NULL COMMENT '0 = Disable,\r\n1 = Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `emloyee_img` varchar(150) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_no` varchar(13) NOT NULL,
  `gender` char(1) NOT NULL COMMENT 'M = Male,\r\nF = Female',
  `department_id` int(11) DEFAULT NULL,
  `pwd` varchar(150) NOT NULL,
  `employee_position_id` int(11) DEFAULT NULL,
  `joining_date` date NOT NULL,
  `experience_in_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_position`
--

CREATE TABLE `tbl_employee_position` (
  `id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `position_name` varchar(150) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0 = Disable,\r\n1 = Enable\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hour_settings`
--

CREATE TABLE `tbl_hour_settings` (
  `id` int(11) NOT NULL,
  `day_name` varchar(30) NOT NULL,
  `total_day_hours` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_category`
--

CREATE TABLE `tbl_leave_category` (
  `id` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `status` char(1) NOT NULL COMMENT '0 = Disable,\r\n1 = Enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_info`
--

CREATE TABLE `tbl_leave_info` (
  `id` int(11) NOT NULL,
  `leave_category_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `leave_reason` varchar(150) NOT NULL,
  `leave_date` date NOT NULL,
  `leave_status` char(1) NOT NULL COMMENT '0 = Rejected,\r\n1 = Approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_content`
--

CREATE TABLE `tbl_page_content` (
  `id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `section_containt` varchar(255) NOT NULL,
  `status` tinyblob NOT NULL COMMENT '0 = Disable,\r\n1 = Enable',
  `icon` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_retiring`
--

CREATE TABLE `tbl_retiring` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `reason` varchar(150) NOT NULL,
  `retiring_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time_tracking`
--

CREATE TABLE `tbl_time_tracking` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `checkin_time` datetime NOT NULL,
  `checkout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Manthan', 'Mistry', 'manthan@gmail.com', '6a15a725a43a60f32190e3929887f513');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_association`
--
ALTER TABLE `tbl_association`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`mobile_no`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `employee_position_id` (`employee_position_id`);

--
-- Indexes for table `tbl_employee_position`
--
ALTER TABLE `tbl_employee_position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id_potition` (`department_id`);

--
-- Indexes for table `tbl_hour_settings`
--
ALTER TABLE `tbl_hour_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_category`
--
ALTER TABLE `tbl_leave_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leave_info`
--
ALTER TABLE `tbl_leave_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_category_id` (`leave_category_id`),
  ADD KEY `employee_id_leave_info` (`employee_id`);

--
-- Indexes for table `tbl_page_content`
--
ALTER TABLE `tbl_page_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `tbl_retiring`
--
ALTER TABLE `tbl_retiring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_time_tracking`
--
ALTER TABLE `tbl_time_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id_time_track` (`employee_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_association`
--
ALTER TABLE `tbl_association`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_position`
--
ALTER TABLE `tbl_employee_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hour_settings`
--
ALTER TABLE `tbl_hour_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_leave_category`
--
ALTER TABLE `tbl_leave_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_leave_info`
--
ALTER TABLE `tbl_leave_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_page_content`
--
ALTER TABLE `tbl_page_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_retiring`
--
ALTER TABLE `tbl_retiring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_time_tracking`
--
ALTER TABLE `tbl_time_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `department_id` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_position_id` FOREIGN KEY (`employee_position_id`) REFERENCES `tbl_employee_position` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_employee_position`
--
ALTER TABLE `tbl_employee_position`
  ADD CONSTRAINT `department_id_potition` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_leave_info`
--
ALTER TABLE `tbl_leave_info`
  ADD CONSTRAINT `employee_id_leave_info` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_category_id` FOREIGN KEY (`leave_category_id`) REFERENCES `tbl_leave_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_page_content`
--
ALTER TABLE `tbl_page_content`
  ADD CONSTRAINT `section_id` FOREIGN KEY (`section_id`) REFERENCES `tbl_association` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_retiring`
--
ALTER TABLE `tbl_retiring`
  ADD CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_time_tracking`
--
ALTER TABLE `tbl_time_tracking`
  ADD CONSTRAINT `employee_id_time_track` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
