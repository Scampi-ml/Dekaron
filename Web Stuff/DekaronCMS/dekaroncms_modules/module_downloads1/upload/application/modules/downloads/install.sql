CREATE TABLE IF NOT EXISTS `downloads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `download_name` text,
  `download_link` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;


INSERT INTO `downloads` (`id`, `download_name`, `download_link`) VALUES
(1, 'Client (Google Mirror)', 'http://www.google.com/client.zip'),
(2, 'Client (Yahoo Mirror)', 'http://www.yahoo.com/client.zip'),
(3, 'Client (Firedrive Mirror)', 'http://www.firedrive.com/client.zip'),
(4, 'Client (Rapidshare Mirror)', 'http://www.rapidshare.com/client.zip'),
(6, 'Client (Mega Mirror)', 'http://www.mega.com/client.zip');