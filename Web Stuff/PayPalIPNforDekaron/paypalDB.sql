
CREATE TABLE IF NOT EXISTS `paypal_logs` (
  `txn_id` varchar(32)  NOT NULL,
  `amount` decimal(4,2) NOT NULL,
  `email` varchar(64) NOT NULL,
  `account` varchar(34) NOT NULL,
  `coins` smallint(5) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY  (`txn_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;