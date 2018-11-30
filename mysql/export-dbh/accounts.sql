-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2018 at 03:03 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `emailVerified` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `first_name`, `last_name`, `email`, `password`, `hash`, `profile_img`, `emailVerified`, `active`, `date_registered`) VALUES
(1, 'Joshua', 'Oweipadei', 'josh@gmail.com', 'ed1fcff553e2801a9db0f8aa278c4c5026435aa7', '208618efcb6c966cd8857bdc724b34d9', 'profiledefault.png', 1, 0, '2018-10-21 17:09:02'),
(2, 'Bayefa', 'Hannah', 'han@gmail.com', '993c7afed352ea3540de9665f479670815276bfb', 'a60b6eeebfb04637c521efec1d13295f', 'profiledefault.png', 0, 0, '2018-10-10 20:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Id` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_commented` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Id`, `statusId`, `userId`, `comment`, `date_commented`) VALUES
(127, 2, 20, 'lolz...', '2018-11-30 14:09:46'),
(128, 2, 1, 'hahaha', '2018-11-30 14:41:40'),
(129, 2, 1, 'What a great day..', '2018-11-30 14:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE `friendship` (
  `Id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_unlike`
--

CREATE TABLE `like_unlike` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `statusId` int(11) NOT NULL,
  `like_value` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sender_read` varchar(3) NOT NULL,
  `receiver_read` varchar(3) NOT NULL,
  `sender_delete` tinyint(1) NOT NULL,
  `receiver_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `myfriends`
--

CREATE TABLE `myfriends` (
  `Id` int(11) NOT NULL,
  `myId` int(11) NOT NULL,
  `myfriends` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `myfriends`
--

INSERT INTO `myfriends` (`Id`, `myId`, `myfriends`) VALUES
(1, 20, 1),
(2, 19, 20),
(3, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `Id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unique_no` int(12) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_desc` text NOT NULL,
  `news_img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`Id`, `full_name`, `unique_no`, `news_title`, `news_desc`, `news_img`, `date`) VALUES
(15, 'Cal Michael', 999000001, 'Arsenal F.C', 'Arsenal is an English Football Club based in North London. ', '988437_618123034930430_6868807511212417021_n.1539458542.jpg', '2018-10-19 23:10:16'),
(16, 'Cal Michael', 999000001, 'Arsenal F.C', 'Arsenal is an English Football Club based in North London. ', '1604591_214452798763044_1691730331_n.1539458542.jpg', '2018-10-19 23:10:29'),
(17, 'Cal Michael', 999000001, 'Arsenal F.C', 'Arsenal is an English Football Club based in North London. ', '10380484_10152240941437713_3173338730985064172_o.1539458542.jpg', '2018-10-19 23:10:37'),
(18, 'Joshua', 999000002, 'Living Faith Church, Otuoke', 'The Security Unit of LFC Otuoke holds their unity thanksgiving this Sunday.\r\nEveryone is invited.\r\nVenune : Church Auditorium', 'â€ª+234 810 577 4208â€¬ 20160131_113749.1539705813.jpg', '2018-10-19 23:10:45'),
(19, 'Joshua', 999000002, 'Living Faith Church, Otuoke', 'The Security Unit of LFC Otuoke holds their unity thanksgiving this Sunday.\r\nEveryone is invited.\r\nVenune : Church Auditorium', 'â€ª+234 813 252 4505â€¬ 20160413_123955.1539705813.jpg', '2018-10-19 23:12:19'),
(20, 'Joshua', 999000002, 'Living Faith Church, Otuoke', 'The Security Unit of LFC Otuoke holds their unity thanksgiving this Sunday.\r\nEveryone is invited.\r\nVenune : Church Auditorium', 'Diligent-youth-makes-easy-age.__quotes-by-French-Proverb-9-1024x1024.1539705813.png', '2018-10-19 23:12:32'),
(21, 'Joshua', 999000002, 'Living Faith Church, Otuoke', 'The Security Unit of LFC Otuoke holds their unity thanksgiving this Sunday.\r\nEveryone is invited.\r\nVenune : Church Auditorium', 'IMG-20160701-WA0000.1539705813.jpg', '2018-10-19 23:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `unique_no` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news_likes`
--

CREATE TABLE `news_likes` (
  `Id` int(11) NOT NULL,
  `news_unique_no` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_likes`
--

INSERT INTO `news_likes` (`Id`, `news_unique_no`, `ip_address`) VALUES
(13, 6, '127.0.0.1'),
(17, 2, '127.0.0.1'),
(18, 3, '127.0.0.1'),
(88, 5, '127.0.0.1'),
(90, 4, '127.0.0.1'),
(95, 999000002, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `news_single`
--

CREATE TABLE `news_single` (
  `Id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unique_no` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_desc` text NOT NULL,
  `news_img` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_single`
--

INSERT INTO `news_single` (`Id`, `full_name`, `unique_no`, `news_title`, `news_desc`, `news_img`, `date`) VALUES
(1, 'John Wiss', 1001, 'Laugh night', 'Set for the great event on campus.', 'FB_IMG_1482835385623.jpg1539845941.jpg', '2018-10-18 06:59:01'),
(2, 'Chuck', 1002, 'Rap battle on campus', 'A platform for empowering rappers and promoting rap music', 'single_news1539846589.jpg', '2018-10-18 07:09:49'),
(3, 'Hannah Jane', 1003, 'Music Fista', 'It\'s all happening tonight at De\' Alammis bar by 10pm ', 'single_news1539846810.jpg', '2018-10-18 07:13:30'),
(4, 'Cal Michael', 1004, 'Champions League Night', 'Chelsea Vs Juventus 7:45pm.\r\nReal Madrid Vs PSG 7:45pm.\r\nBenfica Vs Arsenal 7:45pm.\r\nManchester United Vs Porto 7:45pm.', 'single_news1539847404.jpg', '2018-10-18 07:23:24'),
(5, 'Joshiee', 1005, 'Web Development Tutorials on Campus', 'Coding is actually each... We teach Html5/CSS3, Javascript, PHP, Ruby on Rails, JsReact, NodeJs etc..', 'single_news1539868392.jpg', '2018-10-18 13:13:12'),
(6, 'Clark Kent', 1006, 'Rent house off campus', 'We have agent that get the best house off campus at an affordable price for you.', 'single_news1539868541.jpg', '2018-10-18 13:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `Id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `quote` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`Id`, `userId`, `quote`, `time`) VALUES
(4, 1, 'It\'s me Joshiee Fullstack coming through..! ðŸ‘‘Â ðŸ’Ž', '2018-11-27 17:42:34'),
(5, 19, 'Always remember to live a happy life..ðŸ˜„Â We are all made Kings and Queensâœ¨ðŸ‘‘', '2018-11-30 09:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `status_post`
--

CREATE TABLE `status_post` (
  `status_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` text NOT NULL,
  `date_posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_post`
--

INSERT INTO `status_post` (`status_id`, `userId`, `status`, `date_posted`) VALUES
(1, 1, 'Hey everyone...', '2018-11-30 10:20:30'),
(2, 19, 'Great day it is..!', '2018-11-30 14:09:23'),
(3, 1, 'No time to waste, keep pray and never stop hustling.', '2018-11-30 14:41:21'),
(6, 20, 'Its me Brutosky', '2018-11-30 14:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE `users_account` (
  `Id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `profile_img` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `emailVerified` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_registered` timestamp NULL DEFAULT NULL,
  `last_seen` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`Id`, `first_name`, `last_name`, `gender`, `email`, `username`, `profile_img`, `password`, `hash`, `emailVerified`, `active`, `date_registered`, `last_seen`) VALUES
(1, 'Joshua', 'Bayefa', 'Male', 'oweipadeijoshie@gmail.com', 'joshie', 'profilePic1.jpg', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'de36cde4c2fe6fa6beb123c716c40a74', 1, 1, '2018-10-23 00:38:01', '14:54:14'),
(19, 'Hannah', 'Bayefa', 'Female', 'hannah@gmail.com', 'hannie', 'profilePic19.jpg', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', 'd5b6292fa4ba88170ae928fcce2a9b50', 1, 0, '2018-11-28 14:04:35', '14:57:49'),
(20, 'Chuck', 'Brutosky', 'Male', 'brutosky@yahoo.com', 'chucky', 'profilePic20.jpg', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', '028b9d6d5995022d0e4ceb558356405b', 1, 0, '2018-11-28 14:13:34', '14:57:17'),
(21, 'Hiro', 'Nakamora', 'Male', 'hiro@gmail.com', 'hiro', 'profiledefault.png', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', 'e97453805b520bfc710012e71ff08ef1', 1, 1, '2018-11-28 14:15:04', NULL),
(22, 'Nicky', 'Sandra', 'Female', 'nicky@yahoo.com', 'nicky', 'profiledefault.png', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', 'e2e4646a21ac2186029b8138756a14ef', 1, 0, '2018-11-30 07:56:31', NULL),
(23, 'Peter', 'Petrelli', 'Male', 'peterpetrelli@gmail.com', 'pete', 'profiledefault.png', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', '5d6814e95a84c9c28038fe49f5d7b3a9', 1, 0, '2018-11-30 07:58:24', NULL),
(24, 'Nathan', 'Petrelli', 'Male', 'nathanpetrelli@gmail.com', 'nathanie', 'profiledefault.png', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', 'f3fd5314f062e42da6d720ce36280c56', 1, 0, '2018-11-30 07:59:25', NULL),
(25, 'Claire', 'Bennet', 'Female', 'clairebennet@yahoo.com', 'claire', 'profiledefault.png', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', '7ca3a1461a8ed3291aa8f3bd131adeb0', 1, 0, '2018-11-30 08:00:28', NULL),
(26, 'Clark', 'Kent', 'Male', 'clarkkent@gmail.com', 'clarkey', 'profiledefault.png', 'ab43a7c9cb5b2380afc4ddf8b3e2583169b39a02', '0ceff3a080605284c047f721fe3da868', 1, 0, '2018-11-30 08:01:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `like_unlike`
--
ALTER TABLE `like_unlike`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `myfriends`
--
ALTER TABLE `myfriends`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `news_likes`
--
ALTER TABLE `news_likes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `news_single`
--
ALTER TABLE `news_single`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `status_post`
--
ALTER TABLE `status_post`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `like_unlike`
--
ALTER TABLE `like_unlike`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myfriends`
--
ALTER TABLE `myfriends`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_likes`
--
ALTER TABLE `news_likes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `news_single`
--
ALTER TABLE `news_single`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_post`
--
ALTER TABLE `status_post`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
