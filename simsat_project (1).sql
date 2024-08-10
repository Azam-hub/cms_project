-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2024 at 12:09 AM
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
(6, 20, '2024-08-08', 'absent', '2024-08-08 05:30:28', '2024-08-08 06:10:15'),
(7, 17, '2024-08-08', 'present', '2024-08-08 06:01:15', '2024-08-08 06:01:15'),
(8, 14, '2024-08-08', 'present', '2024-08-08 06:01:18', '2024-08-08 06:07:22'),
(9, 18, '2024-08-08', 'absent', '2024-08-08 06:07:56', '2024-08-08 06:07:56');

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
  `is_deleted` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `created_at` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `duration`, `fees`, `questions_to_ask`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'PCIT', 8, 2000, '8', '0', '2024-07-31 05:39:43', '2024-08-07 00:28:20'),
(2, 'Web development', 12, 3000, '12', '0', '2024-07-31 05:40:35', '2024-08-07 00:27:40'),
(3, 'Graphics Designing', 12, 2500, '10', '0', '2024-07-31 05:42:39', '2024-08-07 00:27:27'),
(4, 'AI Graphics', 6, 4000, '5', '0', '2024-07-31 05:43:29', '2024-08-07 00:26:43'),
(5, 'Advanced Excel', 6, 1500, '10', '0', '2024-08-07 00:42:26', '2024-08-07 00:42:26'),
(6, 'Freelancing', 4, 3000, '10', '0', '2024-08-07 00:43:16', '2024-08-07 00:43:16');

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
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `amount`, `purpose`, `month`, `description`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 4000, 'monthly', '7-2024', 'July', 20, '', ''),
(2, 4000, 'monthly', '8-2024', 'August', 20, '', ''),
(3, 3000, 'monthly', '12-2024', 'December', 20, '', ''),
(4, 2200, 'monthly', '1-2025', 'Januray Fees submitted.', 20, '2024-08-07 20:02:44', '2024-08-07 20:02:44'),
(5, 5000, 'monthly', '4-2025', 'Feb and Mar freezed.', 20, '2024-08-07 20:08:58', '2024-08-07 20:08:58'),
(6, 8200, 'monthly', '5-2025', 'All', 20, '2024-08-07 20:10:07', '2024-08-07 20:10:07'),
(7, 5000, 'examination', '-', 'ss', 20, '2024-08-07 20:11:26', '2024-08-07 20:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `course_id` int NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Microsoft Word', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(2, 'Microsoft Excel', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(3, 'Microsoft Powerpoint', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(4, 'Web Designing', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(5, 'Graphics Designing', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(6, 'Computer Hardware', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(7, 'Networking', 1, '2024-07-31 05:39:43', '2024-07-31 05:39:43'),
(8, 'HTML', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(9, 'CSS', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(10, 'JavaScript', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(11, 'Bootstrap', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(13, 'PHP', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(14, 'Laravel', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(15, 'React', 2, '2024-07-31 05:40:35', '2024-07-31 05:40:35'),
(16, 'Wordpress', 2, '2024-07-31 05:41:03', '2024-07-31 05:41:24'),
(17, 'Adobe Photoshop', 3, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(18, 'Adobe Illustrator', 3, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(19, 'Coreldraw', 3, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(20, 'Adobe InDesign', 3, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(21, 'Canva', 3, '2024-07-31 05:42:39', '2024-07-31 05:42:39'),
(22, 'Advanced Photoshop', 4, '2024-07-31 05:43:29', '2024-07-31 05:43:29'),
(23, 'Prompt Engineering', 4, '2024-07-31 05:43:29', '2024-07-31 05:43:29'),
(24, 'Word Basics', 5, '2024-08-07 00:42:26', '2024-08-07 00:42:26'),
(25, 'Excel Basics', 5, '2024-08-07 00:42:26', '2024-08-07 00:42:26'),
(26, 'Excel Advanced', 5, '2024-08-07 00:42:26', '2024-08-07 00:42:26'),
(27, 'Fiverr', 6, '2024-08-07 00:43:16', '2024-08-07 00:43:16'),
(28, 'Upwork', 6, '2024-08-07 00:43:16', '2024-08-07 00:43:28');

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
(47, 'Automated and faster creation of designs', '[\"Increased manual effort\",\"Limited creativity\",\"Higher cost\"]', 47, '2024-08-01 20:49:43', '2024-08-01 20:49:43');

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
(15, 'Which HTML attribute specifies an alternate text for an image, if the image cannot be displayed?', 2, 0, '2024-08-01 20:09:01', '2024-08-01 20:09:01'),
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
(47, 'What is a primary benefit of using AI in graphic design?', 4, 0, '2024-08-01 20:49:43', '2024-08-01 20:49:43');

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
(4, 'D', '20', '0', '2024-07-31 05:36:03', '2024-07-31 05:36:03');

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
(1, 2, 4, '8-9', 0, '2024-08-08 03:00:15', '2024-08-08 03:37:46'),
(2, 27, 3, '6-7', 0, '2024-08-08 03:41:05', '2024-08-08 06:21:51'),
(3, 1, 3, '9-10', 0, '2024-08-08 17:00:24', '2024-08-08 21:02:50');

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
  `completed_modules` json NOT NULL,
  `room` int NOT NULL,
  `seat` varchar(10) NOT NULL,
  `timing` varchar(20) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `gr_no`, `course_id`, `discount`, `annual_fees`, `completed_modules`, `room`, `seat`, `timing`, `shift`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SS-000001', 4, 0, 0, '[]', 3, '5', '3-4', 'weekend', 'running', 7, '2024-07-31 05:54:29', '2024-07-31 05:54:29'),
(2, 'SS-000002', 4, 0, 0, '[]', 2, '2', '5-6', 'weekend', 'running', 8, '2024-07-31 05:56:46', '2024-08-08 17:18:12'),
(3, 'SS-000003', 2, 0, 0, '[]', 1, '7', '9-10', 'regular', 'running', 9, '2024-07-31 05:59:31', '2024-07-31 05:59:31'),
(4, 'SS-000004', 3, 0, 0, '[]', 2, '5', '4-5', 'regular', 'running', 10, '2024-07-31 06:09:46', '2024-07-31 06:09:46'),
(5, 'SS-000005', 4, 0, 0, '[]', 3, '4', '9-10', 'weekend', 'running', 11, '2024-07-31 06:12:02', '2024-07-31 06:12:02'),
(6, 'SS-000006', 1, 0, 0, '[]', 4, '3', '4-5', 'regular', 'running', 12, '2024-07-31 06:14:15', '2024-07-31 06:14:15'),
(7, 'SS-000007', 3, 0, 0, '[]', 1, '5', '3-4', 'regular', 'running', 13, '2024-07-31 06:15:41', '2024-07-31 06:15:41'),
(8, 'SS-000008', 2, 0, 0, '[]', 1, '7', '3-4', 'regular', 'running', 14, '2024-07-31 06:17:46', '2024-07-31 06:17:46'),
(9, 'SS-000009', 1, 0, 0, '[]', 3, '19', '6-7', 'regular', 'running', 15, '2024-07-31 06:20:23', '2024-07-31 06:20:23'),
(10, 'SS-000010', 2, 0, 0, '[]', 3, '8', '3-4', 'regular', 'running', 16, '2024-07-31 06:22:49', '2024-07-31 06:22:49'),
(11, 'SS-000011', 3, 0, 0, '[]', 3, '12', '9-10', 'regular', 'running', 17, '2024-07-31 06:26:15', '2024-07-31 06:26:15'),
(12, 'SS-000012', 3, 0, 0, '[]', 3, '16', '3-4', 'regular', 'running', 18, '2024-07-31 06:28:31', '2024-08-06 05:11:35'),
(13, 'SS-000013', 2, 0, 0, '[]', 3, '16', '9-10', 'regular', 'running', 19, '2024-07-31 06:30:01', '2024-08-06 05:11:30'),
(14, 'SS-000014', 2, 0, 0, '[]', 3, '18', '9-10', 'regular', 'running', 20, '2024-07-31 06:31:30', '2024-07-31 06:31:30'),
(15, 'SS-000015', 2, 0, 0, '[]', 3, '15', '9-10', 'regular', 'running', 21, '2024-07-31 06:37:14', '2024-08-06 05:09:07'),
(16, 'SS-000016', 4, 0, 0, '[]', 3, '7', '9-10', 'weekend', 'running', 22, '2024-08-06 02:11:38', '2024-08-06 04:49:15'),
(17, 'SS-000017', 2, 0, 0, '[]', 3, '3', '9-10', 'regular', 'running', 23, '2024-08-06 02:13:15', '2024-08-06 02:13:15'),
(18, 'SS-000018', 4, 0, 0, '[]', 3, '8', '9-10', 'weekend', 'running', 24, '2024-08-06 02:15:41', '2024-08-08 16:58:00'),
(19, 'SS-000019', 3, 0, 0, '[]', 3, '14', '9-10', 'regular', 'running', 26, '2024-08-06 03:14:32', '2024-08-06 05:09:00'),
(20, 'SS-000020', 3, 12, 26400, '[]', 3, '9', '9-10', 'regular', 'running', 28, '2024-08-07 01:39:14', '2024-08-08 21:02:21');

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
(13, 'Haris Ansari', 'Sohail', '1212121212121', '1999-03-20', 'haris.ansari@simsatedu.com', '12', '12121212121', 'student_profile_pics/7ubuaFcHpHPt466Cc16lSENhb25v0e1GiL0pkkqk.jpg', 'Zamanabad , Landhi, Karachi', 'student', '-1', '0', '2024-07-31 06:15:41', '2024-07-31 06:15:41'),
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
(25, 'Shaakir Ahmed', 'Sumair', '1212121212123', '2223-03-12', 'shaakir.ahmed@simsatedu.com', '$2y$12$oJ80HM/e0aQr.0vqNTfdvONlMkACF7NGekiufQOOMeKH5VGDM.gdW', '12121212121', 'admin_profile_pics/2bi185NU35ovAWxVZDTkwwGZYug3anKxHpzDfOl9.jpg', 'Lal qila\r\nNear Burj Khalifa', 'admin', '-1', '0', '2024-08-06 02:57:15', '2024-08-06 03:03:41'),
(26, 'Wasim Sheikh', 'Danial', '1212121212122', '3444-02-22', 'wasim.sheikh@simsatedu.com', '12', '12121212121', 'student_profile_pics/bbkq9ifF6epoYKVOVsk1Ov4rImct0GcUOmGHe49t.jpg', 'Karachi', 'student', '-1', '0', '2024-08-06 03:14:32', '2024-08-06 03:14:32'),
(27, 'Shaakir Ahmed', 'Saif', '1234561234561', '3333-11-22', 'shaakir.ahmed_1@simsatedu.com', '$2y$12$YRpo0x0yoNUi7fDLh2PDWunkbwVFrjaFKrd.nMfQkgjsyQRVFp6ie', '12121212121', 'admin_profile_pics/UC3NnoWLYPhThS8M7Su1kWDBve29ZahPQN314J20.jpg', 'Karacxhi', 'admin', '-1', '0', '2024-08-06 05:18:11', '2024-08-06 05:18:11'),
(28, 'Sameer Sheikh', 'Aslam', '1212121212345', '1112-03-23', 'sameer.sheikh@simsatedu.com', '12', '12121212121', 'student_profile_pics/QRS2pRlIQLqYiXhjGlWXcNlRLz4cFR32FC40GtyS.jpg', 'Lal qila\r\nNear Burj Khalifa', 'student', '-1', '0', '2024-08-07 01:39:14', '2024-08-07 01:39:14');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rosters`
--
ALTER TABLE `rosters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
