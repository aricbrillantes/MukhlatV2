-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2018 at 03:00 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mukhlatv2` based on gettogether.sql
--

DROP DATABASE IF EXISTS mukhlatv2;
CREATE DATABASE mukhlatv2;
USE mukhlatv2;


-- --------------------------------------------------------

--
-- Table structure for table `tbl_attachments`
--

CREATE TABLE `tbl_attachments` (
  `attachment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `file_url` varchar(256) NOT NULL,
  `attachment_type_id` int(11) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `caption` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_attachments`
--

INSERT INTO `tbl_attachments` (`attachment_id`, `post_id`, `file_url`, `attachment_type_id`, `date_uploaded`, `caption`) VALUES
(34, 22, './uploads/_20/de0fc9bf228a6430f140a5ac9a5e3572.jpg', 1, '2017-06-23 04:58:37', NULL),
(35, 24, './uploads/_24/2740e00b8a431713d879425b913f0796.png', 1, '2017-06-23 05:02:39', NULL),
(36, 34, './uploads/_34/99b7bb17960a1db82f7fc995de61a2f7.png', 1, '2017-06-23 05:05:45', NULL),
(37, 38, './uploads/_38/60d76cf3eccfef5d9d2628336d56458d.jpg', 1, '2017-06-23 05:52:17', NULL),
(38, 42, './uploads/_42/142fd6fe4bfa3b1c825e89faec24d30b.png', 1, '2017-06-27 02:16:34', NULL),
(39, 43, './uploads/_43/a44d2348c6e591113b97690e7c3008b7.png', 1, '2017-06-27 02:16:42', NULL),
(40, 45, './uploads/_45/acffe9ad161c68e2abe41b63d27fc29f.png', 1, '2017-06-28 11:59:56', NULL),
(41, 72, './uploads/_72/125930fdc665ff22b6a8d41700c80b6e.jpg', 1, '2017-06-29 09:12:50', NULL),
(42, 81, './uploads/_81/81e786bd067b82bf8b69f53bd83e856a.jpg', 1, '2017-06-29 09:50:23', NULL),
(44, 84, './uploads/_83/dac7e6fd62f7b877079cf6dcc406dd24.jpg', 1, '2017-07-11 18:37:08', 'ooopsie'),
(45, 85, './uploads/_83/01c0f0c314e10e755453bf01575f9b49.jpg', 1, '2017-07-11 18:34:26', 'wellll'),
(46, 86, './uploads/_86/184cefa0842bcabb2a5059a689f1c9b1.jpg', 1, '2017-07-11 18:48:10', 'girl version of me'),
(47, 83, './uploads/_83/6e3566eb338c37df5222e7841dd64290.jpg', 1, '2017-07-19 14:15:07', 'Scared Kris'),
(48, 87, './uploads/_87/1fc57f7f6f55371126088a5af0366a3b.jpg', 1, '2017-07-19 14:16:54', '??????'),
(49, 89, './uploads/_89/d60fb34278809b25319489ea20f4db12.png', 1, '2017-07-19 14:17:28', 'look at that cool Yoda'),
(50, 90, './uploads/_0/66ea4cd95b3e3b68f750957850ffe2bc.jpg', 1, '2017-07-19 14:22:45', '*crown emoji*'),
(51, 91, './uploads/_0/0b47bf1bd3af36411740d467ed0910c7.png', 1, '2017-07-19 14:29:43', '*dragon emoji*'),
(52, 92, './uploads/_92/de2a9c1b16d1d2465680aea2e1cc9025.jpg', 1, '2017-07-19 14:31:26', '*bird emoji*'),
(53, 93, './uploads/_93/118d4e2967451390263ce905772d820f.jpg', 1, '2017-07-19 14:32:31', '*ship emoji*'),
(54, 94, './uploads/_94/8ffc3dc78968df942df0c58a0d18107a.jpg', 1, '2017-07-19 14:34:36', '??????'),
(55, 95, './uploads/_95/b3b87da6835e8f25133138b5fef213f0.jpg', 1, '2017-07-19 14:35:31', '??????'),
(56, 96, './uploads/_95/044b7bbe394173e03b0caf46c56e8dcc.jpg', 1, '2017-07-19 14:39:04', 'Arya avenged the Red Wedding.'),
(57, 103, './uploads/_103/a2cbb2cfe8c7196bf853da260999ec81.mp4', 3, '2017-07-19 14:53:34', 'BOOM'),
(58, 105, './uploads/_99/7d8ebbd688b7e9d582cde65b9a339756.gif', 1, '2017-07-19 15:06:26', ''),
(59, 106, './uploads/_98/c5f5894411b0dc790e828878c8e0bc63.png', 1, '2017-07-19 15:09:19', ''),
(60, 107, './uploads/_98/7f3c6377cdc276d05512bf23c3117b69.gif', 1, '2017-07-19 15:10:43', ''),
(61, 108, './uploads/_98/54a0be17f7b3e1d35463c6d46b74d78c.gif', 1, '2017-07-20 07:23:53', 'luv luv luv'),
(62, 110, './uploads/_100/6e0c9ef0ddae4bbc556907db03dd8e56.gif', 1, '2017-07-20 07:25:49', ''),
(63, 113, './uploads/_99/dce8716eac9f70eb2e86f8f6a0b9a938.gif', 1, '2017-07-20 07:33:29', ''),
(64, 126, './uploads/_125/b1de9ab3348854f21d15323aa2eca9b8.JPG', 1, '2017-07-20 07:53:07', ''),
(65, 136, './uploads/_88/61a22adba889937bdab0db20c9cb8e62.png', 1, '2017-07-20 14:29:49', ''),
(66, 138, './uploads/_88/8ede60b03964774bc69822e6c9b1b1fe.png', 1, '2017-07-20 14:31:54', ''),
(67, 139, './uploads/_88/935796a520e8cdcb23c707f7f55849c7.png', 1, '2017-07-20 14:32:48', ''),
(68, 140, './uploads/_88/443f981346e89e55a978e4dfb54ae46e.png', 1, '2017-07-20 14:37:33', 'RAWR'),
(69, 144, './uploads/_137/f466dce1dc6d02d4aca9d53056ad597c.jpg', 1, '2017-07-20 14:45:25', ''),
(70, 145, './uploads/_88/b43f9ee61486ca260bbd1e01b3a6fdd0.gif', 1, '2017-07-20 14:48:51', ''),
(71, 146, './uploads/_134/f5ba354b0c2d8836712a574ca877dfcb.PNG', 1, '2017-07-20 14:49:00', ''),
(72, 147, './uploads/_134/57e8cf12c412ed2f779acb90fe60a03a.JPG', 1, '2017-07-20 14:51:54', ''),
(73, 152, './uploads/_117/7aac3b20c9bfc4164c3c6d5bb665df75.png', 1, '2017-07-20 15:13:49', ''),
(74, 153, './uploads/_134/06686740f3df1f9e3534165f2530c265.PNG', 1, '2017-07-20 16:15:58', ''),
(75, 154, './uploads/_134/1c51070a2a32d9fe94dc9d73e67a1ea9.JPG', 1, '2017-07-20 16:18:46', ''),
(76, 157, './uploads/_134/65043f0b342764f318f79932440803e1.mp4', 3, '2017-07-20 17:46:47', 'listen to it!'),
(77, 162, './uploads/_134/0977d02ba2403f30662d68e377a28f3d.PNG', 1, '2017-07-21 16:53:09', ''),
(78, 165, './uploads/_134/15f53c4906cf08150c5d4e4b0f2f2aee.mp4', 3, '2017-07-21 17:07:11', ''),
(79, 166, './uploads/_134/843475e5706e322a1b5d9b1fd7200be8.PNG', 1, '2017-07-22 06:24:07', ''),
(80, 169, './uploads/_134/b8770099b03b4cfe578338b3d5f51baa.gif', 1, '2017-07-22 15:37:25', ''),
(81, 171, './uploads/_164/6e69ada7db309ab1250f4dfbd8a9bd55.jpg', 1, '2017-07-28 04:40:16', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attachment_type`
--

CREATE TABLE `tbl_attachment_type` (
  `attachment_type_id` int(11) NOT NULL,
  `type_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_attachment_type`
--

INSERT INTO `tbl_attachment_type` (`attachment_type_id`, `type_name`) VALUES
(1, 'image'),
(2, 'audio'),
(3, 'video'),
(4, 'file');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genders`
--

CREATE TABLE `tbl_genders` (
  `gender_id` int(11) NOT NULL,
  `gender_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` varchar(45) NOT NULL,
  `date_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_moderator_invite`
--

CREATE TABLE `tbl_moderator_invite` (
  `invite_id` int(11) NOT NULL,
  `inviter_id` int(11) NOT NULL,
  `invited_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_moderator_invite`
--

INSERT INTO `tbl_moderator_invite` (`invite_id`, `inviter_id`, `invited_id`, `topic_id`, `status`) VALUES
(1, 21, 3, 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_moderator_request`
--

CREATE TABLE `tbl_moderator_request` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_moderator_request`
--

INSERT INTO `tbl_moderator_request` (`request_id`, `user_id`, `topic_id`, `status`) VALUES
(1, 5, 1, 1),
(2, 3, 26, 1),
(3, 33, 33, 1),
(6, 3, 36, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notification_id` int(11) NOT NULL,
  `notification_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doer_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `is_read` int(1) NOT NULL,
  `date_performed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notification_id`, `notification_type_id`, `user_id`, `doer_id`, `source_id`, `is_read`, `date_performed`) VALUES
(1, 5, 3, 5, 3, 1, '2017-06-21 06:06:25'),
(2, 2, 5, 6, 4, 1, '2017-06-22 05:35:52'),
(4, 2, 5, 10, 3, 0, '2017-06-22 06:23:32'),
(5, 2, 5, 9, 3, 0, '2017-06-22 06:24:02'),
(6, 2, 5, 12, 3, 0, '2017-06-22 06:31:19'),
(7, 2, 5, 8, 3, 0, '2017-06-22 06:35:06'),
(8, 2, 5, 11, 3, 0, '2017-06-22 06:39:42'),
(9, 3, 5, 12, 7, 0, '2017-06-23 01:38:45'),
(13, 3, 5, 6, 7, 0, '2017-06-23 04:34:37'),
(14, 2, 12, 9, 10, 1, '2017-06-23 04:40:37'),
(15, 5, 12, 9, 10, 1, '2017-06-23 04:41:01'),
(17, 3, 5, 10, 7, 0, '2017-06-23 04:42:25'),
(18, 5, 12, 7, 11, 1, '2017-06-23 04:42:55'),
(19, 2, 12, 10, 10, 1, '2017-06-23 04:44:07'),
(20, 1, 7, 10, 11, 1, '2017-06-23 04:44:20'),
(21, 5, 12, 7, 13, 1, '2017-06-23 04:46:35'),
(22, 5, 12, 10, 14, 1, '2017-06-23 04:47:12'),
(23, 3, 9, 17, 10, 1, '2017-06-23 04:47:47'),
(24, 5, 12, 7, 15, 1, '2017-06-23 04:48:30'),
(25, 5, 12, 7, 16, 1, '2017-06-23 04:50:09'),
(26, 5, 12, 10, 17, 1, '2017-06-23 04:50:11'),
(27, 2, 12, 8, 10, 1, '2017-06-23 04:50:14'),
(28, 1, 12, 10, 18, 1, '2017-06-23 04:51:04'),
(29, 3, 10, 9, 17, 1, '2017-06-23 04:53:16'),
(30, 3, 9, 10, 10, 1, '2017-06-23 04:54:50'),
(31, 5, 12, 8, 20, 1, '2017-06-23 04:56:15'),
(32, 5, 12, 7, 21, 1, '2017-06-23 04:56:56'),
(33, 2, 12, 6, 10, 1, '2017-06-23 04:57:37'),
(34, 2, 5, 6, 3, 0, '2017-06-23 04:57:54'),
(35, 1, 8, 17, 20, 1, '2017-06-23 04:58:37'),
(36, 3, 8, 10, 20, 1, '2017-06-23 05:00:23'),
(37, 3, 8, 9, 20, 1, '2017-06-23 05:00:34'),
(38, 5, 12, 8, 23, 1, '2017-06-23 05:02:36'),
(39, 5, 12, 9, 24, 1, '2017-06-23 05:02:39'),
(40, 3, 9, 8, 24, 1, '2017-06-23 05:03:20'),
(41, 5, 12, 10, 25, 1, '2017-06-23 05:03:43'),
(42, 5, 12, 17, 26, 1, '2017-06-23 05:05:19'),
(43, 5, 12, 17, 27, 1, '2017-06-23 05:05:20'),
(44, 5, 12, 17, 28, 1, '2017-06-23 05:05:20'),
(45, 5, 12, 17, 29, 1, '2017-06-23 05:05:26'),
(46, 5, 12, 17, 30, 1, '2017-06-23 05:05:27'),
(47, 5, 12, 17, 31, 1, '2017-06-23 05:05:29'),
(48, 5, 12, 17, 32, 1, '2017-06-23 05:05:29'),
(49, 5, 12, 17, 33, 1, '2017-06-23 05:05:33'),
(50, 5, 12, 17, 34, 1, '2017-06-23 05:05:45'),
(51, 3, 10, 8, 25, 1, '2017-06-23 05:06:35'),
(52, 5, 12, 10, 36, 1, '2017-06-23 05:14:43'),
(53, 3, 12, 10, 35, 1, '2017-06-23 05:15:07'),
(54, 3, 17, 10, 34, 1, '2017-06-23 05:15:16'),
(55, 5, 12, 10, 37, 1, '2017-06-23 05:16:15'),
(56, 2, 12, 17, 10, 1, '2017-06-23 05:17:36'),
(57, 5, 12, 17, 38, 1, '2017-06-23 05:52:17'),
(65, 4, 7, 18, 11, 0, '2017-06-23 07:56:08'),
(66, 4, 8, 18, 11, 1, '2017-06-23 07:56:08'),
(67, 4, 9, 18, 11, 1, '2017-06-23 07:56:08'),
(68, 4, 10, 18, 11, 1, '2017-06-23 07:56:08'),
(69, 4, 12, 18, 11, 1, '2017-06-23 07:56:08'),
(70, 4, 16, 18, 11, 1, '2017-06-23 07:56:08'),
(71, 4, 17, 18, 11, 1, '2017-06-23 07:56:08'),
(72, 3, 10, 9, 37, 1, '2017-06-23 09:04:14'),
(73, 1, 5, 18, 6, 0, '2017-06-23 09:12:57'),
(74, 3, 5, 18, 6, 0, '2017-06-23 09:16:41'),
(75, 5, 12, 8, 40, 1, '2017-06-23 16:19:37'),
(77, 3, 19, 12, 46, 1, '2017-06-29 01:15:58'),
(79, 3, 7, 10, 43, 0, '2017-06-29 01:23:34'),
(80, 3, 19, 10, 46, 1, '2017-06-29 01:23:54'),
(81, 2, 17, 10, 16, 1, '2017-06-29 01:42:21'),
(82, 2, 19, 10, 15, 1, '2017-06-29 01:42:31'),
(83, 2, 19, 10, 14, 1, '2017-06-29 01:42:37'),
(84, 5, 17, 10, 47, 1, '2017-06-29 01:50:32'),
(85, 2, 19, 8, 14, 1, '2017-06-29 04:45:24'),
(86, 2, 19, 8, 15, 1, '2017-06-29 04:46:10'),
(87, 2, 19, 17, 15, 1, '2017-06-29 08:46:29'),
(90, 3, 19, 16, 46, 1, '2017-06-29 08:52:25'),
(91, 3, 7, 16, 11, 0, '2017-06-29 08:53:18'),
(92, 5, 18, 16, 50, 1, '2017-06-29 08:58:44'),
(93, 1, 16, 18, 50, 1, '2017-06-29 09:10:36'),
(94, 5, 16, 18, 58, 1, '2017-06-29 09:11:09'),
(95, 5, 12, 17, 61, 0, '2017-06-29 09:12:39'),
(96, 5, 12, 17, 62, 0, '2017-06-29 09:12:39'),
(97, 5, 12, 17, 63, 0, '2017-06-29 09:12:40'),
(98, 5, 12, 17, 64, 0, '2017-06-29 09:12:40'),
(99, 5, 12, 17, 65, 0, '2017-06-29 09:12:41'),
(100, 5, 12, 17, 66, 0, '2017-06-29 09:12:41'),
(101, 5, 12, 17, 67, 0, '2017-06-29 09:12:42'),
(102, 5, 12, 17, 68, 0, '2017-06-29 09:12:43'),
(103, 5, 12, 17, 69, 0, '2017-06-29 09:12:43'),
(104, 5, 12, 17, 70, 0, '2017-06-29 09:12:44'),
(105, 5, 12, 17, 71, 0, '2017-06-29 09:12:45'),
(106, 5, 12, 17, 72, 0, '2017-06-29 09:12:50'),
(107, 5, 16, 18, 73, 1, '2017-06-29 09:13:43'),
(108, 2, 16, 18, 20, 1, '2017-06-29 09:15:01'),
(109, 5, 16, 18, 77, 1, '2017-06-29 09:19:26'),
(110, 5, 16, 18, 78, 1, '2017-06-29 09:20:34'),
(111, 1, 18, 16, 73, 1, '2017-06-29 09:21:49'),
(112, 2, 19, 20, 15, 1, '2017-06-29 09:31:30'),
(113, 2, 16, 20, 18, 1, '2017-06-29 09:32:05'),
(114, 5, 19, 20, 81, 1, '2017-06-29 09:50:23'),
(115, 2, 19, 9, 14, 1, '2017-07-01 14:07:59'),
(116, 4, 7, 18, 24, 0, '2017-07-02 11:09:33'),
(117, 4, 8, 18, 24, 0, '2017-07-02 11:09:33'),
(118, 4, 9, 18, 24, 0, '2017-07-02 11:09:33'),
(119, 4, 10, 18, 24, 0, '2017-07-02 11:09:33'),
(120, 4, 12, 18, 24, 0, '2017-07-02 11:09:33'),
(121, 4, 16, 18, 24, 0, '2017-07-02 11:09:33'),
(122, 4, 17, 18, 24, 0, '2017-07-02 11:09:33'),
(123, 4, 20, 18, 24, 0, '2017-07-02 11:09:33'),
(124, 3, 16, 18, 79, 0, '2017-07-02 11:11:06'),
(125, 5, 12, 3, 82, 0, '2017-07-10 01:16:45'),
(126, 5, 19, 3, 83, 1, '2017-07-10 01:18:56'),
(127, 2, 5, 21, 3, 0, '2017-07-11 18:12:48'),
(128, 4, 3, 21, 26, 1, '2017-07-11 18:16:45'),
(129, 4, 5, 21, 26, 0, '2017-07-11 18:16:45'),
(130, 4, 6, 21, 26, 0, '2017-07-11 18:16:45'),
(131, 2, 21, 3, 26, 1, '2017-07-11 18:18:10'),
(132, 2, 19, 3, 15, 1, '2017-07-11 18:38:27'),
(133, 2, 5, 3, 2, 0, '2017-07-11 18:43:42'),
(134, 2, 5, 3, 3, 0, '2017-07-11 18:43:45'),
(135, 2, 12, 3, 10, 0, '2017-07-11 18:43:48'),
(136, 2, 18, 3, 11, 1, '2017-07-11 18:43:51'),
(137, 2, 18, 3, 12, 1, '2017-07-11 18:43:58'),
(138, 2, 7, 3, 13, 0, '2017-07-11 18:44:02'),
(139, 2, 19, 3, 14, 1, '2017-07-11 18:44:07'),
(140, 2, 17, 3, 16, 0, '2017-07-11 18:44:11'),
(141, 2, 16, 3, 18, 0, '2017-07-11 18:44:14'),
(142, 2, 16, 3, 19, 0, '2017-07-11 18:44:18'),
(143, 2, 16, 3, 20, 0, '2017-07-11 18:44:29'),
(144, 3, 21, 3, 86, 0, '2017-07-11 18:48:27'),
(146, 3, 7, 3, 41, 0, '2017-07-11 19:09:35'),
(147, 2, 22, 23, 27, 1, '2017-07-19 13:56:14'),
(148, 2, 23, 24, 29, 1, '2017-07-19 14:01:26'),
(149, 2, 3, 24, 30, 1, '2017-07-19 14:01:39'),
(150, 2, 23, 22, 29, 1, '2017-07-19 14:03:32'),
(151, 2, 23, 3, 29, 1, '2017-07-19 14:04:19'),
(152, 2, 22, 24, 27, 1, '2017-07-19 14:06:31'),
(153, 2, 22, 3, 27, 1, '2017-07-19 14:13:31'),
(154, 5, 23, 3, 89, 1, '2017-07-19 14:17:28'),
(155, 3, 23, 22, 88, 1, '2017-07-19 14:40:11'),
(156, 3, 3, 23, 89, 1, '2017-07-19 14:41:51'),
(157, 4, 3, 23, 31, 1, '2017-07-19 14:55:00'),
(158, 4, 6, 23, 31, 0, '2017-07-19 14:55:00'),
(159, 4, 19, 23, 31, 1, '2017-07-19 14:55:01'),
(160, 4, 22, 23, 31, 1, '2017-07-19 14:55:01'),
(161, 4, 24, 23, 31, 1, '2017-07-19 14:55:01'),
(162, 1, 3, 23, 89, 1, '2017-07-19 14:55:50'),
(163, 3, 22, 23, 87, 1, '2017-07-19 15:03:49'),
(164, 3, 22, 23, 90, 1, '2017-07-19 15:03:51'),
(165, 3, 22, 23, 91, 1, '2017-07-19 15:03:53'),
(166, 3, 22, 23, 92, 1, '2017-07-19 15:03:54'),
(167, 3, 22, 23, 93, 1, '2017-07-19 15:03:55'),
(168, 3, 22, 23, 94, 1, '2017-07-19 15:03:56'),
(169, 3, 22, 23, 95, 1, '2017-07-19 15:03:58'),
(170, 2, 23, 22, 31, 1, '2017-07-19 15:04:57'),
(171, 3, 23, 22, 103, 1, '2017-07-19 15:05:00'),
(172, 3, 23, 22, 102, 1, '2017-07-19 15:05:03'),
(173, 3, 23, 22, 101, 1, '2017-07-19 15:05:05'),
(174, 3, 23, 22, 100, 1, '2017-07-19 15:05:08'),
(175, 3, 23, 22, 99, 1, '2017-07-19 15:05:12'),
(176, 3, 23, 22, 98, 1, '2017-07-19 15:05:15'),
(179, 1, 23, 22, 98, 1, '2017-07-19 15:10:43'),
(180, 3, 22, 23, 106, 1, '2017-07-20 07:18:01'),
(181, 3, 22, 23, 107, 1, '2017-07-20 07:18:02'),
(182, 1, 22, 23, 107, 1, '2017-07-20 07:23:53'),
(183, 1, 23, 24, 99, 1, '2017-07-20 07:25:07'),
(184, 2, 23, 24, 31, 1, '2017-07-20 07:25:37'),
(185, 3, 22, 23, 105, 1, '2017-07-20 07:26:50'),
(186, 1, 24, 23, 109, 1, '2017-07-20 07:27:40'),
(187, 1, 23, 24, 111, 1, '2017-07-20 07:30:21'),
(188, 3, 23, 22, 111, 1, '2017-07-20 07:32:16'),
(189, 3, 23, 22, 108, 1, '2017-07-20 07:32:33'),
(190, 1, 23, 24, 113, 1, '2017-07-20 07:35:33'),
(191, 2, 23, 28, 31, 1, '2017-07-20 07:35:52'),
(192, 1, 24, 28, 114, 1, '2017-07-20 07:36:30'),
(193, 5, 19, 24, 118, 1, '2017-07-20 07:39:09'),
(194, 2, 19, 29, 32, 1, '2017-07-20 07:41:32'),
(195, 2, 19, 23, 33, 1, '2017-07-20 07:45:06'),
(196, 2, 19, 23, 34, 1, '2017-07-20 07:45:14'),
(197, 2, 19, 23, 32, 1, '2017-07-20 07:45:16'),
(198, 2, 19, 23, 35, 1, '2017-07-20 07:45:25'),
(199, 3, 3, 23, 83, 1, '2017-07-20 07:50:53'),
(200, 2, 19, 3, 32, 1, '2017-07-20 07:50:54'),
(204, 3, 19, 29, 123, 1, '2017-07-20 07:55:19'),
(205, 2, 23, 3, 31, 1, '2017-07-20 08:00:31'),
(207, 2, 19, 3, 34, 1, '2017-07-20 08:01:22'),
(208, 2, 19, 3, 33, 1, '2017-07-20 08:01:25'),
(209, 2, 19, 3, 35, 1, '2017-07-20 08:01:37'),
(210, 1, 23, 28, 88, 1, '2017-07-20 13:42:00'),
(212, 2, 28, 33, 36, 1, '2017-07-20 14:24:43'),
(213, 2, 19, 28, 15, 1, '2017-07-20 14:27:42'),
(219, 2, 23, 28, 29, 1, '2017-07-20 14:30:55'),
(220, 5, 28, 33, 137, 1, '2017-07-20 14:31:23'),
(222, 1, 28, 23, 133, 1, '2017-07-20 14:32:48'),
(223, 3, 23, 3, 136, 1, '2017-07-20 14:33:51'),
(224, 1, 28, 3, 133, 1, '2017-07-20 14:37:33'),
(225, 1, 28, 23, 134, 1, '2017-07-20 14:37:33'),
(226, 2, 28, 23, 36, 1, '2017-07-20 14:37:40'),
(227, 1, 33, 23, 137, 1, '2017-07-20 14:38:36'),
(233, 3, 23, 33, 142, 1, '2017-07-20 14:44:55'),
(234, 1, 23, 33, 142, 1, '2017-07-20 14:45:25'),
(235, 3, 33, 3, 137, 0, '2017-07-20 14:47:07'),
(237, 1, 3, 23, 140, 1, '2017-07-20 14:48:51'),
(238, 1, 33, 23, 144, 0, '2017-07-20 14:54:27'),
(239, 3, 33, 23, 137, 0, '2017-07-20 14:55:08'),
(240, 3, 33, 23, 144, 0, '2017-07-20 14:55:18'),
(241, 1, 28, 23, 146, 1, '2017-07-20 14:57:55'),
(242, 1, 19, 23, 121, 1, '2017-07-20 15:01:13'),
(243, 3, 3, 23, 140, 1, '2017-07-20 15:06:06'),
(244, 1, 19, 23, 120, 1, '2017-07-20 15:09:21'),
(245, 3, 19, 23, 120, 1, '2017-07-20 15:10:27'),
(246, 1, 19, 23, 117, 1, '2017-07-20 15:13:49'),
(247, 3, 19, 23, 117, 1, '2017-07-20 15:14:10'),
(248, 3, 23, 28, 149, 1, '2017-07-20 16:15:07'),
(249, 1, 23, 28, 149, 1, '2017-07-20 16:18:46'),
(250, 5, 33, 28, 155, 0, '2017-07-20 16:19:46'),
(252, 1, 28, 3, 134, 1, '2017-07-20 17:46:47'),
(253, 1, 3, 28, 157, 1, '2017-07-20 17:49:26'),
(254, 3, 28, 23, 158, 1, '2017-07-21 00:57:10'),
(255, 3, 3, 23, 157, 1, '2017-07-21 00:57:11'),
(256, 1, 19, 29, 124, 1, '2017-07-21 03:34:37'),
(257, 3, 3, 28, 157, 1, '2017-07-21 17:04:04'),
(258, 1, 28, 23, 164, 1, '2017-07-22 15:33:24'),
(260, 1, 28, 23, 166, 1, '2017-07-22 15:37:25'),
(261, 3, 29, 3, 160, 1, '2017-07-23 11:01:17'),
(262, 1, 28, 3, 164, 1, '2017-07-23 11:34:51'),
(263, 3, 23, 19, 152, 1, '2017-07-26 03:47:21'),
(264, 3, 28, 3, 171, 1, '2017-07-28 18:13:57'),
(265, 3, 23, 3, 150, 0, '2017-07-30 16:43:23'),
(268, 3, 23, 3, 151, 0, '2017-07-30 16:43:48'),
(271, 3, 3, 19, 83, 1, '2017-07-31 02:39:50'),
(272, 5, 28, 19, 173, 1, '2017-07-31 02:57:34'),
(273, 5, 29, 19, 174, 1, '2017-07-31 04:30:52'),
(274, 3, 3, 28, 140, 1, '2017-08-06 09:06:46'),
(275, 3, 23, 3, 169, 0, '2017-08-16 19:42:41'),
(276, 3, 28, 3, 158, 0, '2017-08-16 19:43:02'),
(279, 2, 28, 3, 36, 0, '2017-08-20 20:55:22'),
(280, 3, 7, 3, 44, 0, '2017-08-20 22:29:31'),
(281, 4, 24, 3, 36, 0, '2017-08-20 22:40:37'),
(282, 4, 25, 3, 36, 0, '2017-08-20 22:40:37'),
(283, 4, 26, 3, 36, 0, '2017-08-20 22:40:37'),
(284, 4, 29, 3, 36, 1, '2017-08-20 22:40:37'),
(285, 3, 28, 3, 154, 0, '2017-08-20 23:47:15'),
(286, 3, 23, 3, 141, 0, '2017-08-20 23:47:27'),
(297, 3, 19, 3, 173, 0, '2017-08-21 00:10:53'),
(298, 1, 19, 3, 173, 0, '2017-08-22 01:23:27'),
(299, 3, 19, 22, 119, 0, '2017-09-21 05:47:18'),
(300, 3, 3, 22, 83, 1, '2017-09-21 05:48:12'),
(301, 3, 28, 22, 163, 0, '2017-09-21 05:50:52'),
(302, 1, 23, 22, 99, 0, '2017-09-21 05:54:13'),
(303, 3, 19, 3, 121, 0, '2017-09-21 05:57:46'),
(304, 5, 19, 3, 178, 0, '2017-09-21 05:58:18'),
(305, 1, 19, 3, 121, 0, '2017-09-21 05:59:32'),
(306, 1, 23, 3, 150, 0, '2017-09-21 05:59:52'),
(307, 5, 33, 3, 182, 0, '2017-09-21 06:00:59'),
(308, 3, 19, 3, 46, 0, '2017-09-21 06:02:28'),
(309, 3, 28, 3, 164, 0, '2017-11-14 04:55:01'),
(310, 5, 3, 18, 183, 0, '2018-01-04 07:17:05'),
(312, 2, 3, 40, 40, 0, '2018-01-09 02:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification_type`
--

CREATE TABLE `tbl_notification_type` (
  `notification_type_id` int(11) NOT NULL,
  `type_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_notification_type`
--

INSERT INTO `tbl_notification_type` (`notification_type_id`, `type_name`) VALUES
(1, 'Reply'),
(2, 'Follow'),
(3, 'Upvote'),
(4, 'Share'),
(5, 'Post');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `post_id` int(11) NOT NULL,
  `root_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_title` varchar(100) DEFAULT '""',
  `post_content` varchar(16000) NOT NULL,
  `date_posted` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `root_id`, `parent_id`, `user_id`, `topic_id`, `post_title`, `post_content`, `date_posted`, `is_deleted`) VALUES
(1, 1, 0, 3, 1, 'This is a post', 'this is me telling something about the post!', '2017-06-21 01:34:31', 0),
(2, 2, 0, 5, 2, 'CHMOD', 'chmod means change mode. to change access permission to a file or directory', '2017-06-21 06:05:22', 0),
(3, 3, 0, 5, 1, 'HELLO', 'HI MY NAME IS M', '2017-06-21 06:06:25', 0),
(6, 6, 0, 5, 3, 'Anime', 'Anything about anime. Could recommendations, discussion and other stuff about anime.', '2017-06-22 05:46:51', 0),
(7, 7, 0, 5, 3, 'Games and E-Sports', 'Anything about Games and E-sports.', '2017-06-22 05:47:51', 0),
(10, 10, 0, 9, 10, 'hello', 'hi', '2017-06-23 04:41:01', 0),
(11, 11, 0, 7, 10, 'GangBeasts', 'GG', '2017-06-23 04:42:55', 0),
(12, 11, 11, 10, 10, '', 'hm?', '2017-06-23 04:44:20', 0),
(13, 13, 0, 7, 10, 'Y U DU DIS', 'please do not down bowt', '2017-06-23 04:46:35', 0),
(14, 14, 0, 10, 10, 'Terraria', 'I have an extra copy of Terraria hihi', '2017-06-23 04:47:12', 0),
(15, 15, 0, 7, 10, 'I want supah hot fire', 'please give me alms', '2017-06-23 04:48:30', 0),
(16, 16, 0, 7, 10, 'GangBeasts', 'We buy six pack gangbeasts ', '2017-06-23 04:50:09', 0),
(17, 17, 0, 10, 10, 'Lets play Killing Floor', 'its on sale in steam', '2017-06-23 04:50:11', 0),
(18, 18, 0, 12, 10, 'CLUSTER TRUCK', 'yummy 138 pesos', '2017-06-23 04:50:26', 0),
(19, 18, 18, 10, 10, '', 'link pls', '2017-06-23 04:51:04', 0),
(20, 20, 0, 8, 10, 'Lurd and Savior', 'ano po steam acc ni  lurd and savior', '2017-06-23 04:56:15', 0),
(21, 21, 0, 7, 10, 'pagift naman ng games', 'please poor ako eh', '2017-06-23 04:56:56', 0),
(22, 20, 20, 17, 10, 'i\'m the one ye', 'a', '2017-06-23 04:58:37', 0),
(23, 23, 0, 8, 10, 'steam acc', 'pahingi po steam accz pls', '2017-06-23 05:02:36', 0),
(24, 24, 0, 9, 10, 'Angel ni Lord and Savor', 'acheem', '2017-06-23 05:02:39', 0),
(25, 25, 0, 10, 10, 'Steam Sale accounts', 'please post your steam accounts here', '2017-06-23 05:03:43', 0),
(26, 26, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:19', 0),
(27, 27, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:20', 0),
(28, 28, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:20', 0),
(29, 29, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:26', 0),
(30, 30, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:27', 0),
(31, 31, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:29', 0),
(32, 32, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:29', 0),
(33, 33, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:33', 0),
(34, 34, 0, 17, 10, 'i\'m the one', 'yea', '2017-06-23 05:05:45', 0),
(35, 35, 0, 12, 10, 'Not steam game lmew', 'https://cliclock.netlify.com/', '2017-06-23 05:07:43', 0),
(36, 36, 0, 10, 10, 'dota po tayo', 'dota', '2017-06-23 05:14:43', 0),
(37, 37, 0, 10, 10, 'GALA TAYO', 'paseo', '2017-06-23 05:16:15', 0),
(38, 38, 0, 17, 10, 'hawt', 'a', '2017-06-23 05:52:17', 0),
(39, 6, 6, 18, 3, '', 'Aldnoah.Zero\r\nBuddy Complex\r\nGolden Time\r\nKiznaiver\r\nSaijaku Muhai no Bahamut\r\nSakurasou no Pet na Kanojo\r\nZetsuen no Tempest', '2017-06-23 09:12:57', 0),
(40, 40, 0, 8, 10, 'G', 'G', '2017-06-23 16:19:37', 0),
(41, 41, 0, 7, 13, 'TE3D House Experience', 'Comments about the experience in TE3D House.', '2017-06-27 02:14:56', 0),
(42, 42, 0, 7, 13, 'TE3D House', 'Hi guys', '2017-06-27 02:16:34', 0),
(43, 43, 0, 7, 13, 'TE3D House', 'Hi guys', '2017-06-27 02:16:42', 0),
(44, 44, 0, 7, 13, 'TE3D House', 'TE3D House is a place for research and study headed by Professor Arnulfo Azcaraga, Ms. Christine Gendrano, and Mr. Emerico Aguilar.', '2017-06-27 02:22:40', 0),
(45, 45, 0, 19, 14, 'Steam Summer Sale', 'What did you get?', '2017-06-28 11:59:56', 0),
(46, 46, 0, 19, 15, 'Dank memes', 'For the dankest of memes.', '2017-06-28 12:03:03', 0),
(47, 47, 0, 10, 16, 'Weightlifting Fairy Kim Bok Joo', 'Can i have a copy of the last episode of the Korean drama', '2017-06-29 01:50:32', 0),
(48, 48, 0, 16, 18, 'jk', 'jk yak di na edgy yung hot topic nowadays :&amp;lt;. yak ', '2017-06-29 08:55:40', 0),
(49, 49, 0, 16, 19, 'seriously tho', '&quot;Kayn&quot;?\r\n&quot;The Shadow Reaper&quot;?\r\nska;ldjf;akljf', '2017-06-29 08:58:08', 0),
(50, 50, 0, 16, 12, 'no', 'no', '2017-06-29 08:58:44', 0),
(51, 51, 0, 16, 20, 'spam #1', 'https://www.amazon.com/SPAM-Classic-12-Ounce-Cans-Pack/dp/B001EQ5NHE', '2017-06-29 09:00:51', 0),
(52, 52, 0, 16, 20, 'spam #2 (wow spam delivered right at your door)', 'www.britsuperstore.com/uk/browse-by-section/groceries/spam.html', '2017-06-29 09:02:23', 0),
(53, 53, 0, 16, 20, 'spam #3', 'it was always my dream to be a can of spam. now I can live that dream through this costume\r\nhttp://www.ebay.ph/itm/ADULT-GIANT-SPAM-CAN-FOOD-POLY-FOAM-COSTUME-DRESS-GC7141-/381831744324?hash=item58e6f20b44:g:5O8AAOSwo4pYbnpE\r\n\r\nI\'d like to thank ebay, first and foremost for letting me achieve my dream.\r\nthe model for wearing the spam costume\r\nthe black spandex underneath to add that extra swag to the costume\r\nand Spam for being delicious.\r\nthank you', '2017-06-29 09:05:22', 0),
(54, 54, 0, 16, 20, 'spam #4', 'spam classic single precooked para sa mga classic single diyan\r\nhttp://www.ebay.ph/itm/CJ-SPAM-Ham-Classic-Single-Precooked-Pork-Retort-Pouch-Korean-Food-80-g-2-ea-/282407342811?hash=item41c0ca12db:g:JukAAOSwZVlXlbNE', '2017-06-29 09:06:30', 0),
(55, 55, 0, 16, 20, 'spam #5', 'have u ever wanted to be spam, but ur office won\'t allow you to dress like one?\r\nsay no more fam, this is the solution\r\nhttp://www.ebay.ph/itm/Spam-Meat-T-Shirt-Food-Small-A7-/263034542091?hash=item3d3e14980b:g:X94AAOSwpkFY7~ik', '2017-06-29 09:07:48', 0),
(56, 56, 0, 16, 20, 'spam #6', 'for those mornings when u don\'t have time to cut your spam\r\nhttp://www.ebay.ph/itm/Stainless-steel-wire-cutting-Food-slicers-Bean-Curd-Spam-Egg-slicer-Antirust-/201653643527?var=&amp;hash=item2ef37e6907:m:m7B72dUC9cd-8f-_dV7HVAw', '2017-06-29 09:09:26', 0),
(57, 50, 50, 18, 12, 'wut??', 'dis?', '2017-06-29 09:10:36', 0),
(58, 58, 0, 18, 19, 'What is diz?', 'haha', '2017-06-29 09:11:09', 0),
(59, 59, 0, 16, 20, 'spam #7', 'RARE collectible Spam !!1! CHINA LIMITED EDITION 100 100 CHINA MARKET LABELXXHZZZ\r\nhttp://www.ebay.ph/itm/RARE-Collectible-SPAM-Classic-Hormel-Food-International-China-Market-Label-/292142966697?hash=item440513e7a9:g:ze0AAOSwoudW4KQ9', '2017-06-29 09:11:12', 0),
(60, 60, 0, 16, 20, 'spam #8', 'SAD THAT YOUR SPAM COSTUME IS IN THE LAUNDRY? BUY ANOTHER DIFFERENT VERSION!!!\r\nNEVER BE WITHOUT YOUR SPAM COSTUME AGAIN\r\nhttp://www.ebay.ph/itm/Adult-Mens-One-Size-Comedy-Spam-Can-Food-Costume-/400211338005?hash=item5d2e746315:m:mE63i1VBNiczIGh1R6cgPsw', '2017-06-29 09:12:27', 0),
(61, 61, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:39', 0),
(62, 62, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:39', 0),
(63, 63, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:40', 0),
(64, 64, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:40', 0),
(65, 65, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:41', 0),
(66, 66, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:41', 0),
(67, 67, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:42', 0),
(68, 68, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:43', 0),
(69, 69, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:43', 0),
(70, 70, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:44', 0),
(71, 71, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:45', 0),
(72, 72, 0, 17, 10, 'LurdnSaviour', 'Siya po ang nag-lulurd at nag-sasave samin HAHAHAH', '2017-06-29 09:12:50', 0),
(73, 73, 0, 18, 20, 'spam #9', 'yamete', '2017-06-29 09:13:43', 0),
(74, 74, 0, 16, 20, 'spam #9', 'GIVE THAT COSTUME TO THAT SPECIAL SOMEONE ;) ;)\r\nwant to live your dream of being a spam with someone special? buy an extra costume for them!\r\nhttp://www.ebay.ph/itm/SPAM-ADULT-COSTUME-Food-Theme-Unisex-Oversized-PolyFoam-Tunic-Halloween-/120789232419?hash=item1c1f996b23:m:mKoWdS-VQkzDO4vaYtIArHA', '2017-06-29 09:13:50', 0),
(75, 75, 0, 16, 20, 'spam #10', 'somehow this was in the search results on e-bay for spam\r\nhttp://www.ebay.ph/itm/MACE-WINDU-Star-Wars-12-Action-Figure-Sideshow-Order-Jedi-Fury-Avengers-FORCE-/231477062697?hash=item35e51bac29:g:2p8AAOSwqu9U2l4C', '2017-06-29 09:16:19', 0),
(76, 76, 0, 16, 20, 'spam #11', 'wala nang quality search results for spam &lt;/3 i hope u enjoy this list', '2017-06-29 09:18:14', 0),
(77, 77, 0, 18, 20, 'spam #12', 'cunt', '2017-06-29 09:19:26', 1),
(78, 78, 0, 18, 20, 'spam #13', 'Nauna ako sa spam #9\r\n', '2017-06-29 09:20:34', 0),
(79, 73, 73, 16, 20, 'WHAT ARE U DOING', 'REPORTED. BLOCKEDT. UNFOLLOWED. !!1!1. DALAWANG #9??? \r\n*ANGERY* &gt;:(', '2017-06-29 09:21:49', 0),
(80, 80, 0, 16, 20, '&lt;/3', '&lt;/3', '2017-06-29 09:22:21', 0),
(81, 81, 0, 20, 15, '.', '.', '2017-06-29 09:50:22', 0),
(82, 82, 0, 3, 10, 'hello', 'world', '2017-07-10 01:16:45', 0),
(83, 83, 0, 3, 15, 'Kris Memes!', 'Share tayo ng kris aquino memes guys', '2017-07-10 01:18:56', 0),
(84, 83, 83, 3, 15, 'hahahaha', 'another kris meme', '2017-07-11 18:33:50', 0),
(85, 83, 84, 3, 15, '', 'another one!', '2017-07-11 18:34:26', 1),
(86, 86, 0, 21, 26, 'This is Josie', 'Can you see I became a girllllllllllllllllll', '2017-07-11 18:48:10', 0),
(87, 87, 0, 22, 27, 'Season 1', 'GoT Spoilers for Season 1', '2017-07-19 14:11:05', 0),
(88, 88, 0, 23, 29, 'Rey is not a Skywalker', 'no no no no', '2017-07-19 14:15:53', 0),
(89, 89, 0, 3, 29, 'I wanna talk about Yoda', 'look at his pose hihi', '2017-07-19 14:17:28', 0),
(90, 0, 0, 22, 27, 'Season 2', 'GoT Spoilers for Season 2', '2017-07-19 14:20:22', 0),
(91, 0, 0, 22, 27, 'Season 3', 'GoT Spoilers for Season 3', '2017-07-19 14:28:57', 0),
(92, 92, 0, 22, 27, 'Season 4', 'GoT Spoilers for Season 4 ', '2017-07-19 14:31:26', 0),
(93, 93, 0, 22, 27, 'Season 5', 'GoT Spoilers for Season 5 ', '2017-07-19 14:32:31', 0),
(94, 94, 0, 22, 27, 'Season 6', 'GoT Spoilers for Season 6', '2017-07-19 14:34:36', 0),
(95, 95, 0, 22, 27, 'Season 7', 'GoT Spoilers for Season 7', '2017-07-19 14:35:31', 0),
(96, 95, 95, 22, 27, '', 'Winter came for House Frey!!! #TheNorthRemembers WOOOO ??', '2017-07-19 14:39:04', 0),
(97, 95, 96, 22, 27, '', 'https://www.youtube.com/watch?v=odT8YWUkJfs', '2017-07-19 14:42:35', 0),
(98, 98, 0, 23, 31, 'Descendants of the Sun', 'you are my everythiiiing\r\nyoo si jin &lt;3\r\nDANGYEOL!', '2017-07-19 14:46:35', 0),
(99, 99, 0, 23, 31, 'Weightlifting Fairy Kim Bok Joo', 'CHICKEN', '2017-07-19 14:47:05', 0),
(100, 100, 0, 23, 31, 'Goblin', 'GONG YOO\r\nEUN TAK\r\nREAPER\r\nSUNNY\r\nDEOK HWA', '2017-07-19 14:49:15', 0),
(101, 101, 0, 23, 31, 'Fight For My Way', 'microphones + karate!', '2017-07-19 14:50:14', 0),
(102, 102, 0, 23, 31, 'Scarlet Heart', ':\'(((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((', '2017-07-19 14:51:04', 0),
(103, 103, 0, 23, 31, 'How to watch kdramas', ';)', '2017-07-19 14:53:34', 0),
(104, 89, 89, 23, 29, '', 'dats mah jedi master', '2017-07-19 14:55:50', 0),
(105, 99, 99, 22, 31, '', 'sweeeg', '2017-07-19 15:06:26', 0),
(106, 98, 98, 22, 31, '', 'shiiip', '2017-07-19 15:09:19', 0),
(107, 98, 98, 22, 31, '', 'DANGYEOL!', '2017-07-19 15:10:43', 0),
(108, 98, 107, 23, 31, '', 'big boss &amp; beauty &lt;3', '2017-07-20 07:23:53', 0),
(109, 99, 99, 24, 31, 'CHIKEN KING', 'CHIIEKCN KINGGG', '2017-07-20 07:25:07', 0),
(110, 100, 100, 23, 31, '', 'yesss', '2017-07-20 07:25:49', 0),
(111, 99, 109, 23, 31, '', 'no', '2017-07-20 07:27:40', 0),
(112, 99, 111, 24, 31, '', 'yes!', '2017-07-20 07:30:21', 0),
(113, 99, 99, 23, 31, '', 'it\'s chicken tiiime', '2017-07-20 07:33:29', 0),
(114, 99, 113, 24, 31, '', '199 only', '2017-07-20 07:35:33', 0),
(115, 99, 114, 28, 31, '', 'Luvett', '2017-07-20 07:36:30', 0),
(116, 116, 0, 19, 32, 'Level Up', 'Discussions about the upcoming event: Level up', '2017-07-20 07:37:58', 0),
(117, 117, 0, 19, 32, 'Sanghabian', 'Topics about Sanghabian', '2017-07-20 07:38:42', 0),
(118, 118, 0, 24, 32, 'Ragnarok', 'Wanna play? ', '2017-07-20 07:39:09', 0),
(119, 119, 0, 19, 33, 'Canteen', 'Anything about the facilities and services in canteen.', '2017-07-20 07:41:28', 0),
(120, 120, 0, 19, 33, 'Enrollment Concerns', 'Malapit nanaman enrollment haha ano concerns or thoughts niyo?', '2017-07-20 07:42:07', 0),
(121, 121, 0, 19, 33, 'Arrows', 'Anything about the shuttle. Suggestions and all sorts of discussions about it are welcome.', '2017-07-20 07:42:42', 0),
(122, 122, 0, 19, 35, 'Practicum', 'How did your practicum go?', '2017-07-20 07:44:48', 0),
(123, 123, 0, 19, 35, 'Life After Graduation', 'Originally intended for alumna but pwede rin sumali mga undergrad if interested.', '2017-07-20 07:45:56', 0),
(124, 124, 0, 19, 35, 'Career Exploration', 'For those who are thinking about pursuing a double degree or an entirely different field after graduation.', '2017-07-20 07:47:35', 0),
(133, 88, 88, 28, 29, 'LIAR', 'WTF! LIAR LIAR PANTS ON FIRE', '2017-07-20 13:42:00', 0),
(134, 134, 0, 28, 36, 'Dear Evan Hansen', 'All we see is sky for forever!', '2017-07-20 13:44:29', 0),
(135, 134, 134, 28, 36, '', '', '2017-07-20 14:22:13', 1),
(136, 88, 133, 23, 29, '', 'u wanna fight?/?', '2017-07-20 14:29:49', 0),
(137, 137, 0, 33, 36, 'TONYING', 'Watch HTG\'s Si Tonying at ang Mahiwagang Aklat ng Kasaysayan', '2017-07-20 14:31:23', 0),
(138, 88, 133, 23, 29, '', 'i will kill', '2017-07-20 14:31:54', 0),
(139, 88, 133, 23, 29, '', 'KILL', '2017-07-20 14:32:48', 0),
(140, 88, 133, 3, 29, '', 'LEZ FIGHT', '2017-07-20 14:37:33', 0),
(141, 134, 134, 23, 36, '', 'dog po ba yung pic mo', '2017-07-20 14:37:33', 0),
(142, 137, 137, 23, 36, '', 'pubs niyo po ba yan', '2017-07-20 14:38:36', 0),
(143, 134, 134, 3, 36, 'luvettt', 'ð??ð??ð??ð??', '2017-07-20 14:43:21', 0),
(144, 137, 142, 33, 36, 'Hindi', 'Hindi po', '2017-07-20 14:45:25', 0),
(145, 88, 140, 23, 29, '', 'DANCE FIGHT BOI', '2017-07-20 14:48:51', 0),
(146, 134, 134, 28, 36, 'Waving through a window', 'When you\'re falling in a forest and theres nobody around, will you ever really chrash or even make a sound?', '2017-07-20 14:49:00', 0),
(147, 134, 134, 28, 36, '', 'AHAHAHAHAH', '2017-07-20 14:51:54', 0),
(148, 137, 144, 23, 36, '', ':\'(', '2017-07-20 14:54:27', 0),
(149, 134, 146, 23, 36, '', 'wala po bang google maps si ate girl? diba free yon', '2017-07-20 14:57:55', 0),
(150, 121, 121, 23, 33, '', 'alabang shuttle please, madami rin pong teachers na galing don :(', '2017-07-20 15:01:13', 0),
(151, 120, 120, 23, 33, 'Enrollment Sched!', 'https://www.facebook.com/STCGovernment/posts/1468363159897797', '2017-07-20 15:09:21', 0),
(152, 117, 117, 23, 32, '', 'leggo!', '2017-07-20 15:13:49', 0),
(153, 134, 134, 28, 36, 'BIRTHDAY NI MICHAEL PARK', 'Insert cake emoji!!!', '2017-07-20 16:15:58', 0),
(154, 134, 149, 28, 36, '', '&quot;Wala akong map, pero meron akong tony award!&quot;', '2017-07-20 16:18:45', 0),
(155, 155, 0, 28, 37, 'Seen', 'AHAHAAHAHHAH', '2017-07-20 16:19:46', 0),
(156, 134, 134, 3, 36, 'LALALALA', 'Dis is the vid', '2017-07-20 17:38:06', 1),
(157, 134, 134, 3, 36, 'For Forever!', 'lalalalala', '2017-07-20 17:46:47', 0),
(158, 134, 157, 28, 36, '', 'All we see is sky for forever. We let the world pass hy for forever, feels like we could go on for forever this way.', '2017-07-20 17:49:26', 0),
(159, 159, 0, 29, 38, 'Chance Passengers no more :(', 'Starting next week July 24, the term &quot;Chance Passengers&quot; will removed under the priority levels of DLSU\'s Arrows Express. They are now called &quot;Paying Passengers&quot; where an outsource will provided and the fare will depend on how many are planning to take the vehicle going to DLSU-Manila and vice versa.\r\n', '2017-07-21 02:32:26', 0),
(160, 160, 0, 29, 38, 'Observations from a long time passenger', 'I am a long time passenger of the Arrows Express for more than three years and manual ticketing is really a burden to me whether those colors matter. The problem is whenever the shuttle is parking near the South Gate or at the front of East Canopy, passengers were triggered especially the &quot;they don\'t know that this color has a purpose&quot; ones where they use their titles or being an older age than the students to hop in the shuttle first. \r\n\r\nLook, Arrows Express was born to provide a ride to the academic community who are in need to the facilities in either campus. \r\n\r\nLets go deeper:\r\nPriority 1: Faculty w/ Intercampus load\r\nPriority 2: Students w/ Intercampus load\r\nPriority 3: Researchers\r\nPriority 4: Administrators\r\nPriority 5*: Chance Passengers\r\n\r\nBased on the priority scheme, it seems that the most affected Lasallians are in those in Priority 1 and 2 where they have classes to teach and to attend. In Manila, some professors are don\'t really care if you are from either campus until you have FDA (Failure Due to Absences) if the student came x minutes late. \r\n\r\nThe bigger impact is on the Priority 1 because the attendance in Manila is really strict and it may result on either late or totally absent and a potential make-up classes may occur.\r\n\r\nSome years ago, the queueing is really bad : ( and based on the first-come-first-serve-does-not-matter-which-colored-ticket-are-you [TL;DR basic queueing]. IT affects the passengers under the priority especially 1 and 2 and the worse there are times that even the parents of that student are requesting to include their child in that schedule (early morning) because she will late for her class (Wow.exe). \r\n\r\nToday, the priority seems to be in effect but the problem now is consistency to the number of passengers on a given schedule vs. the vehicle assigned for that schedule. In my experiences this term, A155 is the hottest schedule where the number of passengers is high and the vehicle is either a 10-seater van or a coaster. Sometimes, I need to defend myself in order to get home na because I don\'t have any activities at STC. [another topic for my reason why soon]. \r\n\r\nI am very happy also that the online reservation will on effect starting next term (AY 2017-2018, Term 1) where the system knows if you have an intercampus load [student or faculty] or just a tourist or a citizen. \r\n\r\nYou know, you already to used have a #TravelGoals in RL where you have a list of plans and knowledge before going to the destination. So, use that hashtag also when you are going to DLSU-STC (now Laguna Campus) especially on the Arrows Express guidelines. Recently, last 2 weeks ago, a group of first timer students from Manila are exploring the campus and when they are given the white embarkation card during the 1pm departure at DLSU, they are complaining that they will not ride that shuttle (at that time, 1pm shuttle is a 14-seater van, an outsource but there are more Priority 2s than the other and also the dispatcher decided to ask those majority if they have classes in DLSU [around 2:30 or so]). They don\'t have a single idea that colors have a reason and they want to change also theirs from white to yellow but the dispatcher refused.\r\n\r\nJust eat some reality if you don\'t want to be them. \r\n \r\n*not anymore starting July 24,2017', '2017-07-21 03:31:14', 0),
(161, 124, 124, 29, 35, '', 'I prefer another degree as long as you have desire to take that program. I know a prof who has 2 Doctoral Degrees in CS and EcE (wow :O ) and I was completely triggered and motivated at the same time to study more x d.', '2017-07-21 03:34:37', 0),
(162, 134, 134, 28, 36, 'COLTON RYAN!', 'OMG ABSENT SI BEN PLATT. NAG PLAY NG EVAN HANSEN SI COLTON RYAN!', '2017-07-21 16:53:09', 0),
(163, 163, 0, 28, 36, 'Hamilton', 'I am not throwing away my shot', '2017-07-21 16:55:46', 0),
(164, 164, 0, 28, 36, 'Falsettos', 'Welcome to falsetto-land!', '2017-07-21 16:57:30', 0),
(165, 134, 134, 28, 36, 'Waving Through a Window', 'When you\'re falling in a forest and there\'s nobody around, do you ever really crash or even make a sound?', '2017-07-21 17:07:11', 0),
(166, 134, 134, 28, 36, 'JOHN KRASINSKI', 'NANOOD SYA NG DEH', '2017-07-22 06:24:07', 0),
(167, 164, 164, 23, 36, '', '??????????', '2017-07-22 15:33:24', 0),
(168, 134, 166, 23, 36, '', 'deh nga?', '2017-07-22 15:34:13', 0),
(169, 134, 166, 23, 36, '', ' ', '2017-07-22 15:37:25', 0),
(170, 164, 164, 3, 36, 'what', 'ð??ð??ð??', '2017-07-23 11:34:51', 0),
(171, 164, 164, 28, 36, '', 'LOOVE, LOVE CAN TELL A MILLION STORIES', '2017-07-28 04:40:16', 0),
(172, 172, 0, 19, 35, '&amp;lt;/3', 'eyyy', '2017-07-31 02:54:13', 0),
(173, 173, 0, 19, 36, 'Wanna eat ice cream. â?ï¸', 'pls', '2017-07-31 02:57:34', 0),
(174, 174, 0, 19, 38, '1 &amp;lt; 2', 'Fact', '2017-07-31 04:30:52', 0),
(175, 175, 0, 3, 40, 'How do you make pizza?', 'As much as I love to eat pizza, I don\'t know how to make one :(', '2017-08-22 01:22:50', 0),
(176, 173, 173, 3, 36, '', 'i want sundae mmmmmmm', '2017-08-22 01:23:27', 0),
(177, 99, 99, 22, 31, 'sweg', 'sweg', '2017-09-21 05:54:13', 0),
(178, 178, 0, 3, 33, 'Chance passenger', 'Ibalik niyo po ang chance passenger', '2017-09-21 05:58:18', 1),
(179, 121, 121, 3, 33, '', 'Ibalik niyo po ang chance passenger', '2017-09-21 05:59:32', 0),
(180, 121, 150, 3, 33, '', 'yes please kailangan ko umuwi :c', '2017-09-21 05:59:52', 0),
(181, 121, 180, 3, 33, '', 'reply', '2017-09-21 06:00:09', 1),
(182, 182, 0, 3, 37, 'President', 'vote niyo si kristian guys', '2017-09-21 06:00:59', 0),
(183, 183, 0, 18, 39, '...', 'Burgerrrr!', '2018-01-04 07:17:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_vote`
--

CREATE TABLE `tbl_post_vote` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_post_vote`
--

INSERT INTO `tbl_post_vote` (`post_id`, `user_id`, `vote_type`) VALUES
(2, 5, 1),
(7, 12, 1),
(7, 6, 1),
(7, 10, 1),
(10, 12, -1),
(10, 8, -1),
(10, 7, -1),
(11, 9, -1),
(11, 10, -1),
(10, 17, -1),
(11, 8, -1),
(13, 8, -1),
(14, 8, -1),
(15, 8, -1),
(16, 8, -1),
(17, 8, -1),
(18, 7, -1),
(18, 8, -1),
(17, 10, 1),
(17, 9, -1),
(13, 9, -1),
(13, 10, -1),
(13, 17, -1),
(10, 10, -1),
(21, 8, -1),
(20, 8, 1),
(20, 10, 1),
(20, 9, 1),
(24, 8, 1),
(23, 8, 1),
(25, 10, 1),
(27, 8, -1),
(31, 10, -1),
(29, 8, -1),
(32, 10, -1),
(30, 10, -1),
(29, 10, -1),
(28, 8, -1),
(27, 10, -1),
(26, 8, -1),
(26, 10, -1),
(28, 10, -1),
(25, 8, 1),
(36, 10, 1),
(35, 10, -1),
(34, 10, 1),
(36, 12, -1),
(37, 9, 1),
(10, 9, -1),
(6, 18, 1),
(46, 12, 1),
(43, 10, 1),
(46, 10, 1),
(46, 16, 1),
(11, 16, 1),
(52, 16, 1),
(46, 19, -1),
(79, 18, -1),
(73, 18, 1),
(83, 3, 1),
(84, 3, 1),
(86, 3, 1),
(41, 3, 1),
(88, 22, 1),
(89, 23, 1),
(97, 22, 1),
(87, 23, 1),
(90, 23, 1),
(91, 23, 1),
(92, 23, 1),
(93, 23, 1),
(94, 23, 1),
(95, 23, 1),
(103, 22, 1),
(102, 22, 1),
(101, 22, 1),
(100, 22, 1),
(99, 22, 1),
(98, 22, 1),
(106, 23, 1),
(107, 23, 1),
(105, 23, 1),
(109, 23, -1),
(111, 22, 1),
(108, 22, 1),
(103, 23, 1),
(102, 23, 1),
(101, 23, 1),
(100, 23, 1),
(99, 23, 1),
(98, 23, 1),
(112, 23, -1),
(83, 23, 1),
(123, 29, 1),
(128, 28, 1),
(129, 28, 1),
(133, 3, -1),
(136, 3, 1),
(137, 3, 1),
(137, 23, 1),
(144, 23, 1),
(134, 28, 1),
(146, 23, -1),
(147, 23, -1),
(150, 23, 1),
(142, 23, 1),
(148, 23, 1),
(141, 23, 1),
(149, 23, 1),
(136, 23, 1),
(133, 23, -1),
(138, 23, 1),
(139, 23, 1),
(140, 23, 1),
(145, 23, 1),
(88, 23, 1),
(151, 23, 1),
(120, 23, 1),
(152, 23, 1),
(117, 23, 1),
(142, 28, -1),
(158, 23, 1),
(157, 23, 1),
(146, 28, 1),
(163, 28, 1),
(164, 28, 1),
(154, 28, 1),
(149, 28, -1),
(153, 28, 1),
(158, 28, 1),
(166, 28, 1),
(165, 28, 1),
(162, 28, 1),
(147, 28, 1),
(154, 23, -1),
(168, 23, 1),
(169, 23, 1),
(168, 28, -1),
(169, 28, -1),
(160, 3, 1),
(152, 19, 1),
(171, 3, 1),
(167, 3, -1),
(150, 3, 1),
(151, 3, 1),
(123, 19, 1),
(170, 28, -1),
(140, 28, -1),
(169, 3, 1),
(44, 3, 1),
(154, 3, 1),
(119, 22, 1),
(83, 22, 1),
(163, 22, 1),
(173, 3, -1),
(163, 3, -1),
(121, 3, 1),
(46, 3, 1),
(164, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topics`
--

CREATE TABLE `tbl_topics` (
  `topic_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `topic_name` varchar(35) NOT NULL,
  `topic_description` varchar(256) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `is_cancelled` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_topics`
--

INSERT INTO `tbl_topics` (`topic_id`, `creator_id`, `topic_name`, `topic_description`, `date_created`, `is_cancelled`) VALUES
(1, 3, 'Welcome To GetTogether!', 'Welcome to GetTogether guys! Feel free to talk about anything in here!', '2017-06-21 01:34:03', 1),
(2, 5, 'chmod and chown', 'how to chmod and chown', '2017-06-21 06:04:02', 0),
(3, 5, 'Other Topics', 'Topics with the desire to reach out to other schools or communities.\r\n', '2017-06-22 05:31:11', 1),
(10, 12, 'Steam Sale', 'Cheap games', '2017-06-23 04:40:19', 0),
(11, 18, 'Movie recommend', 'Bawal *tut*', '2017-06-23 07:50:45', 0),
(12, 18, 'How do you make a game???????', 'Suggestions \r\nanyone?????????????????????????', '2017-06-27 02:12:19', 0),
(13, 7, 'Practicum Experience', 'Share something about your practicum experience.', '2017-06-27 02:12:57', 0),
(14, 19, 'Steam Sale', 'What did you get?', '2017-06-28 11:57:01', 0),
(15, 19, 'Memes', 'For the dankest of memes.', '2017-06-28 12:01:15', 0),
(16, 17, 'Kdramas', 'oppppppppppppaaaaaaaaaaaaaaaaaaaa', '2017-06-29 01:33:15', 0),
(17, 18, 'Topics to talk about', '???', '2017-06-29 08:51:02', 1),
(18, 16, 'HOT TOPIC', 'idk what u were expecting, but if ur a tru edgelurd u must kno h0t t0P1K\r\nhttp://www.hottopic.com/', '2017-06-29 08:55:06', 1),
(19, 16, '3DGY', 'wowz have you heard of the new LoL character, Kayn the Shadow Reaper? edge 2 the m4x powhz', '2017-06-29 08:57:31', 0),
(20, 16, 'Spam', 'links to buy spam online', '2017-06-29 09:00:10', 1),
(21, 18, 'Go lang Enzo', 'lololol', '2017-06-29 09:01:22', 1),
(22, 18, 'Gawa tayo ng topics', 'hehehehe', '2017-06-29 09:02:39', 1),
(23, 18, 'how to be u po?', '????????????????', '2017-06-29 09:12:05', 0),
(24, 18, 'Ano na ginagawa niyo after SIP???', 'Nagtatanong lang', '2017-07-02 11:09:05', 0),
(25, 3, '&lt;/3', 'asdg &lt;3', '2017-07-10 01:17:36', 1),
(26, 21, 'Josie Rizal', 'You know Josie, the Tekken character named after me! lol\n\narces was here hehe', '2017-07-11 18:10:48', 0),
(27, 22, 'GoT Spoilers', 'Winter is here! ??', '2017-07-14 04:01:46', 0),
(28, 24, 'Vote now', 'Please vote\r\ni love ragnarok #cosmic #firebolt #win', '2017-07-19 13:51:08', 0),
(29, 23, 'Star Wars: The Last Jedi - Theories', 'ben solo will be redeemed', '2017-07-19 13:57:14', 0),
(30, 3, 'hello world hello world hello world', 'adsgawegaweg', '2017-07-19 13:59:43', 1),
(31, 23, 'Kdramas', 'kdrama is life', '2017-07-19 14:45:56', 0),
(32, 19, 'Community Building', 'Topics about Community Building.', '2017-07-20 07:37:01', 0),
(33, 19, 'Facilities and Services in STC', 'Anything about STC\'s facilities and services.', '2017-07-20 07:39:56', 0),
(34, 19, 'Future Events in the Campus', 'If may events for STC pwede rin siguro dito magpubs. :)', '2017-07-20 07:43:41', 0),
(35, 19, 'Career', 'Career and Life After Graduation.', '2017-07-20 07:44:27', 0),
(36, 28, 'Musical Theatre', 'When you\'re falling in a forest', '2017-07-20 07:49:43', 0),
(37, 33, 'USG General Elections 2017', 'University Student Government Elections!', '2017-07-20 14:34:57', 0),
(38, 29, 'Arrows Express', 'All related talks about DLSU\'s Arrows Express are here x d', '2017-07-21 02:29:43', 0),
(39, 3, 'Fast Food', 'Chicken or burger?', '2017-08-20 22:45:20', 0),
(40, 3, 'Pizza!', 'Pepperoni pizza is my favorite. What\'s yours? ;)', '2017-08-22 01:20:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topic_follower`
--

CREATE TABLE `tbl_topic_follower` (
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_topic_follower`
--

INSERT INTO `tbl_topic_follower` (`topic_id`, `user_id`) VALUES
(2, 5),
(5, 6),
(6, 6),
(7, 6),
(8, 6),
(4, 5),
(3, 5),
(9, 5),
(3, 10),
(3, 9),
(3, 12),
(3, 8),
(3, 11),
(10, 12),
(10, 9),
(10, 10),
(10, 8),
(10, 6),
(3, 6),
(10, 17),
(11, 18),
(12, 18),
(13, 7),
(14, 19),
(15, 19),
(16, 17),
(16, 10),
(15, 10),
(14, 10),
(14, 8),
(15, 8),
(15, 17),
(17, 18),
(18, 16),
(19, 16),
(20, 16),
(21, 18),
(22, 18),
(23, 18),
(20, 18),
(15, 20),
(18, 20),
(14, 9),
(24, 18),
(25, 3),
(26, 3),
(26, 21),
(1, 3),
(15, 3),
(3, 3),
(11, 3),
(12, 3),
(14, 3),
(16, 3),
(18, 3),
(20, 3),
(27, 22),
(28, 24),
(27, 23),
(29, 23),
(30, 3),
(29, 24),
(30, 24),
(29, 22),
(29, 3),
(27, 24),
(27, 3),
(31, 23),
(31, 22),
(31, 24),
(31, 28),
(32, 19),
(33, 19),
(32, 29),
(34, 19),
(35, 19),
(33, 23),
(34, 23),
(32, 23),
(35, 23),
(36, 28),
(31, 3),
(33, 3),
(36, 33),
(15, 28),
(29, 28),
(37, 33),
(36, 23),
(38, 29),
(36, 3),
(39, 3),
(40, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topic_moderator`
--

CREATE TABLE `tbl_topic_moderator` (
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_topic_moderator`
--

INSERT INTO `tbl_topic_moderator` (`topic_id`, `user_id`) VALUES
(1, 3),
(2, 5),
(3, 5),
(4, 5),
(5, 6),
(6, 6),
(7, 6),
(8, 6),
(9, 5),
(1, 5),
(10, 12),
(11, 18),
(12, 18),
(13, 7),
(14, 19),
(15, 19),
(16, 17),
(17, 18),
(18, 16),
(19, 16),
(20, 16),
(21, 18),
(22, 18),
(23, 18),
(24, 18),
(25, 3),
(26, 21),
(27, 22),
(28, 24),
(29, 23),
(30, 3),
(31, 23),
(32, 19),
(33, 19),
(34, 19),
(35, 19),
(36, 28),
(37, 33),
(38, 29),
(33, 33),
(33, 33),
(39, 3),
(40, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_enabled` int(1) NOT NULL,
  `is_online` binary(1) DEFAULT NULL,
  `profile_url` varchar(100) DEFAULT NULL,
  `session_id` varchar(45) DEFAULT NULL,
  `description` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `birthdate`, `role_id`, `is_enabled`, `is_online`, `profile_url`, `session_id`, `description`) VALUES
(1, 'arces@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Administrator', 'Arces', '1996-12-28', 1, 1, NULL, NULL, NULL, NULL),
(2, 'edward@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Edward', 'Tiro', '1996-12-25', 1, 1, NULL, NULL, NULL, NULL),
(3, 'arcestalavera@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arces', 'Talavera', '1996-12-28', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(5, 'dssssss@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Mike', 'Dayupay', '1991-04-16', 2, 1, NULL, NULL, NULL, NULL),
(6, 'dward@tiro.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Edward', 'Tiro', '1996-11-29', 2, 1, NULL, NULL, NULL, NULL),
(7, 'zedrick@ty.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Lourde', 'N. Savor', '2002-04-06', 2, 1, NULL, NULL, NULL, 'bio'),
(8, 'jim@valentin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '.', '.', '1998-12-29', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(9, 'macx@isip.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Lowrd', '&amp; Savor', '2002-04-25', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(10, 'luis@villadarez.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Louwrd N', 'Savor', '1998-12-19', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(11, 'franc@calma.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Franc', 'Calma', '1981-08-18', 1, 0, NULL, NULL, NULL, NULL),
(12, 'eulo@peneyra.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Eulo', 'Peneyra', '2001-12-02', 2, 1, NULL, NULL, NULL, NULL),
(13, 'redjamesmanalili@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Red', 'Manalili', '2001-07-17', 1, 0, NULL, NULL, NULL, NULL),
(14, 'atasuke@kanegawa.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Atasuke', 'Kanegawa', '1946-08-05', 1, 0, NULL, NULL, NULL, NULL),
(15, 'red@manalili.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Red', 'Manalili', '2001-07-17', 1, 0, NULL, NULL, NULL, NULL),
(16, 'vincenzo@cortez.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Vincenzo', 'Cortez', '2001-08-27', 2, 1, NULL, NULL, NULL, NULL),
(17, 'francine@calma.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Francine', 'Calma', '1981-08-18', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(18, 'james@manalili.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'You don\'t', 'Know me', '2001-07-17', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(19, 'edward@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Edward', 'Tiro', '1996-02-11', 2, 1, NULL, NULL, NULL, NULL),
(20, 'ymer@samson.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Ymer', 'Samson', '1996-01-17', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(21, 'joserizal@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Jose', 'Rizal', '1961-06-19', 2, 1, NULL, NULL, NULL, NULL),
(22, 'arrenstark@winterfell.ws', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arren', 'Stark', '1997-05-14', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.gif', NULL, NULL),
(23, 'hs@sw.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Han', 'Sibs', '1996-10-05', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.gif', NULL, NULL),
(24, 'wat@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Jet', 'Destroyer', '2017-07-19', 2, 1, NULL, NULL, NULL, ''),
(25, 'jeruel_trinidad@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Jj', 'Trinidad', '1998-02-13', 2, 1, NULL, NULL, NULL, NULL),
(26, 'samuel_marquez@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Samuel', 'Marquez', '1996-09-02', 2, 1, NULL, NULL, NULL, NULL),
(27, 'maynard_si@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Maynard John', 'Si', '1997-10-12', 2, 1, NULL, NULL, NULL, NULL),
(28, 'rigel_5656@yahoo.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Rigel', '#de #castro', '1997-03-16', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(29, 'reynaldo_bayeta@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'RJ', 'Bayeta', '1995-05-23', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(30, 'rgee_gallega@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Rgee', 'Gallega', '1997-12-22', 2, 1, NULL, NULL, NULL, NULL),
(31, 'fake@account', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Fake', 'Account', '2017-07-20', 2, 1, NULL, NULL, NULL, NULL),
(32, 'cyrus_vatandoostkakhki@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Cyrus', 'Vatandoost', '1997-12-08', 2, 1, NULL, NULL, NULL, NULL),
(33, 'kristian_sisayan@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Kristian ', 'Sisayan', '1996-07-23', 2, 1, NULL, NULL, NULL, NULL),
(34, 'nikki.ebora@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Nikki', 'Ebora', '2017-03-30', 2, 1, NULL, NULL, NULL, NULL),
(35, 'missjeng@te3dhouse.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Miss Jeng', 'Gendrano', '2017-09-26', 1, 1, NULL, NULL, NULL, NULL),
(36, 'roskiecruz@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Kristoffer Ross', 'Cruz', '1993-09-03', 2, 1, NULL, NULL, NULL, NULL),
(37, 'hello@miguelambrosio.me', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Miguel', 'Ambrosio', '1986-09-18', 2, 1, NULL, NULL, NULL, NULL),
(38, 'talaveraarces@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arces', 'Talavera', '1996-12-28', 2, 1, NULL, NULL, NULL, NULL),
(39, 'aric_brillantes@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Brillantes', '1999-09-30', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL),
(40, 'klaudia_borromeo@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Borromeo', '1997-09-01', 2, 1, NULL, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `tbl_attachment_type`
--
ALTER TABLE `tbl_attachment_type`
  ADD PRIMARY KEY (`attachment_type_id`);

--
-- Indexes for table `tbl_genders`
--
ALTER TABLE `tbl_genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_moderator_invite`
--
ALTER TABLE `tbl_moderator_invite`
  ADD PRIMARY KEY (`invite_id`);

--
-- Indexes for table `tbl_moderator_request`
--
ALTER TABLE `tbl_moderator_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `tbl_notification_type`
--
ALTER TABLE `tbl_notification_type`
  ADD PRIMARY KEY (`notification_type_id`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `tbl_moderator_invite`
--
ALTER TABLE `tbl_moderator_invite`
  MODIFY `invite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_moderator_request`
--
ALTER TABLE `tbl_moderator_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- AUTO_INCREMENT for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
