-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 07:26 AM
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

DROP DATABASE IF EXISTS mukhlatv2;
CREATE DATABASE mukhlatv2;
USE mukhlatv2;

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
(39, 3, './uploads/_3/a34dc1099df64497388c7be26fd80aed.png', 1, ''),
(40, 5, './uploads/_5/4fc0d1b4b48e995de2f6323693202e4e.png', 1, ''),
(41, 7, './uploads/_7/0f4d9a38005a000716222f1f2cb24a69.png', 1, ''),
(42, 9, './uploads/_9/06c5892c2cabac393a97e133f3aa8d19.png', 1, ''),
(43, 12, './uploads/_12/7f507b42a5415f427e608604938b05b3.mp3', 2, ''),
(44, 16, './uploads/_16/9823bd86694f1802c21e6527b35d843d.jpg', 1, ''),
(45, 19, './uploads/_19/3cede9b4d05faec98b3f4bd4b5b752e5.jpg', 1, ''),
(46, 22, './uploads/_22/39796ac24e6a9966a90c2d4145c0b01f.jpg', 1, ''),
(47, 23, './uploads/_23/3023819dc038af59821abb8fab0e42cc.jpg', 1, ''),
(48, 24, './uploads/_24/5c28228ad6762f3a7b94fc22f6241255.png', 1, ''),
(49, 25, './uploads/_25/110d2cfcd756842089da375c1518edcb.jpg', 1, ''),
(50, 30, './uploads/_30/aeae8ec7507b609b3b234bad435d4047.jpg', 1, ''),
(52, 32, './uploads/_32/10336964d30266c4ac18df9fe9b7b521.jpg', 1, ''),
(53, 35, './uploads/_35/a8ed54d8417617fa677dd7165e41b413.jpg', 1, ''),
(54, 39, './uploads/_39/a8ad8bff9230632a88406cd437ad5268.png', 1, ''),
(55, 41, './uploads/_41/1ad7c47352f0df882797c2c84fb2665e.jpg', 1, ''),
(56, 42, './uploads/_42/1c65922a5b2db9f18cf38e99bd7624bb.jpg', 1, ''),
(57, 46, './uploads/_46/ab76c756e53a944c5ba274b1c162520f.jpg', 1, ''),
(58, 47, './uploads/_47/0594267f666137cc231a28b98b7ff34d.jpg', 1, ''),
(59, 52, './uploads/_52/0996e43e3534e46168103ab8924759e9.png', 1, ''),
(60, 53, './uploads/_53/0b15a9db61e1bf97deb99706afc02514.png', 1, ''),
(61, 56, './uploads/_56/e2848729c54ccf55fcb8b2a274a55b53.jpg', 1, ''),
(62, 57, './uploads/_57/e02a92e28aeb3f1e0f71bf09b334e28f.mp4', 3, ''),
(63, 58, './uploads/_58/6bf9e67063fda82c4daef4bf780a60d3.jpg', 1, ''),
(64, 59, './uploads/_59/c34d0fc26dc526d4ff355bfd6dc8aaf7.JPG', 1, ''),
(65, 60, './uploads/_60/c3d2dd3b8c2456e83537b01b840928db.jpg', 1, ''),
(66, 62, './uploads/_62/936617113f5011d805a8dec03a276808.png', 1, ''),
(67, 64, './uploads/_64/fcb32969ec87b4f82d1e9eb19c7d446a.JPG', 1, ''),
(68, 65, './uploads/_65/d74b03c06a30cb4e660de509f6df44ec.jpg', 1, ''),
(69, 66, './uploads/_66/5a287c54b1b8607ebccff41bf78329c4.jpg', 1, ''),
(70, 67, './uploads/_67/00bffde7856778e34a4f8c8fc37fdbe2.png', 1, '');

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
(1, 24, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(2, 26, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(3, 27, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(4, 28, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(5, 29, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(6, 30, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(7, 31, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(8, 32, 2, 0, 2, 0, 0, '2019-12-10 00:00:00'),
(9, 33, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(10, 34, 1, 0, 1, 0, 0, '2019-12-10 00:00:00'),
(11, 35, 0, 0, 0, 0, 0, '2019-12-10 00:00:00'),
(12, 37, 0, 0, 1, 0, 0, '2019-12-10 00:00:00'),
(13, 38, 5, 2, 7, 0, 1, '2019-12-10 00:00:00'),
(14, 39, 4, 3, 7, 0, 0, '2019-12-10 00:00:00'),
(15, 40, 0, 0, 0, 0, 0, '2019-12-10 00:00:00');

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

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`id`, `child_id`, `parent_id`, `note`, `date`) VALUES
(1, 37, 7, 'sasa', '2019-11-27 09:22:55'),
(404, 34, 4, 'hey that isnt a nice word, be careful next timeÂ ð', '2019-12-10 14:20:13'),
(405, 39, 7, 'I hope you\'re enjoying using Mukhlat!', '2019-12-10 14:21:41'),
(406, 38, 7, 'Raf, that\'s a bad word! Remember what we discussed? Avoid these words next timeÂ ð', '2019-12-10 14:22:38'),
(407, 38, 7, 'good to see that you\'re interacting with others, though!', '2019-12-10 14:22:58');

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
(348, 5, 33, 40, 67, 0, '2019-12-10 13:51:16');

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
(3, 3, 0, 27, 27, ' ', 'I like minecraft', '2019-12-10 12:08:11', 0, 0, 0),
(4, 4, 0, 27, 27, ' ', 'minecraft good', '2019-12-10 12:08:28', 0, 0, 0),
(5, 5, 0, 27, 27, ' ', 'robloc nice tooÂ ð', '2019-12-10 12:09:14', 0, 0, 0),
(6, 6, 0, 28, 28, ' ', 'hi visitor', '2019-12-10 12:11:03', 0, 0, 0),
(7, 7, 0, 28, 28, ' ', 'baby yodaÂ â¤ï¸', '2019-12-10 12:11:28', 0, 0, 0),
(8, 8, 0, 27, 28, ' ', 'baby yoda do be lookin kinda fresh doeÂ ð³', '2019-12-10 12:11:55', 0, 1, 0),
(9, 9, 0, 39, 28, ' ', 'yeet', '2019-12-10 12:13:57', 0, 1, 0),
(10, 10, 0, 29, 29, ' ', 'ayo', '2019-12-10 12:14:44', 0, 1, 0),
(11, 11, 0, 29, 29, ' ', 'my name jeff', '2019-12-10 12:14:54', 0, 0, 0),
(12, 12, 0, 29, 29, ' ', 'this song gucciÂ ð', '2019-12-10 12:16:12', 0, 0, 0),
(13, 13, 0, 33, 33, ' ', 'wow i get to talk here cool', '2019-12-10 12:17:07', 0, 0, 0),
(14, 14, 0, 33, 33, ' ', 'whats this foe', '2019-12-10 12:17:17', 0, 1, 0),
(15, 15, 0, 33, 33, ' ', 'for', '2019-12-10 12:17:21', 0, 1, 0),
(16, 16, 0, 33, 33, ' ', 'my pogs hha', '2019-12-10 12:18:00', 0, 0, 0),
(17, 17, 0, 39, 29, ' ', 'dat song kinna lit bro', '2019-12-10 12:18:26', 0, 1, 0),
(18, 18, 0, 31, 31, ' ', 'wow these colors r nice.', '2019-12-10 12:19:13', 0, 0, 0),
(19, 19, 0, 31, 31, ' ', 'post it tooÂ ð', '2019-12-10 12:19:47', 0, 0, 0),
(20, 20, 0, 32, 32, ' ', 'i like memes', '2019-12-10 12:20:46', 0, 0, 0),
(21, 21, 0, 32, 32, ' ', 'i watch movies', '2019-12-10 12:20:56', 0, 0, 0),
(22, 22, 0, 32, 31, ' ', 'ok i post doGgo too', '2019-12-10 12:21:17', 0, 1, 0),
(23, 23, 0, 32, 32, ' ', 'our computoer lsost internet so my parent show me this secret game', '2019-12-10 12:22:33', 0, 0, 0),
(24, 24, 0, 33, 27, ' ', 'pewdiepi is best playurðð', '2019-12-10 12:23:37', 0, 1, 0),
(25, 25, 0, 34, 34, ' ', 'thanos car thanos carÂ ððð', '2019-12-10 12:24:18', 0, 0, 0),
(26, 26, 0, 34, 34, ' ', 'this site kinda boring no cap', '2019-12-10 12:24:34', 0, 1, 0),
(27, 27, 0, 34, 34, ' ', 'im 7 year old', '2019-12-10 12:24:42', 0, 0, 0),
(28, 28, 0, 35, 35, ' ', 'memes r funny', '2019-12-10 12:25:09', 0, 0, 0),
(29, 29, 0, 35, 35, 'check out my room', 'ðððððð', '2019-12-10 12:25:18', 0, 0, 1),
(30, 30, 0, 35, 35, ' ', 'boiÂ ', '2019-12-10 12:25:31', 0, 0, 0),
(31, 31, 0, 35, 35, ' ', 'bruh moment indeed', '2019-12-10 12:25:44', 0, 0, 0),
(32, 32, 0, 35, 35, ' ', 'DO\r\nIT', '2019-12-10 12:27:31', 0, 0, 0),
(33, 33, 0, 35, 35, ' ', 'are my mems funny', '2019-12-10 12:27:47', 0, 1, 0),
(34, 34, 0, 29, 35, ' ', 'got me dead broÂ ððððÂ ', '2019-12-10 12:28:23', 0, 1, 0),
(35, 35, 0, 37, 37, ' ', 'bruh this movie good frfr', '2019-12-10 12:46:07', 0, 0, 0),
(36, 36, 0, 37, 33, ' ', 'we talk here bro', '2019-12-10 12:52:27', 0, 1, 0),
(39, 39, 0, 38, 38, ' ', 'bruhÂ ðð', '2019-12-10 12:58:38', 0, 0, 0),
(40, 40, 0, 38, 38, ' ', 'im raf', '2019-12-10 12:58:55', 0, 0, 0),
(41, 41, 0, 40, 40, ' ', 'cute cat', '2019-12-10 13:05:39', 0, 0, 0),
(42, 42, 0, 31, 31, ' ', 'bread', '2019-12-10 13:07:05', 0, 0, 0),
(43, 43, 0, 39, 38, ' ', 'ðððððððð', '2019-12-10 13:07:42', 0, 1, 0),
(44, 44, 0, 39, 39, ' ', 'my name is aric', '2019-12-10 13:08:29', 0, 0, 0),
(45, 45, 0, 39, 39, ' ', 'i like funy memes', '2019-12-10 13:08:41', 0, 0, 0),
(46, 46, 0, 39, 39, ' ', 'oh shit hahaha', '2019-12-10 13:11:00', 0, 0, 0),
(47, 47, 0, 28, 28, ' ', 'saw this for saleÂ ððð', '2019-12-10 13:12:31', 0, 0, 0),
(48, 48, 0, 39, 39, ' ', '', '2019-12-10 13:13:58', 0, 0, 0),
(49, 49, 0, 39, 34, ' ', 'i like it', '2019-12-10 13:15:05', 0, 1, 0),
(51, 51, 0, 38, 27, ' ', 'big yes', '2019-12-10 13:23:56', 0, 1, 0),
(52, 52, 0, 38, 38, ' ', 'wached frozen 2 that shit mad lit', '2019-12-10 13:24:33', 0, 1, 0),
(53, 53, 0, 34, 32, ' ', 'play roblox nigga', '2019-12-10 13:25:43', 0, 1, 0),
(54, 54, 0, 37, 28, ' ', 'star wars bad xd', '2019-12-10 13:27:50', 0, 1, 0),
(55, 55, 0, 39, 38, ' ', 'oi why u cursin', '2019-12-10 13:29:19', 0, 1, 0),
(56, 56, 0, 39, 39, ' ', 'ðððððð', '2019-12-10 13:30:05', 0, 1, 0),
(57, 57, 0, 39, 39, ' ', 'thanos fortnite lol!', '2019-12-10 13:30:49', 0, 0, 0),
(58, 58, 0, 29, 39, ' ', 'broÂ ðððð', '2019-12-10 13:31:44', 0, 1, 0),
(59, 59, 0, 32, 37, ' ', 'i have all 3Â â¤ï¸â¤ï¸', '2019-12-10 13:32:42', 0, 1, 0),
(60, 60, 0, 32, 38, ' ', 'holy shit this toy wtfÂ ððð', '2019-12-10 13:34:13', 0, 1, 0),
(61, 61, 0, 37, 38, ' ', 'yall gotta stop swearing', '2019-12-10 13:38:02', 0, 1, 0),
(62, 62, 0, 39, 37, ' ', 'the real fast boi', '2019-12-10 13:48:12', 0, 1, 0),
(63, 63, 0, 33, 33, ' ', 'what music is good', '2019-12-10 13:48:44', 0, 1, 0),
(64, 64, 0, 40, 40, ' ', 'didnt like this pizza', '2019-12-10 13:49:27', 0, 1, 0),
(65, 65, 0, 40, 40, ' ', 'doggos', '2019-12-10 13:49:44', 0, 0, 0),
(66, 66, 0, 40, 35, ' ', 'meme poosters!ðð', '2019-12-10 13:50:33', 0, 1, 0),
(67, 67, 0, 40, 33, ' ', 'this dude!', '2019-12-10 13:51:15', 0, 1, 0);

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
(24, 24, 'Terence\'s Room', '', 9, '2017-06-28 12:01:15', 0),
(25, 25, 'Iris\' Room', '', 6, '2017-07-20 07:44:27', 0),
(26, 26, 'James\' Room', '', 7, '2017-07-11 18:10:48', 0),
(27, 27, 'Michael\'s Room', '', 1, '2017-07-11 19:10:48', 0),
(28, 28, 'Arlan\'s Room', '', 2, '2017-07-11 20:10:48', 0),
(29, 29, 'Karl\'s Room', '', 7, '2017-07-14 04:01:46', 0),
(30, 30, 'Khobert\'s Room', '', 12, '2017-07-19 13:57:14', 0),
(31, 31, 'Jersey\'s Room', '', 13, '2017-07-19 14:45:56', 0),
(32, 32, 'Cyrus\' Room', '', 16, '2017-07-19 13:51:08', 0),
(33, 33, 'Liam\'s Room', '', 5, '2017-07-19 13:41:08', 0),
(34, 34, 'Amstel\'s Room', '', 15, '2017-07-20 07:49:43', 0),
(35, 35, 'Kiel\'s Room', '', 4, '2017-07-21 02:29:43', 0),
(37, 37, 'Chris\' Room', '', 2, '2017-07-20 14:34:57', 0),
(38, 38, 'Rafael\'s Room', '', 1, '2019-09-24 11:17:24', 0),
(39, 39, 'Aric\'s Room', '', 15, '2019-09-24 15:28:11', 0),
(40, 40, 'Gaia\'s Room', '', 2, '2019-10-23 06:42:28', 0);

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
(24, 'terence_dugang@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Terence', 'Dugang', '2012-09-02', 2, NULL, 0, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(25, 'iris_libay@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Iris', 'Libay', '2013-10-12', 2, 'gaia@gmail.com', 0, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', NULL),
(26, 'james_baladjay@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'James', 'Baladjay', '2013-03-16', 2, 'gaia@gmail.com', 0, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(27, 'neil_noble@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Michael', 'Noble', '2013-01-24', 2, 'ma.christine.gendrano@dlsu.edu.ph', 1, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', NULL),
(28, 'arlan_gomez@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arlan', 'Gomez', '2013-12-18', 2, 'ma.christine.gendrano@dlsu.edu.ph', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(29, 'karl_mamuyac@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Karl', 'Mamuyac', '2012-05-23', 2, 'terrence.esguerra@dlsu.edu.ph', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(30, 'khobert_linchangco@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Khobert', 'Linchangco', '2014-12-22', 2, 'vongola_mamon@gmail.com', 0, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(31, 'jersey_deguzman@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Jersey', 'De Guzman', '2012-07-20', 2, 'terrence.esguerra@dlsu.edu.ph', 1, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', NULL),
(32, 'cyrus_vatandoostkakhki@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Cyrus', 'Vatandoost', '2012-12-08', 2, 'raf@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(33, 'liam_chua@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Liam', 'Chua', '2012-07-23', 2, 'raf@gmail.com', 1, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', ''),
(34, 'amstel_ventanilla@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Amstel', 'Ventanilla', '2012-03-30', 2, 'arnie.azcarraga@delasalle.ph', 1, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', NULL),
(35, 'ezekiel_arano@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Ezekiel', 'Arano', '2012-09-03', 2, 'arnie.azcarraga@delasalle.ph', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(37, 'christian_talon@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Christian', 'Talon', '2013-12-19', 2, 'arnie.azcarraga@delasalle.ph', 1, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', NULL),
(38, 'rafael_tanchuan@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Rafael', 'Tanchuan', '2013-10-30', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(39, 'aric_brillantes@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Brillantes', '2014-09-30', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', ''),
(40, 'klaudia_borromeo@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Borromeo', '2012-09-01', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', '');

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
(1, 24, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(2, 25, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(3, 26, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(4, 27, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(5, 28, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(6, 29, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(7, 30, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(8, 31, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(9, 32, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(10, 33, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(11, 34, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(12, 35, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(13, 37, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(14, 38, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell146-A cell147-A cell148-A cell149-A cell150-A cell151-A cell152-A cell153-A cell154-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell258-A cell259-A cell260-A cell261-A cell262-A cell263-A cell264-A cell265-A cell266-A cell267-A cell268-A cell269-A cell270-A cell271-A cell272-A cell273-A', NULL, 1, 60),
(15, 39, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell146-A cell147-A cell148-A cell149-A cell150-A cell151-A cell152-A cell153-A cell154-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell258-A cell259-A cell260-A cell261-A cell262-A cell263-A cell264-A cell265-A cell266-A cell267-A cell268-A cell269-A cell270-A cell271-A cell272-A cell273-A', NULL, 1, 60),
(16, 40, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_chatmsgs`
--
ALTER TABLE `tbl_chatmsgs`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_infractions`
--
ALTER TABLE `tbl_infractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4345;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `tbl_usertimes`
--
ALTER TABLE `tbl_usertimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1321221213;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
