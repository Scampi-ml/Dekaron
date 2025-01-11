# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Feb 07, 2003 at 06:09 PM
# Server version: 3.23.53
# PHP Version: 4.2.3
# Database : `changelog`
# --------------------------------------------------------

#
# Table structure for table `updates`
#

CREATE TABLE updates (
  id int(11) NOT NULL auto_increment,
  version text NOT NULL,
  updateNotes text NOT NULL,
  updatedFiles text NOT NULL,
  poster text NOT NULL,
  date text NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

