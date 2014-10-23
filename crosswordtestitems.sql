/* This file creates the test mysql database (and hopefully a cross system mssql database).  The test database
itself only contains 10 words, which is less than what the final product will contain.  This file is so that the database
can be created on either system (windows or linux) quickly. */

CREATE DATABASE IF NOT EXISTS `crossword` /*!40100 DEFAULT CHARACTER SET utf8 */;
use `crossword`;
DROP TABLE IF EXISTS `wordsclues`;
CREATE TABLE `wordsclues` (
  `id` MEDIUMINT NOT NULL AUTO_INCREMENT,
  `words` varchar(30) NOT NULL,
  `clues` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Crossword words and clues.';

INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'Dowling', 'College in Oakdale, NY');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'pain', 'No ___ no gain');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'partial', 'Not complete');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'practice', 'What doctors do.. (they ___ medicine)');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'color', 'The opposite of black and white');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'darkness', 'Under the cover of ___');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'tooth', '___ and nail');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'heart', '___ and soul');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'hiccup', 'stereotyped sound someone makes when drunk');
INSERT INTO wordsclues (id, words, clues) VALUES (NULL, 'worthless', 'M$ SQL server')