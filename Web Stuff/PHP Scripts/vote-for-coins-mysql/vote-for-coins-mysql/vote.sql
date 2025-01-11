SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` bigint(11) NOT NULL auto_increment,
  `account` varchar(30) default NULL,
  `ip` varchar(30) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;


SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(11) NOT NULL auto_increment,
  `account` varchar(30) default NULL,
  `ip` varchar(30) default NULL,
  `date` datetime default NULL,
  `votes` bigint(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
