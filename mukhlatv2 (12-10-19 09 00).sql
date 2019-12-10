-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 01:53 AM
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
(1, 1, 'this is an announcement', '2019-11-27 09:23:45'),
(2, 2, 'this is also an announcement', '2019-11-27 09:24:08'),
(3, 1, 'no classes today', '2019-12-04 10:51:14');

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
(1, 216, './uploads/_216/49318f6b15a05f9409acffc819759967.png', 1, ''),
(2, 218, './uploads/_218/569bedb8643c7eea983287ed34a6f941.mp3', 2, ''),
(3, 221, './uploads/_221/cc57a683745d8d6820b6733a48061a72.png', 1, ''),
(4, 222, './uploads/_222/42edd60e020aa17d3c5edca08f5c1647.mp3', 2, ''),
(5, 228, './uploads/_228/d34d721e9714a625ec987afed85c50e5.png', 1, ''),
(6, 229, './uploads/_229/1ee7bd163a7ef95ec715982ddfc8d3ff.mp3', 2, ''),
(7, 234, './uploads/_234/7facbffda2ed8f76a1b0e412e11a418a.png', 1, ''),
(8, 237, './uploads/_237/f7da0a7668d5fe8e2b5a63856b363f15.mp3', 2, ''),
(9, 241, './uploads/_241/67b1f3d12ce1efeb1e087422a7499453.png', 1, ''),
(10, 244, './uploads/_244/d297292a6e803418a76405464e1de746.mp3', 2, ''),
(11, 246, './uploads/_246/3b0ad71588c2fc00e2f61740d77fec89.png', 1, ''),
(12, 247, './uploads/_247/4fc84da3cdb6c45b73b429b31a3fe44c.mp3', 2, ''),
(13, 252, './uploads/_252/4c3b73231382be91f211501b21e71cdc.png', 1, ''),
(14, 255, './uploads/_255/38d7fb93ac0f250346a6c5679a81a95d.mp3', 2, ''),
(15, 259, './uploads/_259/5155f9c06f104a2f1b50b2344e077d48.png', 1, ''),
(16, 263, './uploads/_263/e8cef2fbbca20aed42f5c5b131607100.mp3', 2, ''),
(17, 268, './uploads/_268/ae09a2b99ac96a5fcadd845b955f93d4.png', 1, ''),
(18, 269, './uploads/_269/a9c43c7f5ecb876c8ccf2f21ab090e0b.mp3', 2, ''),
(19, 271, './uploads/_271/09b9538ded2f2c0f122b282fae9dbb77.png', 1, ''),
(20, 273, './uploads/_273/1a3c0b4c63169043280f03ecfdf5f4ad.mp3', 2, ''),
(21, 280, './uploads/_280/cc0496db195c1ec537c607114e269a02.png', 1, ''),
(22, 281, './uploads/_281/ecdfecee2c8f3ea3e47092dc0060a000.mp3', 2, ''),
(23, 284, './uploads/_284/728962afbb8d426f2ceb3fea5ae95ddb.png', 1, ''),
(24, 285, './uploads/_285/a3a1cb06738e9929c38b705ddaabdce3.png', 1, ''),
(25, 286, './uploads/_286/5c8d063322bfcf63776508e0c733e9d4.mp3', 2, ''),
(26, 293, './uploads/_293/862dd45c0d5d188d04fc5484d769060f.JPG', 1, ''),
(27, 294, './uploads/_294/2354c7f9c9e010b74fff1ed2e596a9ec.JPG', 1, ''),
(28, 295, './uploads/_295/bd412734e42f0d81ad56c4fff259ced5.JPG', 1, ''),
(29, 299, './uploads/_299/ad4bb0eaecbc05535faac23ee24b15b9.png', 1, ''),
(30, 302, './uploads/_302/057985b3378fc6b20eb411ba3f6ae4f2.png', 1, ''),
(31, 303, './uploads/_303/cfb53ddcfde025245c30e012f6f225b2.mp3', 2, ''),
(32, 309, './uploads/_309/0aa22bc190e3b556dbdd5d3d353586f4.png', 1, ''),
(33, 310, './uploads/_310/9468f444b33b6cf78e60b7fdfe99a7cb.png', 1, ''),
(34, 311, './uploads/_311/3d00b246711587aadf09439856ed94e3.png', 1, ''),
(35, 312, './uploads/_312/ad51799902efef5e87c17892f0a16624.mp3', 2, ''),
(36, 313, './uploads/_313/d10d4e08c9d774587ae1e13c1aa50a37.mp4', 3, ''),
(37, 315, './uploads/_315/35a2e874cd67a4c8cdf0ee0e912a2578.mp3', 2, '');

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
(1, 26, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(2, 27, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(3, 28, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(4, 29, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(5, 30, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(6, 31, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(7, 32, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(8, 33, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(9, 34, 0, 0, 0, 0, 0, '2019-12-02 00:00:00'),
(10, 35, 0, 0, 0, 0, 0, '2019-12-03 00:00:00'),
(11, 36, 0, 0, 0, 0, 0, '2019-12-03 00:00:00'),
(12, 37, 0, 1, 1, 0, 0, '2019-12-02 00:00:00'),
(13, 38, 2, 5, 17, 0, 1, '2019-12-10 00:00:00'),
(14, 39, 3, 0, 4, 0, 0, '2019-12-02 00:00:00'),
(25, 56, 0, 0, 0, 0, 0, '2019-12-08 00:00:00');

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
(1, 37, 7, 'hi raf this is a note', '2019-11-27 09:22:55'),
(2, 38, 7, 'hi aric this is a note', '2019-11-27 09:23:01'),
(3, 38, 7, 'and another one', '2019-11-27 09:23:04'),
(4, 39, 7, 'hi gaia this is a note', '2019-11-27 09:23:11'),
(5, 39, 7, 'and another one', '2019-11-27 09:23:15'),
(6, 39, 7, 'and another one x2', '2019-11-27 09:23:21'),
(400, 38, 7, 'hi aric', '2019-12-04 10:52:12'),
(401, 37, 7, 'ðð¢ðnjgð', '2019-12-04 10:52:49'),
(402, 38, 7, '45', '2019-12-04 12:10:57'),
(403, 39, 7, 'sasa', '2019-12-08 15:50:42');

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
(327, 5, 36, 38, 493, 0, '2019-12-04 12:25:35');

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
(214, 214, 0, 26, 26, ' ', 'this is my room', '2019-11-05 12:48:29', 0, 0, 0),
(215, 215, 0, 26, 26, ' ', 'i like it', '2019-11-05 12:48:39', 0, 0, 0),
(216, 216, 0, 26, 26, ' ', 'blue', '2019-11-05 13:35:08', 0, 0, 0),
(217, 217, 0, 28, 26, ' ', 'i like it!', '2019-11-05 13:37:41', 0, 1, 0),
(218, 218, 0, 26, 26, ' ', 'fortnite', '2019-11-05 13:39:44', 0, 0, 0),
(219, 219, 0, 29, 26, ' ', 'its good!', '2019-11-05 13:40:43', 0, 1, 0),
(220, 220, 0, 27, 27, ' ', 'u leik my room', '2019-11-05 13:44:04', 0, 0, 0),
(221, 221, 0, 27, 27, ' ', 'purpp', '2019-11-05 13:44:51', 0, 0, 0),
(222, 222, 0, 27, 27, ' ', 'xp', '2019-11-05 13:45:06', 0, 0, 0),
(223, 223, 0, 27, 27, ' ', 'aye', '2019-11-05 13:45:27', 0, 0, 0),
(224, 224, 0, 32, 27, ' ', 'noice', '2019-11-05 13:45:34', 0, 1, 0),
(225, 225, 0, 33, 27, ' ', 'cool', '2019-11-05 13:45:42', 0, 1, 0),
(226, 226, 0, 36, 27, ' ', 'epic', '2019-11-05 13:45:46', 0, 1, 0),
(227, 227, 0, 27, 27, ' ', 'thanks g', '2019-11-05 13:45:57', 0, 1, 0),
(228, 228, 0, 28, 28, ' ', 'green good', '2019-11-05 13:49:29', 0, 0, 0),
(229, 229, 0, 28, 28, ' ', 'default dance epic', '2019-11-05 13:51:05', 0, 0, 0),
(230, 230, 0, 28, 28, ' ', 'like what I did?', '2019-11-05 13:51:26', 0, 0, 0),
(231, 231, 0, 28, 28, ' ', 'green is best color', '2019-11-05 13:52:42', 0, 0, 0),
(232, 232, 0, 38, 28, ' ', 'wow', '2019-11-05 13:52:48', 0, 1, 0),
(233, 233, 0, 37, 28, ' ', 'i dig I dig', '2019-11-05 13:53:02', 0, 1, 0),
(234, 234, 0, 29, 29, ' ', 'dilaw', '2019-11-05 13:53:56', 0, 0, 0),
(235, 235, 0, 29, 29, ' ', 'larata', '2019-11-05 13:54:44', 0, 0, 0),
(236, 236, 0, 29, 29, ' ', 'this aight?', '2019-11-05 13:54:58', 0, 0, 0),
(237, 237, 0, 29, 29, ' ', 'xp', '2019-11-05 13:55:09', 0, 0, 0),
(238, 238, 0, 32, 29, ' ', 'waaaw', '2019-11-05 13:55:15', 0, 1, 0),
(239, 239, 0, 34, 29, ' ', 'epic lol', '2019-11-05 13:55:23', 0, 1, 0),
(240, 240, 0, 30, 30, ' ', 'pretty happy wit disÂ ', '2019-11-05 13:56:10', 0, 0, 0),
(241, 241, 0, 30, 30, ' ', 'red', '2019-11-05 13:56:30', 0, 0, 0),
(242, 242, 0, 28, 30, ' ', 'gud job', '2019-11-05 13:56:55', 0, 1, 0),
(243, 243, 0, 29, 30, ' ', 'v nice', '2019-11-05 13:57:01', 0, 1, 0),
(244, 244, 0, 30, 30, ' ', 'fort', '2019-11-05 13:57:10', 0, 0, 0),
(245, 245, 0, 31, 31, ' ', 'i enjoyed making this', '2019-11-05 13:59:59', 0, 0, 0),
(246, 246, 0, 31, 31, ' ', 'blue', '2019-11-05 14:00:34', 0, 0, 0),
(247, 247, 0, 31, 31, ' ', 'windows', '2019-11-05 14:00:51', 0, 0, 0),
(248, 248, 0, 31, 31, ' ', 'is it good', '2019-11-05 14:01:29', 0, 0, 0),
(249, 249, 0, 39, 31, ' ', 'mmmmmm', '2019-11-05 14:01:34', 0, 1, 0),
(250, 250, 0, 35, 31, ' ', 'cool haha', '2019-11-05 14:01:40', 0, 1, 0),
(251, 251, 0, 34, 31, ' ', ':o', '2019-11-05 14:03:09', 0, 1, 0),
(252, 252, 0, 32, 32, ' ', 'blu', '2019-11-05 14:04:59', 0, 0, 0),
(253, 253, 0, 32, 32, ' ', 'like what i done?', '2019-11-05 14:05:15', 0, 0, 0),
(254, 254, 0, 32, 32, ' ', 'very happy\r\n', '2019-11-05 14:09:54', 0, 0, 0),
(255, 255, 0, 32, 32, ' ', 'eks p', '2019-11-05 14:12:48', 0, 0, 0),
(256, 256, 0, 32, 32, ' ', 'hahaha', '2019-11-05 14:12:55', 0, 1, 0),
(257, 257, 0, 36, 32, ' ', 'ððð', '2019-11-05 14:13:05', 0, 1, 0),
(258, 258, 0, 33, 33, ' ', 'do u like my room?', '2019-11-05 14:33:12', 0, 0, 0),
(259, 259, 0, 33, 33, ' ', 'yellow', '2019-11-05 14:33:30', 0, 0, 0),
(260, 260, 0, 33, 33, ' ', 'twas fun to make', '2019-11-05 14:38:47', 0, 0, 0),
(261, 261, 0, 35, 33, ' ', 'is good!1', '2019-11-05 14:38:55', 0, 1, 0),
(262, 262, 0, 36, 33, ' ', 'great', '2019-11-05 14:39:08', 0, 1, 0),
(263, 263, 0, 33, 33, ' ', 'epic', '2019-11-05 14:39:23', 0, 0, 0),
(264, 264, 0, 34, 34, ' ', 'had a fun time decorating it', '2019-11-05 14:40:08', 0, 0, 0),
(265, 265, 0, 34, 34, ' ', 'is my room nice', '2019-11-05 14:40:15', 0, 0, 0),
(266, 266, 0, 31, 34, ' ', 'veri nice', '2019-11-05 14:40:37', 0, 1, 0),
(267, 267, 0, 32, 34, ' ', 'good good', '2019-11-05 14:40:42', 0, 1, 0),
(268, 268, 0, 34, 34, ' ', 'red', '2019-11-05 14:40:49', 0, 0, 0),
(269, 269, 0, 34, 34, ' ', 'sound', '2019-11-05 14:41:00', 0, 0, 0),
(270, 270, 0, 35, 35, ' ', 'these are my hobies', '2019-11-05 14:41:36', 0, 0, 0),
(271, 271, 0, 35, 35, ' ', 'purp', '2019-11-05 14:41:47', 0, 0, 0),
(272, 272, 0, 35, 35, ' ', 'are they nice', '2019-11-05 14:41:56', 0, 0, 0),
(273, 273, 0, 35, 35, ' ', 'sound', '2019-11-05 14:42:23', 0, 0, 0),
(274, 274, 0, 30, 35, ' ', 'i like it bro', '2019-11-05 14:42:30', 0, 1, 0),
(275, 275, 0, 38, 35, ' ', 'im a fan', '2019-11-05 14:42:36', 0, 1, 0),
(276, 276, 0, 36, 36, ' ', 'is my room good', '2019-11-05 14:43:28', 0, 0, 0),
(277, 277, 0, 36, 36, ' ', 'made it myself', '2019-11-05 14:43:33', 0, 0, 0),
(278, 278, 0, 30, 36, ' ', 'â¤ï¸', '2019-11-05 14:43:39', 0, 1, 0),
(279, 279, 0, 26, 36, ' ', 'cool very cool', '2019-11-05 14:43:47', 0, 1, 0),
(280, 280, 0, 36, 36, ' ', 'red', '2019-11-05 14:43:55', 0, 0, 0),
(281, 281, 0, 36, 36, ' ', 'fortnite', '2019-11-05 14:44:04', 0, 0, 0),
(282, 282, 0, 37, 37, ' ', 'i like league of legends', '2019-11-05 14:44:38', 0, 0, 0),
(283, 283, 0, 37, 37, ' ', 'these are league of legends characters', '2019-11-05 14:44:48', 0, 0, 0),
(284, 284, 0, 37, 37, ' ', '1', '2019-11-05 14:45:03', 0, 0, 0),
(285, 285, 0, 37, 37, ' ', '2', '2019-11-05 14:45:09', 0, 0, 0),
(286, 286, 0, 37, 37, ' ', 'lol', '2019-11-05 14:45:25', 0, 0, 0),
(287, 287, 0, 27, 37, ' ', 'waw', '2019-11-05 14:45:30', 0, 1, 0),
(288, 288, 0, 28, 37, ' ', 'awesome bro', '2019-11-05 14:45:37', 0, 1, 0),
(289, 289, 0, 39, 37, ' ', 'i dig', '2019-11-05 14:45:41', 0, 1, 0),
(290, 290, 0, 39, 39, ' ', 'i like kitties', '2019-11-05 14:53:46', 0, 0, 0),
(291, 291, 0, 39, 39, ' ', 'these are my kitties', '2019-11-05 14:53:54', 0, 0, 0),
(292, 292, 0, 39, 39, ' ', 'theyre cute right', '2019-11-05 14:54:03', 0, 0, 0),
(293, 293, 0, 39, 39, ' ', 'cat', '2019-11-05 14:55:14', 0, 0, 0),
(294, 294, 0, 39, 39, ' ', 'cat', '2019-11-05 14:55:23', 0, 0, 0),
(296, 296, 0, 38, 39, ' ', 'aw theyre cute', '2019-11-05 14:56:21', 0, 1, 0),
(297, 297, 0, 27, 39, ' ', 'ððð', '2019-11-05 14:56:30', 0, 1, 0),
(298, 298, 0, 27, 39, ' ', 'awwwwwww', '2019-11-05 14:56:36', 0, 1, 0),
(299, 299, 0, 38, 38, ' ', 'another artists paintign', '2019-11-05 15:20:15', 0, 0, 0),
(300, 300, 0, 38, 38, ' ', 'i decorated my room like this because i like art', '2019-11-05 15:20:33', 0, 0, 0),
(301, 301, 0, 38, 38, ' ', 'what do you think', '2019-11-05 15:20:39', 0, 0, 0),
(302, 302, 0, 38, 38, ' ', 'anotha one', '2019-11-05 15:20:49', 0, 0, 0),
(303, 303, 0, 38, 38, ' ', 'waw old sound', '2019-11-05 15:21:00', 0, 0, 0),
(304, 304, 0, 38, 38, 'take a look', 'look at my room :)))', '2019-11-05 15:21:33', 0, 0, 1),
(305, 305, 0, 37, 38, ' ', 'these are good!', '2019-11-05 15:21:44', 0, 1, 0),
(306, 306, 0, 32, 38, ' ', 'cool', '2019-11-05 15:21:50', 0, 1, 0),
(307, 307, 0, 34, 38, ' ', 'who made theseÂ ðð', '2019-11-05 15:22:02', 0, 1, 0),
(309, 309, 0, 38, 38, ' ', 'my first painting', '2019-11-06 08:56:05', 0, 0, 0),
(310, 310, 0, 38, 38, ' ', 'hahah', '2019-11-06 08:56:21', 0, 0, 0),
(311, 311, 0, 38, 38, ' ', 'my newest painting', '2019-11-06 08:56:37', 0, 0, 0),
(312, 312, 0, 38, 38, ' ', 'i dont play no games unless we talkin fortniteÂ ððð', '2019-11-06 08:57:54', 0, 0, 0);

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
(26, 26, 'Terence\'s Room', 'hi everyone!', 9, '2017-06-28 12:01:15', 0),
(27, 27, 'Iris\' Room', 'wassup gamers', 6, '2017-07-20 07:44:27', 0),
(28, 28, 'James\' Room', 'i like green', 7, '2017-07-11 18:10:48', 0),
(29, 29, 'Karl\'s Room', 'sup everyone', 11, '2017-07-14 04:01:46', 0),
(30, 30, 'Khobert\'s Room', 'hello', 12, '2017-07-19 13:57:14', 0),
(31, 31, 'Jersey\'s Room', 'hi guys', 8, '2017-07-19 14:45:56', 0),
(32, 32, 'Cyrus\' Room', 'greetings', 6, '2017-07-19 13:51:08', 0),
(33, 33, 'Liam\'s Room', 'sup gamers', 5, '2017-07-19 13:41:08', 0),
(34, 34, 'Amstel\'s Room', 'hi mga tsong', 3, '2017-07-20 07:49:43', 0),
(35, 35, 'Kiel\'s Room', 'morning lads', 4, '2017-07-21 02:29:43', 0),
(36, 36, 'Chris\' Room', 'kamusta mga sir', 2, '2017-07-20 14:34:57', 0),
(37, 37, 'Rafael\'s Room', 'I like LOL!', 1, '2019-09-24 11:17:24', 0),
(38, 38, 'Aric\'s Room', '', 3, '2019-09-24 15:28:11', 0),
(39, 39, 'Gaia\'s Room', 'see my companions', 2, '2019-10-23 06:42:28', 0);

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
(1, 'aric@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Admin', '1996-12-28', 1, NULL, 1, NULL, NULL),
(2, 'gaia@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Admin', '1996-12-25', 1, NULL, 1, NULL, NULL),
(3, 'raf@admin.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Rafael', 'Admin', '1981-08-18', 1, NULL, 1, NULL, NULL),
(4, 'arnie.azcarraga@delasalle.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Arnulfo', 'Azcarraga', '2001-07-17', 1, NULL, 1, NULL, NULL),
(5, 'terrence.esguerra@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Terrence', 'Esguerra', '1946-08-05', 1, NULL, 1, NULL, NULL),
(6, 'ma.christine.gendrano@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Ma. Christine', 'Gendrano', '2017-09-26', 1, NULL, 1, NULL, NULL),
(7, 'aric30@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Brillantes', '1999-09-30', 3, NULL, 1, NULL, NULL),
(8, 'raf@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Raf', 'Parent', '2019-10-01', 3, NULL, 1, NULL, NULL),
(9, 'gaia@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Parent', '2019-10-02', 3, NULL, 1, NULL, NULL),
(26, 'terence_dugang@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Terence', 'Dugang', '1996-09-02', 2, 'raf@yahoo.com', 0, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(27, 'iris_libay@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Iris', 'Libay', '1997-10-12', 2, NULL, 0, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', NULL),
(28, 'james_baladjay@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'James', 'Baladjay', '1997-03-16', 2, NULL, 0, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL),
(29, 'karl_mamuyac@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Karl', 'Mamuyac', '1995-05-23', 2, NULL, 0, 'uploads/user_profiles/9845565f1dced5ee8e6f64b9b3b4fd68.jpg', NULL),
(30, 'khobert_linchangco@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Khobert', 'Linchangco', '1997-12-22', 2, NULL, 0, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(31, 'jersey_deguzman@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Jersey', 'De Guzman', '2017-07-20', 2, NULL, 0, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', NULL),
(32, 'cyrus_vatandoostkakhki@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Cyrus', 'Vatandoost', '1997-12-08', 2, NULL, 0, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(33, 'liam_chua@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Liam', 'Chua', '1996-07-23', 2, NULL, 0, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', ''),
(34, 'amstel_ventanilla@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Amstel', 'Ventanilla', '2017-03-30', 2, 'raf@gmail.com', 1, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', NULL),
(35, 'ezekiel_arano@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Ezekiel', 'Arano', '1993-09-03', 2, 'raf@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(36, 'christian_talon@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Christian', 'Talon', '1986-09-18', 2, 'raf@gmail.com', 1, 'uploads/user_profiles/d7c20ec986342bcaeca5968777af9c8a.jpg', NULL),
(37, 'rafael_tanchuan@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Rafael', 'Tanchuan', '1998-10-30', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', NULL),
(38, 'aric_brillantes@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Aric', 'Brillantes', '1999-09-30', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/1085ce74273e5976d98d2714ca9493ec.jpg', ''),
(39, 'klaudia_borromeo@dlsu.edu.ph', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Gaia', 'Borromeo', '1997-09-01', 2, 'aric30@gmail.com', 1, 'uploads/user_profiles/c6ba5eeb1ad1547b69c15c93868abe66.jpg', '');

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
(1, 26, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(2, 27, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(3, 28, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(4, 29, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(5, 29, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(6, 30, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(7, 31, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(8, 32, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(9, 33, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 180),
(10, 34, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(11, 35, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(12, 36, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(13, 37, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A', NULL, 1, 120),
(14, 38, 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell146-A cell147-A cell148-A cell149-A cell150-A cell151-A cell152-A cell153-A cell154-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell258-A cell259-A cell260-A cell261-A cell262-A cell263-A cell264-A cell265-A cell266-A cell267-A cell268-A cell269-A cell270-A cell271-A cell272-A cell273-A', NULL, 1, 60),
(15, 39, 'cell128-A cell146-A', NULL, 1, 30);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_attachments`
--
ALTER TABLE `tbl_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_chatmsgs`
--
ALTER TABLE `tbl_chatmsgs`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_infractions`
--
ALTER TABLE `tbl_infractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=404;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;

--
-- AUTO_INCREMENT for table `tbl_topics`
--
ALTER TABLE `tbl_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_usertimes`
--
ALTER TABLE `tbl_usertimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
