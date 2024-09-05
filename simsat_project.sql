-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 05, 2024 at 10:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simsat_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `student_id` int NOT NULL DEFAULT '0',
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `student_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Holiday', 'Cneter will remain closed on 14th August due to Pakistan Independence Days.', 0, 0, '2024-08-20 20:31:34', '2024-08-20 20:33:28'),
(2, 'cehck', 'check', 0, 0, '2024-08-20 20:34:19', '2024-09-01 00:11:03'),
(3, 'Fee Submitted', '. Your subscription is now active for the upcoming month', 3, 0, '2024-08-22 02:52:08', '2024-08-22 02:52:08'),
(4, 'Fee Submitted', 'We have received your monthly fees of December 2024. Your subscription is now active for the upcoming month', 13, 0, '2024-08-22 03:48:35', '2024-08-22 03:48:35'),
(5, 'Reapiring', 'sss', 0, 1, '2024-08-22 04:16:19', '2024-08-24 00:53:09'),
(6, 'Fee Submitted', 'We have received your registration fees.', 27, 0, '2024-08-27 04:45:12', '2024-08-27 04:45:12'),
(7, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 27, 0, '2024-08-27 04:48:21', '2024-08-27 04:48:21'),
(8, 'Fee Submitted', 'We have received your monthly fees of September 2024.', 27, 0, '2024-08-27 04:50:52', '2024-08-27 04:50:52'),
(9, 'Repainring', 'No', 0, 1, '2024-08-31 00:58:12', '2024-08-31 00:58:24'),
(10, 'Fee Submitted', 'We have received your registration fees.', 5, 0, '2024-08-31 04:04:25', '2024-08-31 04:04:25'),
(11, 'Fee Submitted', 'We have received your registration fees.', 6, 0, '2024-08-31 04:07:16', '2024-08-31 04:07:16'),
(12, 'Fee Submitted', 'We have received your registration fees.', 7, 0, '2024-08-31 04:09:57', '2024-08-31 04:09:57'),
(13, 'Fee Submitted', 'We have received your registration fees.', 8, 0, '2024-08-31 04:11:39', '2024-08-31 04:11:39'),
(14, 'Fee Submitted', 'We have received your registration fees.', 10, 0, '2024-08-31 04:15:24', '2024-08-31 04:15:24'),
(15, 'Fee Submitted', 'We have received your registration fees.', 11, 0, '2024-08-31 04:18:15', '2024-08-31 04:18:15'),
(16, 'Fee Submitted', 'We have received your registration fees.', 12, 0, '2024-08-31 04:23:45', '2024-08-31 04:23:45'),
(17, 'Fee Submitted', 'We have received your registration fees.', 14, 0, '2024-08-31 04:26:02', '2024-08-31 04:26:02'),
(18, 'Fee Submitted', 'We have received your monthly fees of January 2025.', 13, 0, '2024-08-31 04:32:01', '2024-08-31 04:32:01'),
(19, 'Fee Submitted', 'We have received your registration fees.', 15, 0, '2024-08-31 04:35:21', '2024-08-31 04:35:21'),
(20, 'Fee Submitted', 'We have received your registration fees.', 16, 0, '2024-08-31 04:38:22', '2024-08-31 04:38:22'),
(21, 'Fee Submitted', 'We have received your registration fees.', 17, 0, '2024-08-31 04:39:10', '2024-08-31 04:39:10'),
(22, 'Fee Submitted', 'We have received your monthly fees of October 2024.', 9, 0, '2024-08-31 04:40:18', '2024-08-31 04:40:18'),
(23, 'Fee Submitted', 'We have received your registration fees.', 18, 0, '2024-08-31 04:42:42', '2024-08-31 04:42:42'),
(24, 'Fee Submitted', 'We have received your registration fees.', 19, 0, '2024-08-31 04:48:03', '2024-08-31 04:48:03'),
(25, 'Fee Submitted', 'We have received your monthly fees of October 2024.', 2, 0, '2024-08-31 04:49:03', '2024-08-31 04:49:03'),
(26, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 5, 0, '2024-08-31 04:50:13', '2024-08-31 04:50:13'),
(27, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 7, 0, '2024-08-31 04:51:00', '2024-08-31 04:51:00'),
(28, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 6, 0, '2024-08-31 04:52:02', '2024-08-31 04:52:02'),
(29, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 8, 0, '2024-08-31 04:57:20', '2024-08-31 04:57:20'),
(30, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 10, 0, '2024-08-31 04:58:31', '2024-08-31 04:58:31'),
(31, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 11, 0, '2024-08-31 21:12:00', '2024-08-31 21:12:00'),
(32, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 12, 0, '2024-08-31 21:13:06', '2024-08-31 21:13:06'),
(33, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 14, 0, '2024-08-31 21:17:06', '2024-08-31 21:17:06'),
(34, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 15, 0, '2024-08-31 21:18:05', '2024-08-31 21:18:05'),
(35, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 16, 0, '2024-08-31 21:20:46', '2024-08-31 21:20:46'),
(36, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 17, 0, '2024-08-31 21:23:10', '2024-08-31 21:23:10'),
(37, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 18, 0, '2024-08-31 21:25:51', '2024-08-31 21:25:51'),
(38, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 19, 0, '2024-08-31 21:27:04', '2024-08-31 21:27:04'),
(39, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 19, 0, '2024-08-31 21:31:04', '2024-08-31 21:31:04'),
(40, 'Fee Submitted', 'We have received your registration fees.', 2, 0, '2024-08-31 21:39:55', '2024-08-31 21:39:55'),
(41, 'Fee Submitted', 'We have received your monthly fees of August 2024.', 2, 0, '2024-08-31 21:40:19', '2024-08-31 21:40:19'),
(42, 'Fee Submitted', 'We have received your registration fees.', 3, 0, '2024-09-01 00:29:02', '2024-09-01 00:29:02'),
(43, 'Fee Submitted', 'We have received your registration fees.', 3, 0, '2024-09-01 00:32:54', '2024-09-01 00:32:54'),
(44, 'Fee Submitted', 'We have received your registration fees.', 5, 0, '2024-09-01 00:33:04', '2024-09-01 00:33:04'),
(45, 'cehck', 'hh', 0, 0, '2024-09-04 04:25:27', '2024-09-04 04:25:27'),
(46, 'how', 'where', 0, 0, '2024-09-04 04:27:06', '2024-09-04 04:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `student_id`, `date`, `status`, `created_at`, `updated_at`) VALUES
(6, 20, '2024-08-08', 'absent', '2024-07-08 05:30:28', '2024-08-08 06:10:15'),
(7, 17, '2024-08-08', 'present', '2024-07-08 06:01:15', '2024-08-08 06:01:15'),
(8, 14, '2024-08-08', 'present', '2024-08-08 06:01:18', '2024-08-08 06:07:22'),
(9, 18, '2024-08-08', 'absent', '2024-08-08 06:07:56', '2024-08-08 06:07:56'),
(10, 16, '2024-08-02', 'absent', '2024-08-10 23:37:47', '2024-08-11 00:49:54'),
(11, 13, '2024-08-07', 'present', '2024-08-14 03:44:36', '2024-08-14 03:44:36'),
(12, 13, '2024-08-06', 'present', '2024-08-14 05:24:29', '2024-08-14 05:24:29'),
(13, 13, '2024-08-12', 'present', '2024-08-14 05:24:41', '2024-08-14 05:24:41'),
(14, 19, '2024-08-02', 'absent', '2024-08-16 05:04:52', '2024-08-17 02:43:34'),
(15, 4, '2024-08-17', 'present', '2024-08-17 02:40:50', '2024-08-17 02:41:30'),
(16, 20, '2024-08-02', 'absent', '2024-08-17 02:43:32', '2024-08-17 02:43:36'),
(17, 20, '2024-08-03', 'present', '2024-08-17 03:10:47', '2024-08-17 03:10:47'),
(18, 13, '2024-08-05', 'absent', '2024-08-17 05:57:59', '2024-08-17 05:57:59'),
(19, 13, '2024-07-17', 'present', '2024-08-22 04:50:50', '2024-08-22 04:50:50'),
(20, 13, '2024-07-18', 'present', '2024-08-22 04:50:59', '2024-08-22 04:50:59'),
(21, 13, '2024-07-04', 'present', '2024-08-22 04:51:07', '2024-08-22 04:51:07'),
(22, 13, '2024-07-08', 'absent', '2024-08-22 04:51:17', '2024-08-22 04:51:17'),
(23, 13, '2024-06-09', 'present', '2024-08-22 04:51:29', '2024-08-22 04:51:29'),
(24, 13, '2024-06-11', 'absent', '2024-08-22 04:51:36', '2024-08-22 04:51:36'),
(25, 13, '2024-06-12', 'absent', '2024-08-22 05:19:48', '2024-08-22 05:19:48'),
(26, 13, '2023-06-14', 'present', '2024-08-22 05:42:43', '2024-08-22 05:42:43'),
(27, 14, '2023-06-14', 'present', '2024-08-22 05:42:45', '2024-08-22 05:42:45'),
(28, 15, '2023-06-14', 'present', '2024-08-22 05:42:45', '2024-08-22 05:42:45'),
(29, 16, '2024-06-13', 'present', '2024-08-22 05:43:21', '2024-08-22 05:43:21'),
(30, 15, '2024-06-13', 'present', '2024-08-22 05:43:22', '2024-08-22 05:43:22'),
(31, 14, '2024-06-13', 'present', '2024-08-22 05:43:24', '2024-08-22 05:43:24'),
(32, 24, '2024-08-10', 'present', '2024-08-24 01:29:32', '2024-08-24 01:29:32'),
(33, 27, '2024-08-26', 'present', '2024-08-27 04:38:43', '2024-08-27 04:38:43'),
(34, 27, '2024-08-25', 'present', '2024-08-27 04:38:48', '2024-08-27 04:38:48'),
(35, 27, '2024-08-24', 'present', '2024-08-27 04:38:54', '2024-08-27 04:38:54'),
(36, 27, '2024-08-22', 'present', '2024-08-27 04:39:02', '2024-08-27 04:39:02'),
(37, 27, '2024-08-09', 'present', '2024-08-27 04:39:05', '2024-08-27 04:39:05'),
(38, 27, '2024-08-16', 'absent', '2024-08-27 04:39:09', '2024-08-27 04:39:09'),
(39, 27, '2024-08-14', 'present', '2024-08-27 04:39:14', '2024-08-27 04:39:14'),
(40, 27, '2024-08-13', 'absent', '2024-08-27 04:39:18', '2024-08-27 04:39:18'),
(41, 27, '2024-08-12', 'absent', '2024-08-27 04:39:22', '2024-08-27 04:39:22'),
(42, 27, '2024-07-26', 'present', '2024-08-27 04:39:41', '2024-08-27 04:39:41'),
(43, 27, '2024-07-25', 'present', '2024-08-27 04:39:46', '2024-08-27 04:39:46'),
(44, 27, '2024-07-24', 'present', '2024-08-27 04:39:50', '2024-08-27 04:39:50'),
(45, 27, '2024-07-17', 'absent', '2024-08-27 04:39:53', '2024-08-27 04:39:53'),
(46, 27, '2024-07-18', 'present', '2024-08-27 04:39:57', '2024-08-27 04:39:57'),
(47, 27, '2024-07-16', 'absent', '2024-08-27 04:40:01', '2024-08-27 04:40:01'),
(48, 27, '2024-06-28', 'present', '2024-08-27 04:40:13', '2024-08-27 04:40:13'),
(49, 27, '2024-06-27', 'present', '2024-08-27 04:40:16', '2024-08-27 04:40:16'),
(50, 27, '2024-06-25', 'absent', '2024-08-27 04:40:20', '2024-08-27 04:40:20'),
(51, 27, '2024-06-13', 'present', '2024-08-27 04:40:23', '2024-08-27 04:40:23'),
(52, 27, '2024-06-12', 'absent', '2024-08-27 04:40:27', '2024-08-27 04:40:27'),
(53, 18, '2024-08-07', 'present', '2024-08-29 06:01:52', '2024-08-29 06:01:52'),
(54, 17, '2024-08-07', 'absent', '2024-08-29 06:01:54', '2024-08-29 06:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `duration` int NOT NULL,
  `fees` int NOT NULL,
  `questions_to_ask` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deactive` int NOT NULL DEFAULT '0',
  `is_deleted` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `duration`, `fees`, `questions_to_ask`, `deactive`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'PCIT', 8, 2000, '8', 0, '0', '2024-07-31 05:39:43', '2024-08-07 00:28:20'),
(2, 'Web development', 12, 3000, '12', 0, '0', '2024-07-31 05:40:35', '2024-08-07 00:27:40'),
(3, 'Graphics Designing', 12, 2500, '10', 0, '0', '2024-07-31 05:42:39', '2024-08-07 00:27:27'),
(4, 'AI Graphics', 6, 4000, '5', 0, '0', '2024-07-31 05:43:29', '2024-08-07 00:26:43'),
(5, 'Advanced Excel', 6, 1500, '10', 0, '0', '2024-08-07 00:42:26', '2024-08-16 02:05:19'),
(6, 'Freelancing', 4, 3000, '10', 0, '0', '2024-08-07 00:43:16', '2024-08-16 02:03:30'),
(7, 'Video', 20, 1233, '12', 0, '0', '2024-08-18 01:54:42', '2024-08-18 01:54:42'),
(8, 'new', 1, 1, '12', 0, '0', '2024-08-18 01:57:45', '2024-08-18 01:57:45'),
(9, 'new', 12, 12, '12', 0, '0', '2024-08-18 01:58:21', '2024-08-18 01:58:21'),
(10, 'Web', 1, 1, '1', 0, '0', '2024-08-18 01:58:32', '2024-08-18 01:58:32'),
(11, 'w', 12, 2, '12', 1, '1', '2024-08-18 02:04:15', '2024-09-01 00:24:00'),
(12, 'Defend', 12, 12, '12', 0, '1', '2024-08-18 02:59:11', '2024-08-24 01:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int NOT NULL,
  `amount` int NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `month` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `student_id` int NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `amount`, `purpose`, `month`, `description`, `student_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 300, 'registration', '-', 's', 2, 0, '2024-08-31 21:39:55', '2024-08-31 21:39:55'),
(2, 3000, 'monthly', '8-2024', 'df', 2, 1, '2024-08-31 21:40:19', '2024-09-01 00:28:17'),
(3, 300, 'registration', '-', 'ded', 3, 1, '2024-09-01 00:29:02', '2024-09-01 00:31:25'),
(4, 300, 'registration', '-', 'df', 3, 0, '2024-09-01 00:32:54', '2024-09-01 00:32:54'),
(5, 300, 'registration', '-', 'd', 5, 1, '2024-09-01 00:33:04', '2024-09-01 00:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_08_18_224921_create_attendances_table', 0),
(2, '2024_08_18_224921_create_courses_table', 0),
(3, '2024_08_18_224921_create_fees_table', 0),
(4, '2024_08_18_224921_create_modules_table', 0),
(5, '2024_08_18_224921_create_options_table', 0),
(6, '2024_08_18_224921_create_questions_table', 0),
(7, '2024_08_18_224921_create_results_table', 0),
(8, '2024_08_18_224921_create_rooms_table', 0),
(9, '2024_08_18_224921_create_rosters_table', 0),
(10, '2024_08_18_224921_create_students_table', 0),
(11, '2024_08_18_224921_create_users_table', 0),
(12, '2024_08_18_224924_add_foreign_keys_to_attendances_table', 0),
(13, '2024_08_18_224924_add_foreign_keys_to_fees_table', 0),
(14, '2024_08_18_224924_add_foreign_keys_to_modules_table', 0),
(15, '2024_08_18_224924_add_foreign_keys_to_options_table', 0),
(16, '2024_08_18_224924_add_foreign_keys_to_questions_table', 0),
(17, '2024_08_18_224924_add_foreign_keys_to_results_table', 0),
(18, '2024_08_18_224924_add_foreign_keys_to_rosters_table', 0),
(19, '2024_08_18_224924_add_foreign_keys_to_students_table', 0),
(20, '2024_08_20_204853_create_announcements_table', 0),
(21, '2024_08_20_204853_create_attendances_table', 0),
(22, '2024_08_20_204853_create_courses_table', 0),
(23, '2024_08_20_204853_create_fees_table', 0),
(24, '2024_08_20_204853_create_modules_table', 0),
(25, '2024_08_20_204853_create_options_table', 0),
(26, '2024_08_20_204853_create_questions_table', 0),
(27, '2024_08_20_204853_create_results_table', 0),
(28, '2024_08_20_204853_create_rooms_table', 0),
(29, '2024_08_20_204853_create_rosters_table', 0),
(30, '2024_08_20_204853_create_students_table', 0),
(31, '2024_08_20_204853_create_users_table', 0),
(32, '2024_08_20_204856_add_foreign_keys_to_attendances_table', 0),
(33, '2024_08_20_204856_add_foreign_keys_to_fees_table', 0),
(34, '2024_08_20_204856_add_foreign_keys_to_modules_table', 0),
(35, '2024_08_20_204856_add_foreign_keys_to_options_table', 0),
(36, '2024_08_20_204856_add_foreign_keys_to_questions_table', 0),
(37, '2024_08_20_204856_add_foreign_keys_to_results_table', 0),
(38, '2024_08_20_204856_add_foreign_keys_to_rosters_table', 0),
(39, '2024_08_20_204856_add_foreign_keys_to_students_table', 0),
(40, '2024_08_21_204102_create_announcements_table', 0),
(41, '2024_08_21_204102_create_attendances_table', 0),
(42, '2024_08_21_204102_create_courses_table', 0),
(43, '2024_08_21_204102_create_fees_table', 0),
(44, '2024_08_21_204102_create_modules_table', 0),
(45, '2024_08_21_204102_create_options_table', 0),
(46, '2024_08_21_204102_create_questions_table', 0),
(47, '2024_08_21_204102_create_results_table', 0),
(48, '2024_08_21_204102_create_rooms_table', 0),
(49, '2024_08_21_204102_create_rosters_table', 0),
(50, '2024_08_21_204102_create_students_table', 0),
(51, '2024_08_21_204102_create_users_table', 0),
(52, '2024_08_21_204105_add_foreign_keys_to_attendances_table', 0),
(53, '2024_08_21_204105_add_foreign_keys_to_fees_table', 0),
(54, '2024_08_21_204105_add_foreign_keys_to_modules_table', 0),
(55, '2024_08_21_204105_add_foreign_keys_to_options_table', 0),
(56, '2024_08_21_204105_add_foreign_keys_to_questions_table', 0),
(57, '2024_08_21_204105_add_foreign_keys_to_results_table', 0),
(58, '2024_08_21_204105_add_foreign_keys_to_rosters_table', 0),
(59, '2024_08_21_204105_add_foreign_keys_to_students_table', 0),
(60, '2024_08_21_204231_create_announcements_table', 0),
(61, '2024_08_21_204231_create_attendances_table', 0),
(62, '2024_08_21_204231_create_courses_table', 0),
(63, '2024_08_21_204231_create_fees_table', 0),
(64, '2024_08_21_204231_create_modules_table', 0),
(65, '2024_08_21_204231_create_options_table', 0),
(66, '2024_08_21_204231_create_questions_table', 0),
(67, '2024_08_21_204231_create_results_table', 0),
(68, '2024_08_21_204231_create_rooms_table', 0),
(69, '2024_08_21_204231_create_rosters_table', 0),
(70, '2024_08_21_204231_create_students_table', 0),
(71, '2024_08_21_204231_create_users_table', 0),
(72, '2024_08_21_204234_add_foreign_keys_to_attendances_table', 0),
(73, '2024_08_21_204234_add_foreign_keys_to_fees_table', 0),
(74, '2024_08_21_204234_add_foreign_keys_to_modules_table', 0),
(75, '2024_08_21_204234_add_foreign_keys_to_options_table', 0),
(76, '2024_08_21_204234_add_foreign_keys_to_questions_table', 0),
(77, '2024_08_21_204234_add_foreign_keys_to_results_table', 0),
(78, '2024_08_21_204234_add_foreign_keys_to_rosters_table', 0),
(79, '2024_08_21_204234_add_foreign_keys_to_students_table', 0),
(80, '2024_08_22_055052_create_announcements_table', 0),
(81, '2024_08_22_055052_create_attendances_table', 0),
(82, '2024_08_22_055052_create_courses_table', 0),
(83, '2024_08_22_055052_create_fees_table', 0),
(84, '2024_08_22_055052_create_modules_table', 0),
(85, '2024_08_22_055052_create_options_table', 0),
(86, '2024_08_22_055052_create_questions_table', 0),
(87, '2024_08_22_055052_create_results_table', 0),
(88, '2024_08_22_055052_create_rooms_table', 0),
(89, '2024_08_22_055052_create_rosters_table', 0),
(90, '2024_08_22_055052_create_students_table', 0),
(91, '2024_08_22_055052_create_users_table', 0),
(92, '2024_08_22_055055_add_foreign_keys_to_attendances_table', 0),
(93, '2024_08_22_055055_add_foreign_keys_to_fees_table', 0),
(94, '2024_08_22_055055_add_foreign_keys_to_modules_table', 0),
(95, '2024_08_22_055055_add_foreign_keys_to_options_table', 0),
(96, '2024_08_22_055055_add_foreign_keys_to_questions_table', 0),
(97, '2024_08_22_055055_add_foreign_keys_to_results_table', 0),
(98, '2024_08_22_055055_add_foreign_keys_to_rosters_table', 0),
(99, '2024_08_22_055055_add_foreign_keys_to_students_table', 0),
(100, '2024_08_22_202755_create_announcements_table', 0),
(101, '2024_08_22_202755_create_attendances_table', 0),
(102, '2024_08_22_202755_create_courses_table', 0),
(103, '2024_08_22_202755_create_fees_table', 0),
(104, '2024_08_22_202755_create_modules_table', 0),
(105, '2024_08_22_202755_create_options_table', 0),
(106, '2024_08_22_202755_create_questions_table', 0),
(107, '2024_08_22_202755_create_results_table', 0),
(108, '2024_08_22_202755_create_rooms_table', 0),
(109, '2024_08_22_202755_create_rosters_table', 0),
(110, '2024_08_22_202755_create_students_table', 0),
(111, '2024_08_22_202755_create_users_table', 0),
(112, '2024_08_22_202758_add_foreign_keys_to_attendances_table', 0),
(113, '2024_08_22_202758_add_foreign_keys_to_fees_table', 0),
(114, '2024_08_22_202758_add_foreign_keys_to_modules_table', 0),
(115, '2024_08_22_202758_add_foreign_keys_to_options_table', 0),
(116, '2024_08_22_202758_add_foreign_keys_to_questions_table', 0),
(117, '2024_08_22_202758_add_foreign_keys_to_results_table', 0),
(118, '2024_08_22_202758_add_foreign_keys_to_rosters_table', 0),
(119, '2024_08_22_202758_add_foreign_keys_to_students_table', 0),
(120, '2024_08_23_052502_create_announcements_table', 0),
(121, '2024_08_23_052502_create_attendances_table', 0),
(122, '2024_08_23_052502_create_courses_table', 0),
(123, '2024_08_23_052502_create_fees_table', 0),
(124, '2024_08_23_052502_create_modules_table', 0),
(125, '2024_08_23_052502_create_options_table', 0),
(126, '2024_08_23_052502_create_questions_table', 0),
(127, '2024_08_23_052502_create_results_table', 0),
(128, '2024_08_23_052502_create_rooms_table', 0),
(129, '2024_08_23_052502_create_rosters_table', 0),
(130, '2024_08_23_052502_create_students_table', 0),
(131, '2024_08_23_052502_create_users_table', 0),
(132, '2024_08_23_052505_add_foreign_keys_to_attendances_table', 0),
(133, '2024_08_23_052505_add_foreign_keys_to_fees_table', 0),
(134, '2024_08_23_052505_add_foreign_keys_to_modules_table', 0),
(135, '2024_08_23_052505_add_foreign_keys_to_options_table', 0),
(136, '2024_08_23_052505_add_foreign_keys_to_questions_table', 0),
(137, '2024_08_23_052505_add_foreign_keys_to_results_table', 0),
(138, '2024_08_23_052505_add_foreign_keys_to_rosters_table', 0),
(139, '2024_08_23_052505_add_foreign_keys_to_students_table', 0),
(140, '2024_09_02_031111_create_announcements_table', 0),
(141, '2024_09_02_031111_create_attendances_table', 0),
(142, '2024_09_02_031111_create_courses_table', 0),
(143, '2024_09_02_031111_create_fees_table', 0),
(144, '2024_09_02_031111_create_modules_table', 0),
(145, '2024_09_02_031111_create_options_table', 0),
(146, '2024_09_02_031111_create_questions_table', 0),
(147, '2024_09_02_031111_create_results_table', 0),
(148, '2024_09_02_031111_create_rooms_table', 0),
(149, '2024_09_02_031111_create_rosters_table', 0),
(150, '2024_09_02_031111_create_students_table', 0),
(151, '2024_09_02_031111_create_users_table', 0),
(152, '2024_09_02_031114_add_foreign_keys_to_attendances_table', 0),
(153, '2024_09_02_031114_add_foreign_keys_to_fees_table', 0),
(154, '2024_09_02_031114_add_foreign_keys_to_modules_table', 0),
(155, '2024_09_02_031114_add_foreign_keys_to_options_table', 0),
(156, '2024_09_02_031114_add_foreign_keys_to_questions_table', 0),
(157, '2024_09_02_031114_add_foreign_keys_to_results_table', 0),
(158, '2024_09_02_031114_add_foreign_keys_to_rosters_table', 0),
(159, '2024_09_02_031114_add_foreign_keys_to_students_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `course_id` int NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `course_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Microsoft Word', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(2, 'Microsoft Excel', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(3, 'Microsoft Powerpoint', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(4, 'Web Designing', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(5, 'Graphics Designing', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(6, 'Computer Hardware', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(7, 'Networking', 1, 0, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(8, 'HTML', 2, 0, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(9, 'CSS', 2, 0, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(10, 'JavaScript', 2, 0, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(11, 'Bootstrap', 2, 0, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(13, 'PHP', 2, 0, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(14, 'Laravel', 2, 0, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(15, 'React', 2, 1, '2024-07-31 05:40:35', '2024-08-22 18:50:03'),
(16, 'Wordpress', 2, 0, '2024-07-31 05:41:03', '2024-07-31 05:41:24'),
(17, 'Adobe Photoshop', 3, 0, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(18, 'Adobe Illustrator', 3, 0, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(19, 'Coreldraw', 3, 0, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(20, 'Adobe InDesign', 3, 0, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(21, 'Canva', 3, 0, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(22, 'Advanced Photoshop', 4, 0, '2024-07-31 05:43:29', '2024-07-31 05:43:29'),
(23, 'Prompt Engineering', 4, 0, '2024-07-31 05:43:29', '2024-07-31 05:43:29'),
(24, 'Word Basics', 4, 0, '2024-08-07 00:42:26', '2024-08-18 02:08:55'),
(25, 'Excel Basics', 5, 0, '2024-08-07 00:42:26', '2024-08-07 00:42:26'),
(26, 'Excel Advanced', 5, 0, '2024-08-07 00:42:26', '2024-08-07 00:42:26'),
(27, 'Fiverr', 6, 0, '2024-08-07 00:43:16', '2024-08-07 00:43:16'),
(28, 'Upwork', 6, 1, '2024-08-07 00:43:16', '2024-08-20 01:17:13'),
(29, '12', 8, 0, '2024-08-18 01:57:45', '2024-08-18 01:57:45'),
(30, '34', 8, 0, '2024-08-18 01:57:45', '2024-08-18 01:57:45'),
(31, 'as', 9, 0, '2024-08-18 01:58:21', '2024-08-18 01:58:21'),
(32, 'dd', 9, 0, '2024-08-18 01:58:21', '2024-08-18 01:58:21'),
(33, 'a', 10, 0, '2024-08-18 01:58:32', '2024-08-18 01:58:32'),
(34, 'sd', 11, 0, '2024-08-18 02:04:15', '2024-08-18 02:04:15'),
(35, 'adsss', 11, 1, '2024-08-18 02:04:15', '2024-08-18 02:04:32'),
(36, 'Word', 5, 1, '2024-08-18 02:13:21', '2024-08-18 02:24:30'),
(37, 'sd', 5, 0, '2024-08-18 02:55:57', '2024-08-18 02:55:57'),
(38, 'dd', 12, 0, '2024-08-18 02:59:11', '2024-08-18 02:59:11'),
(39, 's', 12, 0, '2024-08-18 02:59:11', '2024-08-18 02:59:11'),
(40, 'Free', 6, 0, '2024-08-20 01:26:01', '2024-08-20 01:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int NOT NULL,
  `correct_option` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `other_options` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `question_id` int NOT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `correct_option`, `other_options`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 'Hyper Text Markup Language', '[\"Home Tool Markup Language\",\"Hyperlinks Text Mark Language\",\"Hyperlinks and Text Markup Language\"]', 1, '2024-08-01 20:00:26', '2024-08-01 20:00:26'),
(2, '<style>', '[\"<css>\",\"<script>\",\"<link>\"]', 2, '2024-08-01 20:01:06', '2024-08-01 20:01:06'),
(3, 'style', '[\"font\",\"styles\",\"class\"]', 3, '2024-08-01 20:01:45', '2024-08-01 20:01:45'),
(4, 'background-color', '[\"color\",\"bgcolor\",\"background\"]', 4, '2024-08-01 20:02:31', '2024-08-01 20:02:31'),
(5, '/* this is a comment */', '[\"\\/\\/ this is a comment\",\"<!-- this is a comment -->\",\"this is a comment\"]', 5, '2024-08-01 20:03:21', '2024-08-01 20:03:21'),
(6, 'font-family', '[\"font-weight\",\"font-style\",\"font-size\"]', 6, '2024-08-01 20:03:43', '2024-08-01 20:03:43'),
(7, '<ul>', '[\"<ol>\",\"<li>\",\"<list>\"]', 7, '2024-08-01 20:04:06', '2024-08-01 20:04:06'),
(8, '<a href=\"http://www.example.com\">Example</a>', '[\"<link href=\\\"http:\\/\\/www.example.com\\\">Example<\\/link>\",\"<a url=\\\"http:\\/\\/www.example.com\\\">Example<\\/a>\",\"<url href=\\\"http:\\/\\/www.example.com\\\">Example<\\/url>\"]', 8, '2024-08-01 20:04:32', '2024-08-01 20:04:32'),
(9, '<table>', '[\"<tbl>\",\"<t>\",\"<tb>\"]', 9, '2024-08-01 20:05:07', '2024-08-01 20:05:18'),
(10, 'font-size', '[\"font-style\",\"text-size\",\"text-style\"]', 10, '2024-08-01 20:05:57', '2024-08-01 20:05:57'),
(11, '<input type=\"checkbox\">', '[\"<checkbox>\",\"<check>\",\"<input type=\\\"check\\\">\"]', 11, '2024-08-01 20:07:01', '2024-08-01 20:07:01'),
(12, '<select>', '[\"<list>\",\"<dropdown>\",\"<ul>\"]', 12, '2024-08-01 20:07:32', '2024-08-01 20:07:32'),
(13, 'font-weight', '[\"font-style\",\"text-decoration\",\"text-transform\"]', 13, '2024-08-01 20:08:09', '2024-08-01 20:08:09'),
(14, '<ol>', '[\"<ul>\",\"<list>\",\"<numlist>\"]', 14, '2024-08-01 20:08:35', '2024-08-01 20:08:35'),
(15, 'alt', '[\"title\",\"src\",\"longdesc\"]', 15, '2024-08-01 20:09:01', '2024-08-01 20:09:01'),
(16, 'Adobe Illustrator', '[\"Adobe Photoshop\",\"CorelDRAW\",\"GIMP\"]', 16, '2024-08-01 20:20:48', '2024-08-01 20:20:48'),
(17, 'Red, Green, Blue', '[\"Red, Green, Black\",\"Red, Gray, Blue\",\"Red, Gold, Blue\"]', 17, '2024-08-01 20:21:24', '2024-08-01 20:21:24'),
(18, 'TIFF', '[\"JPEG\",\"PNG\",\"GIF\"]', 18, '2024-08-01 20:21:45', '2024-08-01 20:21:45'),
(19, 'Home', '[\"Insert\",\"Design\",\"Layout\"]', 19, '2024-08-01 20:22:15', '2024-08-01 20:22:15'),
(20, 'Ctrl + B', '[\"Ctrl + I\",\"Ctrl + U\",\"Ctrl + O\"]', 20, '2024-08-01 20:22:45', '2024-08-01 20:22:45'),
(21, 'Show/Hide', '[\"Word Count\",\"Track Changes\",\"Find and Replace\"]', 21, '2024-08-01 20:23:15', '2024-08-01 20:23:15'),
(22, 'Dots Per Inch', '[\"Depth Per Image\",\"Design Per Inch\",\"Dots Per Image\"]', 22, '2024-08-01 20:24:02', '2024-08-01 20:24:02'),
(23, 'CMYK', '[\"RGB\",\"HSL\",\"HEX\"]', 23, '2024-08-01 20:26:31', '2024-08-01 20:26:31'),
(24, 'To ensure that the design extends beyond the trim edge', '[\"To add color to the edges\",\"To highlight important areas\",\"To create a border\"]', 24, '2024-08-01 20:27:02', '2024-08-01 20:27:02'),
(25, 'Eyedropper Tool', '[\"Move Tool\",\"Magic Wand Tool\",\"Brush Tool\"]', 25, '2024-08-01 20:27:27', '2024-08-01 20:27:27'),
(26, 'Arial', '[\"Times New Roman\",\"Georgia\",\"Garamond\"]', 26, '2024-08-01 20:27:58', '2024-08-01 20:27:58'),
(27, 'The space between characters', '[\"The space between lines of text\",\"The thickness of a font\",\"The style of a font\"]', 27, '2024-08-01 20:28:21', '2024-08-01 20:28:21'),
(28, 'PNG', '[\"JPEG\",\"BMP\",\"GIF\"]', 28, '2024-08-01 20:28:53', '2024-08-01 20:28:53'),
(29, 'Adobe Photoshop', '[\"Adobe Illustrator\",\"CorelDRAW\",\"InDesign\"]', 29, '2024-08-01 20:33:21', '2024-08-01 20:33:21'),
(30, 'Photoshop Document', '[\"Photo Style Document\",\"Portable Style Document\",\"Photoshop Design\"]', 30, '2024-08-01 20:33:51', '2024-08-01 20:33:51'),
(31, 'Balance', '[\"Contrast\",\"Proximity\",\"Repetition\"]', 31, '2024-08-01 20:34:18', '2024-08-01 20:34:18'),
(32, 'GIF', '[\"PNG\",\"JPEG\",\"SVG\"]', 32, '2024-08-01 20:35:15', '2024-08-01 20:35:15'),
(33, 'SUM()', '[\"TOTAL()\",\"ADD()\",\"COUNT()\"]', 33, '2024-08-01 20:38:38', '2024-08-01 20:38:38'),
(34, '=', '[\"#\",\"@\",\"&\"]', 34, '2024-08-01 20:39:03', '2024-08-01 20:39:03'),
(35, 'Insert', '[\"Home\",\"Page Layout\",\"Data\"]', 35, '2024-08-01 20:39:39', '2024-08-01 20:39:39'),
(36, 'Normal', '[\"Slide Sorter\",\"Slide Show\",\"Reading\"]', 36, '2024-08-01 20:40:59', '2024-08-01 20:40:59'),
(37, 'Ctrl + M', '[\"Ctrl + N\",\"Ctrl + S\",\"Ctrl + O\"]', 37, '2024-08-01 20:41:22', '2024-08-01 20:41:22'),
(38, 'Slide Master', '[\"Slide Sorter\",\"Slide Layout\",\"Slide Design\"]', 38, '2024-08-01 20:41:44', '2024-08-01 20:41:44'),
(39, 'Local Area Network', '[\"Large Area Network\",\"Light Area Network\",\"Long Area Network\"]', 39, '2024-08-01 20:42:09', '2024-08-01 20:42:09'),
(40, 'Router', '[\"Hub\",\"Switch\",\"Modem\"]', 40, '2024-08-01 20:42:37', '2024-08-01 20:42:37'),
(41, 'POP3', '[\"HTTP\",\"FTP\",\"SMTP\"]', 41, '2024-08-01 20:43:11', '2024-08-01 20:43:11'),
(42, 'Artificial Intelligence', '[\"Artificial Illustration\",\"Automatic Imaging\",\"Advanced Illustration\"]', 42, '2024-08-01 20:46:53', '2024-08-01 20:46:53'),
(43, 'DeepArt', '[\"Adobe Photoshop\",\"Adobe Illustrator\",\"CorelDRAW\"]', 43, '2024-08-01 20:47:29', '2024-08-01 20:47:29'),
(44, 'DALL-E', '[\"DeepDream\",\"StyleGAN\",\"Prisma\"]', 44, '2024-08-01 20:47:56', '2024-08-01 20:47:56'),
(45, 'Generative Adversarial Networks (GANs)', '[\"Supervised Learning\",\"Reinforcement Learning\",\"Clustering\"]', 45, '2024-08-01 20:48:51', '2024-08-01 20:48:51'),
(46, 'Neural Style Transfer', '[\"Image Classification\",\"Object Detection\",\"Semantic Segmentation\"]', 46, '2024-08-01 20:49:15', '2024-08-01 20:49:15'),
(47, 'Automated and faster creation of designs', '[\"Increased manual effort\",\"Limited creativity\",\"Higher cost\"]', 47, '2024-08-01 20:49:43', '2024-08-01 20:49:43'),
(48, 's', '[\"w\",\"s\",\"s\"]', 48, '2024-08-18 03:15:12', '2024-08-18 03:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `question` varchar(700) COLLATE utf8mb4_general_ci NOT NULL,
  `course_id` int NOT NULL,
  `is_deleted` int NOT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `course_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'What does HTML stand for?', 2, 0, '2024-08-01 20:00:26', '2024-08-01 20:00:26'),
(2, 'Which HTML tag is used to define an internal style sheet?', 2, 0, '2024-08-01 20:01:06', '2024-08-01 20:01:06'),
(3, 'Which HTML attribute is used to define inline styles?', 2, 0, '2024-08-01 20:01:45', '2024-08-01 20:01:45'),
(4, 'Which CSS property is used to change the background color?', 2, 0, '2024-08-01 20:02:31', '2024-08-01 20:02:31'),
(5, 'How do you insert a comment in a CSS file?', 2, 0, '2024-08-01 20:03:21', '2024-08-01 20:03:21'),
(6, 'Which property is used to change the font of an element?', 2, 0, '2024-08-01 20:03:43', '2024-08-01 20:03:43'),
(7, 'Which HTML tag is used to define an unordered list?', 2, 0, '2024-08-01 20:04:06', '2024-08-01 20:04:06'),
(8, 'How do you create a link in HTML?', 2, 0, '2024-08-01 20:04:32', '2024-08-01 20:04:32'),
(9, 'Which HTML tag is used to define a table?', 2, 0, '2024-08-01 20:05:07', '2024-08-01 20:05:07'),
(10, 'Which CSS property controls the text size?', 2, 0, '2024-08-01 20:05:57', '2024-08-01 20:05:57'),
(11, 'Which tag is used to create a checkbox in HTML?', 2, 0, '2024-08-01 20:07:01', '2024-08-01 20:07:01'),
(12, 'Which tag is used to create a drop-down list in HTML?', 2, 0, '2024-08-01 20:07:32', '2024-08-01 20:07:32'),
(13, 'Which CSS property is used to make text bold?', 2, 0, '2024-08-01 20:08:09', '2024-08-01 20:08:09'),
(14, 'How do you create a numbered list in HTML?', 2, 0, '2024-08-01 20:08:35', '2024-08-01 20:08:35'),
(15, 'Which HTML attribute specifies an alternate text for an image, if the image cannot be displayed?', 2, 1, '2024-08-01 20:09:01', '2024-09-01 00:38:38'),
(16, 'Which tool is commonly used for creating vector graphics?', 3, 0, '2024-08-01 20:20:48', '2024-08-01 20:20:48'),
(17, 'What does RGB stand for in graphic design?', 3, 0, '2024-08-01 20:21:24', '2024-08-01 20:21:24'),
(18, 'Which file format is typically used for high-quality print graphics?', 3, 0, '2024-08-01 20:21:45', '2024-08-01 20:21:45'),
(19, 'Which tab on the Ribbon do you use to change the font size?', 1, 0, '2024-08-01 20:22:15', '2024-08-01 20:22:15'),
(20, 'How do you make text bold in Microsoft Word?', 1, 0, '2024-08-01 20:22:45', '2024-08-01 20:22:45'),
(21, 'Which feature allows you to see hidden formatting symbols?', 1, 0, '2024-08-01 20:23:15', '2024-08-01 20:23:15'),
(22, 'What does DPI stand for?', 3, 0, '2024-08-01 20:24:02', '2024-08-01 20:24:02'),
(23, 'Which color model is used for print design?', 3, 0, '2024-08-01 20:26:31', '2024-08-01 20:26:31'),
(24, 'What is the purpose of a ‘bleed’ in printing?', 3, 0, '2024-08-01 20:27:02', '2024-08-01 20:27:02'),
(25, 'Which tool is used to select colors in Adobe Photoshop?', 3, 0, '2024-08-01 20:27:27', '2024-08-01 20:27:27'),
(26, 'Which of these is a commonly used sans-serif font?', 3, 0, '2024-08-01 20:27:58', '2024-08-01 20:27:58'),
(27, 'What does the term ‘kerning’ refer to?', 3, 0, '2024-08-01 20:28:21', '2024-08-01 20:28:21'),
(28, 'Which file format is best for preserving the quality of a logo with a transparent background?', 3, 0, '2024-08-01 20:28:53', '2024-08-01 20:28:53'),
(29, 'Which software is primarily used for photo editing?', 3, 0, '2024-08-01 20:33:21', '2024-08-01 20:33:21'),
(30, 'What does the acronym PSD stand for?', 3, 0, '2024-08-01 20:33:51', '2024-08-01 20:33:51'),
(31, 'Which design principle focuses on the arrangement of elements to create a sense of stability?', 3, 0, '2024-08-01 20:34:18', '2024-08-01 20:34:18'),
(32, 'Which file format is commonly used for web graphics that require animation?', 3, 0, '2024-08-01 20:35:15', '2024-08-01 20:35:15'),
(33, 'Which function is used to calculate the sum of a range of cells in Excel?', 1, 0, '2024-08-01 20:38:38', '2024-08-01 20:38:38'),
(34, 'How do you start a formula in Excel?', 1, 0, '2024-08-01 20:39:03', '2024-08-01 20:39:03'),
(35, 'Which tab contains the option to create a chart in Excel?', 1, 0, '2024-08-01 20:39:39', '2024-08-01 20:39:39'),
(36, 'Which view is used to edit the content of individual slides?', 1, 0, '2024-08-01 20:40:59', '2024-08-01 20:40:59'),
(37, 'How do you add a new slide in PowerPoint?', 1, 0, '2024-08-01 20:41:22', '2024-08-01 20:41:22'),
(38, 'Which feature allows you to apply consistent formatting to all slides in a presentation?', 1, 0, '2024-08-01 20:41:44', '2024-08-01 20:41:44'),
(39, 'What does LAN stand for?', 1, 0, '2024-08-01 20:42:09', '2024-08-01 20:42:09'),
(40, 'Which device is used to connect multiple networks together?', 1, 0, '2024-08-01 20:42:37', '2024-08-01 20:42:37'),
(41, 'What protocol is used to receive emails?', 1, 0, '2024-08-01 20:43:11', '2024-08-01 20:43:11'),
(42, 'What does AI stand for in the context of graphics?', 4, 0, '2024-08-01 20:46:53', '2024-08-01 20:46:53'),
(43, 'Which software is widely used for creating AI-generated graphics?', 4, 0, '2024-08-01 20:47:29', '2024-08-01 20:47:29'),
(44, 'Which AI tool is known for turning text descriptions into images?', 4, 0, '2024-08-01 20:47:56', '2024-08-01 20:47:56'),
(45, 'What technique allows AI to generate new images by learning from a dataset of images?', 4, 0, '2024-08-01 20:48:51', '2024-08-01 20:48:51'),
(46, 'Which AI technique is used to add artistic styles to images?', 4, 0, '2024-08-01 20:49:15', '2024-08-01 20:49:15'),
(47, 'What is a primary benefit of using AI in graphic design?', 4, 0, '2024-08-01 20:49:43', '2024-08-01 20:49:43'),
(48, 'wed', 5, 0, '2024-08-18 03:15:12', '2024-08-18 03:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int NOT NULL,
  `correct_answers` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `wrong_answers` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `skipped_questions` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `is_deleted` int NOT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `correct_answers`, `wrong_answers`, `skipped_questions`, `user_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '2', '1', '2', 7, 0, '2024-08-15 05:27:18', '2024-08-15 05:27:18'),
(2, '5', '6', '1', 40, 1, '2024-08-31 02:12:02', '2024-09-01 00:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `name` varchar(10) NOT NULL,
  `seats` varchar(10) NOT NULL,
  `is_deleted` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `seats`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'A', '14', '0', '2024-07-31 05:32:50', '2024-07-31 05:32:50'),
(2, 'B', '7', '0', '2024-07-31 05:32:59', '2024-07-31 05:35:45'),
(3, 'C', '20', '0', '2024-07-31 05:35:55', '2024-07-31 05:36:54'),
(4, 'D', '20', '1', '2024-07-31 05:36:03', '2024-09-01 00:37:22'),
(5, 'E', '12', '0', '2024-08-18 01:47:15', '2024-08-18 01:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `rosters`
--

CREATE TABLE `rosters` (
  `id` int NOT NULL,
  `admin_id` int NOT NULL,
  `room_id` int NOT NULL,
  `timing` varchar(50) NOT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rosters`
--

INSERT INTO `rosters` (`id`, `admin_id`, `room_id`, `timing`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '8-9', 0, '2024-08-08 03:00:15', '2024-08-11 03:08:01'),
(2, 27, 3, '6-7', 0, '2024-08-08 03:41:05', '2024-08-11 03:09:56'),
(3, 1, 1, '4-5', 0, '2024-08-08 17:00:24', '2024-08-24 01:42:56'),
(4, 1, 3, '2-3', 0, '2024-08-11 00:58:11', '2024-08-11 03:09:29'),
(5, 25, 1, '6-7', 0, '2024-08-11 01:50:53', '2024-08-11 02:05:00'),
(6, 2, 3, '1-2', 1, '2024-08-11 03:04:52', '2024-09-01 00:55:44'),
(7, 2, 2, '15-16', 0, '2024-08-11 03:34:53', '2024-08-11 03:34:53'),
(8, 1, 3, '17-18', 1, '2024-08-11 03:40:42', '2024-09-01 00:55:32'),
(9, 32, 2, '14-15', 1, '2024-08-17 00:52:38', '2024-08-24 00:54:28'),
(10, 25, 3, '14-15', 0, '2024-08-18 00:57:17', '2024-08-18 01:12:34'),
(11, 32, 4, '13-14', 1, '2024-08-18 01:12:53', '2024-09-01 00:55:31'),
(12, 32, 3, '12-13', 1, '2024-08-18 01:13:22', '2024-08-24 00:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `gr_no` varchar(50) NOT NULL,
  `course_id` int NOT NULL,
  `discount` int NOT NULL,
  `annual_fees` int NOT NULL,
  `total_modules` json NOT NULL,
  `completed_modules` json NOT NULL,
  `room` int NOT NULL,
  `seat` varchar(10) NOT NULL,
  `timing` varchar(20) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `exclude` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `gr_no`, `course_id`, `discount`, `annual_fees`, `total_modules`, `completed_modules`, `room`, `seat`, `timing`, `shift`, `status`, `exclude`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SS-000001', 4, 0, 0, '[]', '[22, 23]', 3, '5', '15-16', 'weekend', 'pending', 0, 7, '2022-07-31 05:54:29', '2024-08-15 05:27:18'),
(2, 'SS-000002', 4, 0, 0, '[]', '[]', 2, '2', '17-18', 'weekend', 'running', 1, 8, '2022-07-31 05:56:46', '2024-09-05 05:26:51'),
(3, 'SS-000003', 2, 0, 0, '[]', '[]', 1, '7', '4-5', 'regular', 'running', 0, 9, '2022-07-31 05:59:31', '2024-07-31 05:59:31'),
(4, 'SS-000004', 3, 0, 0, '[]', '[]', 3, '5', '2-3', 'weekend', 'running', 0, 10, '2022-07-31 06:09:46', '2024-07-31 06:09:46'),
(5, 'SS-000005', 4, 0, 0, '[]', '[]', 3, '4', '11-12', 'weekend', 'running', 0, 11, '2022-07-31 06:12:02', '2024-07-31 06:12:02'),
(6, 'SS-000006', 1, 0, 0, '[]', '[]', 1, '3', '4-5', 'regular', 'running', 0, 12, '2023-07-31 06:14:15', '2024-07-31 06:14:15'),
(7, 'SS-000007', 3, 0, 0, '[]', '[]', 1, '5', '15-16', 'regular', 'running', 0, 13, '2023-07-31 06:15:41', '2024-08-13 06:01:39'),
(8, 'SS-000008', 2, 0, 0, '[]', '[]', 1, '7', '4-5', 'regular', 'running', 0, 14, '2023-07-31 06:17:46', '2024-07-31 06:17:46'),
(9, 'SS-000009', 1, 0, 0, '[]', '[]', 3, '19', '18-19', 'regular', 'running', 0, 15, '2023-07-31 06:20:23', '2024-08-28 02:16:38'),
(10, 'SS-000010', 2, 0, 0, '[]', '[]', 3, '8', '15-16', 'regular', 'running', 0, 16, '2023-07-31 06:22:49', '2024-07-31 06:22:49'),
(11, 'SS-000011', 3, 0, 0, '[]', '[]', 3, '12', '17-18', 'regular', 'running', 0, 17, '2023-07-31 06:26:15', '2024-07-31 06:26:15'),
(12, 'SS-000012', 3, 0, 0, '[]', '[]', 3, '16', '15-16', 'regular', 'running', 0, 18, '2023-07-31 06:28:31', '2024-08-06 05:11:35'),
(13, 'SS-000013', 2, 0, 56000, '[]', '[]', 3, '16', '17-18', 'regular', 'running', 0, 19, '2023-08-31 06:30:01', '2024-08-24 00:38:35'),
(14, 'SS-000014', 2, 0, 0, '[]', '[]', 3, '18', '17-18', 'regular', 'running', 0, 20, '2024-07-31 06:31:30', '2024-07-31 06:31:30'),
(15, 'SS-000015', 2, 0, 0, '[]', '[]', 3, '15', '17-18', 'regular', 'running', 0, 21, '2024-07-31 06:37:14', '2024-08-06 05:09:07'),
(16, 'SS-000016', 4, 0, 0, '[]', '[]', 3, '7', '17-18', 'weekend', 'running', 0, 22, '2024-08-06 02:11:38', '2024-08-06 04:49:15'),
(17, 'SS-000017', 2, 0, 0, '[]', '[]', 3, '3', '17-18', 'regular', 'running', 0, 23, '2024-08-06 02:13:15', '2024-08-06 02:13:15'),
(18, 'SS-000018', 4, 0, 0, '[]', '[]', 3, '8', '17-18', 'weekend', 'running', 0, 24, '2024-08-06 02:15:41', '2024-08-08 16:58:00'),
(19, 'SS-000019', 3, 0, 80000, '[]', '[]', 3, '14', '17-18', 'regular', 'running', 0, 26, '2024-08-06 03:14:32', '2024-08-06 05:09:00'),
(20, 'SS-000020', 2, 12, 26400, '[8, 9, 10, 11, 13, 14, 16]', '[]', 3, '9', '13-14', 'regular', 'running', 1, 28, '2024-08-07 01:39:14', '2024-09-05 20:30:41'),
(21, 'SS-000021', 2, 0, 36000, '[]', '[8, 9, 11, 10, 14, 13, 15]', 3, '4', '17-18', 'weekend', 'done', 0, 30, '2024-08-11 04:47:39', '2024-08-12 18:31:44'),
(22, 'SS-000022', 4, 0, 24000, '[]', '[]', 3, '16', '19-20', 'weekend', 'passed-out', 0, 31, '2024-08-17 00:47:45', '2024-08-17 02:22:29'),
(23, 'SS-000023', 5, 0, 9000, '[]', '[25, 26, 37]', 4, '17', '19-20', 'regular', 'completed', 0, 35, '2024-08-18 01:39:11', '2024-08-18 02:57:44'),
(24, 'SS-000024', 3, 0, 30000, '[]', '[]', 4, '1', '14-15', 'regular', 'pending', 0, 36, '2024-08-18 22:21:10', '2024-08-18 22:24:05'),
(25, 'SS-000025', 6, 0, 12000, '[27, 28]', '[27, 28]', 3, '2', '17-18', 'regular', 'completed', 0, 38, '2024-08-20 01:07:12', '2024-08-20 01:25:32'),
(26, 'SS-000026', 2, 0, 36000, '[8, 9, 10, 11, 13, 14, 15, 16]', '[8]', 3, '5', '17-18', 'regular', 'freezed', 0, 39, '2024-08-22 18:48:57', '2024-09-01 00:43:23'),
(27, 'SS-000027', 2, 0, 24660, '[8, 9, 10, 11, 13, 14, 15, 16]', '[8, 9, 10, 15, 13, 11, 16, 14]', 3, '1', '13-14', 'weekend', 'done', 0, 40, '2024-08-24 01:36:42', '2024-08-31 02:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cnic_bform_no` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_pic` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `is_deleted` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `father_name`, `cnic_bform_no`, `date_of_birth`, `email`, `password`, `mobile_no`, `profile_pic`, `address`, `role`, `token`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Azam', 'Ashraf', '4220167890123', '2007-07-01', 'muhammad.azam@simsatedu.com', '$2y$12$3K0JAX1sgZ2.oZI1AHd9G.bg88SsQiqk59ENvuPjC.SCcs705s2RK', '03112666802', 'admin_profile_pics/sNZnQkoGyZK22jBcAqUJ5ARUzYPGJ4J4v5mYagaO.jpg', 'House#11 (near choti market), Block#11, Area#37-B, Noor Manzil, Landhi#1, Karachi.', 'super_admin', '-1', '0', '2024-07-31 05:19:29', '2024-07-31 05:19:29'),
(2, 'Dexter Watts', 'Watts', '1234567890123', '2000-02-01', 'dexter.watts@simsatedu.com', '$2y$12$eZJZlc2JmtpYidBoy6vIyuqRcV6LVmJfKfE0Mm2cxLsrfx6snc.H6', '12345678901', 'admin_profile_pics/dA5WFnXI9XXA3dgj4EeapczeDTvuZFee1G3l1jpk.jpg', 'Korangi#2', 'admin', '-1', '0', '2024-07-31 05:25:59', '2024-07-31 05:25:59'),
(3, 'Logan Barnes', 'Barnes', '1234567890123', '1994-06-20', 'logan.barnes@simsatedu.com', '$2y$12$lCCuAEpKaDX3l9kRbnY0wOBGSRookWk0RREiJtg1q4V8/OPz0o/2m', '12121212121', 'admin_profile_pics/NlrLkxZKLeqVLb6vjzO3Sua03MHduDJPqkORlnRc.jpg', 'Street#1, Shah Faisal, Karachi.', 'admin', '-1', '0', '2024-07-31 05:27:21', '2024-07-31 05:27:21'),
(4, 'James Hunt', 'Hunt', '1212121212121', '2002-10-09', 'james.hunt@simsatedu.com', '$2y$12$zX0/X9JDLddZe2EJEZX2kueJGTwzKUx/8b4pj/ZxSwwqkSfz1V5Qa', '03101122334', 'admin_profile_pics/kupJJ8mQ5lsplh5sZI4B4xKwsdeYTJonHnTLrB3w.jpg', 'DHA Phase 2', 'admin', '-1', '0', '2024-07-31 05:28:36', '2024-07-31 05:36:21'),
(5, 'Ronnie Holt', 'Holt', '1212121212121', '1990-07-24', 'ronnie.holt@simsatedu.com', '$2y$12$6Id31np2Nsal206GZ5csbON1eV2Fjl59LTxwekrAk6Nm69AMxB4oi', '12121212121', 'admin_profile_pics/GiA0XakNl4L8lUrGZ79Kg4x6NJmFjlYYxkW0MPv8.jpg', 'House#12, Street#2, Kemari, Karachi.', 'admin', '-1', '0', '2024-07-31 05:30:33', '2024-07-31 05:30:33'),
(6, 'Ricardo Paul', 'Paul', '1234567890123', '2007-03-20', 'ricardo.paul@simsatedu.com', '$2y$12$WXvIimR8KEWHW2btKSW1zu7jUbXzoFX88n214X7CCxPWf4kZTV9iq', '12121212121', 'admin_profile_pics/7yR1RXrV1w5ynyKUJaIa29f3qomeRR90zTXSipql.jpg', 'Sohrab Goth, Karachi.', 'admin', '-1', '0', '2024-07-31 05:32:22', '2024-07-31 05:34:14'),
(7, 'Talha Sheikh', 'Nasir', '1234567890123', '2000-03-12', 'talha.sheikh@simsatedu.com', '12', '12121212121', 'student_profile_pics/cWSC5ncNxZPgAWxPcyjNbKx1yHCXixoRiklZ8w2T.jpg', 'Tariq Road, Karachi', 'student', '-1', '0', '2024-07-31 05:54:29', '2024-07-31 05:54:29'),
(8, 'Anas Malik', 'Malik', '1212121212129', '2001-03-12', 'anas.malik@simsatedu.com', '12', '12121212121', 'student_profile_pics/QSa1yFhFRTpX7As0VC8R31rGFym6EDlxzVvOTGc9.jpg', 'Quaid-e-abad, Karachi.', 'student', '-1', '0', '2024-07-31 05:56:46', '2024-08-08 17:03:42'),
(9, 'Shayan Khan', 'Salman', '1212121212121', '2000-04-12', 'shayan.khan@simsatedu.com', '12', '12121212121', 'student_profile_pics/ovAgI7hpwUNObQWXJ8vMEzfKPw8fseKgX95kluuk.jpg', '2B Landhi, Karachi', 'student', '-1', '0', '2024-07-31 05:59:31', '2024-07-31 05:59:31'),
(10, 'Abdul Qadir', 'Irfan', '1111111111111', '1999-02-11', 'abdul.qadir@simsatedu.com', '12', '12121212121', 'student_profile_pics/fcIL2HSGg3ZiPQZ3wdNyEZ6n0AxbOx0T7Aezp6JK.jpg', 'Malir, karachi', 'student', '-1', '0', '2024-07-31 06:09:46', '2024-07-31 06:09:46'),
(11, 'Mubashir Altaf', 'Anees', '1212121212121', '2009-09-01', 'mubashir.altaf@simsatedu.com', '12', '12121212121', 'student_profile_pics/OWXo2UIZ6e3O5RFWtW73LMDutRhhdHsrwnyJpc2H.jpg', 'Landhi#4, Karachi.', 'student', '-1', '0', '2024-07-31 06:12:02', '2024-07-31 06:12:02'),
(12, 'Abid Qasim', 'Waqas', '1212121212121', '2001-04-20', 'abid.qasim@simsatedu.com', '12', '12111212121', 'student_profile_pics/SxpMhM31uyyynYzXIzeDw9B15koHqyRxmVkpG8wg.jpg', 'Lal qila\r\nNear Burj Khalifa', 'student', '-1', '0', '2024-07-31 06:14:15', '2024-07-31 06:14:15'),
(13, 'Haris Ansari', 'Sohail', '1212121212127', '1999-03-20', 'haris.ansari@simsatedu.com', '12', '12121212121', 'student_profile_pics/7ubuaFcHpHPt466Cc16lSENhb25v0e1GiL0pkkqk.jpg', 'Zamanabad , Landhi, Karachi', 'student', '-1', '0', '2024-07-31 06:15:41', '2024-08-13 06:01:39'),
(14, 'Faizan Quresh', 'Raees', '1212121212121', '1992-09-20', 'faizan.quresh@simsatedu.com', '12', '12121212121', 'student_profile_pics/G7aX8WaDTvNsqCbuIN7tiojVqKPi34EDNfYxakDL.jpg', 'Shahrah-e-Faisal, Karachi.', 'student', '-1', '0', '2024-07-31 06:17:46', '2024-07-31 06:17:46'),
(15, 'Abdullah Quresh', 'Aslam', '1212121212121', '3333-02-12', 'abdullah.quresh@simsatedu.com', '12', '12121212121', 'student_profile_pics/cA6VXOwOs8y2BZCPktoMUmHsMlJmQibBxF0YfO5n.jpg', 'Karachi', 'student', '-1', '0', '2024-07-31 06:20:23', '2024-07-31 06:20:23'),
(16, 'Rafay Sheikh', 'Saleem', '1212121212121', '2222-02-22', 'rafay.sheikh@simsatedu.com', '12', '12121212121', 'student_profile_pics/or9xIdJlOtSq00JFG1As8jYhkHV6qrlWc30Oqcko.jpg', 'Lal qila\r\nNear Burj Khalifa', 'student', '-1', '0', '2024-07-31 06:22:49', '2024-07-31 06:22:49'),
(17, 'Shahzaib Ahmed', 'Sagir', '1212121212121', '1993-03-31', 'shahzaib.ahmed@simsatedu.com', '12', '12121212121', 'student_profile_pics/56iHDtqFN9MENsA04WyG1zQgvLWVstFT72I6738L.jpg', 'West Karachi', 'student', '-1', '0', '2024-07-31 06:26:15', '2024-07-31 06:26:15'),
(18, 'Muzammil Jutt', 'Sahab', '1212121212121', '1111-11-11', 'muzammil.jutt@simsatedu.com', '12', '12121212121', 'student_profile_pics/KBYxWRRKqUKbwcOZQsber41FrKL52DJGncShFDN3.jpg', 'South Karchi', 'student', '-1', '0', '2024-07-31 06:28:31', '2024-07-31 06:28:31'),
(19, 'Basil Waqar', 'Waqar', '1212121212133', '1999-03-22', 'basil.waqar@simsatedu.com', '12', '12121212121', 'student_profile_pics/9tAMLm4UeAaqJtYKsYvhFhxVHm9ivnXyHKGD8mrT.jpg', 'North Nazimabad', 'student', '-1', '0', '2024-07-31 06:30:01', '2024-08-06 05:10:33'),
(20, 'Yasir Malik', 'Qusair', '1212121212121', '2003-04-22', 'yasir.malik@simsatedu.com', '12', '12121212121', 'student_profile_pics/i3nwz09elMlvXV0eyHRC3ujrwh7gslatkJEX2YXo.jpg', 'Lal qila\r\nNear Burj Khalifa', 'student', '-1', '0', '2024-07-31 06:31:30', '2024-07-31 06:31:30'),
(21, 'Syed Abdullah', 'Asim', '1212121212121', '1993-02-22', 'syed.abdullah@simsatedu.com', '12', '12121212121', 'student_profile_pics/3RU5HBrOstN9sFMxOn6GJEVXHuruCwKpRJr5HHcE.jpg', 'New Karachi', 'student', '-1', '0', '2024-07-31 06:37:14', '2024-07-31 06:37:14'),
(22, 'Abdul Qadir', 'Irfan', '1234567890123', '2222-02-11', 'abdul.qadir_1@simsatedu.com', '12', '12121212121', 'student_profile_pics/HefLOVaJU8nDPZu7rFRTUe1VMzeChLpzadAKQ98b.jpg', 'Karachi, Pakistan', 'student', '-1', '0', '2024-08-06 02:11:38', '2024-08-06 02:11:38'),
(23, 'Abdul Qadir', 'Irfan', '1212121212121', '1111-11-12', 'abdul.qadir_2@simsatedu.com', '12', '12121212121', 'student_profile_pics/LjrH9IRDxVfTlOz8Zrozg957we2xUUts2iaLrbg1.jpg', 'Karachi', 'student', '-1', '0', '2024-08-06 02:13:15', '2024-08-06 02:13:15'),
(24, 'Shakeel Ahmed', 'Saif', '1212121212125', '1111-11-11', 'shakeel.ahmed@simsatedu.com', '12', '12121212121', 'student_profile_pics/GmoFhcznha7TM4xEJIQFyqbx2uarPacxwIv4hq3C.jpg', 'Quaidabad', 'student', '-1', '0', '2024-08-06 02:15:41', '2024-08-06 04:51:37'),
(25, 'Shaakir Ahmed', 'Sumair', '1212121212123', '2223-03-12', 'shaakir.ahmed@simsatedu.com', '$2y$12$oJ80HM/e0aQr.0vqNTfdvONlMkACF7NGekiufQOOMeKH5VGDM.gdW', '12121212121', 'admin_profile_pics/2bi185NU35ovAWxVZDTkwwGZYug3anKxHpzDfOl9.jpg', 'Lal qila\r\nNear Burj Khalifa', 'admin', '-1', '1', '2024-08-06 02:57:15', '2024-09-01 00:20:20'),
(26, 'Wasim Sheikh', 'Danial', '1212121212122', '3444-02-22', 'wasim.sheikh@simsatedu.com', '12', '12121212121', 'student_profile_pics/bbkq9ifF6epoYKVOVsk1Ov4rImct0GcUOmGHe49t.jpg', 'Karachi', 'student', '-1', '1', '2024-08-06 03:14:32', '2024-09-01 00:43:24'),
(27, 'Shaakir Ahmed', 'Saif', '1234561234561', '3333-11-22', 'shaakir.ahmed_1@simsatedu.com', '$2y$12$YRpo0x0yoNUi7fDLh2PDWunkbwVFrjaFKrd.nMfQkgjsyQRVFp6ie', '12121212121', 'admin_profile_pics/gNvtXvMym1hnPJs3PknQjNfaTqYu2zXasrQws55V.jpg', 'Karacxhi', 'admin', '-1', '0', '2024-08-06 05:18:11', '2024-08-17 01:35:51'),
(28, 'Sameer Sheikh', 'Aslam', '1212121212345', '1112-03-23', 'sameer.sheikh@simsatedu.com', '12', '12121212121', 'student_profile_pics/QRS2pRlIQLqYiXhjGlWXcNlRLz4cFR32FC40GtyS.jpg', 'Lal qila\r\nNear Burj Khalifa', 'student', '-1', '0', '2024-08-07 01:39:14', '2024-08-07 01:39:14'),
(30, 'Hussain Saad', 'Saad', '1212121212134', '0321-02-13', 'hussain.saad@simsatedu.com', '12', '12121212121', 'student_profile_pics/r4nYie8ByTr059YMwueFw4LrAAQBFw0FDZesqVR9.jpg', 'asd', 'student', '-1', '0', '2024-08-11 04:47:39', '2024-08-11 04:47:39'),
(31, 'Saad Ali', 'Ali', '1234567890456', '0032-02-23', 'saad.ali@simsatedu.com', '12', '12121212121', '0', 'qq', 'student', '-1', '0', '2024-08-17 00:47:45', '2024-08-17 01:34:15'),
(32, 'Faizan Ansari', 'Ansari', '1212121212121', '0032-02-23', 'faizan.ansari@simsatedu.com', '$2y$12$dn2jtUPie547NYG31qG.aenkkBxfmMkIBnO50Wn3SxTX20Ks6SyV6', '12121212121', '0', 'ww', 'admin', '-1', '0', '2024-08-17 00:52:13', '2024-08-17 01:35:16'),
(33, 'Muhammad Saif', 'Aleem', '1212121212121', '2024-08-02', 'muhammad.saif@simsatedu.com', '$2y$12$JPiWkGSiXPZXM/rrzwV1bO3/plKa8No8q3u/m/e9cUt60HhJ.9G7i', '03333333333', '0', 'Lal qila\r\nNear Burj Khalifa', 'admin', '-1', '0', '2024-08-18 00:16:51', '2024-08-18 00:16:51'),
(34, 'Nehal Saif', 'Waqas', '1212121212121', '2024-08-08', 'nehal.saif@simsatedu.com', '$2y$12$NsmlqxUxmIOsajU0OVD5SuL6NNahm8N8Wyx5pMcAWutK6u6xfpQyq', '12121212121', 'admin_profile_pics/Umv9ToMBdxNoAAdihOzFK5oHxaQarbTgMky4FN9e.jpg', 'aas', 'admin', '-1', '0', '2024-08-18 00:49:58', '2024-08-18 00:53:53'),
(35, 'Waqar Saad', 'Saad', '1212121212121', '0012-12-12', 'waqar.saad@simsatedu.com', '12', '12121212121', 'student_profile_pics/FtLhx3xwiis4Zyrk7xho9pd9uObuJm0FmQH1ZyJh.png', 's', 'student', '-1', '0', '2024-08-18 01:39:11', '2024-08-18 22:15:19'),
(36, 'Muhammad Azam', 'a', '1212121212121', '23232-02-21', 'muhammad.azam_1@simsatedu.com', '12', '03333333333', 'student_profile_pics/cstCP7xwuutz270Y6UiV8OGRYYsyx2Cu8H4D5wc2.png', 'Lal qila\r\nNear Burj Khalifa', 'student', '-1', '0', '2024-08-18 22:21:10', '2024-08-24 01:14:39'),
(37, 'Danil qw', 'qw', '1212121212121', '0012-12-12', 'danil.qw@simsatedu.com', '$2y$12$z7cUShrQK2r12HgiUuHC0ekuBI34hkyRc0hAPg/LRh4.349TsMoAK', '12121212121', 'admin_profile_pics/q0xuYPIlqGhzEwxzuXAVVcHNQVP3pEhkVKroNt5g.png', 'q', 'admin', '-1', '1', '2024-08-18 22:29:44', '2024-08-24 00:53:42'),
(38, 'Sumain Abbas', 'Abbas', '1212121212121', '0012-12-12', 'sumain.abbas@simsatedu.com', '12', '12121212121', '0', 'qwewewe', 'student', '-1', '1', '2024-08-20 01:07:12', '2024-08-24 01:06:10'),
(39, 'Ali Abbas', 'Abbas', '1212121212121', '0012-12-12', 'ali.abbas@simsatedu.com', '12', '12121212121', '0', 'qq', 'student', '-1', '1', '2024-08-22 18:48:56', '2024-09-01 00:43:23'),
(40, 'Faraz Aslam', 'Aslam', '1212121212121', '2024-12-01', 'faraz.aslam@simsatedu.com', '12', '12121212121', 'student_profile_pics/x8O5PP6s7X3IClw9fMEBGNAWvbzU9qeF724ZQDjk.png', 's', 'student', '-1', '0', '2024-08-24 01:36:42', '2024-08-31 04:03:44'),
(41, 'Saad Ali', 'Ali', '4220112345678', '2007-07-01', 'saad.ali_1@simsatedu.com', '$2y$12$WCux1x5d2X.exOTp.d4xtOxega7zr33TYUR8Rg7z.fpu5AqQtIoUu', '03112666802', 'admin_profile_pics/ScJF9bi0qBuiCJLHdQjl8EnZRPcNILLfu8yFWU7i.jpg', 'DHA Phase 6, Karachi, Pakistan', 'admin', '-1', '0', '2024-08-25 05:31:33', '2024-08-25 05:31:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rosters`
--
ALTER TABLE `rosters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room` (`room`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rosters`
--
ALTER TABLE `rosters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rosters`
--
ALTER TABLE `rosters`
  ADD CONSTRAINT `rosters_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rosters_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `students_ibfk_5` FOREIGN KEY (`room`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
