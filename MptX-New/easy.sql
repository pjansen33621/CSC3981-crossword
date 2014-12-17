-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2014 at 06:00 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mpt_gaming`
--

-- --------------------------------------------------------

--
-- Table structure for table `easy`
--

CREATE TABLE IF NOT EXISTS `easy` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `words` varchar(30) NOT NULL,
  `clues` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Crossword words and clues.' AUTO_INCREMENT=32 ;

--
-- Dumping data for table `wordsclues`
--

INSERT INTO `easy` (`id`, `words`, `clues`) VALUES
(1, 'went', 'Yesterday, I ____ to the store.'),
(2, 'ate', 'This morning, I ___ breakfast.'),
(3, 'alldone', 'When I finished the exam, I yelled out that I was ____ ____.'),
(4, 'apple', 'Red fruit students often give to teachers.'),
(5, 'pineapple', 'Hawaiian pizza = _____ & ham.'),
(6, 'cherry', 'Red fruit that looks like grapes.'),
(7, 'banana', 'Yellow fruit eaten by monkeys.'),
(8, 'orange', '_____ juice (hint: breakfast beverage / color)');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
