# phpMyAdmin SQL Dump
# version 2.5.7-pl1
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Mar 22, 2005 at 10:28 PM
# Server version: 4.0.13
# PHP Version: 4.3.9
# 
# Database : `xpoll`
# 

# --------------------------------------------------------

#
# Table structure for table `blocked`
#

CREATE TABLE `blocked` (
  `blockedid` int(8) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `polls` longtext NOT NULL
) TYPE=MyISAM;

#
# Dumping data for table `blocked`
#


# --------------------------------------------------------

#
# Table structure for table `ip`
#

CREATE TABLE `ip` (
  `ipid` int(8) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `vote` int(15) NOT NULL default '0',
  PRIMARY KEY  (`ipid`)
) TYPE=MyISAM;

#
# Dumping data for table `ip`
#


# --------------------------------------------------------

#
# Table structure for table `options`
#

CREATE TABLE `options` (
  `optionid` int(8) NOT NULL default '0',
  `pollid` int(8) NOT NULL default '0',
  `options` varchar(255) NOT NULL default '',
  `images` varchar(255) NOT NULL default '',
  `votes` int(8) NOT NULL default '0',
  `order_id` int(8) NOT NULL default '0',
  PRIMARY KEY  (`optionid`)
) TYPE=MyISAM;

#
# Dumping data for table `options`
#


# --------------------------------------------------------

#
# Table structure for table `polls`
#

CREATE TABLE `polls` (
  `pollid` int(8) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `starts` varchar(10) NOT NULL default '',
  `expires` varchar(10) NOT NULL default '',
  `vote` int(15) NOT NULL default '0',
  `voting` char(3) NOT NULL default '',
  `results` char(3) NOT NULL default '',
  `graph` char(3) NOT NULL default '',
  `resultsvotes` char(3) NOT NULL default '',
  `ip` char(3) NOT NULL default '',
  `cookies` char(3) NOT NULL default '',
  `subdate` varchar(10) NOT NULL default '',
  `status` char(3) NOT NULL default '',
  PRIMARY KEY  (`pollid`)
) TYPE=MyISAM;

#
# Dumping data for table `polls`
#

