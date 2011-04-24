-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2011 at 08:25 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `intelliradio`
--

-- --------------------------------------------------------

--
-- Table structure for table `containers`
--

CREATE TABLE IF NOT EXISTS `containers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `current_users` int(10) NOT NULL COMMENT 'The number of users who currently belong to this container',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `containers`
--

INSERT INTO `containers` (`id`, `name`, `current_users`) VALUES
(1, 'default', 0),
(2, 'rock', 0),
(3, 'classical', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `container` varchar(50) NOT NULL,
  `filename` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `name`, `artist`, `container`, `filename`) VALUES
(1, 'Mal Mitak', 'Kasun Kalhara', 'classical', 'mal_mitak-kasun_kalhara.3gp'),
(2, 'Sonduru Sithuwam', 'Kasun Kalhara', 'classical', 'sonduru_situwam-kasun_kalhara.3gp'),
(5, 'Chakithaya', 'Nemesis', 'default', 'chakithaya-nemesis.3gp'),
(6, 'Sonduriye', 'Amarasiri Peiris', 'default', 'sonduriye-amarasiri_peris.3gp'),
(7, 'New Divide', 'Linkin Park', 'rock', 'new_divide-linkin_park.3gp'),
(8, 'No More Sorrow', 'Linkin Park', 'rock', 'no_more_sorrow-linkin_park.3gp');

-- --------------------------------------------------------

--
-- Table structure for table `track_requests`
--

CREATE TABLE IF NOT EXISTS `track_requests` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `track_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `container` varchar(50) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `track_requests`
--

INSERT INTO `track_requests` (`request_id`, `track_id`, `user_id`, `container`) VALUES
(1, 1, 1, 'rock'),
(2, 3, 1, 'classical'),
(3, 4, 1, 'classical'),
(4, 3, 1, 'classical'),
(5, 3, 1, 'classical');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `container` varchar(100) NOT NULL COMMENT 'Id of the container',
  `user_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `container`, `user_ip`) VALUES
(1, 'ramindu', '81dc9bdb52d04dc20036dbd8313ed055', 'rock', '192.168.1.1'),
(2, 'thusira', 'bf1b05493c27f5bf307a28dcc6593fb9', 'rock', '192.168.1.1'),
(3, 'dilan', '99c5e07b4d5de9d18c350cdf64c5aa3d', 'default', '192.168.1.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
