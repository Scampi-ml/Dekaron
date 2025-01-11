CREATE TABLE IF NOT EXISTS `donate_paypal_transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_status` varchar(50) NOT NULL,
  `payment_amount` double NOT NULL,
  `payment_currency` varchar(10) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `coins` int(11) DEFAULT '0',
  `error` text,
  `timestamp` int(11) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `donate_paypal_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` text,
  `coins` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;


INSERT INTO `donate_paypal_items` (`id`, `price`, `coins`) VALUES
(1, '10', 10000),
(2, '20', 20000),
(3, '30', 30000),
(4, '40', 40000),
(5, '50', 50000),
(6, '60', 60000),
(7, '70', 70000),
(8, '80', 80000),
(9, '90', 90000),
(10, '100', 100000);


INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_clientSecret', NULL, NULL);
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_clientId', NULL, NULL);
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_mode', 'sandbox', 'sandbox');
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_ConnectionTimeOut', 30, 30);
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_LogEnabled', 'true', 'true');
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_LogLevel', 'FINE', 'FINE');
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_validationLevel', 'log', 'log');
INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES (NULL, 'donate_paypal', 'paypal_currency', 'USD', 'USD');