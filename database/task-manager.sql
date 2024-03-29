-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 11:45 AM
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
-- Database: `task-manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `checkin` datetime DEFAULT NULL,
  `lunchBreakIn` datetime DEFAULT NULL,
  `lunchBreakOut` datetime DEFAULT NULL,
  `checkout` datetime DEFAULT NULL,
  `attendance_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `name`, `checkin`, `lunchBreakIn`, `lunchBreakOut`, `checkout`, `attendance_date`) VALUES
(2, 118, 'hania', '2024-03-28 13:48:21', NULL, NULL, '2024-03-28 13:48:24', '2024-03-28'),
(8, 2, 'nayab', '2024-03-29 08:57:20', NULL, NULL, '2024-03-29 08:57:28', '2024-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '101', 1710609623),
('user', '1', 1710609623),
('user', '103', 1710609623),
('user', '2', 1710609623);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1710608563, 1710608563),
('auth/employee/create', 2, 'Create employee', NULL, NULL, 1710608049, 1710608049),
('auth/employee/delete', 2, 'Delete employee', NULL, NULL, 1710608049, 1710608049),
('auth/employee/index', 2, 'View index', NULL, NULL, 1710608049, 1710608049),
('auth/employee/update', 2, 'Update employee', NULL, NULL, 1710608049, 1710608049),
('auth/table_lists/create', 2, 'Create table', NULL, NULL, 1710608049, 1710608049),
('auth/table_lists/delete', 2, 'Delete table', NULL, NULL, 1710608049, 1710608049),
('auth/table_lists/index', 2, 'View table lists', NULL, NULL, 1710608049, 1710608049),
('auth/table_lists/update', 2, 'Update table', NULL, NULL, 1710608049, 1710608049),
('auth/table_lists/view', 2, 'View table details', NULL, NULL, 1710608049, 1710608049),
('auth/user/create', 2, 'Create table', NULL, NULL, 1710608049, 1710608049),
('auth/user/delete', 2, 'Delete table', NULL, NULL, 1710608049, 1710608049),
('auth/user/index', 2, 'View index', NULL, NULL, 1710608049, 1710608049),
('auth/user/update', 2, 'Update table', NULL, NULL, 1710608049, 1710608049),
('employee', 1, NULL, NULL, NULL, 1710608563, 1710608563),
('user', 1, NULL, NULL, NULL, 1710608563, 1710608563);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'auth/user/create'),
('admin', 'auth/user/delete'),
('admin', 'auth/user/index'),
('admin', 'auth/user/update'),
('employee', 'auth/table_lists/create'),
('employee', 'auth/table_lists/delete'),
('employee', 'auth/table_lists/index'),
('employee', 'auth/table_lists/update'),
('user', 'auth/employee/create'),
('user', 'auth/employee/delete'),
('user', 'auth/employee/index'),
('user', 'auth/employee/update');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1709618884),
('m130524_201442_init', 1709618896),
('m140506_102106_rbac_init', 1710339828),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1710339829),
('m180523_151638_rbac_updates_indexes_without_prefix', 1710339829),
('m190124_110200_add_verification_token_column_to_user_table', 1709618896),
('m200409_110543_rbac_update_mssql_trigger', 1710339829);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `assigned_to` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `details`, `assigned_to`, `created_at`, `updated_at`) VALUES
(12, 'project 2', 'this is project 2', 2, '2024-03-17 15:08:29', '2024-03-17 15:08:29'),
(17, 'project 3', 'this is project 3', 106, '2024-03-18 10:27:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_lists`
--

CREATE TABLE `table_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_lists`
--

INSERT INTO `table_lists` (`id`, `name`, `description`, `created_by`, `updated_at`, `status`) VALUES
(6, 'project 2', 'this is project 2', 101, '2024-03-18 08:18:35', 'completed'),
(9, 'project 3', 'this is project 3', 106, '2024-03-22 04:24:29', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verification_token` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `role`) VALUES
(1, 'test', '18_TTSrG2W10act9zx0RLgsjIU6Mn_sw', '$2y$13$XIi/cqOXwS6lLX95si3NOetg4uZDdcqEJTIAmD7ate5xhucjvp06a', NULL, 'test@example.com', 10, '0000-00-00 00:00:00', '2024-03-16 15:55:54', 'w9FYhuoiSJHG5XbqRaAH1XrEdV5d6bcs_1709618995', 'user'),
(2, 'nayab', 'pAeGT7Jh4MIPO8Z6LhAmBPaFuiz3A3B4', '$2y$13$CELQ4AChmb0c42t29J1rpO602qv7Wy1Biq2rk1OPDIz7bdz1tXISG', NULL, 'nayabt@test.com', 10, '0000-00-00 00:00:00', '2024-03-16 16:32:17', 'Kf--ZMieHB7IffEjk19zZnpcneYpnQ5z_1710315852', 'user'),
(101, 'admin', 'cuSh4yWTUKE8ZooHSTe5z1d9QGi_kMzB', '$2y$13$JI4oo2x6RF1YN34a2301/OXUnWPujceFUHKnsVl20vqNdaQF7VaoG', NULL, 'admin@gmail.com', 10, '2024-03-16 11:40:53', '2024-03-16 15:56:16', '3ulRX6Pt8wz_QHNObMiTX3eri9osBgoe_1710603653', 'admin'),
(103, 'hamna', 'wcEYwJsu5yGx5cJnGVCBu-XSzaOgFxyR', '$2y$13$C14CV1OdCdNJhIMHkGlG7uIR36pP5gIJZ.tJ0xbk7sBp19xrHYLC6', NULL, 'hamna@gmail.com', 10, '2024-03-16 12:26:47', '2024-03-16 16:26:47', 'h7g7CU2g-bDdoqBhzlm7ZeyiDqs6Ck98_1710606407', 'user'),
(106, 'ahmed', 'zCFQE5qmXr5Pn27y6lYNB6egOXDq60bA', '$2y$13$jeljIeDRfURfUEcD2.ySceACyZgO3kswS9ZjgSqk4krtrD0LSRGxy', NULL, 'ahmed@demo.com', 10, '2024-03-18 10:17:05', '2024-03-18 14:17:05', '_P_51CNKH-XM9yTyxFO_WB_aYltgMjnn_1710771425', 'user'),
(116, 'khizer', '3uEbucnS1RvfoN6_YvofVfl0s3HGlpSI', '$2y$13$hsE80sPk4DlETA4G6VoFIuKxEBPUE9pfEGJoDjiLeWj4ycUQ5nxZC', NULL, 'khizer@gmail.com', 10, '2024-03-26 12:04:10', '2024-03-26 16:04:11', 'q_GApgcFTSL2ajCVdjktl0pH2z2WLm00_1711469050', 'user'),
(118, 'hania', 'Z7LgqNzM2hWmD9U4oUuPoRl6zbtyPxrY', '$2y$13$KEd3Vzybq55FwHQSZLt0BO5m0QkC3F7AUTu3vvJmBHkRbvRF7VpdK', NULL, 'hania@demo.com', 10, '2024-03-27 05:40:02', '2024-03-27 09:40:03', 'Pg9fPoUtXh53UWko7mL8O2z85V0wSP-R_1711532402', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `table_lists`
--
ALTER TABLE `table_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-table_lists-created_by` (`created_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `table_lists`
--
ALTER TABLE `table_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `user` (`id`);

--
-- Constraints for table `table_lists`
--
ALTER TABLE `table_lists`
  ADD CONSTRAINT `fk-table_lists-created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
