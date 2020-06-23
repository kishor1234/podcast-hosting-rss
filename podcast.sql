-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2020 at 03:58 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `podcast`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `byw` varchar(255) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `isDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` longtext NOT NULL,
  `notify` int(11) NOT NULL DEFAULT '0',
  `isActive` int(11) NOT NULL DEFAULT '0',
  `comment_parent` int(11) DEFAULT '0',
  `ip` varchar(200) NOT NULL,
  `isDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filesystem`
--

CREATE TABLE `filesystem` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `extension` varchar(200) NOT NULL,
  `url` text NOT NULL,
  `path` text NOT NULL,
  `isUsed` int(11) NOT NULL DEFAULT '0',
  `onCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filesystem`
--

INSERT INTO `filesystem` (`id`, `name`, `extension`, `url`, `path`, `isUsed`, `onCreate`) VALUES
(1, '1592664402-episode_2.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592664402-episode_2.jpg', '/var/www/html/podcast/assets/upload/profile/1592664402-episode_2.jpg', 1, '2020-06-20 14:46:42'),
(14, '1592669825-episode_2.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592669825-episode_2.jpg', '/var/www/html/podcast/assets/upload/profile/1592669825-episode_2.jpg', 1, '2020-06-20 16:17:05'),
(15, '1592669825-episode.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592669825-episode.jpg', '/var/www/html/podcast/assets/upload/profile/1592669825-episode.jpg', 1, '2020-06-20 16:17:05'),
(16, '1592669825-bensound-betterdays.mp3', 'audio/mp3', 'http://podcast.lcl/assets/upload/profile/1592669825-bensound-betterdays.mp3', '/var/www/html/podcast/assets/upload/profile/1592669825-bensound-betterdays.mp3', 1, '2020-06-20 16:17:05'),
(23, '1592686338-episode_1.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592686338-episode_1.jpg', '/var/www/html/podcast/assets/upload/profile/1592686338-episode_1.jpg', 1, '2020-06-20 20:52:18'),
(24, '1592686338-about.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592686338-about.jpg', '/var/www/html/podcast/assets/upload/profile/1592686338-about.jpg', 1, '2020-06-20 20:52:18'),
(25, '1592686338-bensound-betterdays.mp3', 'audio/mp3', 'http://podcast.lcl/assets/upload/profile/1592686338-bensound-betterdays.mp3', '/var/www/html/podcast/assets/upload/profile/1592686338-bensound-betterdays.mp3', 1, '2020-06-20 20:52:18'),
(26, '1592691995-episode_4.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592691995-episode_4.jpg', '/var/www/html/podcast/assets/upload/profile/1592691995-episode_4.jpg', 1, '2020-06-20 22:26:35'),
(27, '1592691996-blog.jpg', 'image/jpeg', 'http://podcast.lcl/assets/upload/profile/1592691996-blog.jpg', '/var/www/html/podcast/assets/upload/profile/1592691996-blog.jpg', 1, '2020-06-20 22:26:36'),
(28, '1592691996-bensound-betterdays.mp3', 'audio/mp3', 'http://podcast.lcl/assets/upload/profile/1592691996-bensound-betterdays.mp3', '/var/www/html/podcast/assets/upload/profile/1592691996-bensound-betterdays.mp3', 1, '2020-06-20 22:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `image_id` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `banner_id` int(11) NOT NULL,
  `banner_url` text,
  `file_id` int(11) NOT NULL,
  `file_url` text NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_lenght` varchar(255) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `categories` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `likes` int(255) NOT NULL DEFAULT '0',
  `comments` int(255) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `onCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `onUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `userid`, `name`, `email`, `title`, `description`, `image_id`, `image_url`, `banner_id`, `banner_url`, `file_id`, `file_url`, `file_type`, `file_lenght`, `duration`, `categories`, `tags`, `likes`, `comments`, `ip`, `onCreate`, `onUpdate`) VALUES
(5, 1, 'kishor shinde', 'kishor4shinde@gmail.com', 'Episode 1', 'There is no delete keyword or function in the PHP language. If you arrived at this page seeking to delete a file, try unlink(). To delete a variable from the local scope, check out unset().', 14, 'http://podcast.lcl/assets/upload/profile/1592669825-episode_2.jpg', 15, 'http://podcast.lcl/assets/upload/profile/1592669825-episode.jpg', 16, 'http://podcast.lcl/assets/upload/profile/1592669825-bensound-betterdays.mp3', 'audio/mp3', '2153691', '00:02:34', 'Technology', 'Lifistyle, Interview, last episode, MP3', 0, 0, '', '2020-06-20 16:17:05', '2020-06-20 16:47:59'),
(6, 1, 'kishor shinde', 'kishor4shinde@gmail.com', 'Episonde 2 Feel My Pain', 'Feel my pain and I do your `keeping the `\r\nWhen I`m mad at you\r\nWith the piece out there we can go cleaning and \r\nNo one will know where we`ve been', 23, 'http://podcast.lcl/assets/upload/profile/1592686338-episode_1.jpg', 24, 'http://podcast.lcl/assets/upload/profile/1592686338-about.jpg', 25, 'http://podcast.lcl/assets/upload/profile/1592686338-bensound-betterdays.mp3', 'audio/mp3', '2153691', '00:02:34', 'Love', 'Love, Pain, Emostion', 0, 0, '', '2020-06-20 20:52:18', '2020-06-20 20:52:18'),
(7, 1, 'kishor shinde', 'kishor4shinde@gmail.com', 'Episode 3 Indian clasic music', 'Indian classical music is the classical music of the Indian subcontinent, this includes India, Pakistan, Bangladesh, Sri Lanka and Nepal.[1] It has two major traditions: the North Indian and Pakistani classical music tradition is called Hindustani, while the South Indian and Sri Lankan expression is called Carnatic.[2] These traditions were not distinct until about the 16th century. During the period of Islamic rule of the Indian subcontinent, the traditions separated and evolved into distinct forms. Hindustani music emphasizes improvisation and exploring all aspects of a raga, while Carnatic performances tend to be short and composition-based.[2] However, the two systems continue to have more common features than differences.[3]\r\n\r\nThe roots of the classical music of India are found in the Vedic literature of Hinduism and the ancient Natyashastra, the classic Sanskrit text on performance arts by Bharata Muni.[4][5] The 13th century Sanskrit text Sangita-Ratnakara of Sarangadeva is regarded as the definitive text by both the Hindustani music and the Carnatic music traditions.[6][7]\r\n\r\nIndian classical music has two foundational elements, raga and tala. The raga, based on swara (notes including microtones), forms the fabric of a melodic structure, while the tala measures the time cycle.[8] The raga gives an artist a palette to build the melody from sounds, while the tala provides them with a creative framework for rhythmic improvisation using time.[9][10][11] In Indian classical the space between the notes is often more important than the notes themselves, and it does not have Western classical concepts such as harmony, counterpoint, chords, or modulation.', 26, 'http://podcast.lcl/assets/upload/profile/1592691995-episode_4.jpg', 27, 'http://podcast.lcl/assets/upload/profile/1592691996-blog.jpg', 28, 'http://podcast.lcl/assets/upload/profile/1592691996-bensound-betterdays.mp3', 'audio/mp3', '2153691', '00:02:34', 'Classic Music', 'Classic Music, Indian Classic, Classic', 0, 0, '', '2020-06-20 22:26:36', '2020-06-20 22:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `shortLink`
--

CREATE TABLE `shortLink` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '0',
  `valid_time` int(11) NOT NULL,
  `onCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `description` text,
  `fileid` int(11) DEFAULT NULL,
  `image_url` text,
  `categories` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `onCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `onUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `title`, `link`, `cp`, `description`, `fileid`, `image_url`, `categories`, `ip`, `onCreate`, `onUpdate`) VALUES
(1, 'kishor shinde', 'kishor4shinde@gmail.com', '$2y$10$s0L4eIquQZL0KtQBIoKniuJPNjTOzhvXPH967Q03Vwdaox2u85ib6', 'my Podcast', 'http://admin.podcast.lcl/', '2020 Copyright kishor shinde', 'A channel may contain any number of  present.', 1, 'http://podcast.lcl/assets/upload/profile/1592664402-episode_2.jpg', 'Technology', '127.0.0.1', '2020-06-20 07:24:55', '2020-06-20 22:17:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filesystem`
--
ALTER TABLE `filesystem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `shortLink`
--
ALTER TABLE `shortLink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filesystem`
--
ALTER TABLE `filesystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shortLink`
--
ALTER TABLE `shortLink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
