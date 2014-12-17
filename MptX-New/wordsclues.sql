

CREATE TABLE IF NOT EXISTS `wordsclues` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `words` varchar(30) NOT NULL,
  `clues` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Crossword words and clues.' AUTO_INCREMENT=32 ;

--
-- Dumping data for table `wordsclues`
--

INSERT INTO `wordsclues` (`id`, `words`, `clues`) VALUES
(1, 'Dowling', 'Dowling'),
(2, 'pain', 'pain'),
(3, 'partial', 'partial'),
(4, 'practice', 'practice'),
(5, 'color', 'color'),
(6, 'darkness', 'darkness'),
(7, 'tooth', 'tooth'),
(8, 'heart', 'heart'),
(9, 'hiccup', 'hiccup'),
(10, 'worthless', 'worthless'),
(11, 'oakdale', 'oakdale'),
(12, 'american', 'american'),
(13, 'ape', 'ape'),
(14, 'money', 'money'),
(15, 'dog', 'dog'),
(16, 'maria', 'maria'),
(17, 'peter', 'peter'),
(18, 'ty', 'ty'),
(19, 'movie', 'movie'),
(20, 'car', 'car'),
(21, 'laptop', 'laptop'),
(22, 'games', 'games'),
(23, 'omg', 'omg'),
(24, 'database', 'database'),
(25, 'wrapper', 'wrapper'),
(26, 'pocket', 'pocket'),
(27, 'food', 'food'),
(28, 'phone', 'phone'),
(29, 'screen', 'screen'),
(30, 'mouse', 'mouse'),
(31, 'plug', 'plug');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
