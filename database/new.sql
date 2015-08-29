-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2015 at 12:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `section_id`) VALUES
(1, 'fgfgdfgd', 3),
(2, 'history', 4),
(3, 'banner', 5),
(4, 'great personality', 1),
(5, 'khudba', 3);

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `channel_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_name` varchar(100) NOT NULL,
  `channel_desc` varchar(1000) DEFAULT NULL,
  `channel_image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`channel_id`, `channel_name`, `channel_desc`, `channel_image`) VALUES
(1, 'Al Balagh', 'Al Balagh an Urdu channel', 'Mukhtar Nama.jpg'),
(3, 'Sahar Tv', 'Sahar Tv Urdu Channel for News', 'Sahar Tv.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `designer`
--

CREATE TABLE IF NOT EXISTS `designer` (
  `designer_id` int(11) NOT NULL AUTO_INCREMENT,
  `designer_name` varchar(100) NOT NULL,
  `designer_desc` varchar(1000) DEFAULT NULL,
  `designer_image` varchar(1000) NOT NULL,
  PRIMARY KEY (`designer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `designer`
--

INSERT INTO `designer` (`designer_id`, `designer_name`, `designer_desc`, `designer_image`) VALUES
(1, 'Al Fasahah', 'www.alfasahah.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(100) NOT NULL,
  `download_url` varchar(1000) NOT NULL,
  `thumb_url` varchar(50) NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `language` varchar(50) NOT NULL,
  `designer_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(1000) DEFAULT NULL,
  `meta_keyword` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `designer_id` (`designer_id`),
  KEY `playlist_id` (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `playlist_name` varchar(100) NOT NULL,
  `playlist_image` varchar(1000) NOT NULL,
  `playlist_desc` varchar(1000) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(1000) DEFAULT NULL,
  `meta_keyword` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`playlist_id`),
  KEY `section_id` (`section_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlist_id`, `playlist_name`, `playlist_image`, `playlist_desc`, `featured`, `section_id`, `category_id`, `meta_title`, `meta_desc`, `meta_keyword`) VALUES
(1, 'Mukhtar Nama', 'Mukhtar Nama_2_2.png', 'sdadasdsadsadasdasd', 1, 2, 2, 'asdsadsa', 'dasdsad', 'sadasdas'),
(2, 'Ruhullah', 'Ruhullah_1_4.jpg', 'Check', 1, 1, 4, 'meta title', 'meta description', 'meta keywords');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(25) NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_desc` varchar(1000) NOT NULL,
  `meta_keywords` varchar(1000) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `meta_title`, `meta_desc`, `meta_keywords`) VALUES
(1, 'Documentaries', '', '', ''),
(2, 'Movies', '', '', ''),
(3, 'Lectures', '', '', ''),
(4, 'Kids', '', '', ''),
(5, 'Gallery', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_name` varchar(100) NOT NULL,
  `embed_code` varchar(1000) NOT NULL,
  `language` varchar(50) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(1000) DEFAULT NULL,
  `meta_keyword` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`video_id`),
  KEY `playlist_id` (`playlist_id`),
  KEY `channel_id` (`channel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `video_name`, `embed_code`, `language`, `featured`, `playlist_id`, `channel_id`, `meta_title`, `meta_desc`, `meta_keyword`) VALUES
(5, 'Mukhtar Nama Episode-1', 'code of the video', 'URDU', 1, 1, 1, 'ch', 'ds', 'er'),
(6, 'Mukhtar Nama Episode-2', 'code of the video', 'URDU', 1, 1, 1, '', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`designer_id`) REFERENCES `designer` (`designer_id`),
  ADD CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`playlist_id`),
  ADD CONSTRAINT `videos_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`channel_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
