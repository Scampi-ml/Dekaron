SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


CREATE TABLE `acl_account_permissions` (
  `account_id` int(10) unsigned NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `value` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_id_permission_id` (`account_id`,`permission_name`,`module`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `acl_account_roles` (
  `account_id` int(11) unsigned NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  PRIMARY KEY (`account_id`,`role_name`),
  UNIQUE KEY `account_id_role_name` (`account_id`,`role_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `acl_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT '#FFFFFF',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `acl_groups` (`id`, `name`, `color`, `description`) VALUES
(1, 'Guest', '', 'Rank that the user get when they are not logged in.'),
(2, 'Player', '', 'Default player rank, the normal rank that you get when you are logged in.');

CREATE TABLE `acl_group_roles` (
  `group_id` int(10) unsigned NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  PRIMARY KEY (`group_id`,`role_name`,`module`),
  UNIQUE KEY `group_id_role_id` (`group_id`,`role_name`,`module`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `acl_roles` (
  `name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT '',
  PRIMARY KEY (`name`,`module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `acl_roles` (`name`, `module`, `description`) VALUES
('19', '--MENU--', '');

CREATE TABLE `acl_roles_permissions` (
  `role_name` varchar(50) NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `value` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_name`,`permission_name`,`module`),
  UNIQUE KEY `role_name_permission_name` (`role_name`,`permission_name`,`module`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `acl_roles_permissions` (`role_name`, `permission_name`, `module`, `value`) VALUES
('100', '100', '--MENU--', 1),
('101', '101', '--MENU--', 1),
('11', '11', '--MENU--', 1),
('13', '13', '--MENU--', 1),
('19', '19', '--MENU--', 1),
('2', '2', '--MENU--', 1),
('21', '21', '--MENU--', 1),
('5', '5', '--MENU--', 1),
('6', '6', '--MENU--', 1),
('8', '8', '--MENU--', 1);

CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` text,
  `content` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `articles` (`id`, `headline`, `content`, `timestamp`) VALUES
(1, 'Welcome to your new DekaronCMS powered website!', '<div>Your website has been successfully installed and we, the DekaronCMS team, sincerely hope that you will have a great time using it.</div>\n\n<div>To proceed, log into the <a href="/admin">administrator panel</a> using the following details:</div>\n\n<div>&nbsp;</div>\n\n<div><strong>Username:</strong> admin</div>\n\n<div><strong>Password:</strong> admin</div>\n\n<div>&nbsp;</div>\n\n<div>We strongly recommend you change this immediately!</div>\n\n<div>You can find this under &quot;Settings / Admin Login&quot;</div>\n\n<div>&nbsp;</div>\n\n<div>If you run into problems, please contact us via the <a href="http://www.dekaroncms.com/" target="_blank">DekaronCMS</a>.</div>\n\n<div>&nbsp;</div>\n\n<div>Best regards,</div>\n\n<div>The DekaronCMS team</div>\n', 1344607282);

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `image_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT '#',
  `text` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `image_slider` (`id`, `image`, `link`, `text`, `order`) VALUES
(1, '{path}slides/1.jpg', '', 'Example Text 1', 1),
(2, '{path}slides/2.jpg', '', 'Example Text 2', 2),
(3, '{path}slides/3.jpg', '', 'Example Text 3', 3),
(4, '{path}slides/4.jpg', '', 'Example Text 4', 4),
(5, '{path}slides/5.jpg', '', 'Example Text 5', 5);

CREATE TABLE `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text,
  `link` varchar(255) DEFAULT '#',
  `side` varchar(255) DEFAULT 'top',
  `order` int(11) DEFAULT NULL,
  `direct_link` tinyint(1) NOT NULL DEFAULT '0',
  `permission` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `menu` (`id`, `name`, `link`, `side`, `order`, `direct_link`, `permission`) VALUES
(1, 'Home', 'news', 'top', 1, 0, NULL),
(2, 'How to connect', 'page/connect', 'top', 3, 0, NULL),
(3, 'Home', 'news', 'side', 8, 0, NULL);

CREATE TABLE `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `author` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `version` int(10) DEFAULT NULL,
  `update` int(1) DEFAULT NULL,
  `enabled` int(1) DEFAULT NULL,
  `isadmin` int(11) DEFAULT NULL,
  `isucp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `modules` (`id`, `module_name`, `name`, `description`, `author`, `website`, `version`, `update`, `enabled`, `isadmin`, `isucp`) VALUES
(1, 'admin', 'Admin panel', 'Controls all functions & settings on the website', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/admin', 1, 0, 1, 1, 0),
(2, 'error', 'Error handler', 'Displays various errors and 404 errors', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/error', 1, 0, 1, 0, 0),
(3, 'logout', 'Log out', 'Clears users/admin sessions to make them log out', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/logout', 1, 0, 1, 0, 0),
(4, 'news', 'News', 'Displays server news to the users. Acts as front page', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/news', 1, 0, 1, 0, 0),
(5, 'page', 'Pages', 'Allows you to create custom pages', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/page', 1, 0, 1, 0, 0),
(6, 'sidebox', 'Sidebox', 'Create Sideboxes on your website', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/sidebox', 1, 0, 1, 0, 0),
(7, 'slider', 'Slider', 'Shows a slider on your website', 'Janvier123', 'http://www.dekaroncms.com/checkModuleVersion/check/slider', 1, 0, 1, 0, 0);

CREATE TABLE `module_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module_name` text,
  `key` text,
  `value` text,
  `default` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

INSERT INTO `module_config` (`id`, `module_name`, `key`, `value`, `default`) VALUES
(1, 'core', 'title', NULL, 'My Server'),
(2, 'core', 'server_name', NULL, 'Server Name'),
(3, 'core', 'keywords', NULL, 'dekaron,private server,pvp'),
(4, 'core', 'description', NULL, 'Best private server in the entire world!'),
(5, 'core', 'news_limit', NULL, '5'),
(6, 'core', 'connection_type', NULL, 'none'),
(7, 'core', 'api_server', NULL, NULL),
(8, 'core', 'api_http_user', NULL, NULL),
(9, 'core', 'api_http_pass', NULL, NULL),
(10, 'core', 'api_http_auth', NULL, NULL),
(11, 'core', 'api_debug', NULL, 'false'),
(12, 'core', 'admin_nickname', NULL, 'Administrator'),
(13, 'core', 'admin_username', NULL, 'admin'),
(14, 'core', 'admin_password', NULL, 'admin'),
(15, 'core', 'slider', NULL, 'true'),
(16, 'core', 'slider_home', NULL, 'home'),
(17, 'core', 'slider_interval', NULL, '3000'),
(18, 'core', 'slider_style', NULL, 'fade'),
(19, 'core', 'mssql_host', NULL, NULL),
(20, 'core', 'mssql_username', NULL, NULL),
(21, 'core', 'mssql_password', NULL, NULL),
(22, 'core', 'mssql_driver', NULL, 'sqlsrv'),
(23, 'core', 'api_ssl_verify_peer', NULL, NULL),
(24, 'core', 'api_send_cookies', NULL, NULL),
(25, 'core', 'api_api_name', NULL, NULL),
(26, 'core', 'api_api_key', NULL, NULL),
(27, 'core', 'api_ssl_cainfo', NULL, NULL),
(28, 'core', 'theme', NULL, 'default'),
(29, 'core', 'license_key', NULL, NULL),
(30, 'core', 'smtp_host', NULL, NULL),
(31, 'core', 'smtp_user', NULL, NULL),
(32, 'core', 'smtp_pass', NULL, NULL),
(33, 'core', 'smtp_port', NULL, NULL),
(34, 'core', 'version', NULL, '1.0');

CREATE TABLE `module_ucp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module_name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `module_ucp` (`id`, `module_name`) VALUES
(1, 'downloads');

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(50) NOT NULL,
  `name` text,
  `content` text,
  `permission` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `pages` (`id`, `identifier`, `name`, `content`, `permission`) VALUES
(1, 'connect', 'How to connect', '<h2><span>What is Lorem Ipsum?</span></h2><p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', NULL);

CREATE TABLE `sideboxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL DEFAULT '',
  `displayName` text,
  `order` int(11) DEFAULT '100',
  `permission` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `sideboxes_custom` (
  `sidebox_id` int(10) NOT NULL,
  `content` text NOT NULL,
  UNIQUE KEY `sidebox_id` (`sidebox_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `acl_group_roles`
  ADD CONSTRAINT `acl_group_roles_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `acl_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sideboxes_custom`
  ADD CONSTRAINT `sideboxes_custom_ibfk_1` FOREIGN KEY (`sidebox_id`) REFERENCES `sideboxes` (`id`) ON DELETE CASCADE;
