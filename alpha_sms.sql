-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 01:42 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpha_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `des` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `des`) VALUES
(1, 'Full Admin', 'This admin type has access to everything and can edit all data from the system!'),
(2, 'Office Personnel', 'Monitors the system by adding needed data into it. Can add, edit and or delete teachers, students, classes, courses and print report cards'),
(3, 'Accounting Department', 'Will have control over accounting Dashboard and will be able to manage student payments and account balances');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass_md5` varchar(255) NOT NULL,
  `pass_txt` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`id`, `email`, `pass_md5`, `pass_txt`, `status`, `type`, `deleted`, `edited_on`, `created_on`) VALUES
(4, 'edgarandrei1791@outlook.com', 'ee76d0cb0a1b7a5e7f2f092ae2cffcf9', 'Godislove1791', 1, 1, 0, '2019-07-16 00:25:14', '2019-07-16 00:25:14'),
(12, 'test2_email@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 0, 2, 0, '2019-09-22 23:15:44', '2019-07-16 00:49:35'),
(13, 'office@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 0, 3, 0, '2019-09-22 05:00:25', '2019-09-22 05:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cell` varchar(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `education` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `name`, `middle`, `last`, `email`, `cell`, `address`, `position`, `education`, `description`, `image`) VALUES
(4, 'Andrei', 'Edgar', 'Chan', 'edgarandrei1791@outlook.com', '627-7534', 'San Rafael St., Tial Farm Village, Orange Walk Town', 'General Manager', 'Masters Degree in Computer Science, Bachelors in Secondary Education', 'Self motivated person, willing to excel in all aspects of life.', '3cb4bb56656b3dcd920e34a2cb2dc6a7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `expiry_date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `allow_upload` int(11) NOT NULL,
  `ex_disable` int(11) NOT NULL,
  `attachments` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `teacher_id`, `class_id`, `course_id`, `title`, `des`, `expiry_date`, `time`, `allow_upload`, `ex_disable`, `attachments`, `status`, `deleted`, `edited_on`, `created_on`) VALUES
(51, 2, 1, 2, 'The five (5) W in Essays', 'This page features authentic sample assignments that you can view or download to help you develop and enhance your academic writing skills. They include academic essays, reports, case studies as well as reflective writing.', 'Sept 18, 2019', '01:00:00', 1, 1, 1, 1, 0, '2019-09-15 06:48:56', '2019-09-15 05:27:23'),
(52, 1, 2, 1, 'Sample Assignment 1', 'This is a sample assignment for the class Track 7 Level 2 on their Social Studies subject...', 'Sep 21, 2019', '23:59:00', 1, 1, 1, 1, 0, '2019-09-21 18:30:36', '2019-09-21 18:30:36'),
(53, 2, 1, 2, 'Sample Assignment', 'description', 'Sep 27, 2019', '08:31:00', 1, 1, 1, 1, 0, '2019-09-26 21:32:44', '2019-09-26 21:32:44'),
(54, 2, 2, 4, 'Physics Assignment 1', 'This is a physics sample assignment.. ', 'Sep 30, 2019', '00:59:00', 1, 1, 1, 1, 0, '2019-09-28 03:31:24', '2019-09-28 03:31:24'),
(55, 2, 1, 2, 'Sample Assignment', 'asdfasdf', 'Sep 30, 2019', '12:00:00', 1, 1, 1, 1, 0, '2019-09-28 18:38:50', '2019-09-28 18:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `ass_files`
--

CREATE TABLE `ass_files` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `new_name` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `path` varchar(200) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ass_files`
--

INSERT INTO `ass_files` (`id`, `assignment_id`, `new_name`, `name`, `path`, `edited_on`, `created_on`) VALUES
(1, 47, '5ebfcf3b2a3043b91734386778b6cf41.jpg', '20181223_203559.jpg', 'custom/uploads/teachers/files/', '2019-09-08 00:04:26', '2019-09-08 00:04:26'),
(2, 47, 'db242b989dd2d71a93d4d4f33fc20150.jpg', '20181223_203608.jpg', 'custom/uploads/teachers/files/', '2019-09-08 00:04:26', '2019-09-08 00:04:26'),
(3, 47, 'b9cdb27409f904721acbceca90d97dfc.jpg', '20181223_203620.jpg', 'custom/uploads/teachers/files/', '2019-09-08 00:04:26', '2019-09-08 00:04:26'),
(4, 48, 'f21934f7ba2621c50e91b6763f4facab.jpg', '20190315_160627_001.jpg', 'custom/uploads/teachers/files/', '2019-09-08 02:45:46', '2019-09-08 02:45:46'),
(5, 48, 'b857d1f8b3047b4d2756152243318297.jpg', '20190315_160630.jpg', 'custom/uploads/teachers/files/', '2019-09-08 02:45:46', '2019-09-08 02:45:46'),
(6, 48, 'd80b94d172ece44ec8224cd148019952.jpg', '20190315_160642.jpg', 'custom/uploads/teachers/files/', '2019-09-08 02:45:46', '2019-09-08 02:45:46'),
(7, 49, '1ab8f6fea26d312f13a243bac23d410a.jpg', 'WWW.YIFY-TORRENTS.COM.jpg', 'custom/uploads/teachers/files/', '2019-09-08 15:56:56', '2019-09-08 15:56:56'),
(8, 50, '1a95a4b9df16c19556468f9551c51add.jpg', 'owitvet.jpg', 'custom/uploads/teachers/files/', '2019-09-11 21:33:05', '2019-09-11 21:33:05'),
(9, 50, '281d4283a8e2e47b94cb82c84e0a80b1.jpeg', 'WhatsApp Image 2019-08-19 at 1.32.34 PM.jpeg', 'custom/uploads/teachers/files/', '2019-09-11 21:33:05', '2019-09-11 21:33:05'),
(10, 50, '3f487c7e6b189519a6c350d00879d618.jpeg', 'WhatsApp Image 2019-08-19 at 1.33.10 PM.jpeg', 'custom/uploads/teachers/files/', '2019-09-11 21:33:05', '2019-09-11 21:33:05'),
(11, 51, 'c1fd7cc6db1385d7951be10c12bae870.png', 'img2_edited.fw.png', 'custom/uploads/teachers/files/', '2019-09-13 05:27:24', '2019-09-13 05:27:24'),
(12, 51, '65902d2dc575bf2678232cf000a67cb0.png', 'img3.fw.png', 'custom/uploads/teachers/files/', '2019-09-13 05:27:24', '2019-09-13 05:27:24'),
(13, 51, '7d4d3127e6b9bb11fedc08c5b5b4ba67.jpg', 'owitvet.jpg', 'custom/uploads/teachers/files/', '2019-09-13 05:27:24', '2019-09-13 05:27:24'),
(14, 52, 'aaf608d58794ba735e52cd2655226556.jpeg', 'WhatsApp Image 2019-08-19 at 1.32.34 PM.jpeg', 'custom/uploads/teachers/files/', '2019-09-21 18:30:36', '2019-09-21 18:30:36'),
(15, 52, '354e55f9ea038a80c65e1ae2c9f32d32.jpeg', 'WhatsApp Image 2019-08-19 at 1.33.10 PM.jpeg', 'custom/uploads/teachers/files/', '2019-09-21 18:30:36', '2019-09-21 18:30:36'),
(16, 53, 'fb6c24fbaf90b889139dcae9e88b4519.png', 'ass logo.png', 'custom/uploads/teachers/files/', '2019-09-26 21:32:45', '2019-09-26 21:32:45'),
(17, 53, '7797a696b574980323759753d9754471.png', 'img1.fw.png', 'custom/uploads/teachers/files/', '2019-09-26 21:32:45', '2019-09-26 21:32:45'),
(18, 53, '10542521f5b2ec2df2b7f45ba8803a9b.png', 'img2.fw.png', 'custom/uploads/teachers/files/', '2019-09-26 21:32:46', '2019-09-26 21:32:46'),
(19, 54, 'c317b0507d2352d1ef9b35a856612926.jpg', 'me.jpg', 'custom/uploads/teachers/files/', '2019-09-28 03:31:24', '2019-09-28 03:31:24'),
(20, 55, 'a1e630e474308a1eb9a7801fb61ccc34.png', 'ass logo.png', 'custom/uploads/teachers/files/', '2019-09-28 18:38:51', '2019-09-28 18:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `ass_student_files`
--

CREATE TABLE `ass_student_files` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `original` varchar(100) NOT NULL,
  `server_name` varchar(255) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `attendance` int(11) NOT NULL,
  `remarks` varchar(300) NOT NULL,
  `school_year` varchar(50) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `class_id`, `course_id`, `student_id`, `date`, `attendance`, `remarks`, `school_year`, `edited_on`, `created_on`) VALUES
(113, 1, 2, 4, '2019-10-03', 1, 'some text', '2018-2019', '2019-10-04 00:09:40', '2019-10-03 23:08:29'),
(114, 1, 2, 5, '2019-10-03', 2, 'sick', '2018-2019', '2019-10-04 00:10:09', '2019-10-03 23:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `level` varchar(20) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `deleted` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `level`, `description`, `deleted`, `created_on`, `edited_on`) VALUES
(1, 'Track 1', 'Level 1', 'some desc. here', 0, '2019-07-17 05:52:00', '2019-07-17 05:52:00'),
(2, 'Track 7', 'Level 2', 'another desc. here', 0, '2019-07-21 07:24:13', '2019-08-07 04:37:26'),
(3, 'Track 11', 'Level 3', 'Electrical & AC & Refrigeration', 0, '2019-07-21 07:30:16', '2019-07-21 07:30:16'),
(4, 'Track 1 Test', 'Level 2', 'Electrical & AC & Refrigeration - Testing', 0, '2019-07-21 17:30:19', '2019-08-08 21:25:48'),
(5, 'Track 2', 'Level 1', 'Welding, Automechanics and Building & Grounds', 1, '2019-08-07 03:50:54', '2019-08-07 03:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `short` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `short`, `name`, `description`, `status`, `deleted`, `edited_on`, `created_on`) VALUES
(1, 'SS001', 'Social Studies', 'Students study the history of the Caribbean as well as the basic ethics of a human being. ', 1, 0, '2019-08-09 02:31:11', '2019-08-09 00:19:30'),
(2, 'BGM', 'Building and Grounds Maintenance', 'Students learn to take care of the basic building', 1, 0, '2019-08-09 02:30:15', '2019-08-09 02:00:23'),
(3, 'IT012', 'Information Technology', 'Students learn to use a computer and develop basic computer skills', 1, 0, '2019-08-19 18:16:54', '2019-08-19 18:16:54'),
(4, 'Phy001', 'Physics', 'Students learn about basic laws of gravity and how to calculate forces and pressure', 1, 0, '2019-08-30 16:09:44', '2019-08-30 16:09:44'),
(5, 'Sample Course', 'SC001', 'some description', 1, 0, '2019-09-28 18:42:19', '2019-09-28 18:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `course_to_class`
--

CREATE TABLE `course_to_class` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `modules` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_to_class`
--

INSERT INTO `course_to_class` (`id`, `class_id`, `course_id`, `teacher_id`, `modules`, `status`, `deleted`, `edited_on`, `created_on`) VALUES
(1, 1, 1, 3, 5, 1, 0, '2019-08-21 01:01:45', '2019-08-19 05:18:33'),
(2, 1, 2, 2, 7, 1, 0, '2019-08-21 01:02:43', '2019-08-19 18:15:39'),
(3, 1, 3, 1, 8, 1, 0, '2019-08-19 18:17:15', '2019-08-19 18:17:15'),
(5, 2, 3, 4, 12, 1, 0, '2019-08-20 02:10:47', '2019-08-20 02:10:47'),
(6, 2, 4, 2, 10, 1, 0, '2019-08-30 16:10:47', '2019-08-30 16:10:47'),
(9, 2, 1, 1, 8, 1, 0, '2019-09-06 07:06:13', '2019-09-06 07:06:13'),
(10, 2, 2, 1, 3, 1, 0, '2019-09-06 07:06:31', '2019-09-06 07:06:31'),
(11, 1, 5, 4, 9, 1, 0, '2019-09-28 18:42:41', '2019-09-28 18:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `d_events`
--

CREATE TABLE `d_events` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `table_name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL,
  `bground` varchar(20) NOT NULL,
  `border` varchar(20) NOT NULL,
  `deleted` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_events`
--

INSERT INTO `d_events` (`id`, `owner_id`, `table_name`, `title`, `color`, `bground`, `border`, `deleted`, `created_on`) VALUES
(38, 4, 'admin_log', 'Classes Resume', '#fff', 'rgb(0, 192, 239)', 'rgb(0, 192, 239)', 1, '2019-08-28 17:59:59'),
(39, 4, 'admin_log', 'Orientation Week', '#fff', 'rgb(240, 18, 190)', 'rgb(240, 18, 190)', 1, '2019-08-28 18:00:46'),
(40, 4, 'admin_log', 'Staff Meeting', '#fff', 'rgb(0, 166, 90)', 'rgb(0, 166, 90)', 1, '2019-08-28 18:01:22'),
(41, 4, 'admin_log', 'Independence Day', '#fff', 'rgb(0, 31, 63)', 'rgb(0, 31, 63)', 1, '2019-08-28 18:02:22'),
(42, 4, 'admin_log', 'School Parade', '#fff', 'rgb(243, 156, 18)', 'rgb(243, 156, 18)', 1, '2019-08-28 18:02:46'),
(43, 2, 'teachers_log', 'Edgar Birthday', '#fff', 'rgb(0, 31, 63)', 'rgb(0, 31, 63)', 0, '2019-08-28 23:51:50'),
(44, 2, 'teachers_log', 'Private Event', '#fff', 'rgb(96, 92, 168)', 'rgb(96, 92, 168)', 0, '2019-08-29 00:02:31'),
(45, 4, 'admin_log', 'School Trip', '#fff', 'rgb(221, 75, 57)', 'rgb(221, 75, 57)', 0, '2019-09-08 15:51:09'),
(46, 4, 'admin_log', 'Sample', '#fff', 'rgb(243, 156, 18)', 'rgb(243, 156, 18)', 0, '2019-09-11 21:23:36'),
(47, 4, 'admin_log', 'X-mas Fair', '#fff', 'rgb(96, 92, 168)', 'rgb(96, 92, 168)', 1, '2019-09-26 21:26:22'),
(48, 4, 'admin_log', 'New Year Fair', '#fff', 'rgb(0, 166, 90)', 'rgb(0, 166, 90)', 1, '2019-09-28 18:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `mark` varchar(11) NOT NULL,
  `school_year` varchar(50) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `course_id`, `class_id`, `student_id`, `module`, `mark`, `school_year`, `edited_on`, `created_on`) VALUES
(107, 2, 1, 4, 1, '50', '2018-2019', '2019-09-01 01:10:49', '2019-09-01 01:09:53'),
(108, 2, 1, 5, 1, '75', '2018-2019', '2019-09-04 22:17:58', '2019-09-01 03:55:45'),
(109, 2, 1, 4, 2, '88', '2018-2019', '2019-09-01 03:55:54', '2019-09-01 03:55:53'),
(110, 2, 1, 4, 3, '65', '2018-2019', '2019-09-01 03:56:17', '2019-09-01 03:56:17'),
(111, 2, 1, 4, 6, '99', '2018-2019', '2019-09-01 03:56:27', '2019-09-01 03:56:26'),
(112, 2, 1, 4, 7, '53', '2018-2019', '2019-09-01 03:56:31', '2019-09-01 03:56:30'),
(113, 4, 2, 6, 2, '100', '2018-2019', '2019-09-08 15:54:19', '2019-09-08 15:54:16'),
(114, 4, 2, 8, 9, '50', '2018-2019', '2019-09-08 15:54:35', '2019-09-08 15:54:34'),
(115, 2, 1, 5, 4, '99', '2018-2019', '2019-09-11 21:30:03', '2019-09-11 21:30:02'),
(116, 4, 2, 7, 5, '50', '2018-2019', '2019-09-11 21:31:21', '2019-09-11 21:31:20'),
(117, 4, 2, 6, 10, '95', '2018-2019', '2019-09-26 20:19:06', '2019-09-26 20:19:06'),
(118, 2, 1, 5, 2, '85', '2018-2019', '2019-09-28 18:47:02', '2019-09-28 18:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE `grading` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grading`
--

INSERT INTO `grading` (`id`, `name`) VALUES
(1, 'Letter Grades'),
(2, 'Number Grades'),
(3, 'Percentage Grades');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_plans`
--

CREATE TABLE `lesson_plans` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `course` varchar(150) NOT NULL,
  `school_year` varchar(50) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `uploaded_on` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_plans`
--

INSERT INTO `lesson_plans` (`id`, `teacher_id`, `name`, `course`, `school_year`, `des`, `uploaded_on`, `file_name`, `deleted`, `edited_on`, `created_on`) VALUES
(7, 2, 'L1 T7 - M1', 'Mathematics', '2019-2020', 'some description here...', '2019-10-03', '4c7a640ef8deb235ce4ecfd5c5c4d000.jpeg', 0, '2019-10-03 19:25:56', '2019-10-03 19:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `my_events`
--

CREATE TABLE `my_events` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `d_event_id` int(11) NOT NULL,
  `owner_type` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `allDay` int(11) NOT NULL,
  `share_group` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `background` varchar(20) NOT NULL,
  `border` varchar(20) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `my_events`
--

INSERT INTO `my_events` (`id`, `owner_id`, `d_event_id`, `owner_type`, `title`, `start`, `end`, `url`, `des`, `allDay`, `share_group`, `color`, `background`, `border`, `deleted`, `edited_on`, `created_on`) VALUES
(58, 4, 38, 'admin_log', 'Classes Resume', '2019-09-09 00:00:00', '2019-09-09 00:00:00', '', '', 1, '2,3,4', '#fff', 'rgb(0, 192, 239)', 'rgb(0, 192, 239)', 0, '2019-08-28 18:05:07', '2019-08-28 18:00:11'),
(59, 4, 39, 'admin_log', 'Orientation Week', '2019-09-09 00:00:00', '2019-09-14 00:00:00', '', 'The orientation will be held at the school compound and will be starting at 9:00 am and ending at 2:30 pm. All staff and students are asked to be present 15min prior to the starting time.', 0, '2,3,4,5', '#fff', 'rgb(240, 18, 190)', 'rgb(240, 18, 190)', 0, '2019-09-25 20:13:00', '2019-08-28 18:00:52'),
(60, 4, 40, 'admin_log', 'Staff Meeting', '2019-09-13 13:00:00', '2019-09-13 16:00:00', '', '', 0, '2,3,4', '#fff', 'rgb(0, 166, 90)', 'rgb(0, 166, 90)', 0, '2019-08-28 18:04:46', '2019-08-28 18:01:26'),
(61, 4, 41, 'admin_log', 'Independence Day', '2019-09-21 00:00:00', '2019-09-21 00:00:00', '', '', 1, '1', '#fff', 'rgb(0, 31, 63)', 'rgb(0, 31, 63)', 0, '2019-08-28 18:24:02', '2019-08-28 18:02:30'),
(62, 4, 42, 'admin_log', 'School Parade', '2019-09-20 09:00:00', '2019-09-20 12:00:00', 'https://www.google.com/maps/place/18%C2%B004\'49.0%22N+88%C2%B033\'39.5%22W/@18.0802665,-88.5620783,18z/data=!3m1!4b1!4m14!1m7!3m6!1s0x8f5bf66e032f99ab:0x573b5f829841a607!2sOrange+Walk!3b1!8m2!3d18.0842472!4d-88.5710266!3m5!1s0x0:0x0!7e2!8m2!3d18.0802636!4d-88.5609842', '', 0, '2,3,4', '#fff', 'rgb(243, 156, 18)', 'rgb(243, 156, 18)', 0, '2019-08-28 18:21:58', '2019-08-28 18:02:54'),
(63, 2, 43, 'teachers_log', 'Edgar Birthday', '2019-12-12 00:00:00', '2019-12-12 00:00:00', '', '', 1, '5', '#fff', 'rgb(0, 31, 63)', 'rgb(0, 31, 63)', 0, '2019-09-12 21:34:27', '2019-08-28 23:52:04'),
(64, 2, 44, 'teachers_log', 'Private Event', '2019-08-30 00:00:00', '2019-08-30 00:00:00', 'https://www.youtube.com/', '', 1, '4,5', '#fff', 'rgb(96, 92, 168)', 'rgb(96, 92, 168)', 0, '2019-09-12 04:39:43', '2019-08-29 00:02:49'),
(65, 4, 45, 'admin_log', 'School Trip', '2019-12-12 00:00:00', '2019-12-12 00:00:00', '', '', 1, '4,5', '#fff', 'rgb(221, 75, 57)', 'rgb(221, 75, 57)', 0, '2019-09-08 15:51:44', '2019-09-08 15:51:21'),
(66, 4, 46, 'admin_log', 'Sample', '2019-11-12 00:00:00', '2019-11-12 00:00:00', '', '', 1, '3,4,5', '#fff', 'rgb(243, 156, 18)', 'rgb(243, 156, 18)', 0, '2019-09-11 21:24:05', '2019-09-11 21:23:50'),
(67, 4, 47, 'admin_log', 'X-mas Fair', '2019-12-16 00:00:00', '2019-12-16 00:00:00', '', 'The School fair will be held at the school campus. Starting at 7:00pm', 1, '3,4,5', '#fff', 'rgb(96, 92, 168)', 'rgb(96, 92, 168)', 0, '2019-09-26 21:29:22', '2019-09-26 21:26:47'),
(68, 4, 48, 'admin_log', 'New Year Fair', '2020-01-10 00:00:00', '2020-01-10 00:00:00', '', '', 1, '3,4,5', '#fff', 'rgb(0, 166, 90)', 'rgb(0, 166, 90)', 0, '2019-09-28 18:36:13', '2019-09-28 18:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schooling`
--

CREATE TABLE `schooling` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `one` varchar(50) NOT NULL,
  `two` varchar(50) NOT NULL,
  `three` varchar(50) NOT NULL,
  `four` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schooling`
--

INSERT INTO `schooling` (`id`, `name`, `one`, `two`, `three`, `four`) VALUES
(1, 'High School System', '1st Form', '2nd Form', '3rd Form', '4th Form'),
(2, 'Itvet School System', 'Level 1', 'Level 2', 'Level 3', 'Level 4'),
(3, '6th Form School System', 'Year 1', 'Year 2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `cell` varchar(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `schooling` varchar(11) NOT NULL,
  `grading` varchar(11) NOT NULL,
  `terms` varchar(1500) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  `short` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `address`, `phone`, `cell`, `email`, `schooling`, `grading`, `terms`, `start`, `end`, `short`, `image`, `edited_on`, `created_on`) VALUES
(4, 'Orange Walk Itvet', 'San Lorenzo Road, Orange Walk Town', '422-5484', '624-8541', 'orangewalkitvet@yahoo.com', '2', '2', 'terms and conditions for the high school...', '09/12/2019', '04/30/2020', '2019 - 2020', '888cbfbefd27d62d866ecc32024b4375.jpg', '2019-09-11 00:31:33', '2019-09-11 00:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `share_group`
--

CREATE TABLE `share_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_group`
--

INSERT INTO `share_group` (`id`, `name`) VALUES
(1, 'Only Me'),
(2, 'Administrators'),
(3, 'Office Assistants'),
(4, 'Teachers'),
(5, 'Students');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `ss` varchar(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `cell` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `father` varchar(50) NOT NULL,
  `mother` varchar(50) NOT NULL,
  `emergency` varchar(20) NOT NULL,
  `pass_md5` varchar(255) NOT NULL,
  `pass_txt` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `bio` varchar(1000) NOT NULL,
  `deleted` int(11) NOT NULL,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `ss`, `student_id`, `first`, `middle`, `last`, `cell`, `email`, `address`, `gender`, `class_id`, `father`, `mother`, `emergency`, `pass_md5`, `pass_txt`, `status`, `image`, `bio`, `deleted`, `edited_on`, `created_on`) VALUES
(2, '000659823', '3303', 'Joel', 'Alex', 'Alvarado', '658-7821', 'alvarado.joel@gmail.com', 'San Jose Village, Orange Walk Town Test', 'Male', 3, 'Raul Alvarado', 'Estela Alvarado', '658-4215', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, 'avatar5.png', '', 0, '2019-09-25 18:52:25', '2019-07-31 20:50:51'),
(3, '000614587', '6607', 'Nico', 'Esteban', 'Madera', '624-3214', 'nico.madera02@yahoo.com', 'Buena Vista Village, Corozal District', 'Male', 3, 'Procopio Madera', 'Luciana Madera', '635-5621', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, '6607.jpg', '', 0, '2019-07-16 03:35:49', '2019-07-16 03:35:49'),
(4, '000458962', '2204', 'Nancy', 'Olivia', 'Green', '612-4521', 'olivia.nancy26@gmail.com', 'San Pablo Village, Orange Walk District', 'Female', 1, 'Hurtencio Green', 'Esmeralda Green', '624-8648', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, 'avatar4.png', 'Updated Bio', 0, '2019-09-28 18:50:03', '2019-07-16 04:30:19'),
(5, '000458931', '3504', 'Roberto', 'Ever', 'Magana', '624-5412', 'roberto.ever@outlook.com', 'San Roman Village, Corozal District', 'Male', 1, 'Ramon Magana', 'Damaris Magana', '612-6547', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, '', '', 0, '2019-07-17 01:56:23', '2019-07-17 01:56:23'),
(6, '000345323', '4202', 'Alvin', 'Ernesto', 'Campos', '645-8594', 'campos_alvin@gmail.com', 'Progresso Village, Corozal District', 'Male', 2, 'Fabricio Campos', 'Niurka Campos', '624-8547', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, '', '', 0, '2019-08-30 23:03:47', '2019-08-30 23:03:47'),
(7, '000245865', '4203', 'Saul', 'Roberto', 'Alcoser', '624-8564', 'alcoser_saul@yahoo.com', 'Caledonia Village, Corozal District', 'Male', 2, 'Raul Alcoser', 'Bertha Alcoser', '658-9845', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, '', '', 0, '2019-08-30 23:05:50', '2019-08-30 23:05:50'),
(8, '000565874', '4204', 'Ofelia', 'Maria', 'Rodriguez', '624-8657', 'maria23_rodriguez@outlook.com', 'San Esteban Village, Orange Walk District', 'Female', 2, 'Hurtencio Rodriguez', 'Marcia Rodriguez', '689-4587', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, '', '', 0, '2019-08-30 23:12:28', '2019-08-30 23:12:28'),
(9, '000458965', '5505', 'Rita', 'Dalilah', 'Solis', '684-8547', 'solis.rita@yahoo.com', 'Caledonia Village, Corozal District, Belize', 'Female', 3, 'Roque Solis', 'Dominga Solis', '624-8954', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 1, '', '', 0, '2019-09-25 18:51:11', '2019-09-25 18:51:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_priviledges`
--

CREATE TABLE `student_priviledges` (
  `student_id` int(11) NOT NULL,
  `view_grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers_log`
--

CREATE TABLE `teachers_log` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass_md5` varchar(255) NOT NULL,
  `pass_txt` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(300) NOT NULL,
  `education` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `subjects` varchar(50) NOT NULL,
  `homeroom` varchar(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `image` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers_log`
--

INSERT INTO `teachers_log` (`id`, `email`, `pass_md5`, `pass_txt`, `first`, `middle`, `last`, `phone`, `address`, `education`, `status`, `subjects`, `homeroom`, `des`, `image`, `deleted`, `created_on`, `edited_on`) VALUES
(1, 'chanedgar1791@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 'Edgar', '', 'Chan', '', '', '', 1, '', '', '', '', 0, '2019-07-16 02:10:16', '2019-08-21 00:01:35'),
(2, 'oswin.mendez01@yahoo.com', '1a1dc91c907325c69271ddf0c944bc72', 'pass', 'Oswin', 'Alejandro', 'Mendez', '627-8547', 'San Lorenzo Road, Trial Farm Village, Orange Walk Town', 'Bachelor in Education and Mathematics', 1, 'I.T Instructor', '', 'Kind and friendly person! Love to go swimming and flying kites. Quite shy person, enjoys reading books and learning new stuff everyday.', '6178c33463556ce9b9491e4393acdca5.png', 0, '2019-07-16 02:17:41', '2019-09-28 02:02:57'),
(3, 'edgarandrei1791@outlook.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 'Andrei', '', 'Chan', '', '', '', 1, '', '', '', '', 0, '2019-08-07 03:00:02', '2019-08-07 03:00:02'),
(4, 'sample_mail@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 'John', '', 'Doe', '', '', '', 0, '', '', '', '', 0, '2019-08-07 03:35:28', '2019-08-07 03:43:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ass_files`
--
ALTER TABLE `ass_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ass_student_files`
--
ALTER TABLE `ass_student_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_id` (`class_id`,`course_id`,`student_id`,`date`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_to_class`
--
ALTER TABLE `course_to_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_id` (`class_id`,`course_id`);

--
-- Indexes for table `d_events`
--
ALTER TABLE `d_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`,`class_id`,`student_id`,`module`,`school_year`);

--
-- Indexes for table `grading`
--
ALTER TABLE `grading`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_events`
--
ALTER TABLE `my_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schooling`
--
ALTER TABLE `schooling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_group`
--
ALTER TABLE `share_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ss` (`ss`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `student_priviledges`
--
ALTER TABLE `student_priviledges`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teachers_log`
--
ALTER TABLE `teachers_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `ass_files`
--
ALTER TABLE `ass_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ass_student_files`
--
ALTER TABLE `ass_student_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_to_class`
--
ALTER TABLE `course_to_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `d_events`
--
ALTER TABLE `d_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `grading`
--
ALTER TABLE `grading`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lesson_plans`
--
ALTER TABLE `lesson_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `my_events`
--
ALTER TABLE `my_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schooling`
--
ALTER TABLE `schooling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `share_group`
--
ALTER TABLE `share_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers_log`
--
ALTER TABLE `teachers_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
