-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2020 at 09:32 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mukhlatv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE `tbl_announcements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `announcement` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_announcements`
--

INSERT INTO `tbl_announcements` (`id`, `user_id`, `announcement`, `date`) VALUES
(1, 2, 'Good morning kids! We wont be having any classes today because of the typhoonÂ ðÂ Stay safe out there!Â ', '2019-12-02 14:17:00'),
(2, 1, 'Hello everyone! I noticed some of you have been using bad words.Â  I want to remind you that these words are not nice and should never be said to others.Â ðÂ I hope you\'re all enjoying using Mukhlat!Â â¤ï¸', '2019-12-05 13:47:18');

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

INSERT INTO `tbl_attachments` (`attachment_id`, `post_id`, `file_url`, `attachment_type_id`, `caption`) VALUES
(1, 10, './uploads/_10/f8e6ae8ec414308ba3f56929537e6177.jpg', 1, ''),
(2, 13, './uploads/_13/72433134fd2b27c7f694476f2e37cb2d.jpg', 1, ''),
(3, 14, './uploads/_14/96d0c17e02003e3a231a381cbf88a3d9.jpg', 1, ''),
(4, 15, './uploads/_15/a7d78abf729bd07bf91bec769b97d8bf.png', 1, ''),
(5, 16, './uploads/_16/fa77ca1b5f386e5cd223e52dee3db788.png', 1, ''),
(6, 19, './uploads/_19/94c07c2fba797f616fd5cd01428a6d93.png', 1, ''),
(7, 20, './uploads/_20/842512fd7cc7c3534f3c8812347896e9.jpg', 1, ''),
(8, 22, './uploads/_22/744cd04b94b4cf50e9da879939964c5e.png', 1, ''),
(9, 23, './uploads/_23/c2498237a3266f6842ab4b425ff51bf8.jpg', 1, ''),
(10, 24, './uploads/_24/4f024b55a3edb34692a9d38b1e767312.mp3', 2, ''),
(11, 26, './uploads/_26/da3269437e2fb1713749fc7f1459dca9.mp4', 3, '');

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
-- Table structure for table `tbl_chatmsgs`
--

CREATE TABLE `tbl_chatmsgs` (
  `chat_message_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `chat_message` varchar(500) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chatmsgs`
--

INSERT INTO `tbl_chatmsgs` (`chat_message_id`, `chat_id`, `sender_id`, `chat_message`, `create_date`) VALUES
(14, 1, 39, 'helo', '2019-10-04 05:14:24'),
(17, 1, 39, 'new one', '2019-10-04 05:51:36'),
(23, 1, 39, 'hello', '2019-10-07 07:57:19'),
(34, 1, 21, 'wow!', '2019-10-12 04:49:13'),
(35, 1, 21, 'YAY!', '2019-10-12 04:49:13'),
(36, 1, 39, 'YEAH!', '2019-10-14 07:12:25'),
(37, 1, 39, 'asd', '2019-10-14 07:15:08'),
(38, 1, 39, 'kik', '2019-10-14 07:27:34'),
(39, 1, 39, 'hhe', '2019-10-14 07:28:16'),
(40, 1, 39, 'yey', '2019-10-14 11:09:12'),
(41, 1, 39, 'woa', '2019-10-14 11:09:31'),
(42, 2, 40, 'hello', '2019-10-15 05:40:17'),
(43, 2, 40, 'otherchat', '2019-10-15 05:40:17'),
(44, 1, 21, 'test', '2019-10-15 05:52:25'),
(45, 1, 39, 'hello', '2019-10-15 06:17:30'),
(46, 1, 21, 'hi aric', '2019-10-16 02:05:10'),
(47, 1, 39, 'hello jose', '2019-10-16 02:05:20'),
(48, 1, 39, 'yaaaaaas', '2019-10-16 03:43:26'),
(49, 1, 39, 'asd', '2019-10-16 03:49:34'),
(50, 1, 39, 'yes', '2019-10-16 03:52:32'),
(51, 2, 39, 'hi gaia', '2019-10-16 04:00:26'),
(52, 2, 40, 'hi aric', '2019-10-16 04:01:21'),
(53, 6, 40, 'hi jose', '2019-10-16 04:02:43'),
(54, 8, 40, 'hey arces', '2019-10-16 04:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chats`
--

CREATE TABLE `tbl_chats` (
  `chat_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_chats`
--

INSERT INTO `tbl_chats` (`chat_id`, `user_1`, `user_2`, `created_date`) VALUES
(1, 21, 39, '2019-09-25 01:39:41'),
(2, 39, 40, '2019-10-08 05:20:41'),
(3, 39, 3, '2019-10-08 05:20:41'),
(4, 39, 5, '2019-10-15 06:16:00'),
(5, 39, 32, '2019-10-15 06:20:53'),
(6, 40, 21, '2019-10-16 04:02:16'),
(7, 40, 18, '2019-10-16 04:36:25'),
(8, 40, 3, '2019-10-16 04:36:41');

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
-- Table structure for table `tbl_infractions`
--

CREATE TABLE `tbl_infractions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `current_total` float NOT NULL DEFAULT '0',
  `last_total` int(11) NOT NULL DEFAULT '0',
  `overall_total` float NOT NULL DEFAULT '0',
  `last_avg` float NOT NULL DEFAULT '0',
  `current_avg` float NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_infractions`
--

INSERT INTO `tbl_infractions` (`id`, `user_id`, `current_total`, `last_total`, `overall_total`, `last_avg`, `current_avg`, `updated`) VALUES
(22, 10, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(23, 11, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(21, 12, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(24, 13, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(25, 14, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(26, 15, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(27, 16, 0, 0, 0, 0, 0, '2020-02-02 00:00:00'),
(1, 24, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(2, 25, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(3, 26, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(4, 27, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(5, 28, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(6, 29, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(7, 30, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(8, 31, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(9, 32, 0, 0, 2, 0, 0, '2020-01-27 00:00:00'),
(10, 33, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(11, 34, 0, 0, 1, 0, 0, '2020-01-27 00:00:00'),
(12, 35, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(13, 37, 0, 0, 1, 0, 0, '2020-01-25 00:00:00'),
(14, 38, 0, 0, 7, 0, 1, '2020-01-27 00:00:00'),
(15, 39, 3, 0, 11, 0, 0, '2020-01-30 00:00:00'),
(16, 40, 0, 0, 0, 0, 0, '2020-01-27 00:00:00'),
(20, 41, 0, 0, 0, 0, 0, '2020-01-30 00:00:00');

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
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `id` int(11) NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(320, 5, 39, 38, 314, 1, '2019-11-06 10:49:36'),
(321, 5, 36, 38, 487, 0, '2019-12-04 12:09:20'),
(322, 5, 36, 38, 488, 0, '2019-12-04 12:09:20'),
(323, 5, 36, 38, 489, 0, '2019-12-04 12:09:20'),
(324, 5, 36, 38, 490, 0, '2019-12-04 12:10:09'),
(325, 5, 36, 38, 491, 0, '2019-12-04 12:10:09'),
(326, 5, 36, 38, 492, 0, '2019-12-04 12:10:09'),
(327, 5, 36, 38, 493, 0, '2019-12-04 12:25:35'),
(328, 5, 28, 27, 8, 0, '2019-12-10 12:11:55'),
(329, 5, 28, 38, 9, 0, '2019-12-10 12:13:57'),
(330, 5, 29, 38, 17, 0, '2019-12-10 12:18:26'),
(331, 5, 31, 32, 22, 0, '2019-12-10 12:21:17'),
(332, 5, 27, 33, 24, 0, '2019-12-10 12:23:37'),
(333, 5, 35, 29, 34, 0, '2019-12-10 12:28:23'),
(334, 5, 33, 37, 36, 0, '2019-12-10 12:52:27'),
(335, 5, 38, 39, 43, 0, '2019-12-10 13:07:42'),
(336, 5, 34, 39, 49, 0, '2019-12-10 13:15:05'),
(337, 5, 34, 38, 50, 0, '2019-12-10 13:22:53'),
(338, 5, 27, 38, 51, 0, '2019-12-10 13:23:56'),
(339, 5, 32, 34, 53, 0, '2019-12-10 13:25:43'),
(340, 5, 28, 37, 54, 0, '2019-12-10 13:27:50'),
(341, 5, 38, 39, 55, 0, '2019-12-10 13:29:19'),
(342, 5, 39, 29, 58, 0, '2019-12-10 13:31:44'),
(343, 5, 37, 32, 59, 0, '2019-12-10 13:32:42'),
(344, 5, 38, 32, 60, 0, '2019-12-10 13:34:13'),
(345, 5, 38, 32, 61, 0, '2019-12-10 13:38:02'),
(346, 5, 37, 39, 62, 0, '2019-12-10 13:48:12'),
(347, 5, 35, 40, 66, 0, '2019-12-10 13:50:33'),
(348, 5, 33, 40, 67, 0, '2019-12-10 13:51:16'),
(349, 5, 11, 10, 11, 0, '2020-02-02 14:55:51'),
(350, 5, 12, 16, 18, 0, '2020-02-02 16:06:37'),
(351, 5, 10, 14, 21, 0, '2020-02-02 16:14:52'),
(352, 5, 13, 12, 25, 0, '2020-02-02 16:27:23');

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
  `is_deleted` int(1) NOT NULL DEFAULT '0',
  `reply` int(11) DEFAULT NULL,
  `shout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `root_id`, `parent_id`, `user_id`, `topic_id`, `post_title`, `post_content`, `date_posted`, `is_deleted`, `reply`, `shout`) VALUES
(1, 1, 0, 10, 1, ' ', 'hi guys my name is terence! i like foodÂ ;yum;', '2020-02-02 14:00:04', 0, 0, 0),
(2, 2, 0, 11, 2, ' ', 'i am iris and i like games!', '2020-02-02 14:06:56', 0, 0, 0),
(3, 3, 0, 12, 3, ' ', 'I LIKE CATSÂ ;laughing crying;', '2020-02-02 14:30:47', 0, 0, 0),
(6, 6, 0, 13, 4, ' ', 'i like memes!!!!!!!!!!', '2020-02-02 14:34:39', 0, 0, 0),
(7, 7, 0, 14, 5, ' ', 'i liek star wars!Â ;haha;', '2020-02-02 14:42:25', 0, 0, 0),
(8, 8, 0, 15, 6, ' ', 'i like minecraft!!', '2020-02-02 14:43:10', 0, 0, 0),
(9, 9, 0, 16, 7, ' ', 'I LIKE DRAWING', '2020-02-02 14:46:14', 0, 0, 0),
(10, 10, 0, 11, 2, ' ', 'here!', '2020-02-02 14:50:49', 0, 1, 0),
(11, 11, 0, 10, 2, ' ', ';cool;;cool;', '2020-02-02 14:55:51', 0, 1, 0),
(12, 12, 0, 11, 2, ' ', 'thanks!', '2020-02-02 15:02:11', 0, 1, 0),
(13, 13, 0, 12, 3, ' ', ';laughing crying;;laughing crying;;laughing crying;', '2020-02-02 15:04:19', 0, 1, 0),
(14, 14, 0, 10, 1, ' ', 'ate this earlier mmm', '2020-02-02 15:49:43', 0, 1, 0),
(15, 15, 0, 16, 7, ' ', 'sonic 1', '2020-02-02 16:05:36', 0, 0, 0),
(16, 16, 0, 16, 7, ' ', 'sonic 2', '2020-02-02 16:06:00', 0, 0, 0),
(17, 17, 0, 16, 7, ' ', 'as you can see i like sonic', '2020-02-02 16:06:14', 0, 1, 0),
(18, 18, 0, 16, 3, ' ', ';haha;;haha;', '2020-02-02 16:06:37', 0, 1, 0),
(19, 19, 0, 14, 5, ' ', 'â¤ï¸', '2020-02-02 16:13:22', 0, 1, 0),
(20, 20, 0, 14, 5, ' ', 'I love this show!!!', '2020-02-02 16:14:27', 0, 0, 0),
(21, 21, 0, 14, 1, ' ', ';cool;;yum;', '2020-02-02 16:14:52', 0, 1, 0),
(22, 22, 0, 15, 6, ' ', 'see', '2020-02-02 16:18:14', 0, 0, 0),
(23, 23, 0, 13, 4, ' ', 'hahaha', '2020-02-02 16:21:45', 0, 1, 0),
(24, 24, 0, 13, 4, ' ', 'fortnite!', '2020-02-02 16:26:28', 0, 0, 0),
(25, 25, 0, 12, 4, ' ', 'XDÂ ;wenk haha;', '2020-02-02 16:27:23', 0, 1, 0),
(26, 26, 0, 11, 2, ' ', 'thanos', '2020-02-02 16:31:30', 0, 0, 0);

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
(164, 3, 1),
(186, 39, 1);

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
(2, 'Child'),
(3, 'Parent');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topics`
--

CREATE TABLE `tbl_topics` (
  `topic_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `topic_name` varchar(35) NOT NULL,
  `topic_description` varchar(256) NOT NULL,
  `theme` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `is_cancelled` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_topics`
--

INSERT INTO `tbl_topics` (`topic_id`, `creator_id`, `topic_name`, `topic_description`, `theme`, `date_created`, `is_cancelled`) VALUES
(1, 10, 'Terence\'s Room', '', 1, '2017-06-28 12:01:15', 0),
(2, 11, 'Iris\' Room', '', 6, '2017-07-20 07:44:27', 0),
(3, 12, 'James\' Room', '', 15, '2017-07-11 18:10:48', 0),
(4, 13, 'Michael\'s Room', '', 1, '2017-07-11 19:10:48', 0),
(5, 14, 'Arlan\'s Room', '', 7, '2017-07-11 20:10:48', 0),
(6, 15, 'Karl\'s Room', '', 8, '2017-07-14 04:01:46', 0),
(7, 16, 'Khobert\'s Room', '', 17, '2017-07-19 13:57:14', 0);

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
(40, 3),
(40, 39),
(41, 39),
(36, 39),
(37, 39),
(42, 39),
(43, 39),
(40, 38),
(41, 38);

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
(40, 3),
(41, 39),
(42, 39),
(43, 39),
(40, 38),
(41, 38);

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
  `parent` varchar(256) DEFAULT NULL,
  `is_enabled` int(1) NOT NULL,
  `profile_url` varchar(100) DEFAULT NULL,
  `description` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `birthdate`, `role_id`, `parent`, `is_enabled`, `profile_url`, `description`) VALUES
(1, 'aric@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Admin', '1999-09-30', 1, NULL, 1, NULL, NULL),
(2, 'gaia@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Admin', '1996-12-25', 1, NULL, 1, NULL, NULL),
(3, 'raf@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Rafael', 'Admin', '1997-08-18', 1, NULL, 1, NULL, NULL),
(4, 'arnie.azcarraga@delasalle.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arnulfo', 'Azcarraga', '1950-09-30', 3, NULL, 1, NULL, NULL),
(5, 'terrence.esguerra@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Terrence', 'Esguerra', '1950-09-30', 3, NULL, 1, NULL, NULL),
(6, 'ma.christine.gendrano@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Ma. Christine', 'Gendrano', '1950-09-30', 3, NULL, 1, NULL, NULL),
(7, 'aric30@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Brillantes', '1999-09-30', 3, NULL, 1, NULL, NULL),
(8, 'raf@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Raf', 'Parent', '1998-10-01', 3, NULL, 1, NULL, NULL),
(9, 'gaia@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Parent', '1999-10-02', 3, NULL, 1, NULL, NULL),
(10, 'terence_dugang@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Terence', 'Dugang', '2012-09-02', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(11, 'iris_libay@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Iris', 'Libay', '2013-10-12', 2, 'gaia@gmail.com', 1, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', NULL),
(12, 'james_baladjay@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'James', 'Baladjay', '2013-03-16', 2, 'gaia@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(13, 'neil_noble@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Michael', 'Noble', '2013-01-24', 2, 'ma.christine.gendrano@dlsu.edu.ph', 1, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', NULL),
(14, 'arlan_gomez@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arlan', 'Gomez', '2013-12-18', 2, 'ma.christine.gendrano@dlsu.edu.ph', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(15, 'karl_mamuyac@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Karl', 'Mamuyac', '2012-05-23', 2, 'terrence.esguerra@dlsu.edu.ph', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(16, 'khobert_linchangco@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Khobert', 'Linchangco', '2014-12-22', 2, 'terrence.esguerra@dlsu.edu.ph', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertimes`
--

CREATE TABLE `tbl_usertimes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_setting` varchar(10000) DEFAULT 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A',
  `warning` int(11) DEFAULT NULL,
  `keep` int(11) NOT NULL DEFAULT '1',
  `use_limit` int(11) NOT NULL DEFAULT '180'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_usertimes`
--

INSERT INTO `tbl_usertimes` (`id`, `user_id`, `time_setting`, `warning`, `keep`, `use_limit`) VALUES
(1, 10, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(2, 11, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(3, 12, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(4, 13, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(5, 14, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 60),
(6, 15, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(7, 16, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell182-A cell183-A cell184-A cell185-A cell186-A cell187-A cell189-A cell190-A cell191-A cell192-A cell193-A cell194-A cell196-A cell197-A cell198-A cell199-A cell200-A cell201-A cell203-A cell204-A cell205-A cell206-A cell207-A cell208-A cell210-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_chatmsgs`
--
ALTER TABLE `tbl_chatmsgs`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `tbl_chats`
--
ALTER TABLE `tbl_chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `tbl_genders`
--
ALTER TABLE `tbl_genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `tbl_infractions`
--
ALTER TABLE `tbl_infractions`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_usertimes`
--
ALTER TABLE `tbl_usertimes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcements`
--
ALTER TABLE `tbl_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_chatmsgs`
--
ALTER TABLE `tbl_chatmsgs`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_infractions`
--
ALTER TABLE `tbl_infractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_usertimes`
--
ALTER TABLE `tbl_usertimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
