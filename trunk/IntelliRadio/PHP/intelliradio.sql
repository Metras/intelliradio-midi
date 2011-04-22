-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2011 at 03:02 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `containers`
--

INSERT INTO `containers` (`id`, `name`, `current_users`) VALUES
(1, 'default', 0),
(2, 'rock', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `container` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tracks`
--


-- --------------------------------------------------------

--
-- Table structure for table `track_requests`
--

CREATE TABLE IF NOT EXISTS `track_requests` (
  `track_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `container_id` int(10) NOT NULL,
  PRIMARY KEY (`track_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_requests`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `container`, `user_ip`) VALUES
(1, 'ramindu', '81dc9bdb52d04dc20036dbd8313ed055', 'default', '192.168.1.1');
