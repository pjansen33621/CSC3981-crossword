USE mpt_gaming;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user` varchar(30)  NOT NULL,
  `from_user` varchar(30) NOT NULL,
  `deleted` varchar(3) DEFAULT 'no',
  `sent_deleted` varchar(3) DEFAULT 'no',
  `message` varchar(1000),
  PRIMARY KEY (`id`)
);
