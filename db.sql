
CREATE TABLE `administrators` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` tinytext,
  `gender` enum('M','F') DEFAULT 'M',
  `active` enum('Yes','No') DEFAULT 'Yes',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `sequence` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UserName` (`username`),
  KEY `Password` (`id`,`username`,`password`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `administrators` VALUES (1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', NULL, NULL, NULL, 'M', 'Yes', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `ads_category`
-- 

CREATE TABLE `ads_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `active` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `ads_category`
-- 

INSERT INTO `ads_category` VALUES (1, 'Generic', 'Yes');

-- --------------------------------------------------------

-- 
-- Table structure for table `advertisements`
-- 

CREATE TABLE `advertisements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `size` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `categoryname` int(11) DEFAULT NULL,
  `totalimpressions` bigint(20) unsigned NOT NULL DEFAULT '0',
  `impressionleft` int(11) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `target_country` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `target_category` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `active` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  `startdate` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `enddate` varchar(20) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client` (`client`,`size`,`target_country`,`target_category`),
  KEY `startdate` (`startdate`,`enddate`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=22 ;


-- 
-- Table structure for table `captcha`
-- 

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `captcha`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `registered_users`
-- 

CREATE TABLE `registered_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` tinytext,
  `zipcode` varchar(20) DEFAULT NULL,
  `gender` enum('U','M','F') DEFAULT 'U',
  `active` enum('Yes','No') DEFAULT 'Yes',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ipposted` varchar(20) DEFAULT NULL,
  `sequence` int(11) unsigned DEFAULT NULL,
  `paid` enum('No','Yes') NOT NULL DEFAULT 'No',
  `subyears` int(11) NOT NULL DEFAULT '0',
  `startdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UserName` (`username`),
  UNIQUE KEY `username_2` (`username`),
  KEY `Password` (`id`,`username`,`password`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- 
-- Table structure for table `system_configuration`
-- 

CREATE TABLE `system_configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `config_key` varchar(255) NOT NULL,
  `config_value` text NOT NULL,
  `active` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `system_configuration`
-- 

